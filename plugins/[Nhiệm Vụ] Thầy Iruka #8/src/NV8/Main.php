<?php

namespace NV8;

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
if(!file_exists($this->getDataFolder() . "[NV] Thầy Iruka #8/")){
@mkdir($this->getDataFolder() . "[NV] Thầy Iruka #8/");
}
$this->quest = new Config($this->getDataFolder() . "[NV] Thầy Iruka #8/" . "Dữ liệu nhiệm vụ.yml", Config::YAML);
$this->saveDefaultConfig();
$this->config = $this->getConfig();
$this->config->save();
$this->level = $this->getServer()->getPluginManager()->getPlugin("NGVS_Level");
$this->xu = $this->getServer()->getPluginManager()->getPlugin("NGVS_Xu");
$this->neji_tre = $this->getServer()->getPluginManager()->getPlugin("NV_Neji_Tre_7");
$this->nv = $this->getServer()->getPluginManager()->getPlugin("NGVS_Quest");
$this->getServer()->getPluginManager()->registerEvents($this,$this);
}
public function onJoin(PlayerJoinEvent $event){
if(!($this->quest->exists(strtolower($event->getPlayer()->getName())))){
$this->quest->set(strtolower($event->getPlayer()->getName()), ["1" => "Not", "2" => "Not", "3" => "Not", "4" => "Not"]);
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
public function setDone1(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Not", "3" => "Not", "4" => "Not"]);
$this->quest->save();
}
public function setDone2(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Not", "4" => "Not"]);
$this->quest->save();
}
public function setDone3(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Not"]);
$this->quest->save();
}
public function setDone4(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Done"]);
$this->quest->save();
}
public function onTap(SlapperHitEvent $ev){
$entity = $ev->getEntity();
$damager = $ev->getDamager();
if(!$entity instanceof SlapperHuman && $entity->getName() !== "§l§e【§cNhiệm Vụ§e】§r§f Thầy Iruka §6#8"){
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cNhiệm Vụ§e】§r§f Thầy Iruka §6#8" && $this->neji_tre->get2($damager) == "Done" && $this->get1($damager) == "Not" && $this->get2($damager) == "Not"){
$this->UIquest1($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cNhiệm Vụ§e】§r§f Thầy Iruka §6#8" && $this->neji_tre->get2($damager) == "Done" && $this->get1($damager) == "Done" && $this->get2($damager) == "Not"){
$this->UIquest2($damager, "Ngươi cần bỏ ra 200 Xu coi như phí làm nhiệm vụ thì ta mới cho ngươi vào được!");
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cNhiệm Vụ§e】§r§f Thầy Iruka §6#8" && $this->neji_tre->get2($damager) == "Done" && $this->get2($damager) == "Done" && $this->get3($damager) == "Not"){
$this->UIquest3($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§6HOÀN THÀNH KHÓA §cPK1" && $this->neji_tre->get2($damager) == "Done" && $this->get3($damager) == "Done" && $this->get4($damager) == "Not"){
$damager->teleport(new Vector3(-82, 4, 69));
$s1 = Item::get(Item::NETHER_STAR, 0, 1);
$s1->setCustomName("§r§c『§6THUẬT§c』§a Thế Thân");
$damager->getInventory()->addItem($s1);
$this->level->addExp($damager, 1000);
$damager->addTitle("§l§a【§6HOÀN THÀNH§a】\n§r§cNhẫn Giả đã hoàn thành N.Vụ!\n\n\n§f➣§aTiếp theo: §cTìm Jiraiya");
$this->setDone4($damager);
$this->nv->setNV($damager, "Hoàn Thành", "Jiraiya", "-67, 4, 77");
$damager->sendMessage("§f•§c Thuật§a Thế Thân\n§f•§c 1000§a Kinh Nghiệm");
return true;
}

if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cNhiệm Vụ§e】§r§f Thầy Iruka §6#8" && $this->get4($damager) == "Done"){
$this->UIthongbao($damager, "§f•§a Nhẫn Giả đã hoàn thành nhiệm vụ của NPC này!");
return true;
}

if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cNhiệm Vụ§e】§r§f Thầy Iruka §6#8" && $this->neji_tre->get2($damager) == "Not" && $this->get1($damager) == "Not"){
$this->UIthongbao($damager, "§f•§a Vui lòng hoàn thành nhiệm vụ theo số thứ tự!");
return true;
}


}
public function UIthongbao($player, $message){
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
$form->setTitle("§l§e【§cNhiệm Vụ§e】§r§f Thầy Iruka §6#8");
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
$this->UIquest2($player, "Ngươi cần bỏ ra 200 Xu coi như phí làm nhiệm vụ thì ta mới cho ngươi vào được!");
$this->setDone1($player);
break;
}
});
$form->setTitle("§l§e【§cNhiệm Vụ§e】§r§f Thầy Iruka §6#8");
$form->setContent("§fNgươi tới đây để làm nhiệm vụ sao?");
$form->addButton("§l§1Tiếp tục đối thoại ➣");
$form->sendToPlayer($player);
return $form;
}
public function UIquest2($player, $message){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null) use ($message){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
if($this->get1($player) == "Done" && $this->xu->getXu($player) < 200){
$this->UIthongbao($player, "§fNgươi không có đủ 200 Xu rồi, hãy đi kiếm thêm Xu đi!");
return true;
}
$this->UIquest3($player);
$this->setDone2($player);
$this->xu->reduceXu($player, 200);
break;
}
});
$form->setTitle("§l§e【§cNhiệm Vụ§e】§r§f Thầy Iruka §6#8");
$form->setContent($message);
$form->addButton("§l§1Bỏ Phí 200 Xu");
$form->addButton("§l§1Hủy");
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
$player->teleport(new Vector3(-86, 4, 75));
$this->setDone3($player);
$this->nv->setNV($player, "Thử Thách", "Parkour", "NULL");
break;
}
});
$form->setTitle("§l§e【§cNhiệm Vụ§e】§r§f Thầy Iruka §6#8");
$form->setContent("§fĐược rồi, ngươi hãy vào trong và hoàn thành thử thách đi nào!");
$form->addButton("§l§1Tham gia ➣");
$form->sendToPlayer($player);
return $form;
}
}