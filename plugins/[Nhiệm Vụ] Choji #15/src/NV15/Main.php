<?php

namespace NV15;

use pocketmine\nbt\tag\{CompoundTag, ListTag, DoubleTag, FloatTag};
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
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\entity\EffectInstance;
use slapper\entities\SlapperHuman;
use slapper\events\SlapperHitEvent;
use pocketmine\entity\Entity;

class Main extends PluginBase implements Listener{

public $data;
private $config, $amount;

public function onEnable(){
if(!file_exists($this->getDataFolder() . "[NV] Choji #15/")){
@mkdir($this->getDataFolder() . "[NV] Choji #15/");
}
$this->quest = new Config($this->getDataFolder() . "[NV] Choji #15/" . "Dữ liệu nhiệm vụ.yml", Config::YAML);
$this->saveDefaultConfig();
$this->config = $this->getConfig();
$this->config->save();
$this->level = $this->getServer()->getPluginManager()->getPlugin("NGVS_Level");
$this->xu = $this->getServer()->getPluginManager()->getPlugin("NGVS_Xu");
$this->bac = $this->getServer()->getPluginManager()->getPlugin("NGVS_Bac");
$this->vang = $this->getServer()->getPluginManager()->getPlugin("NGVS_Vang");
$this->gai = $this->getServer()->getPluginManager()->getPlugin("NV_Thay_Gai_16");
$this->shikamaru = $this->getServer()->getPluginManager()->getPlugin("NV_Shikamaru_14");
$this->nv = $this->getServer()->getPluginManager()->getPlugin("NGVS_Quest");
$this->getServer()->getPluginManager()->registerEvents($this,$this);
}
public function onJoin(PlayerJoinEvent $event){
if(!($this->quest->exists(strtolower($event->getPlayer()->getName())))){
$this->quest->set(strtolower($event->getPlayer()->getName()), ["1" => "Not", "2" => "Not", "3" => "Not", "4" => "Not", "5" => "Not", "6" => "Not", "7" => "Not"]);
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
public function setDone1(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Not", "3" => "Not", "4" => "Not", "5" => "Not", "6" => "Not", "7" => "Not"]);
$this->quest->save();
}
public function setDone2(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Not", "4" => "Not", "5" => "Not", "6" => "Not", "7" => "Not"]);
$this->quest->save();
}
public function setDone3(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Not", "5" => "Not", "6" => "Not", "7" => "Not"]);
$this->quest->save();
}
public function setDone4(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Done", "5" => "Not", "6" => "Not", "7" => "Not"]);
$this->quest->save();
}
public function setDone5(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Done", "5" => "Done", "6" => "Not", "7" => "Not"]);
$this->quest->save();
}
public function setDone6(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Done", "5" => "Done", "6" => "Done", "7" => "Not"]);
$this->quest->save();
}
public function setDone7(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Done", "5" => "Done", "6" => "Done", "7" => "Done"]);
$this->quest->save();
}
public function onTap(SlapperHitEvent $ev){
$entity = $ev->getEntity();
$damager = $ev->getDamager();
if(!$entity instanceof SlapperHuman && $entity->getName() !== "§l§e【§cNhiệm Vụ§e】§r§f Choji §6#15"){
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cNhiệm Vụ§e】§r§f Choji §6#15" && $this->shikamaru->get5($damager) == "Done" && $this->get1($damager) == "Not" && $this->get2($damager) == "Not"){
$this->UIquest1($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cNhiệm Vụ§e】§r§f Choji §6#15" && $this->shikamaru->get5($damager) == "Done" && $this->get1($damager) == "Done" && $this->get2($damager) == "Not"){
$this->UIquest2($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cNhiệm Vụ§e】§r§f Choji §6#15" && $this->shikamaru->get5($damager) == "Done" && $this->get2($damager) == "Done" && $this->get3($damager) == "Not"){
$this->UIquest3($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cNhiệm Vụ§e】§r§f Choji §6#15" && $this->shikamaru->get5($damager) == "Done" && $this->get3($damager) == "Done" && $this->get4($damager) == "Not"){
$this->UIquest4($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cNhiệm Vụ§e】§r§f Choji §6#15" && $this->level->getLevel($damager) >= 50 && $this->get4($damager) == "Done" && $this->get5($damager) == "Not"){
$this->UIquest5($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cNhiệm Vụ§e】§r§f Choji §6#15" && $this->level->getLevel($damager) >= 50 && $this->get5($damager) == "Done" && $this->get6($damager) == "Not"){
$this->UIquest6($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cNhiệm Vụ§e】§r§f Choji §6#15" && $this->level->getLevel($damager) >= 50 && $this->get6($damager) == "Done" && $this->get7($damager) == "Not"){
$this->UIquest7($damager);
return true;
}
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cNhiệm Vụ§e】§r§f Choji §6#15" && $this->get7($damager) == "Done"){
$this->UIthongbao($damager, "§f•§a Nhẫn Giả đã hoàn thành nhiệm vụ của NPC này!");
return true;
}

if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cNhiệm Vụ§e】§r§f Choji §6#15" && $this->shikamaru->get5($damager) == "Not"){
$this->UIthongbao($damager, "§f•§a Cậu muốn tham gia nhiệm vụ đến gặp Shikamaru á");
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cNhiệm Vụ§e】§r§f Choji §6#15" && $this->level->getLevel($damager) < 50){
$this->UIthongbao($damager, "§f•§a Đạt cấp độ 50 rồi đến gặp mình");
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cNhiệm Vụ§e】§r§f Choji §6#15" && $this->gai->get3($damager) == "Not" && $this->get1($damager) == "Not"){
$this->UIthongbao($damager, "§f•§a Vui lòng hoàn thành nhiệm vụ theo số thứ tự!");
return true;
}


}
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------
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
$form->setTitle("§l§e【§cNhiệm Vụ§e】§r§f Choji §6#15");
$form->setContent($message);
$form->addButton("§l§1Đã Hiểu");
$form->sendToPlayer($player);
return $form;
}
//---------------------------------------------------------------------------------------------------------1-----------------------------------------------------------------
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
$form->setTitle("§l§6".$player->getName());
$form->setContent("§fChào cậu Choji. Shikamaru kêu tớ bảo cậu chuẩn bị để mình xuất phát làm nhiệm vụ");
$form->addButton("§l§1Tiếp tục đối thoại ➣");
$form->sendToPlayer($player);
return $form;
}
//-----------------------------------------------------------------------------------------------------------2---------------------------------------------------------------
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
$form->setTitle("§l§e【§cNhiệm Vụ§e】§r§f Choji §6#15");
$form->setContent("§fta đã mặt giáp đầy đủ rồi và cũng mang theo đủ đồ ăn haha.");
$form->addButton("§l§1Tiếp tục đối thoại ➣");
$form->sendToPlayer($player);
return $form;
}
//-----------------------------------------------------------------------------------------------------------3---------------------------------------------------------------
public function UIquest3($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$this->UIquest4($player);
$this->setDone3($player);
break;
}
});
$form->setTitle("§l§6".$player->getName());
$form->setContent("§fThế mình tập hợp tại cổng làng và đi thôi.");
$form->addButton("§l§1Tiếp tục đối thoại ➣");
$form->sendToPlayer($player);
return $form;
}
//-------------------------------------------------------------------------------------------------------------4-------------------------------------------------------------
public function UIquest4($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$player->addTitle("§l§a【§6HOÀN THÀNH§a】\n§r§cNhẫn Giả đã hoàn thành N.Vụ!\n\n\n§f➣§aTiếp theo: §cTìm Shikamaru");
$this->level->addExp($player, 1000);
$this->bac->addBac($player, 10);
$this->xu->addXu($player, 1000);
$this->vang->addVang($player, 5);
$nhatvi = Item::get(307, 0, 1);
$nhatvi->setCustomName("§r§cGiáp Tân Thủ§6 #");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(4), 2));
$player->getInventory()->addItem($nhatvi);
$this->nv->setNV($player, "Báo Cáo", "Shikamaru", "26, 4, 276");
$this->setDone4($player);
break;
}
});
$form->setTitle("§l§e【§cNhiệm Vụ§e】§r§f Choji §6#15");
$form->setContent("§fNhìn cậu yếu thế. Ta cho cậu cáu này..Coi như quà gặp mặt.\n\n§f•§c 1000§a Kinh Nghiệm\n\n§f•§c 1000§a Xu\n\n§f•§c 10§a Bạc\n\n§f•§c 5§a Vàng\n\n§f•§c 1§a Giáp Tân Thủ #\n\n");
$form->addButton("§l§1HOÀN THÀNH ➣");
$form->sendToPlayer($player);
return $form;
}
//--------------------------------------------------------------------------------------------------------------5------------------------------------------------------------
public function UIquest5($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$this->setDone5($player);
$this->UIquest6($player);
break;
}
});
$form->setTitle("§l§e【§cNhiệm Vụ§e】§r§f Choji §6#15");
$form->setContent("§fChào cậu chúng tờ đã bình phục rồi");
$form->addButton("§l§1Tiếp tục đối thoại ➣");
$form->sendToPlayer($player);
return $form;
}

//---------------------------------------------------------------------------------------------------------------6-----------------------------------------------------------
public function UIquest6($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$this->setDone6($player);
$this->UIquest7($player);
break;
}
});
$form->setTitle("§l§e【§cNhiệm Vụ§e】§r§f Choji §6#15");
$form->setContent("§fCậu đã mạnh hơn rồi nhỉ");
$form->addButton("§l§1Tiếp tục đối thoại ➣");
$form->sendToPlayer($player);
return $form;
}

//----------------------------------------------------------------------------------------------------------------7----------------------------------------------------------
public function UIquest7($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$player->addTitle("§l§a【§6HOÀN THÀNH§a】\n§r§cNhẫn Giả đã hoàn thành N.Vụ!\n\n\n§f➣§aTiếp theo: §cNhiệm Vụ");
$this->level->addExp($player, 1000);
$this->vang->addVang($player, 5);
$this->bac->addBac($player, 50);
$this->xu->addXu($player, 50);
$this->setDone7($player);
$this->nv->setNV($player, "Nhiệm Vụ", "Sakura", "14, 4, 265");
break;
}
});
$form->setTitle("§l§e【§cNhiệm Vụ§e】§r§f Choji §6#15");
$form->setContent("§fCậu đến gặp Sakura để cùng làm nhiệm vụ nha. Mình bận rồi\n\n§f•§c 1000§a EXP\n\n§f•§c 50§a Xu\n\n§f•§c 50§a Bạc\n\n§f•§c 5§a Vàng\n\n");
$form->addButton("§l§6HOÀN THÀNH");
$form->sendToPlayer($player);
return $form;
}
}
