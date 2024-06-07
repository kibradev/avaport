from modules.base_module import Module

class_name = "Shop"


class Shop(Module):
    prefix = "sh"

    def __init__(self, server):
        self.server = server
        self.commands = {"bji": self.buy_joke_item , "bsrg": self.buy_ski_resort_gift, "bwr": self.al_yuzuk }

    def buy_joke_item(self, msg, client):
        item = msg[2]["tpid"]
        cnt = msg[2]["cnt"]
        if item not in self.server.game_items["game"]:
            return
        gold = self.server.game_items["game"][item]["gold"]*cnt
        silver = self.server.game_items["game"][item]["silver"]*cnt
        user_data = self.server.get_user_data(client.uid)
        if user_data["gld"] < gold or user_data["slvr"] < silver:
            return
        redis = self.server.redis
        redis.set(f"uid:{client.uid}:gld", user_data["gld"]-gold)
        redis.set(f"uid:{client.uid}:slvr", user_data["slvr"]-silver)
        self.server.inv[client.uid].add_item(item, "gm", cnt)
        cnt = int(redis.lindex(f"uid:{client.uid}:items:{item}", 1))
        client.send(["ntf.inv", {"it": {"c": cnt, "lid": "", "tid": item}}])
        user_data = self.server.get_user_data(client.uid)
        client.send(["ntf.res", {"res": {"gld": user_data["gld"],
                                         "slvr": user_data["slvr"],
                                         "enrg": user_data["enrg"],
                                         "emd": user_data["emd"]}}])



    def buy_ski_resort_gift(self, msg, client):
        item = msg[2]["tpid"]
        cnt = msg[2]["cnt"]
        if item not in self.server.game_items["game"]:
            return
        gold = self.server.game_items["game"][item]["gold"]*cnt
        silver = self.server.game_items["game"][item]["silver"]*cnt
        user_data = self.server.get_user_data(client.uid)
        if user_data["gld"] < gold or user_data["slvr"] < silver:
            return
        redis = self.server.redis
        redis.set(f"uid:{client.uid}:gld", user_data["gld"]-gold)
        redis.set(f"uid:{client.uid}:slvr", user_data["slvr"]-silver)
        self.server.inv[client.uid].add_item(item, "gm", cnt)
        cnt = int(redis.lindex(f"uid:{client.uid}:items:{item}", 1))
        client.send(["ntf.inv", {"it": {"c": cnt, "lid": "", "tid": item}}])
        user_data = self.server.get_user_data(client.uid)
        client.send(["ntf.res", {"res": {"gld": user_data["gld"],
                                         "slvr": user_data["slvr"],
                                         "enrg": user_data["enrg"],
                                         "emd": user_data["emd"]}}])
        client.send(["cp.ms.rsm", {"txt": f"Bir kutu satın alındı!"}])

    def al_yuzuk(self, msg, client):
        item = msg[2]["tpid"]
        cnt = 1
        if item not in self.server.game_items["game"]:
            return
        gold = self.server.game_items["game"][item]["gold"]*cnt
        silver = self.server.game_items["game"][item]["silver"]*cnt
        user_data = self.server.get_user_data(client.uid)
        if user_data["gld"] < gold or user_data["slvr"] < silver:
            return
        redis = self.server.redis
        redis.set(f"uid:{client.uid}:gld", user_data["gld"]-gold)
        redis.set(f"uid:{client.uid}:slvr", user_data["slvr"]-silver)
        self.server.inv[client.uid].add_item(item, "gm", cnt)
        cnt = int(redis.lindex(f"uid:{client.uid}:items:{item}", 1))
        client.send(["ntf.inv", {"it": {"c": cnt, "lid": "", "tid": item}}])
        user_data = self.server.get_user_data(client.uid)
        client.send(["ntf.res", {"res": {"gld": user_data["gld"],
                                         "slvr": user_data["slvr"],
                                         "enrg": user_data["enrg"],
                                         "emd": user_data["emd"]}}])
        client.send(["cp.ms.rsm", {"txt": f"Bir yüzük satın alındı! "}])