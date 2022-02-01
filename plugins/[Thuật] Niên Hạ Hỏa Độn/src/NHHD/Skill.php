<?php

namespace NHHD;

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
$this->getLogger()->info("Kỹ Năng: Niên Hạ Hỏa Độn đã bật!\n\n\n\n");
}
public function onJoin(PlayerJoinEvent $event){
if($event->getPlayer()->getName() == "KenKeyJ"){
$a = Item::get(Item::NETHER_STAR, 0, 1);
$a->setCustomName("§r§c『§6THUẬT§c』§c§l NIÊN HẠ HỎA ĐỘN");
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
$damager->sendPopup("§f•§a Nhẫn Giả không thể đánh §cHokage§f •\n\n\n");
}
}
if(!$damager instanceof Player){
return false;
}
/*if(!$hit instanceof Player){
return false;
}*/
if($this->giatoc->getGiaToc($damager) !== "Uchiha" && $damager->getInventory()->getItemInHand()->getCustomName() === "§r§c『§6THUẬT§c』§c§l NIÊN HẠ HỎA ĐỘN"){
$damager->sendPopup("§c❖§e Nhẫn Thuật này không thuộc gia tộc của §6Nhẫn Giả\n\n\n");
return true;
}
if($this->mana->getMana($damager) < 70 && $damager->getInventory()->getItemInHand()->getCustomName() === "§r§c『§6THUẬT§c』§c§l NIÊN HẠ HỎA ĐỘN"){
$damager->sendPopup("§c❖§e Số Chakra của §6Nhẫn Giả§e không đủ để thi triển thuật!\n\n\n");
return true;
}
if($this->level->getLevel($damager) < 5 && $damager->getInventory()->getItemInHand()->getCustomName() === "§r§c『§6THUẬT§c』§c§l NIÊN HẠ HỎA ĐỘN"){
$damager->sendPopup("§c❖§e Cấp của §6Nhẫn Giả§e chưa đạt để thi triển thuật!\n\n\n");
return true;
}
if($event->isCancelled() && $damager->getInventory()->getItemInHand()->getCustomName() === "§r§c『§6THUẬT§c』§c§l NIÊN HẠ HỎA ĐỘN"){
$damager->sendPopup("§c❖§e Khu vực này không cho phép sử dụng nhẫn thuật.\n\n\n");
return true;
}
if($this->giatoc->getGiaToc($damager) == "Uchiha" && $this->mana->getMana($damager) >= 70 && $this->level->getLevel($damager) >= 5 && !$event->isCancelled() && $damager->getInventory()->getItemInHand()->getCustomName() === "§r§c『§6THUẬT§c』§c§l NIÊN HẠ HỎA ĐỘN"){
$this->mana->setMana($damager, $this->mana->getMana($damager) - 70);

$p = $damager->getTargetBlock(100);
foreach($damager->getLevel()->getNearbyEntities(new AxisAlignedBB($p->x - 5, $p->y - 5, $p->z - 5, $p->x + 5, $p->y + 5, $p->z + 5), $damager) as $ent){
if($ent instanceof Player){
$ent->addEffect(new EffectInstance(Effect::getEffect(9), 3*20, 5));
$ent->setOnFire($this->level->getLevel($damager));
$level = $damager->getLevel();
$x = $damager->getX();
$y = $damager->getY();
$z = $damager->getZ();
$r = 10;
for($i1 = 0;$i1 <= 360;$i1 += 0.5){
$thisx = $x+$r*sin(3*$i1);
$thisz = $z+$r*sin(4*$i1);
$particle = new EntityFlameParticle(new Vector3($thisx,$y,$thisz));
$level->addParticle($particle);
//return true;
}
}
}

}
}

}
}