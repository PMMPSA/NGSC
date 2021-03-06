<?php

namespace SHARINGAN2020;

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
use pocketmine\level\particle\{AngryVillagerParticle,BubbleParticle,CriticalParticle,DestroyBlockParticle,DustParticle,EnchantmentTableParticle,EnchantParticle,EntityFlameParticle,LargeExplodeParticle,FlameParticle,HappyVillagerParticle,HeartParticle,InkParticle,InstantEnchantParticle,ItemBreakParticle,LavaDripParticle,LavaParticle,MobSpellParticle,PortalParticle,RainSplashParticle,RedstoneParticle,SmokeParticle,SpellParticle,SplashParticle,SporeParticle,TerrainParticle,WaterDripParticle,WaterParticle,WhiteSmokeParticle};
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
$this->getLogger()->info("K??? N??ng: Byakugan ???? b???t!\n\n\n\n");
}
public function onJoin(PlayerJoinEvent $event){
if($event->getPlayer()->getName() == "KenKeyJ"){
$a = Item::get(Item::NETHER_STAR, 0, 1);
$a->setCustomName("??r??c?????6THU???T??c?????c??l SHARINGAN");
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
if($this->giatoc->getGiaToc($damager) !== "Uchiha" && $damager->getInventory()->getItemInHand()->getCustomName() === "??r??c?????6THU???T??c?????c??l SHARINGAN"){
$damager->sendPopup("??c?????e Nh???n Thu???t n??y kh??ng thu???c gia t???c c???a ??6Nh???n Gi???\n\n\n");
return true;
}
if($this->mana->getMana($damager) < 50 && $damager->getInventory()->getItemInHand()->getCustomName() === "??r??c?????6THU???T??c?????c??l SHARINGAN"){
$damager->sendPopup("??c?????e S??? Chakra c???a ??6Nh???n Gi?????e kh??ng ????? ????? thi tri???n thu???t!\n\n\n");
return true;
}
if($this->level->getLevel($damager) < 5 && $damager->getInventory()->getItemInHand()->getCustomName() === "??r??c?????6THU???T??c?????c??l SHARINGAN"){
$damager->sendPopup("??c?????e C???p c???a ??6Nh???n Gi?????e ch??a ?????t ????? thi tri???n thu???t!\n\n\n");
return true;
}
if($event->isCancelled() && $damager->getInventory()->getItemInHand()->getCustomName() === "??r??c?????6THU???T??c?????c??l SHARINGAN"){
$damager->sendPopup("??c?????e Khu v???c n??y kh??ng cho ph??p s??? d???ng nh???n thu???t.\n\n\n");
return true;
}
if($this->giatoc->getGiaToc($damager) == "Uchiha" && $this->mana->getMana($damager) >= 50 && $this->level->getLevel($damager) >= 5 && !$event->isCancelled() && $damager->getInventory()->getItemInHand()->getCustomName() === "??r??c?????6THU???T??c?????c??l SHARINGAN"){
$this->mana->setMana($damager, $this->mana->getMana($damager) - 50);
$p = $damager->getTargetBlock(100);
/*foreach($damager->getLevel()->getNearbyEntities(new AxisAlignedBB($p->getX() - 5, $p->getY() - 5, $p->getZ() - 5, $p->getX() + 5, $p->getY() + 5, $p->getZ() + 5), $damager) as $hit){
if($hit instanceof Player){*/
$hit->addEffect(new EffectInstance(Effect::getEffect(9), 2*20, 20));
$hit->addEffect(new EffectInstance(Effect::getEffect(15), 3*20, 20));
//$hit->addTitle("??cSHARINGAN");
$level = $hit->getLevel();
$time = 1;
$pi = 3.14159;
$time = $time+0.1/$pi;
for($i = 0; $i <= 2*$pi; $i+=$pi/8){
$x = $hit->getX();
$y = $hit->getY();
$z = $hit->getZ();
$vector = new Vector3($x, $y, $z);
$px = $time*cos($i);
$py = exp(-0.1*$time)*sin($time)+1.5;
$pz = $time*sin($i);
$vector1 = $vector->add($px, $py, $pz);
$level->addParticle(new DustParticle($vector1, 11, 11, 11));
$level->addParticle(new DustParticle($vector1, 11, 11, 11));
$level->addParticle(new DustParticle($vector1, 11, 11, 11));
//}
//}
}

}
}
}
}