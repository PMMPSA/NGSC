<?php

namespace QDC;

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

if(!file_exists($this->getDataFolder() . "Hệ Thống QidaCoin/")){
@mkdir($this->getDataFolder() . "Hệ Thống QidaCoin/");
}
$this->qidacoin = new Config($this->getDataFolder() . "Hệ Thống QidaCoin/" . "Dữ liệu QidaCoin.yml", Config::YAML);
$this->saveDefaultConfig();
$this->config = $this->getConfig();
$this->config->save();
$this->getServer()->getPluginManager()->registerEvents($this,$this);
}
public function onJoin(PlayerJoinEvent $ev){
$player = $ev->getPlayer()->getName();
if(!($this->qidacoin->exists(strtolower($player)))){
$this->qidacoin->set(strtolower($player), 0);
$this->qidacoin->save();
return true;
}
}
public function getQidaCoin(Player $player){
$getQidaCoin = $this->qidacoin->get(strtolower($player->getName()));
return $getQidaCoin;
}
public function getQidaCoin1($player){
if($player instanceof Player){
$player = $player->getName();
}
$player = strtolower($player);
$vsoul = $this->qidacoin->get($player);
return $vsoul;
}

public function addQidaCoin(Player $player, $number){
$getQidaCoin = $this->getQidaCoin($player);
$this->qidacoin->set(strtolower($player->getName()), $this->getQidaCoin($player) + $number);
$this->qidacoin->save();
return true;
}
public function reduceQidaCoin(Player $player, $number){
$getQidaCoin = $this->getQidaCoin($player);
$this->qidacoin->set(strtolower($player->getName()), $this->getQidaCoin($player) - $number);
$this->qidacoin->save();
return true;
}
public function getAllQidaCoin(){
$getAllQidaCoin = $this->qidacoin->getAll();
return $getAllQidaCoin;
}
}