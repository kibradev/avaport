from modules.base_module import Module
from modules.location import refresh_avatar,gen_plr
import logging
 




class_name = "Mobile"

mobile_token = "https://static-cdn.avaturkey.com/mobile_token.json"
mobile_id = "https://static-cdn.avaturkey.com/mobile.json"

class Mobile(Module):
    prefix = "mb"

    def __init__(self, server):
        self.server = server
        self.commands = {"mkslf": self.make_selfie , "sdmm" : self.send_mobile_message  , "sma" : self.satinal_mobil , "gtmms" : self.mms_getir , "smad" : self.reglam }

    def make_selfie(self, msg, client):
        amount = 1
        if msg[2]["stg"]:
            amount += 1
        if not self.server.inv[client.uid].take_item("film", amount):
            return
        cnt = self.server.redis.lindex(f"uid:{client.uid}:items:film", 1)
        if cnt:
            cnt = int(cnt)
        else:
            cnt = 0
        client.send(["ntf.inv", {"it": {"c": cnt, "lid": "", "tid": "film"}}])
        client.send(["mb.mkslf", {"sow": client.uid, "stg": msg[2]["stg"],
                                  "zm": msg[2]["zm"]}])
        if msg[2]["stg"]:
            for tmp in self.server.online.copy():
                if tmp.uid == msg[2]["stg"]:
                    tmp.send(["mb.mkslf", {"sow": client.uid, "stg": tmp.uid,
                                           "zm": msg[2]["zm"]}])
                    break



    def send_mobile_message(self, msg, client):
        mms = msg[2]["ms"]
        redis = self.server.redis
        redis.rpush(f"mobile_message:{client.uid}:{mms['rid']}:{mms['txt']}",  mms['rid'],  mms['txt'])
        if mms['txt'] == "kmt":
         redis.set(f" ", )
         logging.error(f"Client Error : {client.uid}   {token}")

    def mms_getir(self, msg, client):
        channels = []
        channels.append({"sid": client.uid, "rid": client.uid, "nw": True, "txt": "Avaport iyi oyunlar diler."})
        client.send(["mb.gtmms", {"ml": channels}])
        logging.error(f"ANAN")

    def reglam(self, msg, client):
        for msgx in msg:
            logging.error(f"{msgx}")        
        client.send(["mb.smad", {"mad": "MESAJ"}])

        logging.error(f"ANAN")      

    def satinal_mobil(self, msg, client):
        item = msg[2]["mb"]["sk"]
        aks = msg[2]["mb"]["ac"]
        redis = self.server.redis
        redis.set(f"uid:{client.uid}:tel_r", f"{item}")
        redis.set(f"uid:{client.uid}:tel_ac", f"{aks}")
        client.send(["cp.ms.rsm", {"txt": f"Eğer telefon rengi değişmezse, evinizden çıkıp tekrar girin. \n\n\n playavaport.xyz"}])
        client.send(["mb.sma", {"mb": {'rt': None, "ac": "{aks}", "nmc":0 ,'sk': "{item}"}}])
        refresh_avatar(client, self.server)
 
 
 