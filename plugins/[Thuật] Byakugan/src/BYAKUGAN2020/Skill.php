<?php

namespace BYAKUGAN2020;

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
$a->setCustomName("??r??c?????6THU???T??c?????b??l BYAKUGAN");
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
if(!$hit instanceof Player){
return false;
}
if($this->giatoc->getGiaToc($damager) !== "Hyuaga" && $damager->getInventory()->getItemInHand()->getCustomName() === "??r??c?????6THU???T??c?????b??l BYAKUGAN"){
$damager->sendPopup("??c?????e Nh???n Thu???t n??y kh??ng thu???c gia t???c c???a ??6Nh???n Gi???\n\n\n");
return true;
}
if($this->mana->getMana($damager) < 50 && $damager->getInventory()->getItemInHand()->getCustomName() === "??r??c?????6THU???T??c?????b??l BYAKUGAN"){
$damager->sendPopup("??c?????e S??? Chakra c???a ??6Nh???n Gi?????e kh??ng ????? ????? thi tri???n thu???t!\n\n\n");
return true;
}
if($this->level->getLevel($damager) < 5 && $damager->getInventory()->getItemInHand()->getCustomName() === "??r??c?????6THU???T??c?????b??l BYAKUGAN"){
$damager->sendPopup("??c?????e C???p c???a ??6Nh???n Gi?????e ch??a ?????t ????? thi tri???n thu???t!\n\n\n");
return true;
}
if($event->isCancelled() && $damager->getInventory()->getItemInHand()->getCustomName() === "??r??c?????6THU???T??c?????b??l BYAKUGAN"){
$damager->sendPopup("??c?????e Khu v???c n??y kh??ng cho ph??p s??? d???ng nh???n thu???t.\n\n\n");
return true;
}
if($this->giatoc->getGiaToc($damager) == "Hyuaga" && $this->mana->getMana($damager) >= 50 && $this->level->getLevel($damager) >= 5 && !$event->isCancelled() && $damager->getInventory()->getItemInHand()->getCustomName() === "??r??c?????6THU???T??c?????b??l BYAKUGAN"){
$this->mana->setMana($damager, $this->mana->getMana($damager) - 50);
$damager->addEffect(new EffectInstance(Effect::getEffect(1), 5*20, 20));
$hit->addTitle("??fBYAKUGAN");
$damager->sendMessage("??cM??u c???a ?????i ph????ng:??a ".$hit->getHealth());
$damager->sendMessage("??cV???t ph???m tr??n tay ?????i ph????ng:??a ".$hit->getInventory()->getItemInHand()->getName());
$damager->sendMessage("??cChakra ?????i ph????ng:??a ".$this->mana->getMana($hit));
$damager->sendMessage("??cCh??? s??? Linh Ho???t:??a ".$this->stats->getCurrentSpeed($hit));
$damager->sendMessage("??cCh??? s??? Th??n L???c:??a ".$this->stats->getCurrentJump($hit));
$damager->sendMessage("??cCh??? s??? S??t Th????ng:??a ".$this->stats->getCurrentDamage($hit));
$damager->sendMessage("??cCh??? s??? B???o K??ch:??a ".$this->stats->getCurrentCrit($hit));
$damager->sendMessage("??cCh??? s??? Sinh L???c:??a ".$this->stats->getCurrentHealth($hit));
}
}
}
}