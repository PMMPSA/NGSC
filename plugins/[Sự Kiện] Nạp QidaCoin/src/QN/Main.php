<?php

namespace QN;

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
if(!file_exists($this->getDataFolder() . "[SK] Phúc Lợi Nạp/")){
@mkdir($this->getDataFolder() . "[SK] Phúc Lợi Nạp/");
}
$this->quest = new Config($this->getDataFolder() . "[SK] Phúc Lợi Nạp/" . "Dữ liệu sự kiện.yml", Config::YAML);
$this->saveDefaultConfig();
$this->config = $this->getConfig();
$this->config->save();
$this->level = $this->getServer()->getPluginManager()->getPlugin("NGVS_Level");
$this->vang = $this->getServer()->getPluginManager()->getPlugin("NGVS_Vang");
$this->stats = $this->getServer()->getPluginManager()->getPlugin("NGVS_Stats");
$this->qidacoin = $this->getServer()->getPluginManager()->getPlugin("NGVS_QidaCoin");
$this->chakra = $this->getServer()->getPluginManager()->getPlugin("NGVS_DCK");
$this->getServer()->getPluginManager()->registerEvents($this,$this);
}
public function onJoin(PlayerJoinEvent $event){
if(!($this->quest->exists(strtolower($event->getPlayer()->getName())))){
$this->quest->set(strtolower($event->getPlayer()->getName()), ["1" => "Not", "2" => "Not", "3" => "Not", "4" => "Not", "5" => "Not", "6" => "Not", "7" => "Not", "8" => "Not", "9" => "Not"]);
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
public function get9(Player $player){
$get9 = $this->quest->get(strtolower($player->getName()))["9"];
return $get9;
}
public function setDone1(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Not", "3" => "Not", "4" => "Not", "5" => "Not", "6" => "Not", "7" => "Not", "8" => "Not", "9" => "Not"]);
$this->quest->save();
}
public function setDone2(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Not", "4" => "Not", "5" => "Not", "6" => "Not", "7" => "Not", "8" => "Not", "9" => "Not"]);
$this->quest->save();
}
public function setDone3(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Not", "5" => "Not", "6" => "Not", "7" => "Not", "8" => "Not", "9" => "Not"]);
$this->quest->save();
}
public function setDone4(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Done", "5" => "Not", "6" => "Not", "7" => "Not", "8" => "Not", "9" => "Not"]);
$this->quest->save();
}
public function setDone5(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Done", "5" => "Done", "6" => "Not", "7" => "Not", "8" => "Not", "9" => "Not"]);
$this->quest->save();
}
public function setDone6(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Done", "5" => "Done", "6" => "Done", "7" => "Not", "8" => "Not", "9" => "Not"]);
$this->quest->save();
}
public function setDone7(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Done", "5" => "Done", "6" => "Done", "7" => "Done", "8" => "Not", "9" => "Not"]);
$this->quest->save();
}
public function setDone8(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Done", "5" => "Done", "6" => "Done", "7" => "Done", "8" => "Done", "9" => "Not"]);
$this->quest->save();
}
public function setDone9(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Done", "5" => "Done", "6" => "Done", "7" => "Done", "8" => "Done", "9" => "Done"]);
$this->quest->save();
}
public function onTap(SlapperHitEvent $ev){
$entity = $ev->getEntity();
$damager = $ev->getDamager();
if(!$entity instanceof SlapperHuman && $entity->getName() !== "§l§e【§cSự Kiện§e】§r§f Quà Nạp QidaCoin"){
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Quà Nạp QidaCoin" && $this->qidacoin->getQidaCoin($damager) >= 100 && $this->get1($damager) == "Not" && $this->get2($damager) == "Not"){
$this->UIquest1($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Quà Nạp QidaCoin" && $this->qidacoin->getQidaCoin($damager) >= 300 && $this->get1($damager) == "Done" && $this->get2($damager) == "Not"){
$this->UIquest2($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Quà Nạp QidaCoin" && $this->qidacoin->getQidaCoin($damager) >= 500 && $this->get2($damager) == "Done" && $this->get3($damager) == "Not"){
$this->UIquest3($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Quà Nạp QidaCoin" && $this->qidacoin->getQidaCoin($damager) >= 1000 && $this->get3($damager) == "Done" && $this->get4($damager) == "Not"){
$this->UIquest4($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Quà Nạp QidaCoin" && $this->qidacoin->getQidaCoin($damager) >= 3000 && $this->get4($damager) == "Done" && $this->get5($damager) == "Not"){
$this->UIquest5($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Quà Nạp QidaCoin" && $this->qidacoin->getQidaCoin($damager) >= 5000 && $this->get5($damager) == "Done" && $this->get6($damager) == "Not"){
$this->UIquest6($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Quà Nạp QidaCoin" && $this->qidacoin->getQidaCoin($damager) >= 9000 && $this->get6($damager) == "Done" && $this->get7($damager) == "Not"){
$this->UIquest7($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Quà Nạp QidaCoin" && $this->qidacoin->getQidaCoin($damager) >= 14000 && $this->get7($damager) == "Done" && $this->get8($damager) == "Not"){
$this->UIquest8($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Quà Nạp QidaCoin" && $this->qidacoin->getQidaCoin($damager) >= 20000 && $this->get8($damager) == "Done" && $this->get9($damager) == "Not"){
$this->UIquest9($damager);
return true;
}
//------------------------------------------------------------------------------------------------------------------------------------------------------
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Quà Nạp QidaCoin" && $this->get9($damager) == "Done"){
$this->UIthongbao($damager, "§f•§a Nhẫn Giả đã nhận hết tất cả các mốc nạp, Vui lòng quay lại sau");
return true;
}
//------------------------------------------------------------------------------------------------------------------------------------------------------
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Quà Nạp QidaCoin" && $this->qidacoin->getQidaCoin($damager) < 100){
$this->UIthongbao($damager, "§f•§a Nhẫn Giả chưa nạp QidaCoin nên không thể nhận quà! Hãy§c /qidacoin §ađể nạp nha");
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Quà Nạp QidaCoin" && $this->qidacoin->getQidaCoin($damager) < 300){
$this->UIthongbao($damager, "§f•§a Nhẫn Giả đã nhận mốc 100 QidaCoin. Hãy nạp thêm để nhận mốc 300 nha§c /qidacoin §ađể nạp nha");
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Quà Nạp QidaCoin" && $this->qidacoin->getQidaCoin($damager) < 500){
$this->UIthongbao($damager, "§f•§a Nhẫn Giả đã nhận mốc 100, 300 QidaCoin. Hãy nạp thêm để nhận mốc 500 nha§c /qidacoin §ađể nạp nha");
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Quà Nạp QidaCoin" && $this->qidacoin->getQidaCoin($damager) < 1000){
$this->UIthongbao($damager, "§f•§a Nhẫn Giả đã nhận mốc 100, 300, 500 QidaCoin. Hãy nạp thêm để nhận mốc 1000 nha§c /qidacoin §ađể nạp nha");
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Quà Nạp QidaCoin" && $this->qidacoin->getQidaCoin($damager) < 3000){
$this->UIthongbao($damager, "§f•§a Nhẫn Giả đã nhận mốc 100, 300, 500, 1000 QidaCoin. Hãy nạp thêm để nhận mốc 3000 nha§c /qidacoin §ađể nạp nha");
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Quà Nạp QidaCoin" && $this->qidacoin->getQidaCoin($damager) < 5000){
$this->UIthongbao($damager, "§f•§a Nhẫn Giả đã nhận mốc 100, 300, 500, 1000, 3000 QidaCoin. Hãy nạp thêm để nhận mốc 5000 nha§c /qidacoin §ađể nạp nha");
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Quà Nạp QidaCoin" && $this->qidacoin->getQidaCoin($damager) < 9000){
$this->UIthongbao($damager, "§f•§a Nhẫn Giả đã nhận mốc 100, 300, 500, 1000, 3000, 5000 QidaCoin. Hãy nạp thêm để nhận mốc 9000 nha§c /qidacoin §ađể nạp nha");
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Quà Nạp QidaCoin" && $this->qidacoin->getQidaCoin($damager) < 14000){
$this->UIthongbao($damager, "§f•§a Nhẫn Giả đã nhận mốc 100, 300, 500, 1000, 3000, 5000, 9000 QidaCoin. Hãy nạp thêm để nhận mốc 14000 nha§c /qidacoin §ađể nạp nha");
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Quà Nạp QidaCoin" && $this->qidacoin->getQidaCoin($damager) < 20000){
$this->UIthongbao($damager, "§f•§a Nhẫn Giả đã nhận mốc 100, 300, 500, 1000, 3000, 5000, 9000, 14000 QidaCoin. Hãy nạp thêm để nhận mốc 20000 nha§c /qidacoin §ađể nạp nha");
return true;
}
//------------------------------------------------------------------------------------------------------------------------------------------------------
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
$form->setTitle("§l§e【§cSự Kiện§e】§r§f Quà Nạp QidaCoin");
$form->setContent($message);
$form->addButton("§l§1Đã Hiểu");
$form->sendToPlayer($player);
return $form;
}
//-----------------------------------------------------------------------------------------------------------100
public function UIquest1($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$this->level->addExp($player, 1000);
$this->chakra->addChakra($player, 10);
$this->stats->addStats($player, 1);
$dan_chakra = Item::get(351, 12, 10);
$dan_chakra->setCustomName("§r§l§bĐan Hồi Phục Chakra");
$dan_hp = Item::get(351, 1, 10);
$dan_hp->setCustomName("§r§l§cĐan Hồi Phục Sinh Lực");
$player->getInventory()->addItem($dan_chakra);
$player->getInventory()->addItem($dan_hp);
$this->setDone1($player);
break;
}
});
$form->setTitle("§l§e【§cSự Kiện§e】§r§f Quà Nạp QidaCoin");
$form->setContent("§fNhẫn Giả đã nạp 100 QidaCoin. Quà nạp QidaCoin\n §3(Cảm ơn bạn đã ủng hộ Server)\n §eLưu Ý: Dọn dẹp túi đồ trước khi nhận quà để\n§etránh tình trạng nghẹt túi đồ dẫn đến việc\n§ekhông nhận được đồ. Vấn đề này admin sẽ không\n§echịu trách nhiệm.
\n\n§f•§c 1000§a EXP.
\n\n§f•§c 10§a Điểm Chakra.
\n\n§f•§c 1§a Điểm Tiềm Năng.
\n\n§f•§c 10§a Đan Chakra.
\n\n§f•§c 10§a Đan HP.\n\n");
$form->addButton("§l§6NHẬN THƯỞNG");
$form->sendToPlayer($player);
return $form;
}
//-----------------------------------------------------------------------------------------------------------200
public function UIquest2($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$this->level->addExp($player, 2000);
$this->vang->addVang($player, 20);
$this->chakra->addChakra($player, 20);
$this->stats->addStats($player, 2);
$dan_chakra = Item::get(351, 12, 10);
$dan_chakra->setCustomName("§r§l§bĐan Hồi Phục Chakra");
$dan_hp = Item::get(351, 1, 10);
$dan_hp->setCustomName("§r§l§cĐan Hồi Phục Sinh Lực");
$player->getInventory()->addItem($dan_chakra);
$player->getInventory()->addItem($dan_hp);
$this->setDone2($player);
break;
}
});
$form->setTitle("§l§e【§cSự Kiện§e】§r§f Quà Nạp QidaCoin");
$form->setContent("§fNhẫn Giả đã nạp 300 QidaCoin. Quà nạp QidaCoin\n §3(Cảm ơn bạn đã ủng hộ Server)\n §eLưu Ý: Dọn dẹp túi đồ trước khi nhận quà để\n§etránh tình trạng nghẹt túi đồ dẫn đến việc\n§ekhông nhận được đồ. Vấn đề này admin sẽ không\n§echịu trách nhiệm.
\n\n§f•§c 2000§a EXP.
\n\n§f•§c 20§a Vàng.
\n\n§f•§c 20§a Điểm Chakra.
\n\n§f•§c 2§a Điểm Tiềm Năng.
\n\n§f•§c 10§a Đan Chakra.
\n\n§f•§c 10§a Đan HP.\n\n");
$form->addButton("§l§6NHẬN THƯỞNG");
$form->sendToPlayer($player);
return $form;
}
//-----------------------------------------------------------------------------------------------------------300
public function UIquest3($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$this->level->addExp($player, 3000);
$this->vang->addVang($player, 30);
$this->chakra->addChakra($player, 30);
$this->stats->addStats($player, 3);
$dan_chakra = Item::get(351, 12, 10);
$dan_chakra->setCustomName("§r§l§bĐan Hồi Phục Chakra");
$dan_hp = Item::get(351, 1, 10);
$dan_hp->setCustomName("§r§l§cĐan Hồi Phục Sinh Lực");
$player->getInventory()->addItem($dan_chakra);
$player->getInventory()->addItem($dan_hp);
$this->setDone3($player);
break;
}
});
$form->setTitle("§l§e【§cSự Kiện§e】§r§f Quà Nạp QidaCoin");
$form->setContent("§fNhẫn Giả đã nạp 500 QidaCoin. Quà nạp QidaCoin\n §3(Cảm ơn bạn đã ủng hộ Server)\n §eLưu Ý: Dọn dẹp túi đồ trước khi nhận quà để\n§etránh tình trạng nghẹt túi đồ dẫn đến việc\n§ekhông nhận được đồ. Vấn đề này admin sẽ không\n§echịu trách nhiệm.
\n\n§f•§c 3000§a EXP.
\n\n§f•§c 30§a Vàng.
\n\n§f•§c 30§a Điểm Chakra.
\n\n§f•§c 3§a Điểm Tiềm Năng.
\n\n§f•§c 10§a Đan Chakra.
\n\n§f•§c 10§a Đan HP.\n\n");
$form->addButton("§l§6NHẬN THƯỞNG");
$form->sendToPlayer($player);
return $form;
}
//-----------------------------------------------------------------------------------------------------------500
public function UIquest4($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$this->level->addExp($player, 5000);
$this->vang->addVang($player, 50);
$this->chakra->addChakra($player, 50);
$this->stats->addStats($player, 5);
$dan_chakra = Item::get(351, 12, 20);
$dan_chakra->setCustomName("§r§l§bĐan Hồi Phục Chakra");
$dan_hp = Item::get(351, 1, 20);
$dan_hp->setCustomName("§r§l§cĐan Hồi Phục Sinh Lực");
$player->getInventory()->addItem($dan_chakra);
$player->getInventory()->addItem($dan_hp);
$nhatvi = Item::get(370, 0, 2);
$nhatvi->setCustomName("§r§cMảnh Hồn §aThất Vĩ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 5));
$player->getInventory()->addItem($nhatvi);
$this->setDone4($player);
break;
}
});
$form->setTitle("§l§e【§cSự Kiện§e】§r§f Quà Nạp QidaCoin");
$form->setContent("§fNhẫn Giả đã nạp 1000 QidaCoin. Quà nạp QidaCoin\n §3(Cảm ơn bạn đã ủng hộ Server)\n §eLưu Ý: Dọn dẹp túi đồ trước khi nhận quà để\n§etránh tình trạng nghẹt túi đồ dẫn đến việc\n§ekhông nhận được đồ. Vấn đề này admin sẽ không\n§echịu trách nhiệm.
\n\n§f•§c 5000§a EXP.
\n\n§f•§c 50§a Vàng.
\n\n§f•§c 50§a Điểm Chakra.
\n\n§f•§c 5§a Điểm Tiềm Năng.
\n\n§f•§c 20§a Đan Chakra.
\n\n§f•§c 20§a Đan HP.
\n\n§f•§c 2§a MẢNH HỒN THẤT VĨ.\n\n");
$form->addButton("§l§6NHẬN THƯỞNG");
$form->sendToPlayer($player);
return $form;
}
//-----------------------------------------------------------------------------------------------------------1000
public function UIquest5($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$this->level->addExp($player, 8000);
$this->vang->addVang($player, 70);
$this->chakra->addChakra($player, 100);
$this->stats->addStats($player, 10);
$dan_chakra = Item::get(351, 12, 80);
$dan_chakra->setCustomName("§r§l§bĐan Hồi Phục Chakra");
$dan_hp = Item::get(351, 1, 80);
$dan_hp->setCustomName("§r§l§cĐan Hồi Phục Sinh Lực");
$player->getInventory()->addItem($dan_chakra);
$player->getInventory()->addItem($dan_hp);
$nhatvi = Item::get(370, 0, 5);
$nhatvi->setCustomName("§r§cMảnh Hồn §aThất Vĩ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 5));
$player->getInventory()->addItem($nhatvi);
$this->setDone5($player);
break;
}
});
$form->setTitle("§l§e【§cSự Kiện§e】§r§f Quà Nạp QidaCoin");
$form->setContent("§fNhẫn Giả đã nạp 3000 QidaCoin. Quà nạp QidaCoin\n §3(Cảm ơn bạn đã ủng hộ Server)\n §eLưu Ý: Dọn dẹp túi đồ trước khi nhận quà để\n§etránh tình trạng nghẹt túi đồ dẫn đến việc\n§ekhông nhận được đồ. Vấn đề này admin sẽ không\n§echịu trách nhiệm.
\n\n§f•§c 8000§a EXP.
\n\n§f•§c 70§a Vàng.
\n\n§f•§c 100§a Điểm Chakra.
\n\n§f•§c 10§a Điểm Tiềm Năng.
\n\n§f•§c 80§a Đan Chakra.
\n\n§f•§c 80§a Đan HP.
\n\n§f•§c 5§a MẢNH HỒN THẤT VĨ.\n\n");
$form->addButton("§l§6NHẬN THƯỞNG");
$form->sendToPlayer($player);
return $form;
}
//-----------------------------------------------------------------------------------------------------------2000
public function UIquest6($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$this->level->addExp($player, 10000);
$this->vang->addVang($player, 100);
$this->chakra->addChakra($player, 150);
$this->stats->addStats($player, 20);
$dan_chakra = Item::get(351, 12, 100);
$dan_chakra->setCustomName("§r§l§bĐan Hồi Phục Chakra");
$dan_hp = Item::get(351, 1, 100);
$dan_hp->setCustomName("§r§l§cĐan Hồi Phục Sinh Lực");
$player->getInventory()->addItem($dan_chakra);
$player->getInventory()->addItem($dan_hp);
$nhatvi = Item::get(370, 0, 10);
$nhatvi->setCustomName("§r§cMảnh Hồn §aThất Vĩ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 5));
$player->getInventory()->addItem($nhatvi);
$this->setDone6($player);
break;
}
});
$form->setTitle("§l§e【§cSự Kiện§e】§r§f Quà Nạp QidaCoin");
$form->setContent("§fNhẫn Giả đã nạp 5000 QidaCoin. Quà nạp QidaCoin\n §3(Cảm ơn bạn đã ủng hộ Server)\n §eLưu Ý: Dọn dẹp túi đồ trước khi nhận quà để\n§etránh tình trạng nghẹt túi đồ dẫn đến việc\n§ekhông nhận được đồ. Vấn đề này admin sẽ không\n§echịu trách nhiệm.
\n\n§f•§c 10000§a EXP.
\n\n§f•§c 100§a Vàng.
\n\n§f•§c 150§a Điểm Chakra.
\n\n§f•§c 20§a Điểm Tiềm Năng.
\n\n§f•§c 100§a Đan Chakra.
\n\n§f•§c 100§a Đan HP.
\n\n§f•§c 10§a MẢNH HỒN NGŨ VĨ.\n\n");
$form->addButton("§l§6NHẬN THƯỞNG");
$form->sendToPlayer($player);
return $form;
}
//-----------------------------------------------------------------------------------------------------------3000
public function UIquest7($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$this->level->addExp($player, 12000);
$this->vang->addVang($player, 120);
$this->chakra->addChakra($player, 200);
$this->stats->addStats($player, 30);
$dan_chakra = Item::get(351, 12, 120);
$dan_chakra->setCustomName("§r§l§bĐan Hồi Phục Chakra");
$dan_hp = Item::get(351, 1, 120);
$dan_hp->setCustomName("§r§l§cĐan Hồi Phục Sinh Lực");
$player->getInventory()->addItem($dan_chakra);
$player->getInventory()->addItem($dan_hp);
$nhatvi = Item::get(370, 0, 15);
$nhatvi->setCustomName("§r§cMảnh Hồn §aThất Vĩ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 5));
$player->getInventory()->addItem($nhatvi);
$this->setDone7($player);
break;
}
});
$form->setTitle("§l§e【§cSự Kiện§e】§r§f Quà Nạp QidaCoin");
$form->setContent("§fNhẫn Giả đã nạp 9000 QidaCoin. Quà nạp QidaCoin\n §3(Cảm ơn bạn đã ủng hộ Server)\n §eLưu Ý: Dọn dẹp túi đồ trước khi nhận quà để\n§etránh tình trạng nghẹt túi đồ dẫn đến việc\n§ekhông nhận được đồ. Vấn đề này admin sẽ không\n§echịu trách nhiệm.
\n\n§f•§c 12000§a EXP.
\n\n§f•§c 120§a Vàng.
\n\n§f•§c 200§a Điểm Chakra.
\n\n§f•§c 30§a Điểm Tiềm Năng.
\n\n§f•§c 120§a Đan Chakra.
\n\n§f•§c 120§a Đan HP.
\n\n§f•§c 15§a MẢNH HỒN THẤT VĨ.\n\n");
$form->addButton("§l§6NHẬN THƯỞNG");
$form->sendToPlayer($player);
return $form;
}
//-----------------------------------------------------------------------------------------------------------3000
public function UIquest8($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$this->level->addExp($player, 15000);
$this->vang->addVang($player, 150);
$this->chakra->addChakra($player, 250);
$this->stats->addStats($player, 40);
$dan_chakra = Item::get(351, 12, 120);
$dan_chakra->setCustomName("§r§l§bĐan Hồi Phục Chakra");
$dan_hp = Item::get(351, 1, 120);
$dan_hp->setCustomName("§r§l§cĐan Hồi Phục Sinh Lực");
$player->getInventory()->addItem($dan_chakra);
$player->getInventory()->addItem($dan_hp);
$nhatvi = Item::get(370, 0, 20);
$nhatvi->setCustomName("§r§cMảnh Hồn §aThất Vĩ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 5));
$player->getInventory()->addItem($nhatvi);
$mu = Item::get(Item::DIAMOND_HELMET);
$mu->setCustomName("§r§l§cMŨ HOKAGE Bậc S");
$mu->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(0), 40));
$mu->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(1), 40));
$mu->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(4), 40));
$mu->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(5), 40));
$mu->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 1000));
$player->getInventory()->addItem($mu);
$quan = Item::get(Item::DIAMOND_LEGGINGS);
$quan->setCustomName("§r§l§cQUẦN HOKAGE Bậc S");
$quan->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(0), 40));
$quan->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(1), 40));
$quan->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(4), 40));
$quan->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(5), 40));
$quan->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 1000));
$player->getInventory()->addItem($quan)	;	
$giap = Item::get(Item::DIAMOND_CHESTPLATE);
$giap->setCustomName("§r§l§cGIÁP HOKAGE Bậc S");
$giap->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(0), 40));
$giap->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(1), 40));
$giap->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(4), 40));
$giap->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(5), 40));
$giap->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 1000));
$player->getInventory()->addItem($giap);	
$giay = Item::get(Item::DIAMOND_BOOTS);
$giay->setCustomName("§r§l§cGIÀY HOKAGE Bậc S");
$giay->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(0), 40));
$giay->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(1), 40));
$giay->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(4), 40));
$giay->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(5), 40));
$giay->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 1000));
$player->getInventory()->addItem($giay);
$this->setDone8($player);
break;
}
});
$form->setTitle("§l§e【§cSự Kiện§e】§r§f Quà Nạp QidaCoin");
$form->setContent("§fNhẫn Giả đã nạp 14000 QidaCoin. Quà nạp QidaCoin\n §3(Cảm ơn bạn đã ủng hộ Server)\n §eLưu Ý: Dọn dẹp túi đồ trước khi nhận quà để\n§etránh tình trạng nghẹt túi đồ dẫn đến việc\n§ekhông nhận được đồ. Vấn đề này admin sẽ không\n§echịu trách nhiệm.
\n\n§f•§c 15000§a EXP.
\n\n§f•§c 150§a Vàng.
\n\n§f•§c 250§a Điểm Chakra.
\n\n§f•§c 40§a Điểm Tiềm Năng.
\n\n§f•§c 120§a Đan Chakra.
\n\n§f•§c 120§a Đan HP.
\n\n§f•§c 20§a MẢNH HỒN THẤT VĨ.
\n\n§f•§c §dBộ Trang Bị HOKAGE Bậc S.\n\n");
$form->addButton("§l§6NHẬN THƯỞNG");
$form->sendToPlayer($player);
return $form;
}
//-----------------------------------------------------------------------------------------------------------3000
public function UIquest9($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$this->level->addExp($player, 20000);
$this->vang->addVang($player, 200);
$this->chakra->addChakra($player, 300);
$this->stats->addStats($player, 50);
$dan_chakra = Item::get(351, 12, 120);
$dan_chakra->setCustomName("§r§l§bĐan Hồi Phục Chakra");
$dan_hp = Item::get(351, 1, 120);
$dan_hp->setCustomName("§r§l§cĐan Hồi Phục Sinh Lực");
$player->getInventory()->addItem($dan_chakra);
$player->getInventory()->addItem($dan_hp);
$nhatvi = Item::get(370, 0, 25);
$nhatvi->setCustomName("§r§cMảnh Hồn §aThất Vĩ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 5));
$player->getInventory()->addItem($nhatvi);
    $mu = Item::get(Item::DIAMOND_HELMET);
    $mu->setCustomName("§r§l§cMŨ HOKAGE Bậc Ss*");
    $mu->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(0), 60));
    $mu->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(1), 60));
    $mu->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(4), 60));
    $mu->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(5), 60));
	$mu->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 1500));
	$player->getInventory()->addItem($mu);
    $quan = Item::get(Item::DIAMOND_LEGGINGS);
    $quan->setCustomName("§r§l§cQUẦN HOKAGE Bậc Ss*");
    $quan->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(0), 60));
    $quan->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(1), 60));
    $quan->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(4), 60));
    $quan->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(5), 60));
	$quan->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 1500));
	    $player->getInventory()->addItem($quan)	;	
    $giap = Item::get(Item::DIAMOND_CHESTPLATE);
    $giap->setCustomName("§r§l§cGIÁP HOKAGE Bậc Ss*");
    $giap->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(0), 60));
    $giap->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(1), 60));
    $giap->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(4), 60));
    $giap->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(5), 60));
	$giap->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 1500));
	$player->getInventory()->addItem($giap);	
	    $giay = Item::get(Item::DIAMOND_BOOTS);
    $giay->setCustomName("§r§l§cGIÀY HOKAGE Bậc Ss*");
    $giay->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(0), 60));
    $giay->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(1), 60));
    $giay->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(4), 60));
    $giay->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(5), 60));
	$giay->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 1500));
	$player->getInventory()->addItem($giay);
$this->setDone9($player);
break;
}
});
$form->setTitle("§l§e【§cSự Kiện§e】§r§f Quà Nạp QidaCoin");
$form->setContent("§fNhẫn Giả đã nạp 20000 QidaCoin. Quà nạp QidaCoin\n §3(Cảm ơn bạn đã ủng hộ Server)\n §eLưu Ý: Dọn dẹp túi đồ trước khi nhận quà để\n§etránh tình trạng nghẹt túi đồ dẫn đến việc\n§ekhông nhận được đồ. Vấn đề này admin sẽ không\n§echịu trách nhiệm.
\n\n§f•§c 20000§a EXP.
\n\n§f•§c 200§a Vàng.
\n\n§f•§c 300§a Điểm Chakra.
\n\n§f•§c 50§a Điểm Tiềm Năng.
\n\n§f•§c 120§a Đan Chakra.
\n\n§f•§c 120§a Đan HP.
\n\n§f•§c 25§a MẢNH HỒN THẤT VĨ.
\n\n§f•§c §dBộ Trang Bị HOKAGE Bậc Ss\n\n");
$form->addButton("§l§6NHẬN THƯỞNG");
$form->sendToPlayer($player);
return $form;
}
}
