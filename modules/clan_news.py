import time
import asyncio
from modules.base_module import Module

class_name = "ClanNews"


class ClanNews(Module):
    prefix = "cn"

    def __init__(self, server):
        self.server = server
        self.commands = {"cadv": self.set_adv, "gcnl": self.get_adv}

    def set_adv(self, msg, client):
        adv = msg[2]["adv"]
        r = self.server.redis
        cid = r.get(f"uid:{client.uid}:clan")
        if not cid:
            return
        role = int(r.get(f"clans:{cid}:m:{client.uid}:role"))
        if role < 3:
            return
        r.set(f"clans:{cid}:adv", adv)
        loop = asyncio.get_event_loop()
        for uid in r.smembers(f"clans:{cid}:m"):
            if uid in self.server.online:
                tmp = self.server.online[uid]
                loop.create_task(tmp.send(["cn.acdv", {"scs": True,
                                                       "adv": adv}]))

    def get_adv(self, msg, client):
        r = self.server.redis
        cid = r.get(f"uid:{client.uid}:clan")
        if not cid:
            return
        adv = r.get(f"clans:{cid}:adv")
        if not adv:
            adv = ""
        nl = []
        for action in r.lrange(f"clans:{cid}:actions", 0, -1):
            date = int(r.get(f"clans:{cid}:actions:{action}"))
            tmp = action.split("_")
            uid = tmp[0]
            ul = True if tmp[1] == "1" else False
            kuid = tmp[2] if len(tmp) == 3 else None
            nl.append({"uid": uid, "d": date, "ul": ul, "kuid": kuid, "tp": 0})
        client.send(["cn.gcnl", {"nl": {"adv": adv, "nl": nl}}])

    def add_action(self, cid, action):
        r = self.server.redis
        if r.llen(f"clans:{cid}:actions") >= 10:
            last = r.rpop(f"clans:{cid}:actions")
            r.delete(f"clans:{cid}:actions:{last}")
        date = int(time.time())
        r.set(f"clans:{cid}:actions:{action}", date)
        r.lpush(f"clans:{cid}:actions", action)
        tmp = action.split("_")
        uid = tmp[0]
        ul = True if tmp[1] == "1" else False
        kuid = tmp[2] if len(tmp) == 3 else None
        n = {"uid": uid, "d": date, "ul": ul, "kuid": kuid, "tp": 0}
        loop = asyncio.get_event_loop()
        for uid in r.smembers(f"clans:{cid}:m"):
            if uid in self.server.online:
                tmp = self.server.online[uid]
                loop.create_task(tmp.send(["cn.gcn", {"n": n}]))
