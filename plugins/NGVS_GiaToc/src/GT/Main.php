<?php

namespace GT;

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
if(!file_exists($this->getDataFolder() . "Gia Tộc/")){
@mkdir($this->getDataFolder() . "Gia Tộc/");
}
$this->giatoc = new Config($this->getDataFolder() . "Gia Tộc/" . "data.yml", Config::YAML);
$this->saveDefaultConfig();
$this->config = $this->getConfig();
$this->config->save();
$this->getServer()->getPluginManager()->registerEvents($this,$this);
}
public function onJoin(PlayerJoinEvent $ev){
$player = $ev->getPlayer()->getName();
if(!($this->giatoc->exists(strtolower($player)))){
$this->giatoc->set(strtolower($player), ["Gia Tộc" => "Chưa có"]);
$this->giatoc->save();
$this->chonGiaToc($ev->getPlayer());
return true;
}
/*if($this->giatoc->get(strtolower($player))["Gia Tộc"] === "Chưa có"){
$this->chonGiaToc($ev->getPlayer());
return true;
}*/
}
public function onMove(PlayerMoveEvent $event){
if($this->giatoc->get(strtolower($event->getPlayer()->getName()))["Gia Tộc"] === "Chưa có"){
$this->chonGiaToc($event->getPlayer());
}
}
public function getGiaToc(Player $player){
$getHe = $this->giatoc->get(strtolower($player->getName()))["Gia Tộc"];
return $getHe;
}
public function setGiaToc(Player $player, $type){
$this->giatoc->set(strtolower($player->getName()), ["Gia Tộc" => $type]);
$this->giatoc->save();
}
public function ThongBao($player, $message){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
$this->chonGiaToc($player);
return true;
}
switch($result){
case 0:
$this->chonGiaToc($player);
break;
}
});
$form->setTitle("§l§1HỆ THỐNG GIA TỘC");
$form->setContent($message);
$form->addButton("§l§1Đã Hiểu");
$form->sendToPlayer($player);
return $form;
}
public function ThongBao1($player, $message){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
//$this->chonGiaToc($player);
return true;
}
switch($result){
case 0:
//$this->chonGiaToc($player);
break;
}
});
$form->setTitle("§l§1HỆ THỐNG GIA TỘC");
$form->setContent($message);
$form->addButton("§l§1Đã Hiểu");
$form->sendToPlayer($player);
return $form;
}
public function chonGiaToc($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
$this->chonGiaToc($player);
return true;
}
switch($result){
case 0:
$this->xacnhanGiaToc($player, "Hyuaga", "§f•§a Nhẫn Giả có thực sự muốn gia nhập vào tộc §cHyuaga§a?");
break;
case 1:
$this->xacnhanGiaToc($player, "Uzumaki", "§f•§a Nhẫn Giả có thực sự muốn gia nhập vào tộc §cUzumaki§a?");
break;
case 2:
$this->xacnhanGiaToc($player, "Uchiha", "§f•§a Nhẫn Giả có thực sự muốn gia nhập vào tộc §cUchiha§a?");
break;
}
});
$form->setTitle("§l§1Gia Tộc NGUYÊN TỐ");
$form->setContent("§f•§a Nhẫn Giả vui lòng chọn Gia Tộc cho riêng mình:");
$form->addButton("§l§1Gia Tộc Hyuaga", 1, "https://www.upsieutoc.com/images/2020/03/13/20200313_142506.png");
$form->addButton("§l§1Gia Tộc Uzumaki", 1, "https://www.upsieutoc.com/images/2020/03/13/20200313_142715.png");
$form->addButton("§l§1Gia Tộc Uchiha", 1, "https://www.upsieutoc.com/images/2020/03/13/20200313_142819.png");
$form->sendToPlayer($player);
return $form;
}
public function xacnhanGiaToc($player, $type, $mess){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null) use ($type, $mess){
$result = $data;
if($result === null){
$this->chonGiaToc($player);
return true;
}
switch($result){
case 0:
if($type === "Hyuaga"){
$this->ThongBao1($player, "§f•§a Nhẫn Giả đã lựa chọn Gia Tộc Hyuaga thành công, hãy bắt đầu hành trình nào!");
$this->setGiaToc($player, $type);
return true;
}
if($type === "Uzumaki"){
$this->ThongBao1($player, "§f•§a Nhẫn Giả đã lựa chọn Gia Tộc Uzumaki thành công, hãy bắt đầu hành trình nào!");
$this->setGiaToc($player, $type);
return true;
}
if($type === "Uchiha"){
$this->ThongBao1($player, "§f•§a Nhẫn Giả đã lựa chọn Gia Tộc Uchiha thành công, hãy bắt đầu hành trình nào!");
$this->setGiaToc($player, $type);
return true;
}
var_dump($player);
break;
case 1:
$this->chonGiaToc($player);
break;
}
});
$form->setTitle("§l§1HỆ THỐNG GIA TỘC");
$form->setContent($mess);
$form->addButton("§l§1XÁC NHẬN");
$form->addButton("§l§1HỦY");
$form->sendToPlayer($player);
return $form;
}



}



