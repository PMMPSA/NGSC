<?php

namespace NV;

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
use slapper\entities\SlapperHuman;
use slapper\events\SlapperHitEvent;

class Main extends PluginBase implements Listener{

public $data;
private $config, $amount;

public function onEnable(){
if(!file_exists($this->getDataFolder() . "[NV] Thầy Kakashi #1/")){
@mkdir($this->getDataFolder() . "[NV] Thầy Kakashi #1/");
}
$this->quest = new Config($this->getDataFolder() . "[NV] Thầy Kakashi #1/" . "Dữ liệu nhiệm vụ.yml", Config::YAML);
$this->saveDefaultConfig();
$this->config = $this->getConfig();
$this->config->save();
$this->level = $this->getServer()->getPluginManager()->getPlugin("NGVS_Level");
$this->xu = $this->getServer()->getPluginManager()->getPlugin("NGVS_Xu");
$this->bac = $this->getServer()->getPluginManager()->getPlugin("NGVS_Bac");
$this->haku = $this->getServer()->getPluginManager()->getPlugin("NV_Haku_5");
$this->nv = $this->getServer()->getPluginManager()->getPlugin("NGVS_Quest");
//$this->jiraiya = $this->getServer()->getPluginManager()->getPlugin("NV_Jiraiya_7");
$this->getServer()->getPluginManager()->registerEvents($this,$this);
}
public function onJoin(PlayerJoinEvent $event){
if(!($this->quest->exists(strtolower($event->getPlayer()->getName())))){
$this->quest->set(strtolower($event->getPlayer()->getName()), ["1" => "Not", "2" => "Not", "3" => "Not", "4" => "Not", "5" => "Not", "6" => "Not"]);
$this->quest->save();
return true;
}
}
public function get1(Player $player){
$get1 = $this->quest->get(strtolower($player->getName()))["1"];
return $get1;
}
public function get2(Player $player){
$get2 = $this->quest->get(strtolower($player->getName()))["2"];
return $get2;
}
public function get3(Player $player){
$get3 = $this->quest->get(strtolower($player->getName()))["3"];
return $get3;
}
public function get4(Player $player){
$get4 = $this->quest->get(strtolower($player->getName()))["4"];
return $get4;
}
public function get5(Player $player){
$get5 = $this->quest->get(strtolower($player->getName()))["5"];
return $get5;
}
public function get6(Player $player){
$get6 = $this->quest->get(strtolower($player->getName()))["6"];
return $get6;
}

public function setDone1(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Not", "3" => "Not", "4" => "Not", "5" => "Not", "6" => "Not"]);
$this->quest->save();
}
public function setDone2(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Not", "4" => "Not", "5" => "Not", "6" => "Not"]);
$this->quest->save();
}
public function setDone3(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Not", "5" => "Not", "6" => "Not"]);
$this->quest->save();
}
public function setDone4(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Done", "5" => "Not", "6" => "Not"]);
$this->quest->save();
}
public function setDone5(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Done", "5" => "Done", "6" => "Not"]);
$this->quest->save();
}
public function setDone6(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Done", "5" => "Done", "6" => "Done"]);
$this->quest->save();
}
public function onTap(SlapperHitEvent $ev){
$entity = $ev->getEntity();
$damager = $ev->getDamager();
if(!$entity instanceof SlapperHuman && $entity->getName() !== "§l§e【§cNhiệm Vụ§e】§r§f Thầy Kakashi §6#1"){
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cNhiệm Vụ§e】§r§f Thầy Kakashi §6#1" && $this->get1($damager) == "Not" && $this->get2($damager) == "Not" && $this->get3($damager) == "Not"){
$this->UIquest1($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cNhiệm Vụ§e】§r§f Thầy Kakashi §6#1" && $this->get1($damager) == "Done" && $this->get2($damager) == "Not" && $this->get3($damager) == "Not"){
$this->UIquest2($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cNhiệm Vụ§e】§r§f Thầy Kakashi §6#1" && $this->get1($damager) == "Done" && $this->get2($damager) == "Done" && $this->get3($damager) == "Not"){
$this->UIquest3($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cNhiệm Vụ§e】§r§f Thầy Kakashi §6#1" && $this->get3($damager) == "Done" && $this->get4($damager) == "Not"){
$this->UIquest4($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cNhiệm Vụ§e】§r§f Thầy Kakashi §6#1" && $this->haku->get4($damager) == "Done" && $this->get4($damager) == "Done" && $this->get5($damager) == "Not"){
$this->UIquest5($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cNhiệm Vụ§e】§r§f Thầy Kakashi §6#1" && $this->haku->get4($damager) == "Done" && $this->get5($damager) == "Done" && $this->get6($damager) == "Not"){
$this->UIquest6($damager);
return true;
}

if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cNhiệm Vụ§e】§r§f Thầy Kakashi §6#1" && $this->get6($damager) == "Done"){
$this->UIthongbao($damager, "§f•§a Nhẫn Giả đã hoàn thành nhiệm vụ của NPC này!");
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cNhiệm Vụ§e】§r§f Thầy Kakashi §6#1" && $this->haku->get4($damager) == "Not" && $this->get4($damager) == "Done" && $this->get5($damager) == "Not"){
$this->UIthongbao($damager, "§f•§a Vui lòng hoàn thành nhiệm vụ theo số thứ tự!");
return true;
}

}
public function UIthongbao($player, $message){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null) use ($message){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
break;
}
});
$form->setTitle("§l§e【§cNhiệm Vụ§e】§r§f Thầy Kakashi §6#1");
$form->setContent($message);
$form->addButton("§l§1Đã Hiểu");
$form->sendToPlayer($player);
return $form;
}
public function UIquest1($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$this->UIquest2($player);
$this->setDone1($player);
break;
}
});
$form->setTitle("§l§e【§cNhiệm Vụ§e】§r§f Thầy Kakashi §6#1");
$form->setContent("§fXin chào Nhẫn Giả giỏi nhất của Làng Lá, ".$player->getName());
$form->addButton("§l§1Tiếp tục đối thoại ➣");
$form->sendToPlayer($player);
return $form;
}
public function UIquest2($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$this->UIquest3($player);
$this->setDone2($player);
break;
}
});
$form->setTitle("§l§e【§cNhiệm Vụ§e】§r§f Thầy Kakashi §6#1");
$form->setContent("§fThật tiếc khi phải thông báo với Nhẫn Giả rằng Nhẫn Giả sẽ không được ghép đội với các Nhẫn Giả khác vì thành tích quá nổi trội của bản thân.");
$form->addButton("§l§1Tiếp tục đối thoại ➣");
$form->sendToPlayer($player);
return $form;
}
public function UIquest3($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
/*$player->addTitle("§l§a【§6HOÀN THÀNH§a】\n§r§cNhẫn Giả đã hoàn thành N.Vụ!\n\n\n§f➣§aTiếp theo: §cTìm Tsunade");
$this->level->addExp($player, 200);*/
$this->UIquest4($player);
$this->setDone3($player);
break;
}
});
$form->setTitle("§l§e【§cNhiệm Vụ§e】§r§f Thầy Kakashi §6#1");
/*$form->setContent("§fĐây là đồ vật của ngươi, hãy nhận lại và kiểm tra xem còn thiếu gì không, nếu có vấn đề muốn hỏi thì cứ đến gặp ta nhé.\n\n§f•§c 200§a EXP\n\n§f•§c 2500§a Xu\n\n§f•§c 50§a Đan dược tăng máu\n\n§f•§c 50§a Đan dược tăng Chakra\n\n");*/
$form->setContent("§fNhưng cũng đừng buồn, biết đâu trên con đường trở thành Shinobi thật sự, Nhẫn Giả sẽ tìm được người phù hợp với mình thì sao?");
$form->addButton("§l§1Tiếp tục đối thoại ➣");
$form->sendToPlayer($player);
return $form;
}
public function UIquest4($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$player->addTitle("§l§a【§6HOÀN THÀNH§a】\n§r§cNhẫn Giả đã hoàn thành N.Vụ!\n\n\n§f➣§aTiếp theo: §cTìm Tsunade");
$this->level->addExp($player, 200);
$this->xu->addXu($player, 500);
$dan_chakra = Item::get(351, 12, 10);
$dan_chakra->setCustomName("§r§l§bĐan Hồi Phục Chakra");
$dan_hp = Item::get(351, 1, 10);
$dan_hp->setCustomName("§r§l§cĐan Hồi Phục Sinh Lực");
$player->getInventory()->addItem($dan_chakra);
$player->getInventory()->addItem($dan_hp);
$this->setDone4($player);
$this->nv->setNV($player, "Diện Kiến", "Hokage Tsunade", "22, 4, 190");
break;
}
});
$form->setTitle("§l§e【§cNhiệm Vụ§e】§r§f Thầy Kakashi §6#1");
$form->setContent("§fTa nghe nói Tsunade đang có nhiệm vụ muốn giao cho ngươi, hãy mau đến diện kiến Hokage đi!\n\n§f•§c 200§a EXP\n\n§f•§c 10§a Đan HP\n\n§f•§c 10§a Đan Chakra\n\n§f•§c 500§a Xu\n\n");
$form->addButton("§l§6HOÀN THÀNH");
$form->sendToPlayer($player);
return $form;
}
public function UIquest5($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$this->UIquest6($player);
$this->setDone5($player);
break;
}
});
$form->setTitle("§l§e【§cNhiệm Vụ§e】§r§f Thầy Kakashi §6#1");
$form->setContent("§fNgươi đã hoàn thành nhiệm vụ đầu tiên của mình rồi sao? Không thể tin được!!");
$form->addButton("§l§1Tiếp tục đối thoại ➣");
$form->sendToPlayer($player);
return $form;
}
public function UIquest6($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$player->addTitle("§l§a【§6HOÀN THÀNH§a】\n§r§cNhẫn Giả đã hoàn thành N.Vụ!\n\n\n§f➣§aTiếp theo: §cTìm Neji");
$this->level->addExp($player, 300);
$this->bac->addBac($player, 300);
$this->xu->addXu($player, 300);
$this->setDone6($player);
$this->nv->setNV($player, "Bạn Mới", "Neji", "18, 10, 218");
break;
}
});
$form->setTitle("§l§e【§cNhiệm Vụ§e】§r§f Thầy Kakashi §6#1");
$form->setContent("§fVới trình độ của ngươi hiện tại, ta nghĩ ngươi nên tới gặp Jiraiya để luyện tập thêm và chuẩn bị nhận các nhiệm vụ cấp cao hơn.\n\n§f•§c 300§a EXP\n\n§f•§c 300§a Bạc\n\n§f•§c 300§a Xu\n\n");
$form->addButton("§l§6HOÀN THÀNH");
$form->sendToPlayer($player);
return $form;
}
}