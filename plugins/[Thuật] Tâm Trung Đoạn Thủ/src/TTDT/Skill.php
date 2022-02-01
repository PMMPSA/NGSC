<?php

namespace TTDT;

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
$this->getLogger()->info("Kỹ Năng: Tâm Trung Đoạn Thủ đã bật!");
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
if(!$hit instanceof Player){
return false;
}
if($this->mana->getMana($damager) < 10 && $damager->getInventory()->getItemInHand()->getCustomName() == "§r§7【§cTHUẬT§7】§e Tâm Trung Đoạn Thủ§7 (§cCấp 5§7) - (§c10 Chakra§7) - (§a•§7)"){
$damager->sendPopup("§c❖§e Số Chakra của §6Nhẫn Giả§e không đủ để thi triển thuật!\n\n\n");
return true;
}
if($this->level->getLevel($damager) < 5 && $damager->getInventory()->getItemInHand()->getCustomName() == "§r§7【§cTHUẬT§7】§e Tâm Trung Đoạn Thủ§7 (§cCấp 5§7) - (§c10 Chakra§7) - (§a•§7)"){
$damager->sendPopup("§c❖§e Cấp của §6Nhẫn Giả§e chưa đạt để thi triển thuật!\n\n\n");
return true;
}
if($event->isCancelled() && $damager->getInventory()->getItemInHand()->getCustomName() == "§r§7【§cTHUẬT§7】§e Tâm Trung Đoạn Thủ§7 (§cCấp 5§7) - (§c10 Chakra§7) - (§a•§7)"){
$damager->sendPopup("§c❖§e Khu vực này không cho phép sử dụng nhẫn thuật.\n\n\n");
return true;
}
if($this->mana->getMana($damager) >= 10 && $this->level->getLevel($damager) >= 5 && !$event->isCancelled() && $damager->getInventory()->getItemInHand()->getCustomName() === "§r§7【§cTHUẬT§7】§e Tâm Trung Đoạn Thủ§7 (§cCấp 5§7) - (§c10 Chakra§7) - (§a•§7)"){
$this->mana->setMana($damager, $this->mana->getMana($damager) - 10);
$hit->addEffect(new EffectInstance(Effect::getEffect(18), 2*20, 2));
$this->mana->setMana($hit, $this->mana->getMana($hit) - 8);
//$hit->addTitle("§bTâm Trung Đoạn Thủ");
$direction = $damager->getDirectionVector();
$level = $hit->getLevel();
$level1 = $damager->getLevel();
$radio1 = 5;
for($i1 = 5; $i1 > 0; $i1-=0.1){
$radio1 = $i1/3;
$px = -$radio1*cos(3*$i1);
$py = 5-$i1;
$pz = -$radio1*sin(3*$i1);
$x = $hit->getX();
$y = $hit->getY();
$z = $hit->getZ();
$vector = new Vector3($x, $y, $z);
$vector1 = $vector->add($px, $py, $pz);
$level->addParticle(new DustParticle($vector1, 225, 255, 0));
$level->addParticle(new DustParticle($vector1, 225, 255, 0));
}
}
}
}
}