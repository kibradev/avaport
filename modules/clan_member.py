import asyncio
from modules.base_module import Module
from modules.location import refresh_avatar

class_name = "ClanMember"


class ClanMember(Module):
    prefix = "clmb"

    def __init__(self, server):
        self.server = server
        self.clan = server.modules["cln"]
        self.commands = {"lvc": self.leave_clan,
                         "rmm": self.remove_member,
                         "chr": self.change_role}

    def leave_clan(self, msg, client):
        r = self.server.redis
        cid = r.get(f"uid:{client.uid}:clan")
        if not cid:
            return
        if client.uid == r.get(f"clans:{cid}:owner"):
            return
        self.clan.leave_clan(cid, client.uid)
        cn = self.server.modules["cn"]
        cn.add_action(cid, f"{client.uid}_1")
        client.send(["ntf.cli", {"cli": None}])
        loop = asyncio.get_event_loop()
        loop.create_task(refresh_avatar(client, self.server))

    def remove_member(self, msg, client):
        r = self.server.redis
        uid = msg[2]["uid"]
        cid = r.get(f"uid:{client.uid}:clan")
        if not cid:
            return
        role = int(r.get(f"clans:{cid}:m:{client.uid}:role"))
        sec_role = int(r.get(f"clans:{cid}:m:{uid}:role"))
        if sec_role >= role:
            if client.uid != r.get(f"clans:{cid}:owner"):
                return
        self.clan.leave_clan(cid, uid)
        cn = self.server.modules["cn"]
        cn.add_action(cid, f"{uid}_1_{client.uid}")
        if uid in self.server.online:
            tmp = self.server.online[uid]
            tmp.send(["ntf.cli", {"cli": None}])
            loop = asyncio.get_event_loop()
            loop.create_task(refresh_avatar(tmp, self.server))

    def change_role(self, msg, client):
        r = self.server.redis
        uid = msg[2]["uid"]
        rl = msg[2]["rl"]
        cid = r.get(f"uid:{client.uid}:clan")
        if not cid:
            return
        role = int(r.get(f"clans:{cid}:m:{client.uid}:role"))
        sec_role = int(r.get(f"clans:{cid}:m:{uid}:role"))
        if sec_role >= role:
            if client.uid != r.get(f"clans:{cid}:owner"):
                return
        if rl >= role or rl < 0:
            return
        r.set(f"clans:{cid}:m:{uid}:role", rl)
        messages = [["cln.ucm", {"cmr": {"uid": uid, "jd": 1, "rl": rl,
                                         "cam": {"ah": [], "cid": 0, "ap": 0},
                                         "ccn": 0}}]]
        if rl == 3:
            r.set(f"clans:{cid}:m:{client.uid}:role", 2)
            r.set(f"clans:{cid}:owner", uid)
            messages.append(["cln.ucm", {"cmr": {"uid": client.uid, "jd": 1,
                                                 "rl": 2, "cam": {"ah": [],
                                                                  "cid": 0,
                                                                  "ap": 0},
                                                 "ccn": 0}}])
        loop = asyncio.get_event_loop()
        for uid in r.smembers(f"clans:{cid}:m"):
            if uid in self.server.online:
                tmp = self.server.online[uid]
                for msg in messages:
                    loop.create_task(tmp.send(msg))
