<?php

namespace HTB;

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
if(!file_exists($this->getDataFolder() . "Hệ Thống Bạc/")){
@mkdir($this->getDataFolder() . "Hệ Thống Bạc/");
}
$this->bac = new Config($this->getDataFolder() . "Hệ Thống Bạc/" . "Dữ liệu Bạc.yml", Config::YAML);
$this->saveDefaultConfig();
$this->config = $this->getConfig();
$this->config->save();
$this->getServer()->getPluginManager()->registerEvents($this,$this);
}
public function onJoin(PlayerJoinEvent $ev){
$player = $ev->getPlayer()->getName();
if(!($this->bac->exists(strtolower($player)))){
$this->bac->set(strtolower($player), 0);
$this->bac->save();
return true;
}
}
public function getBac(Player $player){
$getBac = $this->bac->get(strtolower($player->getName()));
return $getBac;
}
public function addBac(Player $player, $number){
$getBac = $this->getBac($player);
$this->bac->set(strtolower($player->getName()), $this->getBac($player) + $number);
$this->bac->save();
return true;
}
public function reduceBac(Player $player, $number){
$getBac = $this->getBac($player);
$this->bac->set(strtolower($player->getName()), $this->getBac($player) - $number);
$this->bac->save();
return true;
}
public function getAllBac(){
$getAllBac = $this->bac->getAll();
return $getAllBac;
}
}