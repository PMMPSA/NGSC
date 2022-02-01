<?php

namespace NGVS\NGVS_Stats;

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
use pocketmine\event\player\{PlayerInteractEvent, PlayerItemHeldEvent, PlayerJoinEvent, PlayerChatEvent, PlayerMoveEvent};
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\block\Block;
use pocketmine\level\particle\{AngryVillagerParticle,BubbleParticle,CriticalParticle,DestroyBlockParticle,DustParticle,EnchantmentTableParticle,EnchantParticle,EntityFlameParticle,LargeExplodeParticle,FlameParticle,HappyVillagerParticle,HeartParticle,InkParticle,InstantEnchantParticle,ItemBreakParticle,LavaDripParticle,LavaParticle,MobSpellParticle,PortalParticle,RainSplashParticle,RedstoneParticle,SmokeParticle,SpellParticle,SplashParticle,SporeParticle,TerrainParticle,WaterDripParticle,WaterParticle,WhiteSmokeParticle};
use pocketmine\math\Vector3;
use pocketmine\utils\Config;
use pocketmine\Inventory;
use pocketmine\level\Level;
use pocketmine\entity\human;
use pocketmine\entity\Effect;
use NGVS\NGVS_Mana\Mana\ManaTask;
use pocketmine\network\protocol\SetTitlePacket;

class Main extends PluginBase implements Listener{

public $data;
private $config, $amount;

public function onEnable(){
if(!file_exists($this->getDataFolder() . "Stats/")){
@mkdir($this->getDataFolder() . "Stats/");
}
$this->stats = new Config($this->getDataFolder() . "Stats/" . "data.yml", Config::YAML);
$this->saveDefaultConfig();
$this->config = $this->getConfig();
$this->config->save();
$this->getServer()->getPluginManager()->registerEvents($this,$this);
}
public function onJoin(PlayerJoinEvent $ev){
$player = $ev->getPlayer()->getName();
if(!($this->stats->exists(strtolower($player)))){
$this->stats->set(strtolower($player), [1,1,1,1,0,10]);
$this->stats->save();
return true;
}
$ev->getPlayer()->setMaxHealth($this->getCurrentHealth($ev->getPlayer())*2);
}
public function getCurrentJump(Player $player){
$getCurrentJump = $this->stats->get(strtolower($player->getName()))[0];
return $getCurrentJump;
}
public function getCurrentSpeed(Player $player){
$getCurrentSpeed = $this->stats->get(strtolower($player->getName()))[1];
return $getCurrentSpeed;
}
public function getCurrentDamage(Player $player){
$getCurrentDamage = $this->stats->get(strtolower($player->getName()))[2];
return $getCurrentDamage;
}
public function getCurrentCrit(Player $player){
$getCurrentCrit = $this->stats->get(strtolower($player->getName()))[3];
return $getCurrentCrit;
}
public function getCurrentStats(Player $player){
$getCurrentStats = $this->stats->get(strtolower($player->getName()))[4];
return $getCurrentStats;
}
public function getCurrentHealth(Player $player){
$getCurrentHealth = $this->stats->get(strtolower($player->getName()))[5];
return $getCurrentHealth;
}
public function upgradeJump(Player $player){
$getCurrentJump = $this->getCurrentJump($player);
$getCurrentSpeed = $this->getCurrentSpeed($player);
$getCurrentDamage = $this->getCurrentDamage($player);
$getCurrentCrit = $this->getCurrentCrit($player);
$getStats = $this->getCurrentStats($player);
$getHealth = $this->getCurrentHealth($player);
$this->stats->set(strtolower($player->getName()), [$getCurrentJump + 1, $getCurrentSpeed, $getCurrentDamage, $getCurrentCrit, $getStats, $getHealth]);
$this->stats->save();
return true;
}
public function upgradeDamage(Player $player){
$getCurrentJump = $this->getCurrentJump($player);
$getCurrentSpeed = $this->getCurrentSpeed($player);
$getCurrentDamage = $this->getCurrentDamage($player);
$getCurrentCrit = $this->getCurrentCrit($player);
$getStats = $this->getCurrentStats($player);
$getHealth = $this->getCurrentHealth($player);
$this->stats->set(strtolower($player->getName()), [$getCurrentJump, $getCurrentSpeed, $getCurrentDamage + 1, $getCurrentCrit, $getStats, $getHealth]);
$this->stats->save();
return true;
}
public function upgradeCrit(Player $player){
$getCurrentJump = $this->getCurrentJump($player);
$getCurrentSpeed = $this->getCurrentSpeed($player);
$getCurrentDamage = $this->getCurrentDamage($player);
$getCurrentCrit = $this->getCurrentCrit($player);
$getStats = $this->getCurrentStats($player);
$getHealth = $this->getCurrentHealth($player);
$this->stats->set(strtolower($player->getName()), [$getCurrentJump, $getCurrentSpeed, $getCurrentDamage, $getCurrentCrit + 1, $getStats, $getHealth]);
$this->stats->save();
return true;
}
public function upgradeSpeed(Player $player){
$getCurrentJump = $this->getCurrentJump($player);
$getCurrentSpeed = $this->getCurrentSpeed($player);
$getCurrentDamage = $this->getCurrentDamage($player);
$getCurrentCrit = $this->getCurrentCrit($player);
$getStats = $this->getCurrentStats($player);
$getHealth = $this->getCurrentHealth($player);
$this->stats->set(strtolower($player->getName()), [$getCurrentJump, $getCurrentSpeed + 1, $getCurrentDamage, $getCurrentCrit, $getStats, $getHealth]);
$this->stats->save();
return true;
}
public function upgradeHealth(Player $player){
$getCurrentJump = $this->getCurrentJump($player);
$getCurrentSpeed = $this->getCurrentSpeed($player);
$getCurrentDamage = $this->getCurrentDamage($player);
$getCurrentCrit = $this->getCurrentCrit($player);
$getStats = $this->getCurrentStats($player);
$getHealth = $this->getCurrentHealth($player);
$this->stats->set(strtolower($player->getName()), [$getCurrentJump, $getCurrentSpeed, $getCurrentDamage, $getCurrentCrit, $getStats, $getHealth + 1]);
$this->stats->save();
return true;
}
public function addStats(Player $player, $count){
$getCurrentJump = $this->getCurrentJump($player);
$getCurrentSpeed = $this->getCurrentSpeed($player);
$getCurrentDamage = $this->getCurrentDamage($player);
$getCurrentCrit = $this->getCurrentCrit($player);
$getStats = $this->getCurrentStats($player);
$getHealth = $this->getCurrentHealth($player);
$this->stats->set(strtolower($player->getName()), [$getCurrentJump, $getCurrentSpeed, $getCurrentDamage, $getCurrentCrit, $getStats + $count, $getHealth]);
$this->stats->save();
return true;
}
public function reduceStats(Player $player, $count){
$getCurrentJump = $this->getCurrentJump($player);
$getCurrentSpeed = $this->getCurrentSpeed($player);
$getCurrentDamage = $this->getCurrentDamage($player);
$getCurrentCrit = $this->getCurrentCrit($player);
$getStats = $this->getCurrentStats($player);
$getHealth = $this->getCurrentHealth($player);
$this->stats->set(strtolower($player->getName()), [$getCurrentJump, $getCurrentSpeed, $getCurrentDamage, $getCurrentCrit, $getStats - $count, $getHealth]);
$this->stats->save();
return true;
}
public function onFight(EntityDamageEvent $event) {
if($event instanceof EntityDamageByEntityEvent) {
$hit = $event->getEntity();
$damager = $event->getDamager();
if($damager instanceof Player) {
$event->setModifier($this->getCurrentDamage($damager),2);
$event->setModifier($this->getCurrentDamage($damager),7);
}
if(!$damager instanceof Player){
return false;
}


}
}
/*public function onMove(PlayerMoveEvent $event){
$player = $event->getPlayer();
$player->setHealth($this->getCurrentHealth($player));
}*/


}