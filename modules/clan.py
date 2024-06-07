import asyncio
import time
from modules.base_module import Module
from modules.location import refresh_avatar

class_name = "Clan"


class Clan(Module):
    prefix = "cln"

    def __init__(self, server):
        self.server = server
        self.commands = {"grci": self.get_random_clan_ids,
                         "crt": self.create,
                         "lcmids": self.load_clans,
                         "dcl": self.dismiss,
                         "lccmsg": self.load_clan_chat_message}

    def get_random_clan_ids(self, msg, client):
        clans = self.server.redis.srandmember("clans", 50)
        cids = []
        for cid in clans:
            cids.append(cid)
        client.send(["cln.grci", {"clid": msg[2]["clid"], "cids": cids}])

    def create(self, msg, client):
        r = self.server.redis
        has_clan = r.get(f"uid:{client.uid}:clan")
        if has_clan:
            return
        clans = r.smembers("clans")
        cid = 1
        while str(cid) in clans:
            cid += 1
        create_date = int(time.time())
        user_data = self.server.get_user_data(client.uid)
        pipe = r.pipeline()
        pipe.sadd("clans", cid)
        pipe.set(f"clans:{cid}:icon", msg[2]["cin"])
        pipe.set(f"clans:{cid}:name", msg[2]["ctl"])
        pipe.set(f"clans:{cid}:tag", msg[2]["ctg"])
        pipe.set(f"clans:{cid}:pin", msg[2]["pc"])
        lvl = 9
        pipe.set(f"clans:{cid}:lvl", lvl)
        pipe.set(f"clans:{cid}:room", msg[2]["rtid"])
        pipe.set(f"clans:{cid}:create_date", create_date)
        pipe.set(f"clans:{cid}:owner", client.uid)
        pipe.sadd(f"clans:{cid}:m", client.uid)
        pipe.set(f"clans:{cid}:m:{client.uid}:role", 3)
        pipe.set(f"uid:{client.uid}:clan", cid)
        pipe.execute()
        cinv = {"c": {"cfrn": {"id": "cfrn", "it": []},
                      "crc": {"id": "crc", "it": []}}}
        act = r.get(f"uid:{client.uid}:act")
        if act:
            act = int(act)
        else:
            act = 0
        members = {client.uid: {"uid": client.uid, "jd": create_date, "rl": 3,
                                "cam": {"ah": [], "cid": 1, "ap": act},
                                "cid": cid, "ccn": 0}}
        client.send(["ntf.cli", {"cli": {"tg": msg[2]["ctg"],
                                               "icn": msg[2]["cin"],
                                               "acv": 0, "ctl": msg[2]["ctl"],
                                               "clv": 1, "crl": 3, "crst": 0,
                                               "cid": cid}}])
        tmp = {"cinv": cinv, "st": 0, "mmbs": members, "lvl": lvl,
               "crid": client.uid, "ttl": msg[2]["ctl"], "ccn": 0,
               "pvt": False, "crdt": create_date, "tg": msg[2]["ctg"],
               "icn": msg[2]["cin"], "clrtg": 0, "hpc": True, "id": cid}
        act = self.server.modules["ca"]._get_rating(cid)
        tmp["actvtmdl"] = {"cca": act, "ccpawdendtm": 0, "mcid": 1,
                           "ccedt": int(time.time())+(60*60*24*30),
                           "mced": int(time.time())+(60*60*24*30), "ccid": 2,
                           "ccpawd": 0}
        client.send(["cln.crt", {"scs": True, "clm": tmp,
                                       "nl": {"adv": "", "nl": []}}])
        refresh_avatar(client, self.server)

    def dismiss(self, msg, client):
        r = self.server.redis
        cid = r.get(f"uid:{client.uid}:clan")
        if not cid:
            return
        clan = self.get_clan(cid)
        if clan["members"][client.uid]["role"] != 3:
            return
        if msg[2]["pc"] != clan["pin"]:
            return client.send(["cln.dcl", {"scs": False}])
        pipe = r.pipeline()
        pipe.delete(f"clans:{cid}:icon")
        pipe.delete(f"clans:{cid}:name")
        pipe.delete(f"clans:{cid}:tag")
        pipe.delete(f"clans:{cid}:pin")
        pipe.delete(f"clans:{cid}:room")
        pipe.delete(f"clans:{cid}:create_date")
        pipe.delete(f"clans:{cid}:owner")
        pipe.delete(f"clans:{cid}:adv")
        for uid in clan["members"]:
            pipe.delete(f"clans:{cid}:m:{uid}:role")
            pipe.delete(f"uid:{uid}:clan")
        pipe.delete(f"clans:{cid}:m")
        req = []
        for uid in r.smembers(f"clans:{cid}:req"):
            pipe.delete(f"uid:{uid}:req")
            req.append(uid)
        pipe.delete(f"clans:{cid}:req")
        for action in r.lrange(f"clans:{cid}:actions", 0, -1):
            pipe.delete(f"clans:{cid}:actions:{action}")
        pipe.delete(f"clans:{cid}:action")
        pipe.srem("clans", cid)
        pipe.execute()
        loop = asyncio.get_event_loop()
        for uid in req:
            if uid in self.server.online:
                tmp = self.server.online[uid]
                loop.create_task(tmp.send(["crq.dlr", {"rid": uid}]))
        for uid in clan["members"]:
            if uid in self.server.online:
                tmp = self.server.online[uid]
                loop.create_task(tmp.send(["ntf.cli", {"cli": None}]))
                loop.create_task(refresh_avatar(tmp, self.server))
        client.send(["cln.dcl", {"scs": True}])

    def load_clans(self, msg, client):
        inv = {"c": {"cfrn": {"id": "cfrn", "it": []},
                     "crc": {"id": "crc", "it": []}}}
        clans = []
        for cid in msg[2]["cids"]:
            clan = self.get_clan(cid)
            if not clan:
                continue
            members = {}
            for member in clan["members"]:
                act = self.server.redis.get(f"uid:{member}:act")
                if act:
                    act = int(act)
                else:
                    act = 0
                members[member] = {"uid": member, "jd": 1,
                                   "rl": clan["members"][member]["role"],
                                   "ccm": {"glhs": [], "ctid": 0, "glr": 0,
                                           "lgct": 0},
                                   "cam": {"ah": [], "cid": 1, "ap": act},
                                   "ccn": 0}
            tmp = {"cinv": inv, "st": 0, "mmbs": members, "lvl": clan["lvl"],
                   "crid": clan["owner"], "ttl": clan["name"], "ccn": 0,
                   "pvt": False, "crdt": clan["create_date"], "id": cid,
                   "tg": clan["tag"], "icn": clan["icon"], "clrtg": 0,
                   "hpc": True}
            act = self.server.modules["ca"]._get_rating(cid)
            tmp["actvtmdl"] = {"cca": act, "ccpawdendtm": 0, "mcid": 1,
                               "ccedt": int(time.time())+(60*60*24*30),
                               "mced": int(time.time())+(60*60*24*30),
                               "ccid": 2, "ccpawd": 0}
            clans.append(tmp)
        client.send(["cln.lcmids", {"clms": clans,
                                          "clid": msg[2]["clid"]}])

    def load_clan_chat_message(self, msg, client):
        # TODO последние сообщения в клане
        return

    def get_clan(self, cid):
        r = self.server.redis
        pipe = r.pipeline()
        pipe.get(f"clans:{cid}:name")
        pipe.get(f"clans:{cid}:tag")
        pipe.get(f"clans:{cid}:icon")
        pipe.get(f"clans:{cid}:room")
        pipe.get(f"clans:{cid}:owner")
        pipe.get(f"clans:{cid}:create_date")
        pipe.get(f"clans:{cid}:pin")
        pipe.get(f"clans:{cid}:lvl")
        result = pipe.execute()
        if not result[5]:
            return
        members = {}
        for member in r.smembers(f"clans:{cid}:m"):
            role = r.get(f"clans:{cid}:m:{member}:role")
            members[member] = {"role": int(role)}
        return {"name": result[0], "tag": result[1], "icon": result[2],
                "room": result[3], "members": members, "owner": result[4],
                "create_date": int(result[5]), "pin": result[6],
                "lvl": int(result[7])}

    def join_clan(self, cid, uid):
        rid = int(uid)
        r = self.server.redis
        r.set(f"uid:{uid}:clan", cid)
        r.sadd(f"clans:{cid}:m", uid)
        r.set(f"clans:{cid}:m:{uid}:role", 0)
        clan = self.get_clan(cid)
        if uid in self.server.online:
            tmp = self.server.online[uid]
            tmp.send(["ntf.cli", {"cli": {"tg": clan["tag"],
                                                "icn": clan["icon"], "acv": 0,
                                                "ctl": clan["name"], "clv": 1,
                                                "crl": 0, "crst": 0,
                                                "cid": int(cid)}}])
            tmp.send(["crq.alr", {"rid": rid}])
            loop = asyncio.get_event_loop()
            loop.create_task(refresh_avatar(tmp, self.server))
        act = self.server.redis.get(f"uid:{uid}:act")
        if act:
            act = int(act)
        else:
            act = 0
        message = ["clmb.adm", {"clmr": {"uid": uid, "jd": 1, "rl": 0,
                                         "cam": {"ah": [], "cid": 1,
                                                 "ap": act},
                                         "cid": int(cid), "ccn": 0}}]
        inv = {"c": {"cfrn": {"id": "cfrn", "it": []},
                     "crc": {"id": "crc", "it": []}}}
        members = {}
        for member in clan["members"]:
            act = self.server.redis.get(f"uid:{member}:act")
            if act:
                act = int(act)
            else:
                act = 0
            members[member] = {"uid": member, "jd": 1,
                               "rl": clan["members"][member]["role"],
                               "cam": {"ah": [], "cid": 1, "ap": act},
                               "ccn": 0}
        tmp = {"cinv": inv, "st": 0, "mmbs": members, "lvl": clan["lvl"],
               "crid": clan["owner"], "ttl": clan["name"], "ccn": 0,
               "pvt": False, "crdt": clan["create_date"], "tg": clan["tag"],
               "icn": clan["icon"], "clrtg": 0, "hpc": True, "id": int(cid)}
        act = self.server.modules["ca"]._get_rating(cid)
        tmp["actvtmdl"] = {"cca": act, "ccpawdendtm": 0, "mcid": 1,
                           "ccedt": int(time.time())+(60*60*24*30),
                           "mced": int(time.time())+(60*60*24*30),
                           "ccid": 0, "ccpawd": 0}
        message2 = ["cln.upc", {"clm": tmp}]
        for member in clan["members"]:
            if member in self.server.online:
                tmp = self.server.online[member]
                loop = asyncio.get_event_loop()
                loop.create_task(tmp.send(message))
                loop.create_task(tmp.send(message2))
                if clan["members"][member]["role"] > 1:
                    loop.create_task(tmp.send(["crq.alr", {"rid": rid}]))

    def leave_clan(self, cid, uid):
        r = self.server.redis
        members = (self.get_clan(cid))["members"]
        pipe = r.pipeline()
        pipe.delete(f"uid:{uid}:clan")
        pipe.delete(f"clans:{cid}:m:{uid}:role")
        pipe.srem(f"clans:{cid}:m", uid)
        pipe.execute()
        inv = {"c": {"cfrn": {"id": "cfrn", "it": []},
                     "crc": {"id": "crc", "it": []}}}
        clan = self.get_clan(cid)
        members = {}
        for member in clan["members"]:
            act = self.server.redis.get(f"uid:{member}:act")
            if act:
                act = int(act)
            else:
                act = 0
            members[member] = {"uid": member, "jd": 1,
                               "rl": clan["members"][member]["role"],
                               "cam": {"ah": [], "cid": 1, "ap": act},
                               "cid": cid, "ccn": 0}
        tmp = {"cinv": inv, "st": 0, "mmbs": members, "lvl": clan["lvl"],
               "crid": clan["owner"], "ttl": clan["name"], "ccn": 0,
               "pvt": False, "crdt": clan["create_date"], "tg": clan["tag"],
               "icn": clan["icon"], "clrtg": 0, "hpc": True, "id": int(cid)}
        act = self.server.modules["ca"]._get_rating(cid)
        tmp["actvtmdl"] = {"cca": act, "ccpawdendtm": 0, "mcid": 1,
                           "ccedt": int(time.time())+(60*60*24*30),
                           "mced": int(time.time())+(60*60*24*30),
                           "ccid": 0, "ccpawd": 0}
        message = ["cln.upc", {"clm": tmp}]
        loop = asyncio.get_event_loop()
        for member in members:
            if member in self.server.online:
                tmp = self.server.online[member]
                loop.create_task(tmp.send(message))
                loop.create_task(tmp.send(["clmb.lvc", {"uid": uid}]))
