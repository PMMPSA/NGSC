<?php

namespace KI;

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
$this->vang = $this->getServer()->getPluginManager()->getPlugin("NGVS_Vang");
if(!file_exists($this->getDataFolder() . "LuotKhoe/")){
@mkdir($this->getDataFolder() . "LuotKhoe/");
}
$this->lk = new Config($this->getDataFolder() . "LuotKhoe/" . "LuotKhoe.yml", Config::YAML);
$this->saveDefaultConfig();
$this->config = $this->getConfig();
$this->config->save();
$this->getServer()->getPluginManager()->registerEvents($this,$this);
}
public function onJoin(PlayerJoinEvent $ev){
$player = $ev->getPlayer()->getName();
if(!($this->lk->exists(strtolower($player)))){
$this->lk->set(strtolower($player), 0);
$this->lk->save();
return true;
}
}
public function viewLK($player){
$vlk = $this->lk->get(strtolower($player->getName()));
return $vlk;
}
public function addLK($player, $amount){
$this->lk->set(strtolower($player->getName()), $this->viewLK($player) + $amount);
$this->lk->save();
}
   //}
public function reduceLK($player, $amount){
$this->lk->set(strtolower($player->getName()), $this->viewLK($player) - $amount);
$this->lk->save();
}
//}
public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool{
if($cmd->getName() == "khoe"){
$this->menuUI($sender);
}
return true;
}
public function ThongBao($player, $message){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
$this->getServer()->dispatchCommand($player, "khoe");
return true;
}
switch($result){
case 0:
$this->getServer()->dispatchCommand($player, "khoe");
break;
}
});
$form->setTitle("§l§1KHOE VẬT PHẨM");
$form->setContent($message);
$form->addButton("§l§1Đã Hiểu");
$form->sendToPlayer($player);
return $form;
}
public function ThongBao1($player, $message){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, $data){
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
$form->setTitle("§l§1KHOE VẬT PHẨM");
$form->setContent($message);
$form->addButton("§l§1Đã Hiểu");
$form->sendToPlayer($player);
return $form;
}
public function menuUI($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, $data){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$this->muaUI($player);
break;
case 1:
if($this->viewLK($player) < 1){
$this->ThongBao($player, "§f•§c Số lượt khoe của Nhẫn Giả không đủ để thực hiện");
return true;
}
if($player->getInventory()->getItemInHand()->getId() == 0){
$this->ThongBao($player, "§f•§c Vật phẩm trên tay của Nhẫn Giả hiện đang trống nên không thể khoe");
return true;
}
$this->getServer()->broadcastMessage("§l§c❖§6 Nhẫn Giả ".$player->getName()."§e đang sở hữu vật phẩm §c".$player->getInventory()->getItemInHand()->getName()."§e. Các §6Nhẫn Giả§e đã có vật phẩm này chưa?");
$this->reduceLK($player, 1);
break;
}
});
$form->setTitle("§l§1KHOE VẬT PHẨM");
$form->setContent("§f•§a Số lượt khoe vật phẩm Nhẫn Giả đang có:§c ".$this->viewLK($player)." Lượt\n§f•§a Số vàng Nhẫn Giả đang có:§c ".$this->vang->getVang($player)." Vàng\n§l§cLƯU Ý:§r§a Mỗi lượt khoe có giá 5 Vàng. Để mua lượt khoe, các Nhẫn Giả vui lòng nhấn vào nút §7(§l§1MUA LƯỢT KHOE§r§7)§a.Sau khi mua, các Nhẫn Giả nhấn nút §7(§l§1KHOE VẬT PHẨM§r§7) để khoe vật phẩm đang cầm trên tay lên kênh chat.");
$form->addButton("§l§1MUA LƯỢT KHOE");
$form->addButton("§l§1KHOE VẬT PHẨM");
$form->sendToPlayer($player);
return $form;
}
public function muaUI($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createCustomForm(function (Player $player, $data){
$result = $data;
if($result === null){
$this->getServer()->dispatchCommand($player, "khoe");
return true;
}
if($data[0] != null && $this->vang->getVang($player) < 5*$data[0]){
$this->ThongBao1($player, "§f•§c Nhẫn Giả không có đủ ".(5*$data[0])."Vàng để mua ".$data[0]." lượt khoe");
return true;
}
if($data[0] != null && !is_numeric($data[0])){
$this->ThongBao1($player, "§f•§c Giá trị Nhẫn Giả vừa nhập không phải là số!");
return true;
}
if($data[0] != null && is_numeric($data[0]) && $this->vang->getVang($player) >= 5*$data[0]){
$this->ThongBao1($player, "§f•§a Nhẫn Giả đã mua thành công§c $data[0] §alượt");
$this->addLK($player, $data[0]);
$this->vang->reduceVang($player, $data[0]*5);
return true;
}
if($data[0] = null){
$this->ThongBao1($player, "§f•§c Vui lòng không bỏ trống!");
return true;
}
});
$form->setTitle("§l§1KHOE VẬT PHẨM");
//$form->addContent($message);
$form->addInput("§f•§a Vui lòng nhập số lượt:", "VD: 123456789");
$form->sendToPlayer($player);
return $form;
}

}
