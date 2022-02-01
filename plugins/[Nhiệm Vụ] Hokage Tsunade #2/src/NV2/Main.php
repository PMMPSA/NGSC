<?php

namespace NV2;

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
if(!file_exists($this->getDataFolder() . "[NV] Hokage Tsunade #2/")){
@mkdir($this->getDataFolder() . "[NV] Hokage Tsunade #2/");
}
$this->quest = new Config($this->getDataFolder() . "[NV] Hokage Tsunade #2/" . "Dữ liệu nhiệm vụ.yml", Config::YAML);
$this->saveDefaultConfig();
$this->config = $this->getConfig();
$this->config->save();
$this->level = $this->getServer()->getPluginManager()->getPlugin("NGVS_Level");
$this->xu = $this->getServer()->getPluginManager()->getPlugin("NGVS_Xu");
$this->kakashi = $this->getServer()->getPluginManager()->getPlugin("NV_Thay_Kakashi_1");
$this->nv = $this->getServer()->getPluginManager()->getPlugin("NGVS_Quest");
$this->getServer()->getPluginManager()->registerEvents($this,$this);
}
public function onJoin(PlayerJoinEvent $event){
if(!($this->quest->exists(strtolower($event->getPlayer()->getName())))){
$this->quest->set(strtolower($event->getPlayer()->getName()), ["1" => "Not", "2" => "Not", "3" => "Not", "4" => "Not", "5" => "Not", "6" => "Not", "7" => "Not", "8" => "Not"]);
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
public function get7(Player $player){
$get7 = $this->quest->get(strtolower($player->getName()))["7"];
return $get7;
}
public function get8(Player $player){
$get8 = $this->quest->get(strtolower($player->getName()))["8"];
return $get8;
}
public function setDone1(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Not", "3" => "Not", "4" => "Not", "5" => "Not", "6" => "Not", "7" => "Not", "8" => "Not"]);
$this->quest->save();
}
public function setDone2(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Not", "4" => "Not", "5" => "Not", "6" => "Not", "7" => "Not", "8" => "Not"]);
$this->quest->save();
}
public function setDone3(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Not", "5" => "Not", "6" => "Not", "7" => "Not", "8" => "Not"]);
$this->quest->save();
}
public function setDone4(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Done", "5" => "Not", "6" => "Not", "7" => "Not", "8" => "Not"]);
$this->quest->save();
}
public function setDone5(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Done", "5" => "Done", "6" => "Not", "7" => "Not", "8" => "Not"]);
$this->quest->save();
}
public function setDone6(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Done", "5" => "Done", "6" => "Done", "7" => "Not", "8" => "Not"]);
$this->quest->save();
}
public function setDone7(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Done", "5" => "Done", "6" => "Done", "7" => "Done", "8" => "Not"]);
$this->quest->save();
}
public function setDone8(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Done", "5" => "Done", "6" => "Done", "7" => "Done", "8" => "Done"]);
$this->quest->save();
}
public function onTap(SlapperHitEvent $ev){
$entity = $ev->getEntity();
$damager = $ev->getDamager();
if(!$entity instanceof SlapperHuman && $entity->getName() !== "§l§e【§cNhiệm Vụ§e】§r§f Hokage Tsunade §6#2"){
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cNhiệm Vụ§e】§r§f Hokage Tsunade §6#2" && $this->kakashi->get4($damager) == "Done" && $this->get1($damager) == "Not"){
$this->UIquest1($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cNhiệm Vụ§e】§r§f Hokage Tsunade §6#2" && $this->kakashi->get4($damager) == "Done" && $this->get1($damager) == "Done" && $this->get2($damager) == "Not"){
$this->UIquest2($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cNhiệm Vụ§e】§r§f Hokage Tsunade §6#2" && $this->kakashi->get4($damager) == "Done" && $this->get2($damager) == "Done" && $this->get3($damager) == "Not"){
$this->UIquest3($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cNhiệm Vụ§e】§r§f Hokage Tsunade §6#2" && $this->kakashi->get4($damager) == "Done" && $this->get3($damager) == "Done" && $this->get4($damager) == "Not"){
$this->UIquest4($damager, "§fNhu Quyền là của tộc nào ?");
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cNhiệm Vụ§e】§r§f Hokage Tsunade §6#2" && $this->kakashi->get4($damager) == "Done" && $this->get4($damager) == "Done" && $this->get5($damager) == "Not"){
$this->UIquest5($damager, "§fTộc Uchiha có huyết kế giới hạn gì ?");
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cNhiệm Vụ§e】§r§f Hokage Tsunade §6#2" && $this->kakashi->get4($damager) == "Done" && $this->get5($damager) == "Done" && $this->get6($damager) == "Not"){
$this->UIquest6($damager, "§fThuật nào sau đây là do Đệ Tứ tạo ra ?");
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cNhiệm Vụ§e】§r§f Hokage Tsunade §6#2" && $this->kakashi->get4($damager) == "Done" && $this->get6($damager) == "Done" && $this->get7($damager) == "Not"){
$this->UIquest7($damager, "§fAi là mẹ của Naruto - mang trong mình một con quái vật mạnh nhất có 9 đuôi ?");
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cNhiệm Vụ§e】§r§f Hokage Tsunade §6#2" && $this->kakashi->get4($damager) == "Done" && $this->get7($damager) == "Done" && $this->get8($damager) == "Not"){
$this->UIquest8($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cNhiệm Vụ§e】§r§f Hokage Tsunade §6#2" && $this->kakashi->get4($damager) == "Done" && $this->get7($damager) == "Done" && $this->get8($damager) == "Done"){
$this->UIthongbao($damager, "§f•§a Nhẫn Giả đã hoàn thành nhiệm vụ của NPC này!");
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cNhiệm Vụ§e】§r§f Hokage Tsunade §6#2" && $this->kakashi->get4($damager) == "Not" && $this->get1($damager) == "Not"){
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
$form->setTitle("§l§e【§cNhiệm Vụ§e】§r§f Hokage Tsunade §6#2");
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
$form->setTitle("§l§e【§cNhiệm Vụ§e】§r§f Hokage Tsunade §6#2");
$form->setContent("§fCó phải ngươi là Nhẫn Giả ".$player->getName().", nổi trội nhất Làng Lá không?");
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
$form->setTitle("§l§e【§cNhiệm Vụ§e】§r§f Hokage Tsunade §6#2");
$form->setContent("§fTa có nhiệm vụ muốn giao cho ngươi, hãy bảo vệ ông Tazuna hoàn thành cây cầu.");
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
$this->UIquest4($player, "§fNhu Quyền là của tộc nào ?");
$this->setDone3($player);
break;
}
});
$form->setTitle("§l§e【§cNhiệm Vụ§e】§r§f Hokage Tsunade §6#2");
$form->setContent("§fNhưng trước khi nhận nhiệm vụ đầu tiên, ngươi hay trả lời các câu hỏi sau của ta. Ngươi có dám không?");
$form->addButton("§l§1Thực Hiện Thử Thách ➣");
$form->sendToPlayer($player);
return $form;
}
public function UIquest4($player, $msg){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$this->UIquest4($player, "§fNhu Quyền là của tộc nào ?");
break;
case 1:
$this->UIquest4($player, "§fNhu Quyền là của tộc nào ?");
break;
case 2:
$this->UIquest5($player, "§fTộc Uchiha có huyết kế giới hạn gì ?");
$this->setDone4($player);
break;
case 3:
$this->UIquest4($player, "§fNhu Quyền là của tộc nào ?");
break;
}
});
$form->setTitle("§l§e【§cNhiệm Vụ§e】§r§f Hokage Tsunade §6#2");
$form->setContent($msg);
$form->addButton("§l§1Tộc Uchiha");
$form->addButton("§l§1Tộc Uzumaki");
$form->addButton("§l§1Tộc Hyuuga");
$form->addButton("§l§1Tộc Inuzuka");
$form->sendToPlayer($player);
return $form;
}
public function UIquest5($player, $msg){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$this->UIquest6($player, "§fThuật nào sau đây là do Đệ Tứ tạo ra ?");
$this->setDone5($player);
break;
case 1:
$this->UIquest5($player, "§fTộc Uchiha có huyết kế giới hạn gì ?");
break;
case 2:
$this->UIquest5($player, "§fTộc Uchiha có huyết kế giới hạn gì ?");
break;
case 3:
$this->UIquest5($player, "§fTộc Uchiha có huyết kế giới hạn gì ?");
break;
}
});
$form->setTitle("§l§e【§cNhiệm Vụ§e】§r§f Hokage Tsunade §6#2");
$form->setContent($msg);
$form->addButton("§l§1Sharingan");
$form->addButton("§l§1Rasengan");
$form->addButton("§l§1Byakugan");
$form->addButton("§l§1Tenseigan");
$form->sendToPlayer($player);
return $form;
}
public function UIquest6($player, $msg){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$this->UIquest6($player, "§fThuật nào sau đây là do Đệ Tứ tạo ra ?");
break;
case 1:
$this->UIquest7($player, "§fAi là mẹ của Naruto - mang trong mình một con quái vật mạnh nhất có 9 đuôi ?");
$this->setDone6($player);
break;
case 2:
$this->UIquest6($player, "§fThuật nào sau đây là do Đệ Tứ tạo ra ?");
break;
case 3:
$this->UIquest6($player, "§fThuật nào sau đây là do Đệ Tứ tạo ra ?");
break;
}
});
$form->setTitle("§l§e【§cNhiệm Vụ§e】§r§f Hokage Tsunade §6#2");
$form->setContent($msg);
$form->addButton("§l§1Hỏa Độn");
$form->addButton("§l§1Rasengan");
$form->addButton("§l§1Phân Thân Chi Thuật");
$form->addButton("§l§1Triệu Hồi Chi Thuật");
$form->sendToPlayer($player);
return $form;
}
public function UIquest7($player, $msg){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$this->UIquest8($player);
$this->setDone7($player);
break;
case 1:
$this->UIquest7($player, "§fAi là mẹ của Naruto - mang trong mình một con quái vật mạnh nhất có 9 đuôi ?");
$this->setDone6($player);
break;
case 2:
$this->UIquest7($player, "§fAi là mẹ của Naruto - mang trong mình một con quái vật mạnh nhất có 9 đuôi ?");
break;
case 3:
$this->UIquest7($player, "§fAi là mẹ của Naruto - mang trong mình một con quái vật mạnh nhất có 9 đuôi ?");
break;
}
});
$form->setTitle("§l§e【§cNhiệm Vụ§e】§r§f Hokage Tsunade §6#2");
$form->setContent($msg);
$form->addButton("§l§1Uzumaki Kushina");
$form->addButton("§l§1Uzumaki Naruto");
$form->addButton("§l§1Uzumaki Mito");
$form->addButton("§l§1Uzumaki Ito");
$form->sendToPlayer($player);
return $form;
}
public function UIquest8($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$this->setDone8($player);
$player->addTitle("§l§a【§6HOÀN THÀNH§a】\n§r§cNhẫn Giả đã hoàn thành N.Vụ!\n\n\n§f➣§aTiếp theo: §cTìm Tazuna");
$this->level->addExp($player, 1000);
$this->xu->addXu($player, 1000);
$kiemgo = Item::get(Item::WOODEN_SWORD);
$kiemgo->setCustomName("§r§l§1Kiếm Gỗ Tập Sự");
$player->getInventory()->addItem($kiemgo);
$dc = Item::get(Item::EMERALD, 0, 1);
$dc->setCustomName("§r§c•§a Ngọc Dịch Chuyển §c•§b Ông Tazuna");
$player->getInventory()->addItem($dc);
$this->nv->setNV($player, "Bảo Vệ", "Ông Tazuna", "Kiểm Tra Túi");
break;
}
});
$form->setTitle("§l§e【§cNhiệm Vụ§e】§r§f Hokage Tsunade §6#2");
$form->setContent("§fKhông hổ danh là Nhẫn Giả nổi trội nhất của làng ta! Được rồi, ta sẽ giao cho ngươi nhiệm vụ này. Hãy sử dụng đan dịch chuyển để tìm đường đến chỗ ông Tazuna đi.\n\n§f•§c 1000§a Kinh Nghiệm\n\n§f•§c 1.000§a Xu\n\n§f•§c 1§a Kiếm Gỗ Tập Sự\n\n§f•§c 1§a Đan Dịch Chuyển Tới Tazuna\n\n");
$form->addButton("§l§6HOÀN THÀNH");
$form->sendToPlayer($player);
return $form;
}

/*public function onFight(EntityDamageEvent $event) {
if($event instanceof EntityDamageByEntityEvent) {
$hit = $event->getEntity();
$damager = $event->getDamager();
if($damager instanceof Player) {
if($hit instanceof SlapperHuman && !$event->isCancelled()){
$event->setCancelled(true);
}
}
}
}*/

}