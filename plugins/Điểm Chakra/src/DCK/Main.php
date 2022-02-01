<?php

namespace DCK;

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
if(!file_exists($this->getDataFolder() . "Điểm Chakra/")){
@mkdir($this->getDataFolder() . "Điểm Chakra/");
}
$this->chakra = new Config($this->getDataFolder() . "Điểm Chakra/" . "Dữ liệu Điểm Chakra.yml", Config::YAML);
$this->saveDefaultConfig();
$this->config = $this->getConfig();
$this->config->save();
$this->getServer()->getPluginManager()->registerEvents($this,$this);
}
public function onJoin(PlayerJoinEvent $ev){
$player = $ev->getPlayer()->getName();
if(!($this->chakra->exists(strtolower($player)))){
$this->chakra->set(strtolower($player), 0);
$this->chakra->save();
return true;
}
}
public function getChakra(Player $player){
$getChakra = $this->chakra->get(strtolower($player->getName()));
return $getChakra;
}
public function addChakra(Player $player, $number){
$getChakra = $this->getChakra($player);
$this->chakra->set(strtolower($player->getName()), $this->getChakra($player) + $number);
$this->chakra->save();
return true;
}
public function reduceChakra(Player $player, $number){
$getChakra = $this->getChakra($player);
$this->chakra->set(strtolower($player->getName()), $this->getChakra($player) - $number);
$this->chakra->save();
return true;
}
public function getAllChakra(){
$getAllChakra = $this->chakra->getAll();
return $getAllChakra;
}


//----------------------------------------------------------------------------------------------------------
/*public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool{
if($command->getName() === "chakra"){
$this->Chakra($sender);
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
$form->setTitle("§l§1HỆ THỐNG ĐIỂM CHAKRA");
$form->setContent($message);
$form->addButton("§l§1OK");
$form->sendToPlayer($player);
return $form;
}
public function Chakra($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$this->topChakra($player);
break;
}
});
$form->setTitle("§l§1HỆ THỐNG ĐIỂM CHAKRA");
$form->setContent("§f•§a Tổng điểm Chakra hiện tại của Nhẫn Giả là: §c".$this->getAllChakra($player)."§a Chakra");
$form->addButton("§l§1XEM TOP XU");
$form->sendToPlayer($player);
return $form;
}
public function topChakra($player){
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
$form->setTitle("§l§1TOP CHAKRA TOÀN MÁY CHỦ");
$form->setContent();
$form->addButton("§l§1OK");
$form->sendToPlayer($player);
return $form;
}*/

}