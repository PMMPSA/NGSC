<?php

namespace CB;

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
use pocketmine\event\player\{PlayerInteractEvent, PlayerItemHeldEvent, PlayerJoinEvent, PlayerChatEvent, PlayerMoveEvent};
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

class Main extends PluginBase implements Listener{

public $data;
private $config, $amount;

public function onEnable(){
if(!file_exists($this->getDataFolder() . "Rank/")){
@mkdir($this->getDataFolder() . "Rank/");
}
$this->rank = new Config($this->getDataFolder() . "Rank/" . "data.yml", Config::YAML);
$this->saveDefaultConfig();
$this->config = $this->getConfig();
$this->config->save();
$this->stats = $this->getServer()->getPluginManager()->getPlugin("NGVS_Stats");
$this->sm = $this->getServer()->getPluginManager()->getPlugin("NGVS_SucManh");
$this->getServer()->getPluginManager()->registerEvents($this,$this);
}
public function onJoin(PlayerJoinEvent $ev){
$player = $ev->getPlayer()->getName();
if(!($this->rank->exists(strtolower($player)))){
$this->rank->set(strtolower($player), ["Rank" => "Tập Sự"]);
$this->rank->save();
return true;
}
}
public function getRank(Player $player){
$getRank = $this->rank->get(strtolower($player->getName()))["Rank"];
return $getRank;
}
public function getNextRank(Player $player){
if($this->getRank($player) == "Tập Sự"){
$nextrank == "Genin";
//return $nextrank;
}
if($this->getRank($player) == "Genin"){
$nextrank == "Chunnin";
//return $nextrank;
}
if($this->getRank($player) == "Chunnin"){
$nextrank == "Jonin";
//return $nextrank;
}
if($this->getRank($player) == "Jonin"){
$nextrank == "Jonin 1 Sao";
//return $nextrank;
}
if($this->getRank($player) == "Jonin 1 Sao"){
$nextrank == "Jonin 2 Sao";
//return $nextrank;
}
if($this->getRank($player) == "Jonin 2 Sao"){
$nextrank == "Jonin 3 Sao";
//return $nextrank;
}
if($this->getRank($player) == "Jonin 3 Sao"){
$nextrank == "Anbu";
//return $nextrank;
}
if($this->getRank($player) == "Anbu"){
$nextrank == "Anbu 1 Sao";
//return $nextrank;
}
if($this->getRank($player) == "Anbu 1 Sao"){
$nextrank == "Anbu 2 Sao";
//return $nextrank;
}
if($this->getRank($player) == "Anbu 2 Sao"){
$nextrank == "Anbu 3 Sao";
//return $nextrank;
}
if($this->getRank($player) == "Anbu 3 Sao"){
$nextrank == "Sannin";
//return $nextrank;
}
if($this->getRank($player) == "Sannin"){
$nextrank == "Sannin Bậc A";
//return $nextrank;
}
if($this->getRank($player) == "Sannin Bậc A"){
$nextrank == "Sannin Bậc S";
//return $nextrank;
}
if($this->getRank($player) == "Sannin Bậc S"){
$nextrank == "Sannin Bậc Ss";
//return $nextrank;
}
if($this->getRank($player) == "Sannin Bậc Ss"){
$nextrank == "Kage";
//return $nextrank;
}
if($this->getRank($player) == "Kage"){
$nextrank == "Hiền Nhân";
//return $nextrank;
}
if($this->getRank($player) == "Hiền Nhân"){
$nextrank == "Hiền Nhân Bậc S";
//return $nextrank;
}
if($this->getRank($player) == "Hiền Nhân Bậc S"){
$nextrank == "Hiền Nhân Bậc Ss";
//return $nextrank;
}
if($this->getRank($player) == "Hiền Nhân Bậc Ss"){
$nextrank == "Lục Đạo";
//return $nextrank;
}
if($this->getRank($player) == "Lục Đạo"){
$nextrank == "Lục Đạo Bậc A";
//return $nextrank;
}
if($this->getRank($player) == "Lục Đạo Bậc A"){
$nextrank == "Lục Đạo Bậc S";
//return $nextrank;
}
if($this->getRank($player) == "Lục Đạo Bậc S"){
$nextrank == "Lục Đạo Bậc Ss";
//return $nextrank;
}
if($this->getRank($player) == "Lục Đạo Bậc Ss"){
$nextrank == "Tiên Nhân";
//return $nextrank;
}
if($this->getRank($player) == "Tiên Nhân"){
$nextrank == "Tiên Nhân Bậc A";
//return $nextrank;
}
if($this->getRank($player) == "Tiên Nhân Bậc A"){
$nextrank == "Tiên Nhân Bậc S";
//return $nextrank;
}
if($this->getRank($player) == "Tiên Nhân Bậc S"){
$nextrank == "Tiên Nhân Bậc Ss";
//return $nextrank;
}
if($this->getRank($player) == "Tiên Nhân Bậc Ss"){
$nextrank == "Lục Đạo Tiên Nhân";
//return $nextrank;
}
if($this->getRank($player) == "Lục Đạo Tiên Nhân"){
$nextrank == "Lục Đạo Tiên Nhân Bậc A";
//return $nextrank;
}
if($this->getRank($player) == "Lục Đạo Tiên Nhân Bậc A"){
$nextrank == "Lục Đạo Tiên Nhân Bậc S";
//return $nextrank;
}
if($this->getRank($player) == "Lục Đạo Tiên Nhân Bậc S"){
$nextrank == "Lục Đạo Tiên Nhân Bậc Ss";
//return $nextrank;
}
return $nextrank;
}
public function getNextStats(Player $player){
if($this->getRank($player) == "Tập Sự"){
$nextrank == 20;
return $nextrank;
}
if($this->getRank($player) == "Genin"){
$nextrank == 30;
return $nextrank;
}
if($this->getRank($player) == "Chunnin"){
$nextrank == 40;
return $nextrank;
}
if($this->getRank($player) == "Jonin"){
$nextrank == 60;
return $nextrank;
}
if($this->getRank($player) == "Jonin 1 Sao"){
$nextrank == 80;
return $nextrank;
}
if($this->getRank($player) == "Jonin 2 Sao"){
$nextrank == 100;
return $nextrank;
}
if($this->getRank($player) == "Jonin 3 Sao"){
$nextrank == 130;
return $nextrank;
}
if($this->getRank($player) == "Anbu"){
$nextrank == 160;
return $nextrank;
}
if($this->getRank($player) == "Anbu 1 Sao"){
$nextrank == 190;
return $nextrank;
}
if($this->getRank($player) == "Anbu 2 Sao"){
$nextrank == 230;
return $nextrank;
}
if($this->getRank($player) == "Anbu 3 Sao"){
$nextrank == 270;
return $nextrank;
}
if($this->getRank($player) == "Sannin"){
$nextrank == 320;
return $nextrank;
}
if($this->getRank($player) == "Sannin Bậc A"){
$nextrank == 370;
return $nextrank;
}
if($this->getRank($player) == "Sannin Bậc S"){
$nextrank == 430;
return $nextrank;
}
if($this->getRank($player) == "Sannin Bậc Ss"){
$nextrank == 490;
return $nextrank;
}
if($this->getRank($player) == "Kage"){
$nextrank == 550;
return $nextrank;
}
if($this->getRank($player) == "Hiền Nhân"){
$nextrank == 620;
return $nextrank;
}
if($this->getRank($player) == "Hiền Nhân Bậc S"){
$nextrank == 690;
return $nextrank;
}
if($this->getRank($player) == "Hiền Nhân Bậc Ss"){
$nextrank == 760;
return $nextrank;
}
if($this->getRank($player) == "Lục Đạo"){
$nextrank == 840;
return $nextrank;
}
if($this->getRank($player) == "Lục Đạo Bậc A"){
$nextrank == 930;
return $nextrank;
}
if($this->getRank($player) == "Lục Đạo Bậc S"){
$nextrank == 1020;
return $nextrank;
}
if($this->getRank($player) == "Lục Đạo Bậc Ss"){
$nextrank == 1150;
return $nextrank;
}
if($this->getRank($player) == "Tiên Nhân"){
$nextrank == 1280;
return $nextrank;
}
if($this->getRank($player) == "Tiên Nhân Bậc A"){
$nextrank == 1450;
return $nextrank;
}
if($this->getRank($player) == "Tiên Nhân Bậc S"){
$nextrank == 1650;
return $nextrank;
}
if($this->getRank($player) == "Tiên Nhân Bậc Ss"){
$nextrank == 1850;
return $nextrank;
}
if($this->getRank($player) == "Lục Đạo Tiên Nhân"){
$nextrank == 2000;
return $nextrank;
}
if($this->getRank($player) == "Lục Đạo Tiên Nhân Bậc A"){
$nextrank == 2150;
return $nextrank;
}
if($this->getRank($player) == "Lục Đạo Tiên Nhân Bậc S"){
$nextrank == 2300;
return $nextrank;
}
if($this->getRank($player) == "Lục Đạo Tiên Nhân Bậc Ss"){
$nextrank == 2500;
return $nextrank;
}


}
public function setGenin(Player $player){
$this->rank->set(strtolower($player->getName()), ["Rank" => "Genin"]);
$this->rank->save();
//$player->setNameTag("§l§2【§aGENIN§2】§r§f ".$player->getName());
}
public function setChunnin(Player $player){
$this->rank->set(strtolower($player->getName()), ["Rank" => "Chunnin"]);
$this->rank->save();
}
public function setJonin(Player $player){
$this->rank->set(strtolower($player->getName()), ["Rank" => "Jonin"]);
$this->rank->save();
}
public function setKage(Player $player){
$this->rank->set(strtolower($player->getName()), ["Rank" => "Kage"]);
$this->rank->save();
}
public function setRANK(Player $player, $rank){
$this->rank->set(strtolower($player->getName()), ["Rank" => $rank]);
$this->rank->save();
}
public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool{
if($command->getName() === "rank"){
if($this->getRank($sender) == "Tập Sự"){
$this->rankUI($sender, $this->stats->getCurrentJump($sender) + $this->stats->getCurrentSpeed($sender) + $this->stats->getCurrentDamage($sender) + $this->stats->getCurrentCrit($sender) + $this->stats->getCurrentHealth($sender), "Genin", 20);
return true;
}
if($this->getRank($sender) == "Genin"){
$this->rankUI($sender, $this->stats->getCurrentJump($sender) + $this->stats->getCurrentSpeed($sender) + $this->stats->getCurrentDamage($sender) + $this->stats->getCurrentCrit($sender) + $this->stats->getCurrentHealth($sender), "Chunnin", 30);
return true;
}
if($this->getRank($sender) == "Chunnin"){
$this->rankUI($sender, $this->stats->getCurrentJump($sender) + $this->stats->getCurrentSpeed($sender) + $this->stats->getCurrentDamage($sender) + $this->stats->getCurrentCrit($sender) + $this->stats->getCurrentHealth($sender), "Jonin", 40);
return true;
}
if($this->getRank($sender) == "Jonin"){
$this->rankUI($sender, $this->stats->getCurrentJump($sender) + $this->stats->getCurrentSpeed($sender) + $this->stats->getCurrentDamage($sender) + $this->stats->getCurrentCrit($sender) + $this->stats->getCurrentHealth($sender), "Jonin 1 Sao", 60);
return true;
}
if($this->getRank($sender) == "Jonin 1 Sao"){
$this->rankUI($sender, $this->stats->getCurrentJump($sender) + $this->stats->getCurrentSpeed($sender) + $this->stats->getCurrentDamage($sender) + $this->stats->getCurrentCrit($sender) + $this->stats->getCurrentHealth($sender), "Jonin 2 Sao", 80);
return true;
}
if($this->getRank($sender) == "Jonin 2 Sao"){
$this->rankUI($sender, $this->stats->getCurrentJump($sender) + $this->stats->getCurrentSpeed($sender) + $this->stats->getCurrentDamage($sender) + $this->stats->getCurrentCrit($sender) + $this->stats->getCurrentHealth($sender), "Jonin 3 Sao", 100);
return true;
}
if($this->getRank($sender) == "Jonin 3 Sao"){
$this->rankUI($sender, $this->stats->getCurrentJump($sender) + $this->stats->getCurrentSpeed($sender) + $this->stats->getCurrentDamage($sender) + $this->stats->getCurrentCrit($sender) + $this->stats->getCurrentHealth($sender), "Anbu", 130);
return true;
}
if($this->getRank($sender) == "Anbu"){
$this->rankUI($sender, $this->stats->getCurrentJump($sender) + $this->stats->getCurrentSpeed($sender) + $this->stats->getCurrentDamage($sender) + $this->stats->getCurrentCrit($sender) + $this->stats->getCurrentHealth($sender), "Anbu 1 Sao", 160);
return true;
}
if($this->getRank($sender) == "Anbu 1 Sao"){
$this->rankUI($sender, $this->stats->getCurrentJump($sender) + $this->stats->getCurrentSpeed($sender) + $this->stats->getCurrentDamage($sender) + $this->stats->getCurrentCrit($sender) + $this->stats->getCurrentHealth($sender), "Anbu 2 Sao", 190);
return true;
}
if($this->getRank($sender) == "Anbu 2 Sao"){
$this->rankUI($sender, $this->stats->getCurrentJump($sender) + $this->stats->getCurrentSpeed($sender) + $this->stats->getCurrentDamage($sender) + $this->stats->getCurrentCrit($sender) + $this->stats->getCurrentHealth($sender), "Anbu 3 Sao", 230);
return true;
}
if($this->getRank($sender) == "Anbu 3 Sao"){
$this->rankUI($sender, $this->stats->getCurrentJump($sender) + $this->stats->getCurrentSpeed($sender) + $this->stats->getCurrentDamage($sender) + $this->stats->getCurrentCrit($sender) + $this->stats->getCurrentHealth($sender), "Sannin", 270);
return true;
}
if($this->getRank($sender) == "Sannin"){
$this->rankUI($sender, $this->stats->getCurrentJump($sender) + $this->stats->getCurrentSpeed($sender) + $this->stats->getCurrentDamage($sender) + $this->stats->getCurrentCrit($sender) + $this->stats->getCurrentHealth($sender), "Sannin Bậc A", 320);
return true;
}
if($this->getRank($sender) == "Sannin Bậc A"){
$this->rankUI($sender, $this->stats->getCurrentJump($sender) + $this->stats->getCurrentSpeed($sender) + $this->stats->getCurrentDamage($sender) + $this->stats->getCurrentCrit($sender) + $this->stats->getCurrentHealth($sender), "Sannin Bậc S", 370);
return true;
}
if($this->getRank($sender) == "Sannin Bậc S"){
$this->rankUI($sender, $this->stats->getCurrentJump($sender) + $this->stats->getCurrentSpeed($sender) + $this->stats->getCurrentDamage($sender) + $this->stats->getCurrentCrit($sender) + $this->stats->getCurrentHealth($sender), "Sannin Bậc Ss", 430);
return true;
}
if($this->getRank($sender) == "Sannin Bậc Ss"){
$this->rankUI($sender, $this->stats->getCurrentJump($sender) + $this->stats->getCurrentSpeed($sender) + $this->stats->getCurrentDamage($sender) + $this->stats->getCurrentCrit($sender) + $this->stats->getCurrentHealth($sender), "Kage", 490);
return true;
}
if($this->getRank($sender) == "Kage"){
$this->rankUI($sender, $this->stats->getCurrentJump($sender) + $this->stats->getCurrentSpeed($sender) + $this->stats->getCurrentDamage($sender) + $this->stats->getCurrentCrit($sender) + $this->stats->getCurrentHealth($sender), "Hiền Nhân", 550);
return true;
}
if($this->getRank($sender) == "Hiền Nhân"){
$this->rankUI($sender, $this->stats->getCurrentJump($sender) + $this->stats->getCurrentSpeed($sender) + $this->stats->getCurrentDamage($sender) + $this->stats->getCurrentCrit($sender) + $this->stats->getCurrentHealth($sender), "Hiền Nhân Bậc S", 620);
return true;
}
if($this->getRank($sender) == "Hiền Nhân Bậc S"){
$this->rankUI($sender, $this->stats->getCurrentJump($sender) + $this->stats->getCurrentSpeed($sender) + $this->stats->getCurrentDamage($sender) + $this->stats->getCurrentCrit($sender) + $this->stats->getCurrentHealth($sender), "Hiền Nhân Bậc Ss", 690);
return true;
}
if($this->getRank($sender) == "Hiền Nhân Bậc Ss"){
$this->rankUI($sender, $this->stats->getCurrentJump($sender) + $this->stats->getCurrentSpeed($sender) + $this->stats->getCurrentDamage($sender) + $this->stats->getCurrentCrit($sender) + $this->stats->getCurrentHealth($sender), "Lục Đạo", 760);
return true;
}
if($this->getRank($sender) == "Lục Đạo"){
$this->rankUI($sender, $this->stats->getCurrentJump($sender) + $this->stats->getCurrentSpeed($sender) + $this->stats->getCurrentDamage($sender) + $this->stats->getCurrentCrit($sender) + $this->stats->getCurrentHealth($sender), "Lục Đạo Bậc A", 840);
return true;
}
if($this->getRank($sender) == "Lục Đạo Bậc A"){
$this->rankUI($sender, $this->stats->getCurrentJump($sender) + $this->stats->getCurrentSpeed($sender) + $this->stats->getCurrentDamage($sender) + $this->stats->getCurrentCrit($sender) + $this->stats->getCurrentHealth($sender), "Lục Đạo Bậc S", 930);
return true;
}
if($this->getRank($sender) == "Lục Đạo Bậc S"){
$this->rankUI($sender, $this->stats->getCurrentJump($sender) + $this->stats->getCurrentSpeed($sender) + $this->stats->getCurrentDamage($sender) + $this->stats->getCurrentCrit($sender) + $this->stats->getCurrentHealth($sender), "Lục Đạo Bậc Ss", 1020);
return true;
}
if($this->getRank($sender) == "Lục Đạo Bậc Ss"){
$this->rankUI($sender, $this->stats->getCurrentJump($sender) + $this->stats->getCurrentSpeed($sender) + $this->stats->getCurrentDamage($sender) + $this->stats->getCurrentCrit($sender) + $this->stats->getCurrentHealth($sender), "Tiên Nhân", 1150);
return true;
}
if($this->getRank($sender) == "Tiên Nhân"){
$this->rankUI($sender, $this->stats->getCurrentJump($sender) + $this->stats->getCurrentSpeed($sender) + $this->stats->getCurrentDamage($sender) + $this->stats->getCurrentCrit($sender) + $this->stats->getCurrentHealth($sender), "Tiên Nhân Bậc A", 1280);
return true;
}
if($this->getRank($sender) == "Tiên Nhân Bậc A"){
$this->rankUI($sender, $this->stats->getCurrentJump($sender) + $this->stats->getCurrentSpeed($sender) + $this->stats->getCurrentDamage($sender) + $this->stats->getCurrentCrit($sender) + $this->stats->getCurrentHealth($sender), "Tiên Nhân Bậc S", 1450);
return true;
}
if($this->getRank($sender) == "Tiên Nhân Bậc S"){
$this->rankUI($sender, $this->stats->getCurrentJump($sender) + $this->stats->getCurrentSpeed($sender) + $this->stats->getCurrentDamage($sender) + $this->stats->getCurrentCrit($sender) + $this->stats->getCurrentHealth($sender), "Tiên Nhân Bậc Ss", 1650);
return true;
}
if($this->getRank($sender) == "Tiên Nhân Bậc Ss"){
$this->rankUI($sender, $this->stats->getCurrentJump($sender) + $this->stats->getCurrentSpeed($sender) + $this->stats->getCurrentDamage($sender) + $this->stats->getCurrentCrit($sender) + $this->stats->getCurrentHealth($sender), "Lục Đạo Tiên Nhân", 1850);
return true;
}
if($this->getRank($sender) == "Lục Đạo Tiên Nhân"){
$this->rankUI($sender, $this->stats->getCurrentJump($sender) + $this->stats->getCurrentSpeed($sender) + $this->stats->getCurrentDamage($sender) + $this->stats->getCurrentCrit($sender) + $this->stats->getCurrentHealth($sender), "Lục Đạo Tiên Nhân Bậc A", 2000);
return true;
}
if($this->getRank($sender) == "Lục Đạo Tiên Nhân Bậc A"){
$this->rankUI($sender, $this->stats->getCurrentJump($sender) + $this->stats->getCurrentSpeed($sender) + $this->stats->getCurrentDamage($sender) + $this->stats->getCurrentCrit($sender) + $this->stats->getCurrentHealth($sender), "Lục Đạo Tiên Nhân Bậc S", 2150);
return true;
}
if($this->getRank($sender) == "Lục Đạo Tiên Nhân Bậc S"){
$this->rankUI($sender, $this->stats->getCurrentJump($sender) + $this->stats->getCurrentSpeed($sender) + $this->stats->getCurrentDamage($sender) + $this->stats->getCurrentCrit($sender) + $this->stats->getCurrentHealth($sender), "Lục Đạo Tiên Nhân Bậc Ss", 2300);
return true;
}
if($this->getRank($sender) == "Lục Đạo Tiên Nhân Bậc Ss"){
$this->ThongBao1($sender,"§f•§a Nhẫn Giả Đã Đạt Giới Hạn Cấp Bậc...");
return true;
}

}
return true;
}
public function ThongBao($player, $message){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
$this->getServer()->dispatchCommand($player, "rank");
return true;
}
switch($result){
case 0:
$this->getServer()->dispatchCommand($player, "rank");
break;
}
});
$form->setTitle("§l§1CẤP BẬC NINJA");
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
//$this->getServer()->dispatchCommand($player, "rank");
return true;
}
switch($result){
case 0:
//$this->getServer()->dispatchCommand($player, "rank");
break;
}
});
$form->setTitle("§l§1CẤP BẬC NINJA");
$form->setContent($message);
$form->addButton("§l§1Đã Hiểu");
$form->sendToPlayer($player);
return $form;
}
public function rankUI($player, $countall, $nextrank, $nextstats){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null) use ($countall, $nextrank, $nextstats){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
if($countall >= $nextstats && $this->getRank($player) == "Tập Sự"){
$this->ThongBao($player,"§f•§a Chúc mừng! Nhẫn Giả đã nâng bậc thành công lên Genin\n§f•§a +1000 Sức Mạnh");
$this->sm->addSucManh($player, 1000);
$this->setGenin($player);
$this->getServer()->broadcastMessage("§l§f❖§c Nhẫn Giả §a".$player->getName()."§c đã tiến cấp lên tới §l§a".$this->getRank($player));
return true;
}
if($countall >= $nextstats && $this->getRank($player) == "Genin"){
$this->ThongBao($player,"§f•§a Chúc mừng! Nhẫn Giả đã nâng bậc thành công lên Chunnin\n§f•§a +2000 Sức Mạnh");
$this->sm->addSucManh($player, 2000);
$this->setChunnin($player);
$this->getServer()->broadcastMessage("§l§f❖§c Nhẫn Giả §a".$player->getName()."§c đã tiến cấp lên tới §l§a".$this->getRank($player));
return true;
}
if($countall >= $nextstats && $this->getRank($player) == "Chunnin"){
$this->ThongBao($player,"§f•§a Chúc mừng! Nhẫn Giả đã nâng bậc thành công lên Jonin\n§f•§a +3000 Sức Mạnh");
$this->sm->addSucManh($player, 3000);
$this->setJonin($player);
$this->getServer()->broadcastMessage("§l§f❖§c Nhẫn Giả §a".$player->getName()."§c đã tiến cấp lên tới §l§a".$this->getRank($player));
return true;
}
if($countall >= $nextstats && $this->getRank($player) == "Jonin"){
$this->ThongBao($player,"§f•§a Chúc mừng! Nhẫn Giả đã nâng bậc thành công lên Jonin 1 Sao\n§f•§a +4000 Sức Mạnh");
$this->sm->addSucManh($player, 4000);
$this->setRANK($player, "Jonin 1 Sao");
$this->getServer()->broadcastMessage("§l§f❖§c Nhẫn Giả §a".$player->getName()."§c đã tiến cấp lên tới §l§a".$this->getRank($player));
return true;
}
if($countall >= $nextstats && $this->getRank($player) == "Jonin 1 Sao"){
$this->ThongBao($player,"§f•§a Chúc mừng! Nhẫn Giả đã nâng bậc thành công lên Jonin 2 Sao\n§f•§a +6000 Sức Mạnh");
$this->sm->addSucManh($player, 6000);
$this->setRANK($player, "Jonin 2 Sao");
$this->getServer()->broadcastMessage("§l§f❖§c Nhẫn Giả §a".$player->getName()."§c đã tiến cấp lên tới §l§a".$this->getRank($player));
return true;
}
if($countall >= $nextstats && $this->getRank($player) == "Jonin 2 Sao"){
$this->ThongBao($player,"§f•§a Chúc mừng! Nhẫn Giả đã nâng bậc thành công lên Jonin 3 Sao\n§f•§a +10000 Sức Mạnh");
$this->sm->addSucManh($player, 10000);
$this->setRANK($player, "Jonin 3 Sao");
$this->getServer()->broadcastMessage("§l§f❖§c Nhẫn Giả §a".$player->getName()."§c đã tiến cấp lên tới §l§a".$this->getRank($player));
return true;
}
if($countall >= $nextstats && $this->getRank($player) == "Jonin 3 Sao"){
$this->ThongBao($player,"§f•§a Chúc mừng! Nhẫn Giả đã nâng bậc thành công lên Anbu\n§f•§a +12000 Sức Mạnh");
$this->sm->addSucManh($player, 12000);
$this->setRANK($player, "Anbu");
$this->getServer()->broadcastMessage("§l§f❖§c Nhẫn Giả §a".$player->getName()."§c đã tiến cấp lên tới §l§a".$this->getRank($player));
return true;
}
if($countall >= $nextstats && $this->getRank($player) == "Anbu"){
$this->ThongBao($player,"§f•§a Chúc mừng! Nhẫn Giả đã nâng bậc thành công lên Anbu 1 Sao\n§f•§a +13000 Sức Mạnh");
$this->sm->addSucManh($player, 13000);
$this->setRANK($player, "Anbu 1 Sao");
$this->getServer()->broadcastMessage("§l§f❖§c Nhẫn Giả §a".$player->getName()."§c đã tiến cấp lên tới §l§a".$this->getRank($player));
return true;
}
if($countall >= $nextstats && $this->getRank($player) == "Anbu 1 Sao"){
$this->ThongBao($player,"§f•§a Chúc mừng! Nhẫn Giả đã nâng bậc thành công lên Anbu 2 Sao\n§f•§a +14000 Sức Mạnh");
$this->sm->addSucManh($player, 14000);
$this->setRANK($player, "Anbu 2 Sao");
$this->getServer()->broadcastMessage("§l§f❖§c Nhẫn Giả §a".$player->getName()."§c đã tiến cấp lên tới §l§a".$this->getRank($player));
return true;
}
if($countall >= $nextstats && $this->getRank($player) == "Anbu 2 Sao"){
$this->ThongBao($player,"§f•§a Chúc mừng! Nhẫn Giả đã nâng bậc thành công lên Anbu 3 Sao\n§f•§a +15000 Sức Mạnh");
$this->sm->addSucManh($player, 15000);
$this->setRANK($player, "Anbu 3 Sao");
$this->getServer()->broadcastMessage("§l§f❖§c Nhẫn Giả §a".$player->getName()."§c đã tiến cấp lên tới §l§a".$this->getRank($player));
return true;
}
if($countall >= $nextstats && $this->getRank($player) == "Anbu 3 Sao"){
$this->ThongBao($player,"§f•§a Chúc mừng! Nhẫn Giả đã nâng bậc thành công lên Sannin\n§f•§a +16000 Sức Mạnh");
$this->sm->addSucManh($player, 16000);
$this->setRANK($player, "Sannin");
$this->getServer()->broadcastMessage("§l§f❖§c Nhẫn Giả §a".$player->getName()."§c đã tiến cấp lên tới §l§a".$this->getRank($player));
return true;
}
if($countall >= $nextstats && $this->getRank($player) == "Sannin"){
$this->ThongBao($player,"§f•§a Chúc mừng! Nhẫn Giả đã nâng bậc thành công lên Sannin Bậc A\n§f•§a +17000 Sức Mạnh");
$this->sm->addSucManh($player, 17000);
$this->setRANK($player, "Sannin Bậc A");
$this->getServer()->broadcastMessage("§l§f❖§c Nhẫn Giả §a".$player->getName()."§c đã tiến cấp lên tới §l§a".$this->getRank($player));
return true;
}
if($countall >= $nextstats && $this->getRank($player) == "Sannin Bậc A"){
$this->ThongBao($player,"§f•§a Chúc mừng! Nhẫn Giả đã nâng bậc thành công lên Sannin Bậc S\n§f•§a +18000 Sức Mạnh");
$this->sm->addSucManh($player, 18000);
$this->setRANK($player, "Sannin Bậc S");
$this->getServer()->broadcastMessage("§l§f❖§c Nhẫn Giả §a".$player->getName()."§c đã tiến cấp lên tới §l§a".$this->getRank($player));
return true;
}
if($countall >= $nextstats && $this->getRank($player) == "Sannin Bậc S"){
$this->ThongBao($player,"§f•§a Chúc mừng! Nhẫn Giả đã nâng bậc thành công lên Sannin Bậc Ss\n§f•§a +19000 Sức Mạnh");
$this->sm->addSucManh($player, 19000);
$this->setRANK($player, "Sannin Bậc Ss");
$this->getServer()->broadcastMessage("§l§f❖§c Nhẫn Giả §a".$player->getName()."§c đã tiến cấp lên tới §l§a".$this->getRank($player));
return true;
}
if($countall >= $nextstats && $this->getRank($player) == "Sannin Bậc Ss"){
$this->ThongBao($player,"§f•§a Chúc mừng! Nhẫn Giả đã nâng bậc thành công lên Kage\n§f•§a +20000 Sức Mạnh");
$this->sm->addSucManh($player, 20000);
$this->setRANK($player, "Kage");
$this->getServer()->broadcastMessage("§l§f❖§c Nhẫn Giả §a".$player->getName()."§c đã tiến cấp lên tới §l§a".$this->getRank($player));
return true;
}
if($countall >= $nextstats && $this->getRank($player) == "Kage"){
$this->ThongBao($player,"§f•§a Chúc mừng! Nhẫn Giả đã nâng bậc thành công lên Hiền Nhân\n§f•§a +21000 Sức Mạnh");
$this->sm->addSucManh($player, 21000);
$this->setRANK($player, "Hiền Nhân");
$this->getServer()->broadcastMessage("§l§f❖§c Nhẫn Giả §a".$player->getName()."§c đã tiến cấp lên tới §l§a".$this->getRank($player));
return true;
}
if($countall >= $nextstats && $this->getRank($player) == "Hiền Nhân"){
$this->ThongBao($player,"§f•§a Chúc mừng! Nhẫn Giả đã nâng bậc thành công lên Hiền Nhân Bậc S\n§f•§a +22000 Sức Mạnh");
$this->sm->addSucManh($player, 22000);
$this->setRANK($player, "Hiền Nhân Bậc S");
$this->getServer()->broadcastMessage("§l§f❖§c Nhẫn Giả §a".$player->getName()."§c đã tiến cấp lên tới §l§a".$this->getRank($player));
return true;
}
if($countall >= $nextstats && $this->getRank($player) == "Hiền Nhân Bậc S"){
$this->ThongBao($player,"§f•§a Chúc mừng! Nhẫn Giả đã nâng bậc thành công lên Hiền Nhân Bậc Ss\n§f•§a +23000 Sức Mạnh");
$this->sm->addSucManh($player, 23000);
$this->setRANK($player, "Hiền Nhân Bậc Ss");
$this->getServer()->broadcastMessage("§l§f❖§c Nhẫn Giả §a".$player->getName()."§c đã tiến cấp lên tới §l§a".$this->getRank($player));
return true;
}
if($countall >= $nextstats && $this->getRank($player) == "Hiền Nhân Bậc Ss"){
$this->ThongBao($player,"§f•§a Chúc mừng! Nhẫn Giả đã nâng bậc thành công lên Lục Đạo\n§f•§a +24000 Sức Mạnh");
$this->sm->addSucManh($player, 24000);
$this->setRANK($player, "Lục Đạo");
$this->getServer()->broadcastMessage("§l§f❖§c Nhẫn Giả §a".$player->getName()."§c đã tiến cấp lên tới §l§a".$this->getRank($player));
return true;
}
if($countall >= $nextstats && $this->getRank($player) == "Lục Đạo"){
$this->ThongBao($player,"§f•§a Chúc mừng! Nhẫn Giả đã nâng bậc thành công lên Lục Đạo Bậc A\n§f•§a +25000 Sức Mạnh");
$this->sm->addSucManh($player, 25000);
$this->setRANK($player, "Lục Đạo Bậc A");
$this->getServer()->broadcastMessage("§l§f❖§c Nhẫn Giả §a".$player->getName()."§c đã tiến cấp lên tới §l§a".$this->getRank($player));
return true;
}
if($countall >= $nextstats && $this->getRank($player) == "Lục Đạo Bậc A"){
$this->ThongBao($player,"§f•§a Chúc mừng! Nhẫn Giả đã nâng bậc thành công lên Lục Đạo Bậc S\n§f•§a +26000 Sức Mạnh");
$this->sm->addSucManh($player, 26000);
$this->setRANK($player, "Lục Đạo Bậc S");
$this->getServer()->broadcastMessage("§l§f❖§c Nhẫn Giả §a".$player->getName()."§c đã tiến cấp lên tới §l§a".$this->getRank($player));
return true;
}
if($countall >= $nextstats && $this->getRank($player) == "Lục Đạo Bậc S"){
$this->ThongBao($player,"§f•§a Chúc mừng! Nhẫn Giả đã nâng bậc thành công lên Lục Đạo Bậc Ss\n§f•§a +27000 Sức Mạnh");
$this->sm->addSucManh($player, 27000);
$this->setRANK($player, "Lục Đạo Bậc Ss");
$this->getServer()->broadcastMessage("§l§f❖§c Nhẫn Giả §a".$player->getName()."§c đã tiến cấp lên tới §l§a".$this->getRank($player));
return true;
}
if($countall >= $nextstats && $this->getRank($player) == "Lục Đạo Bậc Ss"){
$this->ThongBao($player,"§f•§a Chúc mừng! Nhẫn Giả đã nâng bậc thành công lên Tiên Nhân\n§f•§a +28000 Sức Mạnh");
$this->sm->addSucManh($player, 28000);
$this->setRANK($player, "Tiên Nhân");
$this->getServer()->broadcastMessage("§l§f❖§c Nhẫn Giả §a".$player->getName()."§c đã tiến cấp lên tới §l§a".$this->getRank($player));
return true;
}
if($countall >= $nextstats && $this->getRank($player) == "Tiên Nhân"){
$this->ThongBao($player,"§f•§a Chúc mừng! Nhẫn Giả đã nâng bậc thành công lên Tiên Nhân\n§f•§a +28000 Sức Mạnh");
$this->sm->addSucManh($player, 30000);
$this->setRANK($player, "Tiên Nhân Bậc A");
$this->getServer()->broadcastMessage("§l§f❖§c Nhẫn Giả §a".$player->getName()."§c đã tiến cấp lên tới §l§a".$this->getRank($player));
return true;
}
if($countall >= $nextstats && $this->getRank($player) == "Tiên Nhân Bậc A"){
$this->ThongBao($player,"§f•§a Chúc mừng! Nhẫn Giả đã nâng bậc thành công lên Tiên Nhân\n§f•§a +28000 Sức Mạnh");
$this->sm->addSucManh($player, 32000);
$this->setRANK($player, "Tiên Nhân Bậc S");
$this->getServer()->broadcastMessage("§l§f❖§c Nhẫn Giả §a".$player->getName()."§c đã tiến cấp lên tới §l§a".$this->getRank($player));
return true;
}
if($countall >= $nextstats && $this->getRank($player) == "Tiên Nhân Bậc S"){
$this->ThongBao($player,"§f•§a Chúc mừng! Nhẫn Giả đã nâng bậc thành công lên Tiên Nhân\n§f•§a +28000 Sức Mạnh");
$this->sm->addSucManh($player, 34000);
$this->setRANK($player, "Tiên Nhân Bậc Ss");
$this->getServer()->broadcastMessage("§l§f❖§c Nhẫn Giả §a".$player->getName()."§c đã tiến cấp lên tới §l§a".$this->getRank($player));
return true;
}
if($countall >= $nextstats && $this->getRank($player) == "Tiên Nhân Bậc Ss"){
$this->ThongBao($player,"§f•§a Chúc mừng! Nhẫn Giả đã nâng bậc thành công lên Tiên Nhân\n§f•§a +28000 Sức Mạnh");
$this->sm->addSucManh($player, 40000);
$this->setRANK($player, "Lục Đạo Tiên Nhân");
$this->getServer()->broadcastMessage("§l§f❖§c Nhẫn Giả §a".$player->getName()."§c đã tiến cấp lên tới §l§a".$this->getRank($player));
return true;
}
if($countall >= $nextstats && $this->getRank($player) == "Lục Đạo Tiên Nhân"){
$this->ThongBao($player,"§f•§a Chúc mừng! Nhẫn Giả đã nâng bậc thành công lên Tiên Nhân\n§f•§a +28000 Sức Mạnh");
$this->sm->addSucManh($player, 42000);
$this->setRANK($player, "Lục Đạo Tiên Nhân Bậc A");
$this->getServer()->broadcastMessage("§l§f❖§c Nhẫn Giả §a".$player->getName()."§c đã tiến cấp lên tới §l§a".$this->getRank($player));
return true;
}
if($countall >= $nextstats && $this->getRank($player) == "Lục Đạo Tiên Nhân Bậc A"){
$this->ThongBao($player,"§f•§a Chúc mừng! Nhẫn Giả đã nâng bậc thành công lên Tiên Nhân\n§f•§a +28000 Sức Mạnh");
$this->sm->addSucManh($player, 44000);
$this->setRANK($player, "Lục Đạo Tiên Nhân Bậc S");
$this->getServer()->broadcastMessage("§l§f❖§c Nhẫn Giả §a".$player->getName()."§c đã tiến cấp lên tới §l§a".$this->getRank($player));
return true;
}
if($countall >= $nextstats && $this->getRank($player) == "Lục Đạo Tiên Nhân Bậc S"){
$this->ThongBao($player,"§f•§a Chúc mừng! Nhẫn Giả đã nâng bậc thành công lên Tiên Nhân\n§f•§a +28000 Sức Mạnh");
$this->sm->addSucManh($player, 46000);
$this->setRANK($player, "Lục Đạo Tiên Nhân Bậc Ss");
$this->getServer()->broadcastMessage("§l§f❖§c Nhẫn Giả §a".$player->getName()."§c đã tiến cấp lên tới §l§a".$this->getRank($player));
return true;
}
if($countall >= $nextstats && $this->getRank($player) == "Lục Đạo Tiên Nhân Bậc Ss"){
$this->ThongBao($player,"§f•§c Nhẫn Giả Đã Đạt Giới Hạn Cấp Bậc...");
return true;
}
if($countall < $nextstats){
$this->ThongBao($player,"§f•§c Số điểm tiềm năng Nhẫn Giả đã nâng chưa đủ để tiến bậc Ninja");
}
break;
}
});
$form->setTitle("§l§1CẤP BẬC NINJA");
$form->setContent("§f•§a Cấp bậc Ninja hiện tại của Nhẫn Giả:§c ".$this->getRank($player)."\n§f•§a Tổng số điểm tiềm năng Nhẫn Giả đã nâng:§c ".$countall." Điểm\n§f•§a Cấp bận Ninja tiếp theo là:§c ".$nextrank." §f-§a Cần §c".$nextstats." §ađiểm tiềm năng đã được nâng\n§f-§a Nhẫn Giả có muốn nâng bậc Ninja của bản thân không?");
$form->addButton("§l§1NÂNG BẬC NINJA");
$form->sendToPlayer($player);
return $form;
}
public function onMove(PlayerMoveEvent $event){
$player = $event->getPlayer();
if($this->getRank($player) == "Tập Sự"){
$player->setNameTag("§l§7【§fTẬP SỰ§7】§r§f ".$player->getName());
return true;
}
if($this->getRank($player) == "Genin"){
$player->setNameTag("§l§2【§aGENIN§2】§r§f ".$player->getName());
return true;
}
if($this->getRank($player) == "Chunnin"){
//$player->setNameTag("§l§4【§bCHUNNIN§4】§r§f ".$player->getName());
$player->setNameTag("§l§2【§aCHUNNIN§2】§r§f ".$player->getName());
return true;
}
if($this->getRank($player) == "Jonin"){
$player->setNameTag("§l§5【§dJONIN§5】§r§f ".$player->getName());
return true;
}
if($this->getRank($player) == "Jonin 1 Sao"){
$player->setNameTag("§l§5【§dJONIN 1 Sao§5】§r§f ".$player->getName());
return true;
}
if($this->getRank($player) == "Jonin 2 Sao"){
$player->setNameTag("§l§5【§dJONIN 2 Sao§5】§r§f ".$player->getName());
return true;
}
if($this->getRank($player) == "Jonin 3 Sao"){
$player->setNameTag("§l§5【§dJONIN 3 Sao§5】§r§f ".$player->getName());
return true;
}
if($this->getRank($player) == "Anbu"){
$player->setNameTag("§l§4【§bANBU§4】§r§f ".$player->getName());
return true;
}
if($this->getRank($player) == "Anbu 1 Sao"){
$player->setNameTag("§l§4【§bANBU 1 Sao§4】§r§f ".$player->getName());
return true;
}
if($this->getRank($player) == "Anbu 2 Sao"){
$player->setNameTag("§l§4【§bANBU 2 Sao§4】§r§f ".$player->getName());
return true;
}
if($this->getRank($player) == "Anbu 3 Sao"){
$player->setNameTag("§l§4【§bANBU 3 Sao§4】§r§f ".$player->getName());
return true;
}
if($this->getRank($player) == "Sannin"){
$player->setNameTag("§l§9【§1SANNIN§9】§r§f ".$player->getName());
return true;
}
if($this->getRank($player) == "Sannin Bậc A"){
$player->setNameTag("§l§9【§1SANNIN Bậc A§9】§r§f ".$player->getName());
return true;
}
if($this->getRank($player) == "Sannin Bậc S"){
$player->setNameTag("§l§9【§1SANNIN Bậc S§9】§r§f ".$player->getName());
return true;
}
if($this->getRank($player) == "Sannin Bậc Ss"){
$player->setNameTag("§l§9【§1SANNIN Bậc Ss§9】§r§f ".$player->getName());
return true;
}
if($this->getRank($player) == "Kage"){
$player->setNameTag("§l§6【§cKAGE§6】§r§e ".$player->getName());
return true;
}
if($this->getRank($player) == "Hiền Nhân"){
$player->setNameTag("§l§6【§cHIỀN NHÂN§6】§r§e ".$player->getName());
return true;
}
if($this->getRank($player) == "Hiền Nhân Bậc S"){
$player->setNameTag("§l§6【§cHIỀN NHÂN Bậc S§6】§r§e ".$player->getName());
return true;
}
if($this->getRank($player) == "Hiền Nhân Bậc Ss"){
$player->setNameTag("§l§6【§cHIỀN NHÂN Bậc Ss§6】§r§e ".$player->getName());
return true;
}
if($this->getRank($player) == "Lục Đạo"){
$player->setNameTag("§l§a✾§8【§cLỤC ĐẠO§8】§a✾§r§c ".$player->getName());
return true;
}
if($this->getRank($player) == "Lục Đạo Bậc A"){
$player->setNameTag("§l§a✾§8【§cLỤC ĐẠO Bậc A§8】§a✾§r§c ".$player->getName());
return true;
}
if($this->getRank($player) == "Lục Đạo Bậc S"){
$player->setNameTag("§l§a✾§8【§cLỤC ĐẠO Bậc S§8】§a✾§r§c ".$player->getName());
return true;
}
if($this->getRank($player) == "Lục Đạo Bậc Ss"){
$player->setNameTag("§l§a✾§8【§cLỤC ĐẠO Bậc Ss§8】§a✾§r§c ".$player->getName());
return true;
}
if($this->getRank($player) == "Tiên Nhân"){
$player->setNameTag("§l§a✾§7【§eTIÊN §cNHÂN§7】§a✾§r§c ".$player->getName());
return true;
}
if($this->getRank($player) == "Tiên Nhân Bậc A"){
$player->setNameTag("§l§a✾§7【§eTIÊN §cNHÂN §dBậc A§7】§a✾§r§c ".$player->getName());
return true;
}
if($this->getRank($player) == "Tiên Nhân Bậc S"){
$player->setNameTag("§l§a✾§7【§eTIÊN §cNHÂN §dBậc S§7】§a✾§r§c ".$player->getName());
return true;
}
if($this->getRank($player) == "Tiên Nhân Bậc Ss"){
$player->setNameTag("§l§a✾§7【§eTIÊN §cNHÂN §dBậc Ss§7】§a✾§r§c ".$player->getName());
return true;
}
if($this->getRank($player) == "Lục Đạo Tiên Nhân"){
$player->setNameTag("§l§a✾§6【§bLỤC §cĐẠO §aTIÊN §eNHÂN§6】§a✾§r§c ".$player->getName());
return true;
}
if($this->getRank($player) == "Lục Đạo Tiên Nhân Bậc A"){
$player->setNameTag("§l§a✾§6【§bLỤC §cĐẠO §aTIÊN §eNHÂN §dBậc A§6】§a✾§r§c ".$player->getName());
return true;
}
if($this->getRank($player) == "Lục Đạo Tiên Nhân Bậc S"){
$player->setNameTag("§l§a✾§6【§bLỤC §cĐẠO §aTIÊN §eNHÂN §dBậc S§6】§a✾§r§c ".$player->getName());
return true;
}
if($this->getRank($player) == "Lục Đạo Tiên Nhân Bậc Ss"){
$player->setNameTag("§l§a✾§6【§bLỤC §cĐẠO §aTIÊN §eNHÂN §dBậc Ss§6】§a✾§r§c ".$player->getName());
return true;
}

}



}