<?php

namespace Level;

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
use pocketmine\event\entity\EntityDeathEvent;
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
//gy

public function onEnable(){
if(!file_exists($this->getDataFolder() . "Dữ Liệu Cấp Độ/")){
@mkdir($this->getDataFolder() . "Dữ Liệu Cấp Độ/");
}
$this->level = new Config($this->getDataFolder() . "Dữ Liệu Cấp Độ/" . "data.yml", Config::YAML);
$this->saveDefaultConfig();
$this->config = $this->getConfig();
$this->config->save();
$this->ramen = $this->getServer()->getPluginManager()->getPlugin("NGVS_Ramen");
$this->stats = $this->getServer()->getPluginManager()->getPlugin("NGVS_Stats");
$this->sm = $this->getServer()->getPluginManager()->getPlugin("NGVS_SucManh");
$this->getServer()->getPluginManager()->registerEvents($this,$this);
}
public function onJoin(PlayerJoinEvent $event){
$player = $event->getPlayer()->getName();
if(!($this->level->exists(strtolower($player)))){
$this->level->set(strtolower($player), [1,500,0]);
$this->level->save();
}
}
public function getLevel($player){
if($player instanceof Player){
$player = $player->getName();
}
$player = strtolower($player);
$level = $this->level->get($player)[0];
return $level;
}
public function getExp($player){
if($player instanceof Player){
$player = $player->getName();
}
$player = strtolower($player);
$current_exp = $this->level->get($player)[1];
return $current_exp;
}
public function getMaxExp($player){
if($player instanceof Player){
$player = $player->getName();
}
$player = strtolower($player);
$max_exp = $this->level->get($player)[2];
return $max_exp;
}
public function upLevel($player){
if($player instanceof Player){
//$player = $player->getName();
var_dump($player);
}
//$player = strtolower($player);
$this->level->set(strtolower($player->getName()), [$this->getLevel(strtolower($player->getName())) + 1, 0, 200+($this->getLevel(strtolower($player->getName()))*400)]);
$player->sendMessage("§c✿§e Chúc mừng, bạn đã đạt cấp độ §6".$this->getLevel(strtolower($player->getName())));
$this->getReward($player);
$this->level->save();
}
public function addExp($player, $count){
if($player instanceof Player){
//$player = $player->getName();
var_dump($player);
}
if($count > $this->getMaxExp($player) - $this->getExp($player)){
$a = $this->getMaxExp($player) - $count;
$this->upLevel($player);
$this->level->set(strtolower($player->getName()), [$this->getLevel(strtolower($player->getName())), $this->getExp(strtolower($player->getName())) + $a, 200+($this->getLevel(strtolower($player->getName()))*400)]);
#200+(2*100)--> 400
$this->level->save();
return true;
}
if($this->getExp(strtolower($player->getName())) < 0){
$a = $this->getExp(strtolower($player->getName())) - $this->getExp(strtolower($player->getName())) - $this->getExp(strtolower($player->getName()));
$a1 = $a + $count;
$this->level->set(strtolower($player->getName()), [$this->getLevel(strtolower($player->getName())), $a1, 200+($this->getLevel(strtolower($player->getName()))*400)]);
#200+(2*100)--> 400
$this->level->save();
return true;
}

if($this->getExp($player) >= $this->getMaxExp($player)){
$this->level->set(strtolower($player->getName()), [$this->getLevel(strtolower($player->getName())) + 1, 0, 200+($this->getLevel(strtolower($player->getName()))*400)]);
$player->sendMessage("§c✿§e Chúc mừng, bạn đã đạt cấp độ §6".$this->getLevel(strtolower($player->getName())));
//$player->sendPopup("§c✿§e Số Exp của bạn ở cấp độ mới đã được đưa về §60");
$this->getReward($player);
$this->level->save();
return true;
}
if($this->getExp(strtolower($player->getName())) < $this->getMaxExp(strtolower($player->getName()))){
//$player = strtolower($player);
$this->level->set(strtolower($player->getName()), [$this->getLevel(strtolower($player->getName())), $this->getExp(strtolower($player->getName())) + $count, 200+($this->getLevel(strtolower($player->getName()))*400)]);
#200+(2*100)--> 400
$this->level->save();
return true;
}
}
public function getReward(Player $player){
/*if($player instanceof Player){
$player1 = $player->getName();
}
$player1 = strtolower($player1);*/
$level = $this->getLevel($player);
switch($level){
case 1:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 1 điểm tiềm năng, 1000 Sức Mạnh!");
$this->stats->addStats($player, 1);
$this->sm->addSucManh($player, 1000);
break;
case 2:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 1 điểm tiềm năng, 2000 Sức Mạnh!");
$this->stats->addStats($player, 1);
$this->sm->addSucManh($player, 2000);
break;
case 3:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 1 điểm tiềm năng, 3000 Sức Mạnh!");
$this->stats->addStats($player, 1);
$this->sm->addSucManh($player, 3000);
break;
case 4:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 1 điểm tiềm năng, 4000 Sức Mạnh!");
$this->stats->addStats($player, 1);
$this->sm->addSucManh($player, 4000);
break;
case 5:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 1 điểm tiềm năng, 5000 Sức Mạnh!");
$this->stats->addStats($player, 1);
$this->sm->addSucManh($player, 5000);
break;
case 6:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 1 điểm tiềm năng, 6000 Sức Mạnh!");
$this->stats->addStats($player, 1);
$this->sm->addSucManh($player, 6000);
break;
case 7:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 1 điểm tiềm năng, 6000 Sức Mạnh!");
$this->stats->addStats($player, 1);
$this->sm->addSucManh($player, 6000);
break;
case 8:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 1 điểm tiềm năng, 7000 Sức Mạnh!");
$this->stats->addStats($player, 1);
$this->sm->addSucManh($player, 7000);
break;
case 9:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 1 điểm tiềm năng, 7000 Sức Mạnh!");
$this->stats->addStats($player, 1);
$this->sm->addSucManh($player, 7000);
break;
case 10:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 1 điểm tiềm năng, 8000 Sức Mạnh!");
$this->stats->addStats($player, 1);
$this->sm->addSucManh($player, 8000);
break;
case 11:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 1 điểm tiềm năng, 10000 Sức Mạnh!");
$this->stats->addStats($player, 1);
$this->sm->addSucManh($player, 10000);
break;
case 12:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 1 điểm tiềm năng, 10000 Sức Mạnh!");
$this->stats->addStats($player, 1);
$this->sm->addSucManh($player, 10000);
break;
case 13:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 1 điểm tiềm năng, 10000 Sức Mạnh!");
$this->stats->addStats($player, 1);
$this->sm->addSucManh($player, 10000);
break;
case 14:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 15:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 16:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 17:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 18:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 19:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 20:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 21:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 22:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 23:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 24:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 25:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 26:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 27:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 28:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 29:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 30:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 31:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 32:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 33:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 34:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 35:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->stats->addStats($player, 1);
$this->sm->addSucManh($player, 10000);
break;
case 36:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 37:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 1000);
break;
case 38:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 39:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 40:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 41:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 42:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 43:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 44:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 45:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 46:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 47:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 48:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 49:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 50:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 51:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 52:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 1000);
break;
case 53:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 54:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 55:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 56:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 57:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 58:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 59:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 60:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 61:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 62:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 63:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 64:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 65:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 66:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 67:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 68:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 1000);
break;
case 69:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 70:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 71:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 72:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 73:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 74:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 75:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 76:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 77:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 78:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 79:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 80:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 81:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 82:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 83:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 84:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 1000);
break;
case 85:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 86:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 87:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 88:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 89:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 90:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 91:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 92:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 93:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 94:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 95:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 96:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 97:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 98:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 99:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 10000 Sức Mạnh!");
$this->sm->addSucManh($player, 10000);
break;
case 100:
$player->sendMessage("§c✿§6 Nhẫn Giả§e đã được Cộng 50000 Sức Mạnh!");
$this->sm->addSucManh($player, 50000);
break;
}
}
/*public function onFight(EntityDamageEvent $event) {
if($event instanceof EntityDamageByEntityEvent) {
$hit = $event->getEntity();
$damager = $event->getDamager();
if($damager instanceof Player) {
if($hit->getName() == "LonMongManh69" && !$event->isCancelled()){
$event->setCancelled();
}
}
if(!$damager instanceof Player){
return false;
}
}
}*/



/*public function onDeath(EntityDeathEvent $event) {
if($event->getEntity()->getLastDamageCause() instanceof EntityDamageByEntityEvent) {
if($event->getEntity()->getLastDamageCause()->getDamager() instanceof Player){
$damager = $event->getEntity()->getLastDamageCause()->getDamager();
$this->addExp($damager, 20);
$damager->sendMessage("§c✿§6 +20 EXP");
}
}
}*/




/*public function onMove(PlayerMoveEvent $event){
$player = $event->getPlayer();
if($this->getExp($player) >= $this->getMaxExp($player)){
$this->upLevel($player);
$this->
return true;
}
}
public function onMove(PlayerMoveEvent $event){
$player = $event->getPlayer();
date_default_timezone_set("Asia/Ho_Chi_Minh");
//$time = date_default_timezone_get();
//var_dump($time);
if(!(date("H:i") == "20:01" || date("H:i") == "20:02" || date("H:i") == "20:03" || date("H:i") == "20:04" || date("H:i") == "20:05")){
$player->sendPopup("§l§c【§eCấp §6".$this->getLevel($player)."§e - §6".$this->getExp($player)."§c/§6".$this->getMaxExp($player)."§c】");
$this->ramen->setB($player);
return true;
}
if(!(date("H:i") == "12:01" || date("H:i") == "12:02" || date("H:i") == "12:03" || date("H:i") == "12:04" || date("H:i") == "12:05")){
$player->sendPopup("§l§c【§eCấp §6".$this->getLevel($player)."§e - §6".$this->getExp($player)."§c/§6".$this->getMaxExp($player)."§c】");
$this->ramen->setB($player);
return true;
}
if(date("H:i") == "20:01" || date("H:i") == "20:02" || date("H:i") == "20:03" || date("H:i") == "20:04" || date("H:i") == "20:05"){
$player->sendPopup("§l§c【§eCấp §6".$this->getLevel($player)."§e - §6".$this->getExp($player)."§c/§6".$this->getMaxExp($player)."§c】");
$this->ramen->setD($player);
return true;
}
if(date("H:i") == "14:30" || date("H:i") == "12:02" || date("H:i") == "12:03" || date("H:i") == "12:04" || date("H:i") == "12:05"){
$player->sendPopup("§l§c【§eCấp §6".$this->getLevel($player)."§e - §6".$this->getExp($player)."§c/§6".$this->getMaxExp($player)."§c】");
$this->ramen->setD($player);
return true;
}
$player->sendPopup("§l§c【§eCấp §6".$this->getLevel($player)."§e - §6".$this->getExp($player)."§c/§6".$this->getMaxExp($player)."§c】");
}*/


}