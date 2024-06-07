from modules.base_module import Module
from modules.location import gen_plr
import time
import logging

class_name = "Inventory"


class Inventory(Module):
	prefix = "tr"

	def __init__(self, server):
		self.server = server
		self.commands = {"sale": self.sale_item , "opgft": self.open_gift , "offer": self.offer, "use": self.kullan }

	def sale_item(self, msg, client):
		items = self.server.game_items["game"]
		tpid = msg[2]["tpid"]
		cnt = msg[2]["cnt"]
		if tpid not in items or "saleSilver" not in items[tpid]:
			return
		if not self.server.inv[client.uid].take_item(tpid, cnt):
			return
		price = items[tpid]["saleSilver"]
		user_data = self.server.get_user_data(client.uid)
		redis = self.server.redis
		redis.set(f"uid:{client.uid}:slvr", user_data["slvr"]+price*cnt)
		ci = gen_plr(client.uid, self.server)["ci"]
		client.send(["ntf.ci", {"ci": ci}])
		inv = self.server.inv[client.uid].get()
		client.send(["ntf.inv", {"inv": inv}])
		user_data = self.server.get_user_data(client.uid)
		client.send(["ntf.res", {"res": {"gld": user_data["gld"],
										 "slvr": user_data["slvr"],
										 "enrg": user_data["enrg"],
										 "emd": user_data["emd"]}}])
	def open_gift(self, msg, client):
		mms = msg[2]["tpid"]
		for item in msg:
		 logging.error(item)
		bilgi = self.server.redis
		sayii = bilgi.lrange(f"uid:{client.uid}:items:{mms}",  1, 1)
		veri = sayii[0]
		convertedInt = int(veri)
		convertedInt -= 1
		logging.error(f"[KUTU] KUL {client.uid}  KUL ID:   {mms}  KUL SAYISI: {sayii[0]} ")
		if convertedInt <= 1:
			bilgi.lset(f"uid:{client.uid}:items:{mms}", 1, 0)
			bilgi.srem(f"uid:{client.uid}:items", mms)
			logging.error(f"sil ")
			logging.error(f"[KUTU] KUL {client.uid}  KUL ID:   {mms}  KUL SAYISI: {convertedInt} ")
			cnt = int(bilgi.lindex(f"uid:{client.uid}:items:{mms}", 1))
			client.send(["ntf.inv", {"it": {"c": cnt, "lid": "", "tid": mms}}])
			client.send(["ntf.inv", {"it": {"c": cnt, "lid": "", "tid": mms}}])
			client.send(["cp.ms.rsm", {"txt": f"Kutu açma geçici olarak kapatılmıştır."}])


		else:
		  bilgi.lset(f"uid:{client.uid}:items:{mms}", 1, convertedInt)
		logging.error(f"KUL {client.uid}  KUL ID:   {mms}  KUL SAYISI: {convertedInt} ")
		cnt = int(bilgi.lindex(f"uid:{client.uid}:items:{mms}", 1))
		client.send(["ntf.inv", {"it": {"c": cnt, "lid": "", "tid": mms}}])
		client.send(["ntf.inv", {"it": {"c": cnt, "lid": "", "tid": mms}}])
		client.send(["cp.ms.rsm", {"txt": f"Kutu açma geçici olarak kapatılmıştır." }])


	def kullan(self, msg, client):
		mms = msg[2]["tpid"]
		bilgi = self.server.redis
		sayii = bilgi.lrange(f"uid:{client.uid}:items:{mms}",  1, 1)
		veri = sayii[0]
		convertedInt = int(veri)
		convertedInt -= 1
		logging.error(f"KUL {client.uid}  KUL ID:   {mms}  KUL SAYISI: {sayii[0]} ")
		if convertedInt <= 1:
			bilgi.lset(f"uid:{client.uid}:items:{mms}", 1, 0)
			bilgi.srem(f"uid:{client.uid}:items", mms)
			logging.error(f"sil ")
			logging.error(f"KUL {client.uid}  KUL ID:   {mms}  KUL SAYISI: {convertedInt} ")
			cnt = int(bilgi.lindex(f"uid:{client.uid}:items:{mms}", 1))
			client.send(["ntf.inv", {"it": {"c": cnt, "lid": "", "tid": mms}}])
			client.send(["ntf.inv", {"it": {"c": cnt, "lid": "", "tid": mms}}])
			client.send(["cp.ms.rsm", {"txt": f"Kutu açma geçici olarak kapatılmıştır."}])


		else:
			bilgi.lset(f"uid:{client.uid}:items:{mms}", 1, convertedInt)
		logging.error(f"KUL {client.uid}  KUL ID:   {mms}  KUL SAYISI: {convertedInt} ")
		cnt = int(bilgi.lindex(f"uid:{client.uid}:items:{mms}", 1))
		client.send(["ntf.inv", {"it": {"c": cnt, "lid": "", "tid": mms}}])
		client.send(["ntf.inv", {"it": {"c": cnt, "lid": "", "tid": mms}}])
		client.send(["cp.ms.rsm", {"txt": f"Kutu açma geçici olarak kapatılmıştır."}])


	def offer(self, msg, client):
	 bilgi = self.server.redis
	 mms = msg[2]["ioid"]
	 v = client.uid
	 h = 0
	 lg = bilgi.lrange("promo_kod", 0 ,-1)
	 kullanan = bilgi.lrange("promo_kul", 0 ,-1)
	 mesaj = lg[2]
	 miktar = lg[4]
	 item = lg[3]
	 for i in kullanan:
	   if v == i:
		   h = 1
	   else:
		   h = 0
	 if h == 0:
	  if mms == lg[0]:
		  g = bilgi.get(f"uid:{client.uid}:{item}")
		  sonuc = int(miktar) + int(g)
		  bilgi.set(f"uid:{client.uid}:{item}", sonuc)
		  bilgi.rpush(f"promo_kul", client.uid)
		  client.send(["cp.ms.rsm", {"txt": f"{mesaj}"}])
	 else:
		 client.send(["cp.ms.rsm", {"txt": f"Üzgünüm yanlış veya kullanılmış bir kod girdiniz."}])


