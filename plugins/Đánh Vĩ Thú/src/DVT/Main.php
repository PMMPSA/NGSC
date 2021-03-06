<?php

namespace DVT;

use pocketmine\nbt\tag\{CompoundTag, ListTag, DoubleTag, FloatTag};
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\utils\TextFormat;
use pocketmine\event\Listener;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDeathEvent;
use onebone\economyapi\EconomyAPI;
use pocketmine\item\Item;
use pocketmine\event\player\{PlayerInteractEvent, PlayerItemHeldEvent, PlayerJoinEvent, PlayerChatEvent};
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\block\Block;
use pocketmine\level\particle\{AngryVillagerParticle,BubbleParticle,CriticalParticle,DestroyBlockParticle,DustParticle,EnchantmentTableParticle,EnchantParticle,EntityFlameParticle,LargeExplodeParticle,FlameParticle,HappyVillagerParticle,HeartParticle,InkParticle,InstantEnchantParticle,ItemBreakParticle,LavaDripParticle,LavaParticle,MobSpellParticle,PortalParticle,RainSplashParticle,RedstoneParticle,SmokeParticle,SpellParticle,SplashParticle,SporeParticle,TerrainParticle,WaterDripParticle,WaterParticle,WhiteSmokeParticle, HugeExplodeSeedParticle};
use pocketmine\math\Vector3;
use pocketmine\entity\Entity;
use pocketmine\utils\Config;
use pocketmine\Inventory;
use pocketmine\level\Level;
use pocketmine\entity\human;
use pocketmine\entity\Effect;
use pocketmine\math\AxisAlignedBB;
//use pocketmine\math\Vector3;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\entity\EffectInstance;
use pocketmine\network\protocol\SetTitlePacket;
use phuongaz\AuraBoss\Entity\ViThu;

class Main extends PluginBase implements Listener{

public function onEnable() : void{
$this->getServer()->getPluginManager()->registerEvents($this, $this);
$this->mana = $this->getServer()->getPluginManager()->getPlugin("NGVS_Mana");
$this->level = $this->getServer()->getPluginManager()->getPlugin("NGVS_Level");
$this->giatoc = $this->getServer()->getPluginManager()->getPlugin("NGVS_GiaToc");
$this->stats = $this->getServer()->getPluginManager()->getPlugin("NGVS_Stats");
$this->mana = $this->getServer()->getPluginManager()->getPlugin("NGVS_Mana");
$this->xu = $this->getServer()->getPluginManager()->getPlugin("NGVS_Xu");
$this->bac = $this->getServer()->getPluginManager()->getPlugin("NGVS_Bac");
$this->vang= $this->getServer()->getPluginManager()->getPlugin("NGVS_Vang");
$this->sm= $this->getServer()->getPluginManager()->getPlugin("NGVS_SucManh");
$this->chakra = $this->getServer()->getPluginManager()->getPlugin("NGVS_DCK");
}
public function onFight(EntityDamageEvent $event) {
if($event instanceof EntityDamageByEntityEvent) {
$hit = $event->getEntity();
$damager = $event->getDamager();


if($damager instanceof Player){
if($hit instanceof ViThu && $event->isCancelled()){
$event->setCancelled(false);
return true;
}


if($hit instanceof ViThu && !$event->isCancelled() && $hit->getName() == "??l??c?????6NH???T V????c?????a SHUKAKU"){

return true;
}


}
if(!$damager instanceof Player){
return false;
}

}
}

public function onDeath(EntityDeathEvent $event) {
$entity = $event->getEntity();
if($event->getEntity()->getLastDamageCause() instanceof EntityDamageByEntityEvent && $event->getEntity()->getLastDamageCause()->getDamager() instanceof Player){
$damager = $event->getEntity()->getLastDamageCause()->getDamager();
$boss = $event->getEntity();
$name = $damager->getName();
if($boss->getName() == "??l??c?????6NH???T V????c?????a SHUKAKU"){
$this->xu->addXu($damager, 9999);
$this->level->addExp($damager, 5000);
$this->bac->addBac($damager, 100);
$this->stats->addStats($damager, 5);
$this->chakra->addChakra($damager, 500);
$nhatvi = Item::get(370, 0, 2);
$nhatvi->setCustomName("??r??cM???nh H???n ??aNh???t V??");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 1));
$damager->getInventory()->addItem($nhatvi);
$this->getServer()->broadcastMessage("??l??c?????6 Nh???n Gi??? ??e".$damager->getName()."??6 ???? ti??u di???t th??nh c??ng NH???T V??.");
$level = $boss->getLevel();
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$damager->sendMessage("??f?????a Nh???n Gi??? nh???n ???????c:??c 9.999??a Xu,??c 5.000??a Kinh Nghi???m,??c 100??a B???c,??c 5??a ??i???m Ti???m N??ng,??c 500??a ??i???m Chakra T???ng, ??l??b2 M???NH H???N NH???T V??");
return true;
}
if($boss->getName() == "??l??c?????6NH??? V????c?????a NEKOMATA"){
$this->xu->addXu($damager, 9999);
$this->level->addExp($damager, 10000);
$this->bac->addBac($damager, 500);
$this->stats->addStats($damager, 10);
$this->chakra->addChakra($damager, 800);
$nhatvi = Item::get(370, 0, 3);
$damager->sendMessage("??f?????a Nh???n Gi??? nh???n ???????c:??c 9.999??a Xu,??c 10.000??a Kinh Nghi???m,??c 500??a B???c,??c 10??a ??i???m Ti???m N??ng,??c 800??a ??i???m Chakra T???ng, ??l??b3 M???NH H???N NH??? V??");
$nhatvi->setCustomName("??r??cM???nh H???n ??aNh??? V??");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 2));
$damager->getInventory()->addItem($nhatvi);
$this->getServer()->broadcastMessage("??l??c?????6 Nh???n Gi??? ??e".$damager->getName()."??6 ???? ti??u di???t th??nh c??ng NH??? V??.");
$level = $boss->getLevel();
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
return true;
}
if($boss->getName() == "??l??c?????6TAM V????c?????a ISONADE"){
$this->xu->addXu($damager, 9999);
$this->level->addExp($damager, 10000);
$this->bac->addBac($damager, 600);
$this->stats->addStats($damager, 10);
$nhatvi = Item::get(370, 0, 1);
$damager->sendMessage("??f?????a Nh???n Gi??? nh???n ???????c:??c 9.999??a Xu,??c 10.000??a Kinh Nghi???m,??c 600??a B???c,??c 10??a ??i???m Ti???m N??ng, ??l??b1 M???NH H???N TAM V??");
$nhatvi->setCustomName("??r??cM???nh H???n ??aTam V??");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 3));
$damager->getInventory()->addItem($nhatvi);
$this->getServer()->broadcastMessage("??l??c?????6 Nh???n Gi??? ??e".$damager->getName()."??6 ???? ti??u di???t th??nh c??ng TAM V??.");
$level = $boss->getLevel();
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
return true;
}
if($boss->getName() == "??l??c?????6T??? V????c?????a SOKOU"){
$this->xu->addXu($damager, 9999);
$this->level->addExp($damager, 10000);
$this->bac->addBac($damager, 100);
$this->stats->addStats($damager, 5);
$this->vang->addVang($damager, 10);
$nhatvi = Item::get(370, 0, 3);
$nhatvi->setCustomName("??r??cM???nh H???n ??aT??? V??");
$damager->sendMessage("??f?????a Nh???n Gi??? nh???n ???????c:??c 9.999??a Xu,??c 10.000??a Kinh Nghi???m,??c 100??a B???c,??c 10??a V??ng,??c 5??a ??i???m Ti???m N??ng, ??l??b3 M???NH H???N T??? V??");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 4));
$damager->getInventory()->addItem($nhatvi);
$this->getServer()->broadcastMessage("??l??c?????6 Nh???n Gi??? ??e".$damager->getName()."??6 ???? ti??u di???t th??nh c??ng T??? V??.");
$level = $boss->getLevel();
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
return true;
}
if($boss->getName() == "??l??c?????6NG?? V????c?????a KOKUOU"){
$this->xu->addXu($damager, 99999);
$this->level->addExp($damager, 30000);
$this->bac->addBac($damager, 1000);
$this->stats->addStats($damager, 20);
$nhatvi = Item::get(370, 0, 1);
$nhatvi->setCustomName("??r??cM???nh H???n ??aNg?? V??");
$damager->sendMessage("??f?????a Nh???n Gi??? nh???n ???????c:??c 99.999??a Xu,??c 30.000??a Kinh Nghi???m,??c 1000??a B???c,??c 20??a ??i???m Ti???m N??ng, ??l??b1 M???NH H???N NG?? V??");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 5));
$damager->getInventory()->addItem($nhatvi);
$this->getServer()->broadcastMessage("??l??c?????6 Nh???n Gi??? ??e".$damager->getName()."??6 ???? ti??u di???t th??nh c??ng NG?? V??.");
$level = $boss->getLevel();
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
return true;
}
if($boss->getName() == "??l??c?????6L???C V????c?????a RAIJUU"){
$this->xu->addXu($damager, 99999);
$this->level->addExp($damager, 40000);
$this->bac->addBac($damager, 1500);
$this->stats->addStats($damager, 20);
$nhatvi = Item::get(370, 0, 1);
$damager->sendMessage("??f?????a Nh???n Gi??? nh???n ???????c:??c 99.999??a Xu,??c 40.000??a Kinh Nghi???m,??c 1500??a B???c,??c 20??a ??i???m Ti???m N??ng, ??l??b1 M???NH H???N L???C V??");
$nhatvi->setCustomName("??r??cM???nh H???n ??aL???c V??");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 6));
$damager->getInventory()->addItem($nhatvi);
$this->getServer()->broadcastMessage("??l??c?????6 Nh???n Gi??? ??e".$damager->getName()."??6 ???? ti??u di???t th??nh c??ng L???C V??.");
$level = $boss->getLevel();
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
return true;
}
if($boss->getName() == "??l??c?????6TH???T V????c?????a KAKU"){
$this->xu->addXu($damager, 99999);
$this->level->addExp($damager, 50000);
$this->bac->addBac($damager, 2000);
$this->stats->addStats($damager, 25);
$nhatvi = Item::get(370, 0, 1);
$nhatvi->setCustomName("??r??cM???nh H???n ??aTh???t V??");
$damager->sendMessage("??f?????a Nh???n Gi??? nh???n ???????c:??c 99.999??a Xu,??c 50.000??a Kinh Nghi???m,??c 2000??a B???c,??c 25??a ??i???m Ti???m N??ng, ??l??b1 M???NH H???N TH???T V??");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 7));
$damager->getInventory()->addItem($nhatvi);
$this->getServer()->broadcastMessage("??l??c?????6 Nh???n Gi??? ??e".$damager->getName()."??6 ???? ti??u di???t th??nh c??ng TH???T V??.");
$level = $boss->getLevel();
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
return true;
}
/*Nh???t V??:
???o H??a Nh???t V??, 9.999Xu, 5.000 EXP, 100 B???c, 5 ??i???m Ti???m N??ng, Ng???u nhi??n r??i set ????? Genin
Nh??? V??:
???o H??a Nh??? V???, 9.999Xu, 10.000 EXP, 500 B???c, 10 ??i???m Ti???m N??ng, Ng???u nhi??n r??i set ????? Genin
T??? V??:
???o H??a T??? V??, 9.999Xu, 20.000 EXP, 800 B???c, 15 ??i???m Ti???m N??ng
Ng?? V??:
???o H??a Ng?? V??, 99.999Xu, 30.000 EXP, 1.000 B???c, 20 ??i???m Ti???m N??ng
Th???t V??:
???o H??a Th???t V??, 99.999Xu, 50.000 EXP, 2.000 B???c, 25 ??i???m Ti???m N???n
B??t V??:
???o H??a B??t V??, 99.999 Xu, 80.000 EXP, 3.000 B???c, 40 ??i???m Ti???m N??ng, Ng???u nhi??n r??i set ????? Kage, Phong B???
C???u V??:
???o H??a C???u V??, 999.999 Xu, 90.000 EXP, 4.000 B???c, 50 ??i???m Ti???m N??ng, Ng???u nhi??n r??i set ????? L???c ?????o, H???a B???*/
if($boss->getName() == "??l??c?????6B??T V????c?????a HACHIBI"){
$this->xu->addXu($damager, 99999);
$this->level->addExp($damager, 80000);
$this->bac->addBac($damager, 3000);
$this->stats->addStats($damager, 40);
$nhatvi = Item::get(370, 0, 1);
$nhatvi->setCustomName("??r??cM???nh H???n ??aB??t V??");
$damager->sendMessage("??f?????a Nh???n Gi??? nh???n ???????c:??c 99.999??a Xu,??c 80.000??a Kinh Nghi???m,??c 3000??a B???c,??c 40??a ??i???m Ti???m N??ng, ??l??b1 M???NH H???N B??T V??");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 8));
$damager->getInventory()->addItem($nhatvi);
$this->getServer()->broadcastMessage("??l??c?????6 Nh???n Gi??? ??e".$damager->getName()."??6 ???? ti??u di???t th??nh c??ng B??T V??.");
$level = $boss->getLevel();
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
return true;
}
if($boss->getName() == "??l??c?????6C???U V????c?????a KURAMA"){
$this->xu->addXu($damager, 999999);
$this->level->addExp($damager, 20000);
$this->bac->addBac($damager, 3000);
$this->stats->addStats($damager, 50);
$nhatvi = Item::get(370, 0, 5);
$nhatvi->setCustomName("??r??cM???nh H???n ??aC???u V??");
$damager->sendMessage("??f?????a Nh???n Gi??? nh???n ???????c:??c 999.999??a Xu,??c 2000??a Kinh Nghi???m,??c 3000??a B???c,??c 50??a ??i???m Ti???m N??ng, ??l??b5 M???NH H???N C???U V??");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 9));
$damager->getInventory()->addItem($nhatvi);
$this->getServer()->broadcastMessage("??l??c?????6 Nh???n Gi??? ??e".$damager->getName()."??6 ???? ti??u di???t th??nh c??ng C???U V??.");
$level = $boss->getLevel();
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
//$damager
return true;
}

}
}
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------
public function onInteract(PlayerInteractEvent $event){
$player = $event->getPlayer();
if($player->getInventory()->getItemInHand()->getCustomName() == "??r??cM???nh H???n ??aNh???t V??" && $player->getInventory()->getItemInHand()->getCount() >= 30){
$this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setuperm ".$player->getName()." shukaku.aohoa.vithu");
$this->sm->addSucmanh($player, 20000);
$this->getServer()->broadcastMessage("??l??f?????a NH???N GI??? ??c".$player->getName()."??a ???? PHONG ???N TH??NH C??NG ??cNH???T V????a V??O C?? TH???!");
$player->sendMessage("??f?????a H??y s??? d???ng??c /aohoa??a ????? bi???n th??n th??nh Shukaku\n??f?????a +20000 S???c M???nh");
$this->stats->upgradeHealth($player);
$player->setMaxHealth($this->stats->getCurrentHealth($player)*7);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 30);
$player->getInventory()->setItemInHand($item);
return true;

}
if($player->getInventory()->getItemInHand()->getCustomName() == "??r??cM???nh H???n ??aNh??? V??" && $player->getInventory()->getItemInHand()->getCount() >= 30){
$this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setuperm ".$player->getName()." matatabi.aohoa.vithu");
$this->sm->addSucmanh($player, 40000);
$this->getServer()->broadcastMessage("??l??f?????a NH???N GI??? ??c".$player->getName()."??a ???? PHONG ???N TH??NH C??NG ??cNH??? V????a V??O C?? TH???!");
$player->sendMessage("??f?????a H??y s??? d???ng??c /aohoa??a ????? bi???n th??n th??nh Matatabi\n??f?????a +40000 S???c M???nh");
$this->stats->upgradeHealth($player);
$player->setMaxHealth($this->stats->getCurrentHealth($player)*7);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 30);
$player->getInventory()->setItemInHand($item);
return true;
}
if($player->getInventory()->getItemInHand()->getCustomName() == "??r??cM???nh H???n ??aTam V??" && $player->getInventory()->getItemInHand()->getCount() >= 35){
$this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setuperm ".$player->getName()." isobu.aohoa.vithu");
$this->sm->addSucmanh($player, 60000);
$this->getServer()->broadcastMessage("??l??f?????a NH???N GI??? ??c".$player->getName()."??a ???? PHONG ???N TH??NH C??NG ??cTAM V????a V??O C?? TH???!");
$player->sendMessage("??f?????a H??y s??? d???ng??c /aohoa??a ????? bi???n th??n th??nh Isobu\n??f?????a +60000 S???c M???nh");
$this->stats->upgradeHealth($player);
$player->setMaxHealth($this->stats->getCurrentHealth($player)*7);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 35);
$player->getInventory()->setItemInHand($item);
return true;
}
if($player->getInventory()->getItemInHand()->getCustomName() == "??r??cM???nh H???n ??aT??? V??" && $player->getInventory()->getItemInHand()->getCount() >= 40){
$this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setuperm ".$player->getName()." son_goku.aohoa.vithu");
$this->sm->addSucmanh($player, 80000);
$this->getServer()->broadcastMessage("??l??f?????a NH???N GI??? ??c".$player->getName()."??a ???? PHONG ???N TH??NH C??NG ??cT??? V????a V??O C?? TH???!");
$player->sendMessage("??f?????a H??y s??? d???ng??c /aohoa??a ????? bi???n th??n th??nh Songoku\n??f?????a +80000 S???c M???nh");
$this->stats->upgradeHealth($player);
$player->setMaxHealth($this->stats->getCurrentHealth($player)*8);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 40);
$player->getInventory()->setItemInHand($item);
return true;
}
if($player->getInventory()->getItemInHand()->getCustomName() == "??r??cM???nh H???n ??aNg?? V??" && $player->getInventory()->getItemInHand()->getCount() >= 40){
$this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setuperm ".$player->getName()." kokuou.aohoa.vithu");
$this->sm->addSucmanh($player, 100000);
$this->getServer()->broadcastMessage("??l??f?????a NH???N GI??? ??c".$player->getName()."??a ???? PHONG ???N TH??NH C??NG ??cNG?? V????a V??O C?? TH???!");
$player->sendMessage("??f?????a H??y s??? d???ng??c /aohoa??a ????? bi???n th??n th??nh Kokuou\n??f?????a +100000 S???c M???nh");
$this->stats->upgradeHealth($player);
$player->setMaxHealth($this->stats->getCurrentHealth($player)*10);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 40);
$player->getInventory()->setItemInHand($item);
return true;
}
if($player->getInventory()->getItemInHand()->getCustomName() == "??r??cM???nh H???n ??aL???c V??" && $player->getInventory()->getItemInHand()->getCount() >= 40){
$this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setuperm ".$player->getName()." juubi.aohoa.vithu");
$this->sm->addSucmanh($player, 120000);
$this->getServer()->broadcastMessage("??l??f?????a NH???N GI??? ??c".$player->getName()."??a ???? PHONG ???N TH??NH C??NG ??cL???C V????a V??O C?? TH???!");
$player->sendMessage("??f?????a H??y s??? d???ng??c /aohoa??a ????? bi???n th??n th??nh Juubi\n??f?????a +120000 S???c M???nh");
$this->stats->upgradeHealth($player);
$player->setMaxHealth($this->stats->getCurrentHealth($player)*11);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 40);
$player->getInventory()->setItemInHand($item);
return true;
}
if($player->getInventory()->getItemInHand()->getCustomName() == "??r??cM???nh H???n ??aTh???t V??" && $player->getInventory()->getItemInHand()->getCount() >= 45){
$this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setuperm ".$player->getName()." chomei.aohoa.vithu");
$this->sm->addSucmanh($player, 140000);
$this->getServer()->broadcastMessage("??l??f?????a NH???N GI??? ??c".$player->getName()."??a ???? PHONG ???N TH??NH C??NG ??cTH???T V????a V??O C?? TH???!");
$player->sendMessage("??f?????a H??y s??? d???ng??c /aohoa??a ????? bi???n th??n th??nh Chomei\n??f?????a +140000 S???c M???nh");
$this->stats->upgradeHealth($player);
$player->setMaxHealth($this->stats->getCurrentHealth($player)*12);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 35);
$player->getInventory()->setItemInHand($item);
return true;
}
if($player->getInventory()->getItemInHand()->getCustomName() == "??r??cM???nh H???n ??aB??t V??" && $player->getInventory()->getItemInHand()->getCount() >= 50){
$this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setuperm ".$player->getName()." giuki.aohoa.vithu");
$this->sm->addSucmanh($player, 160000);
$this->getServer()->broadcastMessage("??l??f?????a NH???N GI??? ??c".$player->getName()."??a ???? PHONG ???N TH??NH C??NG ??cB??T V????a V??O C?? TH???!");
$player->sendMessage("??f?????a H??y s??? d???ng??c /aohoa??a ????? bi???n th??n th??nh Giuki\n??f?????a +160000 S???c M???nh");
$this->stats->upgradeHealth($player);
$player->setMaxHealth($this->stats->getCurrentHealth($player)*14);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 40);
$player->getInventory()->setItemInHand($item);
return true;
}
if($player->getInventory()->getItemInHand()->getCustomName() == "??r??cM???nh H???n ??aC???u V??" && $player->getInventory()->getItemInHand()->getCount() >= 50){
$this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setuperm ".$player->getName()." kurama.aohoa.vithu");
$this->sm->addSucmanh($player, 180000);
$this->getServer()->broadcastMessage("??l??f?????a NH???N GI??? ??c".$player->getName()."??a ???? PHONG ???N TH??NH C??NG ??cC???U V????a V??O C?? TH???!");
$player->sendMessage("??f?????a H??y s??? d???ng??c /aohoa??a ????? bi???n th??n th??nh Kurama\n??f?????a +180000 S???c M???nh");
$this->stats->upgradeHealth($player);
$this->stats->upgradeHealth($player);
$player->setMaxHealth($this->stats->getCurrentHealth($player)*15);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 50);
$player->getInventory()->setItemInHand($item);
return true;
}

if($player->getInventory()->getItemInHand()->getCustomName() == "??r??cM???nh H???n ??aC???u V??_Chakra" && $player->getInventory()->getItemInHand()->getCount() >= 64){
$this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setuperm ".$player->getName()." kurama_chakra.aohoa.vithu");
$this->sm->addSucmanh($player, 200000);
$this->getServer()->broadcastMessage("??l??f?????a NH???N GI??? ??c".$player->getName()."??a ???? PHONG ???N TH??NH C??NG ??cC???U V?? CHAKRA??a V??O C?? TH???!");
$player->sendMessage("??f?????a H??y s??? d???ng??c /aohoa??a ????? bi???n th??n th??nh Kurama_Chakra\n??f?????a +200000 S???c M???nh");
$this->stats->upgradeHealth($player);
$this->stats->upgradeHealth($player);
$player->setMaxHealth($this->stats->getCurrentHealth($player)*30);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 64);
$player->getInventory()->setItemInHand($item);
return true;
}


}


}