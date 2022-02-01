<?php

namespace StatsCMD;

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
use pocketmine\math\Vector3;
use pocketmine\utils\Config;
use pocketmine\Inventory;
use pocketmine\level\Level;
use pocketmine\entity\human;
use pocketmine\entity\Effect;
use pocketmine\network\protocol\SetTitlePacket;

class Main extends PluginBase implements Listener{
public function onEnable(){
$this->getServer()->getPluginManager()->registerEvents($this, $this);
$this->level = $this->getServer()->getPluginManager()->getPlugin("NGVS_Level");
$this->stats = $this->getServer()->getPluginManager()->getPlugin("NGVS_Stats");
$this->sm = $this->getServer()->getPluginManager()->getPlugin("NGVS_SucManh");
}
public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool{
if($command->getName() === "stats"){
$this->menuStats($sender);
}
return true;
}
public function ThongBao($player, $message){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
$this->menuStats($player);
return true;
}
switch($result){
case 0:
$this->menuStats($player);
break;
}
});
$form->setTitle("§l§1ĐIỂM TIỀM NĂNG");
$form->setContent($message);
$form->addButton("§l§1Đã Hiểu");
$form->sendToPlayer($player);
return $form;
}
public function menuStats($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
/*$a = *20);
$a1 = $a/20;
$b = $this->stats->getCurrentJump($player)*(15*20);
$b1 = $b/20;*/
if($result === null){
return true;
}
switch($result){
case 0:
if($this->level->getLevel($player) < 5){
$this->ThongBao($player, "§6Nhẫn Giả§c chưa đạt cấp yêu cầu để mở khóa hệ thống §6Điểm Tiềm Năng");
return true;
}
if($this->stats->getCurrentJump($player) > 5){
$this->ThongBao($player, "§6Nhẫn Giả§c đã đạt tới cảnh giới cao nhất của §aThân Lực");
return true;
}
$this->Agree($player, "Thân Lực"); #AgreeJump
break;
case 1:
if($this->level->getLevel($player) < 5){
$this->ThongBao($player, "§6Nhẫn Giả§c chưa đạt cấp yêu cầu để mở khóa hệ thống §6Điểm Tiềm Năng");
return true;
}
if($this->stats->getCurrentSpeed($player) > 8){
$this->ThongBao($player, "§6Nhẫn Giả§c đã đạt tới cảnh giới cao nhất của §aLinh Hoạt");
return true;
}
$this->Agree($player, "Linh Hoạt"); #AgreeSpeed
break;
case 2:
if($this->level->getLevel($player) < 5){
$this->ThongBao($player, "§6Nhẫn Giả§c chưa đạt cấp yêu cầu để mở khóa hệ thống §6Điểm Tiềm Năng");
return true;
}
if($this->stats->getCurrentDamage($player) > 100){
$this->ThongBao($player, "§6Nhẫn Giả§c đã đạt tới cảnh giới cao nhất của §aSát Thương");
return true;
}
$this->Agree($player, "Sát Thương"); #AgreeSpeed
break;
case 3:
if($this->level->getLevel($player) < 5){
$this->ThongBao($player, "§6Nhẫn Giả§c chưa đạt cấp yêu cầu để mở khóa hệ thống §6Điểm Tiềm Năng");
return true;
}
if($this->stats->getCurrentCrit($player) > 100){
$this->ThongBao($player, "§6Nhẫn Giả§c đã đạt tới cảnh giới cao nhất của §aBạo Kích");
return true;
}
$this->Agree($player, "Bạo Kích"); #AgreeSpeed
break;
case 4:
if($this->level->getLevel($player) < 5){
$this->ThongBao($player, "§6Nhẫn Giả§c chưa đạt cấp yêu cầu để mở khóa hệ thống §6Điểm Tiềm Năng");
return true;
}
if($this->stats->getCurrentHealth($player) > 20000){
$this->ThongBao($player, "§6Nhẫn Giả§c đã đạt tới cảnh giới cao nhất của §aSinh Lực");
return true;
}
$this->Agree($player, "Sinh Lực"); #AgreeSpeed
break;
}
});
$form->setTitle("§l§1ĐIỂM TIỀM NĂNG");
$form->setContent("§f•§a Số điểm tiềm năng §6Nhẫn Giả§a đang có: §c".$this->stats->getCurrentStats($player)." điểm\n§f•§a Linh Hoạt: §c".$this->stats->getCurrentSpeed($player)." bậc §f-§a Hiệu lực trong: §c".($this->stats->getCurrentSpeed($player)*15)." giây\n§f•§a Thân Lực:§c ".$this->stats->getCurrentJump($player)." bậc §f-§a Hiệu lực trong: §c".($this->stats->getCurrentJump($player)*15)." giây\n§f•§a Sát Thương:§c ".$this->stats->getCurrentDamage($player)." bậc\n§f•§a Bạo Kích:§c ".$this->stats->getCurrentCrit($player)."\n§f•§a Sinh Lực:§c ".$this->stats->getCurrentHealth($player)." Máu");
$form->addButton("§l§1NÂNG ĐIỂM THÂN LỰC");
$form->addButton("§l§1NÂNG ĐIỂM LINH HOẠT");
$form->addButton("§l§1NÂNG ĐIỂM SÁT THƯƠNG");
$form->addButton("§l§1NÂNG ĐIỂM BẠO KÍCH");
$form->addButton("§l§1NÂNG ĐIỂM SINH LỰC");
$form->sendToPlayer($player);
return $form;
}
public function Agree($player, $type){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null) use ($type){
$result = $data;
if($result === null){
$this->menuStats($player);
return true;
}
switch($result){
case 0:
if($type === "Linh Hoạt" && $this->stats->getCurrentStats($player) < 1){
$this->ThongBao($player, "§f•§c Số điểm tiềm năng của §6Nhẫn Giả§c không đủ để nâng");
//return true;
}
if($type === "Linh Hoạt" && $this->stats->getCurrentStats($player) >= 1){
$this->ThongBao($player, "§f•§6 Nhẫn Giả§a đã nâng thành công §c1§a điểm tiềm năng cho §cLinh Hoạt\n§f•§6 +1234 Sức Mạnh");
$this->stats->reduceStats($player, 1);
$this->sm->addSucmanh($player, 1234);
$this->stats->upgradeSpeed($player);
//return true;
}
if($type === "Thân Lực" && $this->stats->getCurrentStats($player) < 1){
$this->ThongBao($player, "§f•§c Số điểm tiềm năng của §6Nhẫn Giả§c không đủ để nâng");
//return true;
}
if($type === "Thân Lực" && $this->stats->getCurrentStats($player) >= 1){
$this->ThongBao($player, "§f•§6 Nhẫn Giả§a đã nâng thành công §c1§a điểm tiềm năng cho §cThân Lực\n§f•§6 +2341 Sức Mạnh");
$this->stats->reduceStats($player, 1);
$this->sm->addSucmanh($player, 2341);
$this->stats->upgradeJump($player);
//return true;
}
if($type === "Sát Thương" && $this->stats->getCurrentStats($player) < 2){
$this->ThongBao($player, "§f•§c Số điểm tiềm năng của §6Nhẫn Giả§c không đủ để nâng");
//return true;
}
if($type === "Sát Thương" && $this->stats->getCurrentStats($player) >= 2){
$this->ThongBao($player, "§f•§6 Nhẫn Giả§a đã nâng thành công §c1§a điểm tiềm năng cho §cSát Thương\n§f•§6 +4321 Sức Mạnh");
$this->stats->reduceStats($player, 2);
$this->sm->addSucmanh($player, 4321);
$this->stats->upgradeDamage($player);
//return true;
}
if($type === "Bạo Kích" && $this->stats->getCurrentStats($player) < 2){
$this->ThongBao($player, "§f•§c Số điểm tiềm năng của §6Nhẫn Giả§c không đủ để nâng");
//return true;
}
if($type === "Bạo Kích" && $this->stats->getCurrentStats($player) >= 2){
$this->ThongBao($player, "§f•§6 Nhẫn Giả§a đã nâng thành công §c1§a điểm tiềm năng cho §cBạo Kích\n§f•§6 +3214 Sức Mạnh");
$this->stats->reduceStats($player, 1);
$this->sm->addSucmanh($player, 3214);
$this->stats->upgradeCrit($player);
//return true;
}
if($type === "Sinh Lực" && $this->stats->getCurrentStats($player) < 2){
$this->ThongBao($player, "§f•§c Số điểm tiềm năng của §6Nhẫn Giả§c không đủ để nâng");
//return true;
}
if($type === "Sinh Lực" && $this->stats->getCurrentStats($player) >= 2){
$this->ThongBao($player, "§f•§6 Nhẫn Giả§a đã nâng thành công §c1§a điểm tiềm năng cho §cSinh Lực\n§f•§6 +3996 Sức Mạnh");
$this->stats->reduceStats($player, 1);
$this->sm->addSucmanh($player, 3996);
$this->stats->upgradeHealth($player);
$player->setMaxHealth($this->stats->getCurrentHealth($player)*1);
//return true;
}
var_dump($player);
break;
case 1:
$this->menuStats($player);
break;
}
});
$form->setTitle("§l§1ĐIỂM TIỀM NĂNG");
$form->setContent("§f•§6 Nhẫn Giả§a có muốn dùng §c1§a điểm tiềm năng để nâng §c".$type."§a?");
$form->addButton("§l§1XÁC NHẬN");
$form->addButton("§l§1HỦY");
$form->sendToPlayer($player);
}
}