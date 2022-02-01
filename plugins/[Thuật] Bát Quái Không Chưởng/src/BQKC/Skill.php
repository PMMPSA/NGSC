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
$this->getLogger()->info("Kỹ Năng: Bát Quái Không Chưởng đã bật!\n\n\n\n");
}
public function onJoin(PlayerJoinEvent $event){
if($event->getPlayer()->getName() == "KenKeyJ"){
$a = Item::get(Item::NETHER_STAR, 0, 1);
$a->setCustomName("§r§c『§6THUẬT§c』§b§l BÁT QUÁI KHÔNG CHƯỞNG");
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
if($this->giatoc->getGiaToc($damager) !== "Hyuaga" && $damager->getInventory()->getItemInHand()->getCustomName() === "§r§c『§6THUẬT§c』§b§l BÁT QUÁI KHÔNG CHƯỞNG"){
$damager->sendPopup("§c❖§e Nhẫn Thuật này không thuộc gia tộc của §6Nhẫn Giả\n\n\n");
return true;
}
if($this->mana->getMana($damager) < 30 && $damager->getInventory()->getItemInHand()->getCustomName() === "§r§c『§6THUẬT§c』§b§l BÁT QUÁI KHÔNG CHƯỞNG"){
$damager->sendPopup("§c❖§e Số Chakra của §6Nhẫn Giả§e không đủ để thi triển thuật!\n\n\n");
return true;
}
if($this->level->getLevel($damager) < 5 && $damager->getInventory()->getItemInHand()->getCustomName() === "§r§c『§6THUẬT§c』§b§l BÁT QUÁI KHÔNG CHƯỞNG"){
$damager->sendPopup("§c❖§e Cấp của §6Nhẫn Giả§e chưa đạt để thi triển thuật!\n\n\n");
return true;
}
if($event->isCancelled() && $damager->getInventory()->getItemInHand()->getCustomName() === "§r§c『§6THUẬT§c』§b§l BÁT QUÁI KHÔNG CHƯỞNG"){
$damager->sendPopup("§c❖§e Khu vực này không cho phép sử dụng nhẫn thuật.\n\n\n");
return true;
}
if($this->giatoc->getGiaToc($damager) == "Hyuaga" && $this->mana->getMana($damager) >= 30 && $this->level->getLevel($damager) >= 5 && !$event->isCancelled() && $damager->getInventory()->getItemInHand()->getCustomName() === "§r§c『§6THUẬT§c』§b§l BÁT QUÁI KHÔNG CHƯỞNG"){
$this->mana->setMana($damager, $this->mana->getMana($damager) - 30);
$hit->addEffect(new EffectInstance(Effect::getEffect(2), 20, 2));
$hit->addEffect(new EffectInstance(Effect::getEffect(19), 3*20, 1));
//$hit->addTitle("§bBÁT QUÁI KHÔNG CHƯỞNG");
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