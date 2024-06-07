import time
import operator
import asyncio
from modules.base_module import Module

class_name = "ClanActivity"


class ClanActivity(Module):
    prefix = "ca"

    def __init__(self, server):
        self.server = server
        self.commands = {"gam": self.get_activity_members,
                         "gcart": self.get_activity_top}
        self.top = []
        self.update_time = 0
        self.updating = False

    def get_activity_members(self, msg, client):
        cid = self.server.redis.get(f"uid:{client.uid}:clan")
        if not cid:
            return
        global_act = self._get_rating(cid)
        end_time = int(time.time())+(60*60*24*30)
        client.send(["ca.gam", {"cam": {"cca": global_act,
                                              "ccpawdendtm": 0, "mcid": 1,
                                              "ccedt": end_time, "ccid": 2,
                                              "mced": end_time, "ccpawd": 0,
                                              "mca": global_act}}])

    def get_activity_top(self, msg, client):
        client.send(["ca.gcart", {"cartuids": self.top, "carendtm": 0}])
        if time.time() - self.update_time > 10 * 60 and not self.updating:
            self.update_time = time.time()

    def _get_rating(self, cid):
        members = self.server.redis.smembers(f"clans:{cid}:m")
        global_act = 0
        for uid in members:
            act = self.server.redis.get(f"uid:{uid}:act")
            if not act:
                continue
            global_act += int(act)
        return global_act

    def _update_top(self):
        self.updating = True
        clans = self.server.redis.smembers("clans")
        rating = {}
        for cid in clans:
            tmp = self._get_rating(cid)
            if not tmp:
                continue
            rating[cid] = tmp
        sorted_clans = sorted(rating.items(), key=operator.itemgetter(1),
                              reverse=True)
        top = []
        i = 1
        for clan in sorted_clans:
            top.append(clan[0])
            if i == 20:
                break
            i += 1
        self.top = top
        self.update_time = time.time()
        self.updating = False
