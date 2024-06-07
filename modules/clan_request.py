import time
from modules.base_module import Module

class_name = "ClanRequest"


class ClanRequest(Module):
    prefix = "crq"

    def __init__(self, server):
        self.server = server
        self.clan = server.modules["cln"]
        self.commands = {"lrui": self.load_requests,
                         "lrci": self.load_clan_requests,
                         "crr": self.create_request,
                         "dlr": self.delete_request,
                         "alr": self.approve_request}

    def load_requests(self, msg, client):
        cid = self.server.redis.get(f"uid:{client.uid}:req")
        if not cid:
            return client.send(["crq.lrq", {"rqls": []}])
        client.send(["crq.lrq", {"rqls": [{"uid": client.uid, "crd": 1,
                                                 "src": 0,
                                                 "rid": int(client.uid),
                                                 "cid": cid}]}])

    def load_clan_requests(self, msg, client):
        r = self.server.redis
        cid = r.get(f"uid:{client.uid}:clan")
        role = int(r.get(f"clans:{cid}:m:{client.uid}:role"))
        if role < 2:
            return
        requests = []
        for rid in r.smembers(f"clans:{cid}:req"):
            requests.append({"uid": int(rid), "crd": 1, "src": 0,
                             "rid": int(rid), "cid": int(cid)})
        client.send(["crq.lrq", {"rqls": requests}])

    def create_request(self, msg, client):
        r = self.server.redis
        if r.get(f"uid:{client.uid}:clan"):
            return
        if r.get(f"uid:{client.uid}:req"):
            return
        cid = msg[2]["cid"]
        if str(cid) not in r.smembers("clans"):
            return
        r.sadd(f"clans:{cid}:req", client.uid)
        r.set(f"uid:{client.uid}:req", cid)
        client.send(["crq.crr", {"scs": True,
                                       "rqst": {"uid": client.uid,
                                                "crd": int(time.time()),
                                                "src": 0, "cid": cid,
                                                "rid": int(client.uid)}}])
        clan = self.clan.get_clan(cid)
        for uid in clan["members"]:
            if clan["members"][uid]["role"] < 2:
                continue
            if uid in self.server.online:
                tmp = self.server.online[uid]
                tmp.send(["crq.dlr", {"rid": client.uid}])
                tmp.send(["crq.crr", {"scs": True,
                                            "rqst": {"uid": client.uid,
                                                     "crd": int(time.time()),
                                                     "src": 0, "cid": cid,
                                                     "rid": int(client.uid)}}])

    def delete_request(self, msg, client):
        r = self.server.redis
        rid = msg[2]["rid"]
        if str(rid) == client.uid:
            cid = r.get(f"uid:{client.uid}:req")
        else:
            cid = r.get(f"uid:{client.uid}:clan")
        if not cid:
            return
        if str(rid) != client.uid:
            role = int(r.get(f"clans:{cid}:m:{client.uid}:role"))
            if role < 2:
                return
        if str(rid) not in r.smembers(f"clans:{cid}:req"):
            return
        r.srem(f"clans:{cid}:req", rid)
        r.delete(f"uid:{rid}:req")
        if str(rid) in self.server.online:
            tmp = self.server.online[str(rid)]
            tmp.send(["crq.dlr", {"rid": rid}])
        clan = self.clan.get_clan(cid)
        for uid in clan["members"]:
            if clan["members"][uid]["role"] < 2:
                continue
            if uid in self.server.online:
                tmp = self.server.online[uid]
                tmp.send(["crq.dlr", {"rid": rid}])

    def approve_request(self, msg, client):
        r = self.server.redis
        uid = str(msg[2]["rid"])
        cid = r.get(f"uid:{client.uid}:clan")
        role = int(r.get(f"clans:{cid}:m:{client.uid}:role"))
        if role < 2:
            return
        if uid not in r.smembers(f"clans:{cid}:req"):
            return
        r.srem(f"clans:{cid}:req", uid)
        r.delete(f"uid:{uid}:req")
        self.clan.join_clan(cid, uid)
        cn = self.server.modules["cn"]
        cn.add_action(cid, f"{uid}_0")
