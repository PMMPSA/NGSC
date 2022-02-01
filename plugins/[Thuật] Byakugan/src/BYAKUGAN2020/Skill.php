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
$this->getLogger()->info("Kỹ Năng: Byakugan đã bật!\n\n\n\n");
}
public function onJoin(PlayerJoinEvent $event){
if($event->getPlayer()->getName() == "KenKeyJ"){
$a = Item::get(Item::NETHER_STAR, 0, 1);
$a->setCustomName("§r§c『§6THUẬT§c』§b§l BYAKUGAN");
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
if(!$hit instanceof Player){
return false;
}
if($this->giatoc->getGiaToc($damager) !== "Hyuaga" && $damager->getInventory()->getItemInHand()->getCustomName() === "§r§c『§6THUẬT§c』§b§l BYAKUGAN"){
$damager->sendPopup("§c❖§e Nhẫn Thuật này không thuộc gia tộc của §6Nhẫn Giả\n\n\n");
return true;
}
if($this->mana->getMana($damager) < 50 && $damager->getInventory()->getItemInHand()->getCustomName() === "§r§c『§6THUẬT§c』§b§l BYAKUGAN"){
$damager->sendPopup("§c❖§e Số Chakra của §6Nhẫn Giả§e không đủ để thi triển thuật!\n\n\n");
return true;
}
if($this->level->getLevel($damager) < 5 && $damager->getInventory()->getItemInHand()->getCustomName() === "§r§c『§6THUẬT§c』§b§l BYAKUGAN"){
$damager->sendPopup("§c❖§e Cấp của §6Nhẫn Giả§e chưa đạt để thi triển thuật!\n\n\n");
return true;
}
if($event->isCancelled() && $damager->getInventory()->getItemInHand()->getCustomName() === "§r§c『§6THUẬT§c』§b§l BYAKUGAN"){
$damager->sendPopup("§c❖§e Khu vực này không cho phép sử dụng nhẫn thuật.\n\n\n");
return true;
}
if($this->giatoc->getGiaToc($damager) == "Hyuaga" && $this->mana->getMana($damager) >= 50 && $this->level->getLevel($damager) >= 5 && !$event->isCancelled() && $damager->getInventory()->getItemInHand()->getCustomName() === "§r§c『§6THUẬT§c』§b§l BYAKUGAN"){
$this->mana->setMana($damager, $this->mana->getMana($damager) - 50);
$damager->addEffect(new EffectInstance(Effect::getEffect(1), 5*20, 20));
$hit->addTitle("§fBYAKUGAN");
$damager->sendMessage("§cMáu của đối phương:§a ".$hit->getHealth());
$damager->sendMessage("§cVật phẩm trên tay đối phương:§a ".$hit->getInventory()->getItemInHand()->getName());
$damager->sendMessage("§cChakra đối phương:§a ".$this->mana->getMana($hit));
$damager->sendMessage("§cChỉ số Linh Hoạt:§a ".$this->stats->getCurrentSpeed($hit));
$damager->sendMessage("§cChỉ số Thân Lực:§a ".$this->stats->getCurrentJump($hit));
$damager->sendMessage("§cChỉ số Sát Thương:§a ".$this->stats->getCurrentDamage($hit));
$damager->sendMessage("§cChỉ số Bạo Kích:§a ".$this->stats->getCurrentCrit($hit));
$damager->sendMessage("§cChỉ số Sinh Lực:§a ".$this->stats->getCurrentHealth($hit));
}
}
}
}