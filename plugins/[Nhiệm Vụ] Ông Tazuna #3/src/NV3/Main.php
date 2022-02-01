<?php

namespace NV3;

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
if(!file_exists($this->getDataFolder() . "[NV] Ông Tazuna #3/")){
@mkdir($this->getDataFolder() . "[NV] Ông Tazuna #3/");
}
$this->quest = new Config($this->getDataFolder() . "[NV] Ông Tazuna #3/" . "Dữ liệu nhiệm vụ.yml", Config::YAML);
$this->saveDefaultConfig();
$this->config = $this->getConfig();
$this->config->save();
$this->level = $this->getServer()->getPluginManager()->getPlugin("NGVS_Level");
$this->xu = $this->getServer()->getPluginManager()->getPlugin("NGVS_Xu");
$this->tsunade = $this->getServer()->getPluginManager()->getPlugin("NV_Hokage_Tsunade_2");
$this->haku = $this->getServer()->getPluginManager()->getPlugin("NV_Haku_5");
$this->nv = $this->getServer()->getPluginManager()->getPlugin("NGVS_Quest");
$this->getServer()->getPluginManager()->registerEvents($this,$this);
}
public function onJoin(PlayerJoinEvent $event){
if(!($this->quest->exists(strtolower($event->getPlayer()->getName())))){
$this->quest->set(strtolower($event->getPlayer()->getName()), ["1" => "Not", "2" => "Not", "3" => "Not", "4" => "Not", "5" => "Not"]);
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

public function setDone1(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Not", "3" => "Not", "4" => "Not", "5" => "Not"]);
$this->quest->save();
}
public function setDone2(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Not", "4" => "Not", "5" => "Not"]);
$this->quest->save();
}
public function setDone3(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Not", "5" => "Not"]);
$this->quest->save();
}
public function setDone4(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Done", "5" => "Not"]);
$this->quest->save();
}
public function setDone5(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Done", "5" => "Done"]);
$this->quest->save();
}
public function onTap(SlapperHitEvent $ev){
$entity = $ev->getEntity();
$damager = $ev->getDamager();
if(!$entity instanceof SlapperHuman && $entity->getName() !== "§l§e【§cNhiệm Vụ§e】§r§f Ông Tazuna §6#3"){
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cNhiệm Vụ§e】§r§f Ông Tazuna §6#3" && $this->tsunade->get8($damager) == "Done" && $this->get1($damager) == "Not" && $this->get2($damager) == "Not" && $this->get3($damager) == "Not"){
$this->UIquest1($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cNhiệm Vụ§e】§r§f Ông Tazuna §6#3" && $this->tsunade->get8($damager) == "Done" && $this->get1($damager) == "Done" && $this->get2($damager) == "Not" && $this->get3($damager) == "Not"){
$this->UIquest2($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cNhiệm Vụ§e】§r§f Ông Tazuna §6#3" && $this->tsunade->get8($damager) == "Done" && $this->get1($damager) == "Done" && $this->get2($damager) == "Done" && $this->get3($damager) == "Not"){
$this->UIquest3($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cNhiệm Vụ§e】§r§f Ông Tazuna §6#3" && $this->get1($damager) == "Done" && $this->get2($damager) == "Done" && $this->get3($damager) == "Done" && $this->get4($damager) == "Not" && $this->haku->get3($damager) == "Done"){
$this->UIquest4($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cNhiệm Vụ§e】§r§f Ông Tazuna §6#3" && $this->get1($damager) == "Done" && $this->get2($damager) == "Done" && $this->get3($damager) == "Done" && $this->get4($damager) == "Done" && $this->get5($damager) == "Not" && $this->haku->get3($damager) == "Done"){
$this->UIquest5($damager);
return true;
}

if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cNhiệm Vụ§e】§r§f Ông Tazuna §6#3" && $this->get3($damager) == "Done" && $this->haku->get3($damager) == "Not"){
$this->UIthongbao($damager, "§f•§a Vui lòng hoàn thành nhiệm vụ theo số thứ tự!");
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cNhiệm Vụ§e】§r§f Ông Tazuna §6#3" && $this->tsunade->get8($damager) == "Not" && $this->get1($damager) == "Not"){
$this->UIthongbao($damager, "§f•§a Vui lòng hoàn thành nhiệm vụ theo số thứ tự!");
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cNhiệm Vụ§e】§r§f Ông Tazuna §6#3" && $this->get5($damager) == "Done"){
$this->UIthongbao($damager, "§f•§a Nhẫn Giả đã hoàn thành nhiệm vụ của NPC này!");
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
$form->setTitle("§l§e【§cNhiệm Vụ§e】§r§f Ông Tazuna §6#3");
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
$form->setTitle("§l§e【§cNhiệm Vụ§e】§r§f Ông Tazuna §6#3");
$form->setContent("§fCó phải ngươi là Nhẫn Giả ".$player->getName().", đến đây để bảo vệ ta để hoàn thành cây cầu phải không?");
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
$form->setTitle("§l§e【§cNhiệm Vụ§e】§r§f Ông Tazuna §6#3");
$form->setContent("§fĐúng là ngươi rồi! Giờ ngươi sẽ trông chừng bên ngoài cho ta, để ta hoàn thành cây cầu.");
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
$player->addTitle("§l§a【§6HOÀN THÀNH§a】\n§r§cNhẫn Giả đã hoàn thành N.Vụ!\n\n\n§f➣§aTiếp theo: §cTìm Momochi Zabuza Thương Lượng");
$this->level->addExp($player, 500);
$s1 = Item::get(Item::NETHER_STAR, 0, 1);
$s1->setCustomName("§r§c『§6THUẬT§c』§a Thế Thân");
//$player->getInventory()->addItem($s1);
$this->setDone3($player);
$this->nv->setNV($player, "Thương Lượng", "Zabuza", "Bên Kia Cầu");
break;
}
});
$form->setTitle("§l§e【§cNhiệm Vụ§e】§r§f Ông Tazuna §6#3");
$form->setContent("§fKhông hổ danh là Nhẫn Giả nổi trội được Hokage Tsunade kêu đến đây để bảo vệ ta.\n\n§f•§c 500§a Kinh Nghiệm\n\n");
$form->addButton("§l§6HOÀN THÀNH");
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
$this->UIquest5($player);
$this->setDone4($player);
break;
}
});
$form->setTitle("§l§e【§cNhiệm Vụ§e】§r§f Ông Tazuna §6#3");
$form->setContent("§fNgươi đã đánh đuổi bọn chúng rồi sao?");
$form->addButton("§l§1Tiếp tục đối thoại ➣");
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
$player->addTitle("§l§a【§6HOÀN THÀNH§a】\n§r§cNhẫn Giả đã hoàn thành N.Vụ!\n\n\n§f➣§aTiếp theo: §cTìm Naruto");
$this->level->addExp($player, 500*2);
$kiemgo = Item::get(Item::LEATHER_CHESTPLATE);
$kiemgo->setCustomName("§r§l§1Giáp Gỗ Tập Sự");
$player->getInventory()->addItem($kiemgo);
$this->getServer()->getCommandMap()->dispatch($player, "hub");
$this->setDone5($player);
$this->nv->setNV($player, "Trở Về", "Naruto", "17, 5, 217");
break;
}
});
$form->setTitle("§l§e【§cNhiệm Vụ§e】§r§f Ông Tazuna §6#3");
$form->setContent("§fCảm ơn ngươi nhé, ta có quà cho ngươi đây. Chúc ngươi thành công!\n\n§f•§c 1.000§a Kinh Nghiệm\n\n§f•§c 1§a Giáp Gỗ Tập Sự\n\n");
$form->addButton("§l§6HOÀN THÀNH");
$form->sendToPlayer($player);
return $form;
}
}