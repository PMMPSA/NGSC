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
$form->setTitle("??l??1KHOE V???T PH???M");
$form->setContent($message);
$form->addButton("??l??1???? Hi???u");
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
$form->setTitle("??l??1KHOE V???T PH???M");
$form->setContent($message);
$form->addButton("??l??1???? Hi???u");
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
$this->ThongBao($player, "??f?????c S??? l?????t khoe c???a Nh???n Gi??? kh??ng ????? ????? th???c hi???n");
return true;
}
if($player->getInventory()->getItemInHand()->getId() == 0){
$this->ThongBao($player, "??f?????c V???t ph???m tr??n tay c???a Nh???n Gi??? hi???n ??ang tr???ng n??n kh??ng th??? khoe");
return true;
}
$this->getServer()->broadcastMessage("??l??c?????6 Nh???n Gi??? ".$player->getName()."??e ??ang s??? h???u v???t ph???m ??c".$player->getInventory()->getItemInHand()->getName()."??e. C??c ??6Nh???n Gi?????e ???? c?? v???t ph???m n??y ch??a?");
$this->reduceLK($player, 1);
break;
}
});
$form->setTitle("??l??1KHOE V???T PH???M");
$form->setContent("??f?????a S??? l?????t khoe v???t ph???m Nh???n Gi??? ??ang c??:??c ".$this->viewLK($player)." L?????t\n??f?????a S??? v??ng Nh???n Gi??? ??ang c??:??c ".$this->vang->getVang($player)." V??ng\n??l??cL??U ??:??r??a M???i l?????t khoe c?? gi?? 5 V??ng. ????? mua l?????t khoe, c??c Nh???n Gi??? vui l??ng nh???n v??o n??t ??7(??l??1MUA L?????T KHOE??r??7)??a.Sau khi mua, c??c Nh???n Gi??? nh???n n??t ??7(??l??1KHOE V???T PH???M??r??7) ????? khoe v???t ph???m ??ang c???m tr??n tay l??n k??nh chat.");
$form->addButton("??l??1MUA L?????T KHOE");
$form->addButton("??l??1KHOE V???T PH???M");
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
$this->ThongBao1($player, "??f?????c Nh???n Gi??? kh??ng c?? ????? ".(5*$data[0])."V??ng ????? mua ".$data[0]." l?????t khoe");
return true;
}
if($data[0] != null && !is_numeric($data[0])){
$this->ThongBao1($player, "??f?????c Gi?? tr??? Nh???n Gi??? v???a nh???p kh??ng ph???i l?? s???!");
return true;
}
if($data[0] != null && is_numeric($data[0]) && $this->vang->getVang($player) >= 5*$data[0]){
$this->ThongBao1($player, "??f?????a Nh???n Gi??? ???? mua th??nh c??ng??c $data[0] ??al?????t");
$this->addLK($player, $data[0]);
$this->vang->reduceVang($player, $data[0]*5);
return true;
}
if($data[0] = null){
$this->ThongBao1($player, "??f?????c Vui l??ng kh??ng b??? tr???ng!");
return true;
}
});
$form->setTitle("??l??1KHOE V???T PH???M");
//$form->addContent($message);
$form->addInput("??f?????a Vui l??ng nh???p s??? l?????t:", "VD: 123456789");
$form->sendToPlayer($player);
return $form;
}

}
