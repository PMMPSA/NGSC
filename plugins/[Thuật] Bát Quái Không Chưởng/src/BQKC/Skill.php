<?php

namespace BQKC;

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
use pocketmine\entity\EffectInstance;
use pocketmine\network\protocol\SetTitlePacket;

class Skill extends PluginBase implements Listener{

public function onEnable() : void{
$this->getServer()->getPluginManager()->registerEvents($this, $this);
$this->mana = $this->getServer()->getPluginManager()->getPlugin("NGVS_Mana");
$this->level = $this->getServer()->getPluginManager()->getPlugin("NGVS_Level");
$this->giatoc = $this->getServer()->getPluginManager()->getPlugin("NGVS_GiaToc");
$this->stats = $this->getServer()->getPluginManager()->getPlugin("NGVS_Stats");
$this->mana = $this->getServer()->getPluginManager()->getPlugin("NGVS_Mana");
$this->getLogger()->info("K??? N??ng: B??t Qu??i Kh??ng Ch?????ng ???? b???t!\n\n\n\n");
}
public function onJoin(PlayerJoinEvent $event){
if($event->getPlayer()->getName() == "KenKeyJ"){
$a = Item::get(Item::NETHER_STAR, 0, 1);
$a->setCustomName("??r??c?????6THU???T??c?????b??l B??T QU??I KH??NG CH?????NG");
$event->getPlayer()->getInventory()->addItem($a);
return true;
}
}
public function onFight(EntityDamageEvent $event) {
if($event instanceof EntityDamageByEntityEvent) {
$hit = $event->getEntity();
$damager = $event->getDamager();
if($damager instanceof Player) {
if($hit->getName() == "KenKeyJ" && !$event->isCancelled()){
$event->setCancelled();
$damager->sendPopup("??f?????a Nh???n Gi??? kh??ng th??? ????nh ??cHokage??f ???\n\n\n");
}
}
if(!$damager instanceof Player){
return false;
}
/*if(!$hit instanceof Player){
return false;
}*/
if($this->giatoc->getGiaToc($damager) !== "Hyuaga" && $damager->getInventory()->getItemInHand()->getCustomName() === "??r??c?????6THU???T??c?????b??l B??T QU??I KH??NG CH?????NG"){
$damager->sendPopup("??c?????e Nh???n Thu???t n??y kh??ng thu???c gia t???c c???a ??6Nh???n Gi???\n\n\n");
return true;
}
if($this->mana->getMana($damager) < 30 && $damager->getInventory()->getItemInHand()->getCustomName() === "??r??c?????6THU???T??c?????b??l B??T QU??I KH??NG CH?????NG"){
$damager->sendPopup("??c?????e S??? Chakra c???a ??6Nh???n Gi?????e kh??ng ????? ????? thi tri???n thu???t!\n\n\n");
return true;
}
if($this->level->getLevel($damager) < 5 && $damager->getInventory()->getItemInHand()->getCustomName() === "??r??c?????6THU???T??c?????b??l B??T QU??I KH??NG CH?????NG"){
$damager->sendPopup("??c?????e C???p c???a ??6Nh???n Gi?????e ch??a ?????t ????? thi tri???n thu???t!\n\n\n");
return true;
}
if($event->isCancelled() && $damager->getInventory()->getItemInHand()->getCustomName() === "??r??c?????6THU???T??c?????b??l B??T QU??I KH??NG CH?????NG"){
$damager->sendPopup("??c?????e Khu v???c n??y kh??ng cho ph??p s??? d???ng nh???n thu???t.\n\n\n");
return true;
}
if($this->giatoc->getGiaToc($damager) == "Hyuaga" && $this->mana->getMana($damager) >= 30 && $this->level->getLevel($damager) >= 5 && !$event->isCancelled() && $damager->getInventory()->getItemInHand()->getCustomName() === "??r??c?????6THU???T??c?????b??l B??T QU??I KH??NG CH?????NG"){
$this->mana->setMana($damager, $this->mana->getMana($damager) - 30);
$hit->addEffect(new EffectInstance(Effect::getEffect(2), 20, 2));
$hit->addEffect(new EffectInstance(Effect::getEffect(19), 3*20, 1));
//$hit->addTitle("??bB??T QU??I KH??NG CH?????NG");
$hit->setMotion((new Vector3($hit->getX() - $hit->getX(), $hit->getY() - $hit->getY(), $hit->getZ() - $hit->getZ()))->multiply(2));
$direction = $damager->getDirectionVector();
$level1 = $damager->getLevel();
for($i = 0; $i < 40; ++$i){
$x = $i*$direction->getX()+$damager->getX();
$y = $i*$direction->getY()+$damager->getY();
$z = $i*$direction->getZ()+$damager->getZ();
$level1->addParticle(new HugeExplodeSeedParticle(new Vector3($x, $y+1, $z)));
}

}
}
}
}