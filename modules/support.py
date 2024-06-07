from modules.base_module import Module
from modules.location import refresh_avatar
import urllib, json
import urllib.request
import logging




 
url = "https://static-cdn.avaturkey.com/suppor.json"
icon = "https://www.youtube.com/channel/UCwtU6EBcXZVjd8g2-fzdh4A" \
       "readme/star.png"
class_name = "Support"


class Support(Module):
    prefix = "spt"

    def __init__(self, server):
        self.server = server
        self.commands = {"init": self.init, "gscnl": self.get_social_channels,
                         "rsnm": self.reset_avatar_name,
                         "lmdac": self.load_moderator_actions,
                         "swcr": self.degi_tac,
                         "clev": self.kapat_etkinlik

                         }

    def init(self, msg, client):
        client.send(["spt.init", {"a": False}])

    def get_social_channels(self, msg, client):
        channels = [{"act": True, "prt": 1, "id": 1, "stid": "Avaport | Destek",
                         "dsctn": f"Herhangi bir sorunla karşılaşırsanız soru sormaktan çekinmeyin."
                         f"",
                         "ttl": "Avaport | Destek", "icnurl": icon,
                         "lnk": "https://www.facebook.com/avaturkmod"},
                         {"act": True, "prt": 2, "id": 2, "stid": "Avaport | Youtube",
                         "dsctn": f"Youtube kanalına abone olun, yeni gelecek günceleme \n ve etkinliklerden haberdar olun."
                         f"",
                         "ttl": "Avaport | Youtube", "icnurl": icon,
                         "lnk": "https://www.facebook.com/"}]
       
        client.send(["spt.gscnl", {"scls": channels}])

    def reset_avatar_name(self, msg, client):
        privileges = self.server.modules["cp"].privileges
        user_data = self.server.get_user_data(client.uid)
        if user_data["role"] < privileges["RENAME_AVATAR"]:
            return
        uid = str(msg[2]["uid"])
        name = msg[2]["n"]
        if not self.server.redis.lindex(f"uid:{uid}:appearance", 0):
            return
        self.server.redis.lset(f"uid:{uid}:appearance", 0, name)
        for tmp in self.server.online.copy():
            if tmp.uid == uid:
                refresh_avatar(tmp, self.server)
                break

    def kapat_etkinlik(self, msg, client):
       uid = msg[2]["id"]
       logging.error(f"Etkinlik {client.uid} ve {uid}")


    def load_moderator_actions(self, msg, client):
        client.send(["spt.lmdac", {"uid": msg[2]["uid"], "acts": []}])

    def degi_tac(self, msg, client):
       privileges = self.server.modules["cp"].privileges
       user_data = self.server.get_user_data(client.uid)
       if user_data["role"] < privileges["RENAME_AVATAR"]:
            return
       uid = client.uid
       tac = self.server.redis.get(f"uid:{uid}:tac")
       if tac == None:
          self.server.redis.set(f"uid:{uid}:tac", 1)
       if tac == "0":
          self.server.redis.set(f"uid:{uid}:tac", 1)
       if tac == "1":
          self.server.redis.set(f"uid:{uid}:tac", 0)