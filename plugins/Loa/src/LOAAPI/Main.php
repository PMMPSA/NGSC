<?php

namespace LOAAPI;

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
use pocketmine\network\protocol\SetTitlePacket;
//use PTK\coinapi\Coin;

class Main extends PluginBase implements Listener{

public $data;
private $config, $amount;

public function onEnable(){
$this->xu = $this->getServer()->getPluginManager()->getPlugin("NGVS_Xu");
if(!file_exists($this->getDataFolder() . "Hệ Thống Loa/")){
@mkdir($this->getDataFolder() . "Hệ Thống Loa/");
}
$this->loa = new Config($this->getDataFolder() . "Hệ Thống Loa/" . "Data_loa.yml", Config::YAML);
$this->saveDefaultConfig();
$this->config = $this->getConfig();
$this->config->save();
$this->getServer()->getPluginManager()->registerEvents($this,$this);
}
public function onJoin(PlayerJoinEvent $ev){
$player = $ev->getPlayer()->getName();
if(!($this->loa->exists(strtolower($player)))){
$this->loa->set(strtolower($player), 0);
$this->loa->save();
return true;
}
}
public function viewLOA($player){
$vLOA = $this->loa->get(strtolower($player->getName()));
return $vLOA;
}
public function addLOA($player, $amount){
$this->loa->set(strtolower($player->getName()), $this->viewLOA($player) + $amount);
$this->loa->save();
}
   //}
public function reduceLOA($player, $amount){
$this->loa->set(strtolower($player->getName()), $this->viewLOA($player) - $amount);
$this->loa->save();
}
//}
public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool{
if($cmd->getName() == "loa"){
$this->menuUI($sender);
}
return true;
}
public function ThongBao($player, $message){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
$this->getServer()->dispatchCommand($player, "loa");
return true;
}
switch($result){
case 0:
$this->getServer()->dispatchCommand($player, "loa");
break;
}
});
$form->setTitle("§l§1HỆ THỐNG LOA");
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
$this->muaUI($player);
return true;
}
switch($result){
case 0:
$this->muaUI($player);
break;
}
});
$form->setTitle("§l§HỆ THỐNG LOA");
$form->setContent($message);
$form->addButton("§l§1Đã Hiểu");
$form->sendToPlayer($player);
return $form;
}
public function menuUI($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$this->muaUI($player);
break;
case 1:
if($this->viewLOA($player) < 1){
$this->ThongBao($player, "§f•§c Số lượt dùng loa của Nhẫn Giả không đủ để thực hiện");
return true;
}
$this->useLoa($player);
$this->reduceLOA($player, 1);
break;
}
});
$form->setTitle("§l§1HỆ THỐNG LOA");
$form->setContent("§f•§a Số lượt dùng loa Nhẫn Giả đang có:§c ".$this->viewLOA($player)." Lượt\n§f•§a Số xu Nhẫn Giả đang có:§c ".$this->xu->getXu($player)." Xu\n§l§cLƯU Ý:§r§a Mỗi loa có giá 50.000 Xu. Để mua loa, các Nhẫn Giả vui lòng nhấn vào nút §7(§l§1MUA LOA§r§7)§a.Sau khi mua, các Nhẫn Giả nhấn nút §7(§l§1DÙNG LOA§r§7)§a để hiển thị lời nói của Nhẫn Giả lên kênh chat.");
$form->addButton("§l§1MUA LOA");
$form->addButton("§l§1DÙNG LOA");
$form->sendToPlayer($player);
return $form;
}
public function muaUI($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createCustomForm(function (Player $player, $data){
$result = $data;
if($result === null){
$this->getServer()->dispatchCommand($player, "loa");
return true;
}
if($data[0] != null && $this->xu->getXu($player) < 50000*$data[0]){
$this->ThongBao1($player, "§f•§c Nhẫn Giả không có đủ ".(50000*$data[0])."Xu để mua ".$data[0]." loa");
return true;
}
if($data[0] != null && !is_numeric($data[0])){
$this->ThongBao1($player, "§f•§c Giá trị Nhẫn Giả vừa nhập không phải là số!");
return true;
}
if($data[0] != null && is_numeric($data[0]) && $this->xu->getXu($player) >= 50000*$data[0]){
$this->ThongBao1($player, "§f•§a Nhẫn Giả đã mua thành công§c $data[0] §alượt");
$this->addLOA($player, $data[0]);
$this->xu->reduceXu($player, $data[0]*50000);
return true;
}
if($data[0] = null){
	$this->ThongBao1($player, "§f•§c Vui lòng không bỏ trống số lượng cần mua!");
	return true;
}
});
$form->setTitle("§l§1HỆ THỐNG LOA");
//$form->addContent($message);
$form->addInput("§f•§a Vui lòng nhập số lượt:", "VD: 123456789");
$form->sendToPlayer($player);
return $form;
}
public function useLoa($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createCustomForm(function (Player $player, $data){
$result = $data;
if($result === null){
$this->getServer()->dispatchCommand($player, "loa");
return true;
}
if($data[0] != null){
$motivo = implode(" ", $data);
$worte = explode(" ", $motivo);
unset($worte[0]);
$motivo = implode(" ", $worte);
$this->ThongBao($player, "§f•§a Nhẫn Giả đã dùng thành công 1 lượt loa để nói: ".$motivo);
$this->getServer()->broadcastMessage("§l§c❖§6 Nhẫn Giả §e".$player->getName()." đã nói:§r§c ".$motivo);
return true;
}
if($data[0] = null){
$this->ThongBao1($player, "§f•§c Vui lòng không bỏ trống!");
return true;
}
});
$form->setTitle("§l§1HỆ THỐNG LOA");
//$form->addContent($message);
$form->addInput("§f•§a Vui lòng nhập lời nói:", "VD: Nhẫn Giả Song Chiến");
$form->sendToPlayer($player);
return $form;
}



}
