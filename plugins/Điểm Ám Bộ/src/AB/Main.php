<?php

namespace AB;

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
if(!file_exists($this->getDataFolder() . "Hệ Thống Điểm Ám Bộ/")){
@mkdir($this->getDataFolder() . "Hệ Thống Điểm Ám Bộ/");
}
$this->ambo = new Config($this->getDataFolder() . "Hệ Thống Điểm Ám Bộ/" . "Dữ liệu vàng.yml", Config::YAML);
$this->saveDefaultConfig();
$this->config = $this->getConfig();
$this->config->save();
$this->getServer()->getPluginManager()->registerEvents($this,$this);
}
public function onJoin(PlayerJoinEvent $ev){
$player = $ev->getPlayer()->getName();
if(!($this->ambo->exists(strtolower($player)))){
$this->ambo->set(strtolower($player), 0);
$this->ambo->save();
return true;
}
}
public function getAmbo(Player $player){
$getAmbo = $this->ambo->get(strtolower($player->getName()));
return $getAmbo;
}
public function addAmbo(Player $player, $number){
$getAmbo = $this->getAmbo($player);
$this->ambo->set(strtolower($player->getName()), $this->getAmbo($player) + $number);
$this->ambo->save();
return true;
}
public function reduceAmbo(Player $player, $number){
$getAmbo = $this->getAmbo($player);
$this->ambo->set(strtolower($player->getName()), $this->getAmbo($player) - $number);
$this->ambo->save();
return true;
}
public function getAllAmbo(){
$getAllAmbo = $this->ambo->getAll();
return $getAllAmbo;
}

/*public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool{
if($command->getName() === "xu"){
$this->menuXu($sender);
}
return true;
}
public function ThongBao($player, $message){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
break;
}
});
$form->setTitle("§l§1HỆ THỐNG XU");
$form->setContent($message);
$form->addButton("§l§1Đã Hiểu");
$form->sendToPlayer($player);
return $form;
}
public function menuXu($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$this->topXu($player);
break;
}
});
$form->setTitle("§l§1HỆ THỐNG XU");
$form->setContent("§f•§a Số Xu hiện tại Nhẫn Giả đang sở hữu: §c".$this->getXu($player)."§a Xu");
$form->addButton("§l§1XEM TOP XU");
$form->sendToPlayer($player);
return $form;
}
public function topXu($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
break;
}
});
$form->setTitle("§l§1TOP XU MÁY CHỦ");
$form->setContent();
$form->addButton("§l§1Đã Hiểu");
$form->sendToPlayer($player);
return $form;
}*/

}