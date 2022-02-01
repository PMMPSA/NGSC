<?php

namespace SM;

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
if(!file_exists($this->getDataFolder() . "Hệ Thống Sức Mạnh/")){
@mkdir($this->getDataFolder() . "Hệ Thống Sức Mạnh/");
}
$this->sucmanh = new Config($this->getDataFolder() . "Hệ Thống Sức Mạnh/" . "Dữ liệu Sức Mạnh.yml", Config::YAML);
$this->saveDefaultConfig();
$this->config = $this->getConfig();
$this->config->save();
$this->getServer()->getPluginManager()->registerEvents($this,$this);
}
public function onJoin(PlayerJoinEvent $ev){
$player = $ev->getPlayer()->getName();
if(!($this->sucmanh->exists(strtolower($player)))){
$this->sucmanh->set(strtolower($player), 0);
$this->sucmanh->save();
return true;
}
}
public function getSucmanh(Player $player){
$getSucmanh = $this->sucmanh->get(strtolower($player->getName()));
return $getSucmanh;
}
public function addSucmanh(Player $player, $number){
$getSucmanh = $this->getSucmanh($player);
$this->sucmanh->set(strtolower($player->getName()), $this->getSucmanh($player) + $number);
$this->sucmanh->save();
return true;
}
public function reduceLucchien(Player $player, $number){
$getSucmanh = $this->getSucmanh($player);
$this->sucmanh->set(strtolower($player->getName()), $this->getSucmanh($player) - $number);
$this->sucmanh->save();
return true;
}
public function getAllSucmanh(){
$getAllSucmanh = $this->sucmanh->getAll();
return $getAllSucmanh;
}

/*public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool{
if($command->getName() === "top"){
$this->topSucmanh($sender);
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
$form->setTitle("§l§1HỆ THỐNG SỨC MẠNH NGSC");
$form->setContent($message);
$form->addButton("§l§1Đã Hiểu");
$form->sendToPlayer($player);
return $form;
}
public function topSucmanh($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$this->topSucmanh($player);
break;
}
});
$form->setTitle("§l§1HỆ THỐNG SỨC MẠNH NGSC");
$form->setContent("§f•§a Sức mạnh hiện tại của Nhẫn Giả là: §c".$this->getSucmanh($player)." Sức Mạnh");
$form->addButton("§l§1XEM TOP SỨC MẠNH");
$form->sendToPlayer($player);
return $form;
}
public function topSucmanh($player){
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
$form->setTitle("§l§1TOP SỨC MẠNH NGSC");
$form->setContent();
$form->addButton("§l§1Đã Hiểu");
$form->sendToPlayer($player);
return $form;
}*/

}