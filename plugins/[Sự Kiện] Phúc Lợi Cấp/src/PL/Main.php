<?php

namespace PL;

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
if(!file_exists($this->getDataFolder() . "[SK] Phúc Lợi Cấp/")){
@mkdir($this->getDataFolder() . "[SK] Phúc Lợi Cấp/");
}
$this->quest = new Config($this->getDataFolder() . "[SK] Phúc Lợi Cấp/" . "Dữ liệu sự kiện.yml", Config::YAML);
$this->saveDefaultConfig();
$this->config = $this->getConfig();
$this->config->save();
$this->level = $this->getServer()->getPluginManager()->getPlugin("NGVS_Level");
$this->xu = $this->getServer()->getPluginManager()->getPlugin("NGVS_Xu");
$this->bac = $this->getServer()->getPluginManager()->getPlugin("NGVS_Bac");
$this->vang = $this->getServer()->getPluginManager()->getPlugin("NGVS_Vang");
$this->stats = $this->getServer()->getPluginManager()->getPlugin("NGVS_Stats");
$this->getServer()->getPluginManager()->registerEvents($this,$this);
}
public function onJoin(PlayerJoinEvent $event){
if(!($this->quest->exists(strtolower($event->getPlayer()->getName())))){
$this->quest->set(strtolower($event->getPlayer()->getName()), ["1" => "Not", "2" => "Not", "3" => "Not", "4" => "Not", "5" => "Not", "6" => "Not", "7" => "Not", "8" => "Not", "9" => "Not", "10" => "Not", "11" => "Not", "12" => "Not", "13" => "Not", "14" => "Not", "15" => "Not", "16" => "Not", "17" => "Not", "18" => "Not", "19" => "Not", "20" => "Not", "21" => "Not", "22" => "Not", "23" => "Not", "24" => "Not", "25" => "Not", "26" => "Not"]);
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
public function get10(Player $player){
$get10 = $this->quest->get(strtolower($player->getName()))["10"];
return $get10;
}
public function get11(Player $player){
$get11 = $this->quest->get(strtolower($player->getName()))["11"];
return $get11;
}
public function get12(Player $player){
$get12 = $this->quest->get(strtolower($player->getName()))["12"];
return $get12;
}
public function get13(Player $player){
$get13 = $this->quest->get(strtolower($player->getName()))["13"];
return $get13;
}
public function get14(Player $player){
$get14 = $this->quest->get(strtolower($player->getName()))["14"];
return $get14;
}
public function get15(Player $player){
$get15 = $this->quest->get(strtolower($player->getName()))["15"];
return $get15;
}
public function get16(Player $player){
$get16 = $this->quest->get(strtolower($player->getName()))["16"];
return $get16;
}
public function get17(Player $player){
$get17 = $this->quest->get(strtolower($player->getName()))["17"];
return $get17;
}
public function get18(Player $player){
$get18 = $this->quest->get(strtolower($player->getName()))["18"];
return $get18;
}
public function get19(Player $player){
$get19 = $this->quest->get(strtolower($player->getName()))["19"];
return $get19;
}
public function get20(Player $player){
$get20 = $this->quest->get(strtolower($player->getName()))["20"];
return $get20;
}
public function get21(Player $player){
$get21 = $this->quest->get(strtolower($player->getName()))["21"];
return $get21;
}
public function get22(Player $player){
$get22 = $this->quest->get(strtolower($player->getName()))["22"];
return $get22;
}
public function get23(Player $player){
$get23 = $this->quest->get(strtolower($player->getName()))["23"];
return $get23;
}
public function get24(Player $player){
$get24 = $this->quest->get(strtolower($player->getName()))["24"];
return $get24;
}
public function get25(Player $player){
$get25 = $this->quest->get(strtolower($player->getName()))["25"];
return $get25;
}
public function get26(Player $player){
$get26 = $this->quest->get(strtolower($player->getName()))["26"];
return $get26;
}
public function setDone1(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Not", "3" => "Not", "4" => "Not", "5" => "Not", "6" => "Not", "7" => "Not", "8" => "Not", "9" => "Not", "10" => "Not", "11" => "Not", "12" => "Not", "13" => "Not", "14" => "Not", "15" => "Not", "16" => "Not", "17" => "Not", "18" => "Not", "19" => "Not", "20" => "Not", "21" => "Not", "22" => "Not", "23" => "Not", "24" => "Not", "25" => "Not", "26" => "Not"]);
$this->quest->save();
}
public function setDone2(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Not", "4" => "Not", "5" => "Not", "6" => "Not", "7" => "Not", "8" => "Not", "9" => "Not", "10" => "Not", "11" => "Not", "12" => "Not", "13" => "Not", "14" => "Not", "15" => "Not", "16" => "Not", "17" => "Not", "18" => "Not", "19" => "Not", "20" => "Not", "21" => "Not", "22" => "Not", "23" => "Not", "24" => "Not", "25" => "Not", "26" => "Not"]);
$this->quest->save();
}
public function setDone3(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Not", "5" => "Not", "6" => "Not", "7" => "Not", "8" => "Not", "9" => "Not", "10" => "Not", "11" => "Not", "12" => "Not", "13" => "Not", "14" => "Not", "15" => "Not", "16" => "Not", "17" => "Not", "18" => "Not", "19" => "Not", "20" => "Not", "21" => "Not", "22" => "Not", "23" => "Not", "24" => "Not", "25" => "Not", "26" => "Not"]);
$this->quest->save();
}
public function setDone4(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Done", "5" => "Not", "6" => "Not", "7" => "Not", "8" => "Not", "9" => "Not", "10" => "Not", "11" => "Not", "12" => "Not", "13" => "Not", "14" => "Not", "15" => "Not", "16" => "Not", "17" => "Not", "18" => "Not", "19" => "Not", "20" => "Not", "21" => "Not", "22" => "Not", "23" => "Not", "24" => "Not", "25" => "Not", "26" => "Not"]);
$this->quest->save();
}
public function setDone5(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Done", "5" => "Done", "6" => "Not", "7" => "Not", "8" => "Not", "9" => "Not", "10" => "Not", "11" => "Not", "12" => "Not", "13" => "Not", "14" => "Not", "15" => "Not", "16" => "Not", "17" => "Not", "18" => "Not", "19" => "Not", "20" => "Not", "21" => "Not", "22" => "Not", "23" => "Not", "24" => "Not", "25" => "Not", "26" => "Not"]);
$this->quest->save();
}
public function setDone6(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Done", "5" => "Done", "6" => "Done", "7" => "Not", "8" => "Not", "9" => "Not", "10" => "Not", "11" => "Not", "12" => "Not", "13" => "Not", "14" => "Not", "15" => "Not", "16" => "Not", "17" => "Not", "18" => "Not", "19" => "Not", "20" => "Not", "21" => "Not", "22" => "Not", "23" => "Not", "24" => "Not", "25" => "Not", "26" => "Not"]);
$this->quest->save();
}
public function setDone7(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Done", "5" => "Done", "6" => "Done", "7" => "Done", "8" => "Not", "9" => "Not", "10" => "Not", "11" => "Not", "12" => "Not", "13" => "Not", "14" => "Not", "15" => "Not", "16" => "Not", "17" => "Not", "18" => "Not", "19" => "Not", "20" => "Not", "21" => "Not", "22" => "Not", "23" => "Not", "24" => "Not", "25" => "Not", "26" => "Not"]);
$this->quest->save();
}
public function setDone8(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Done", "5" => "Done", "6" => "Done", "7" => "Done", "8" => "Done", "9" => "Not", "10" => "Not", "11" => "Not", "12" => "Not", "13" => "Not", "14" => "Not", "15" => "Not", "16" => "Not", "17" => "Not", "18" => "Not", "19" => "Not", "20" => "Not", "21" => "Not", "22" => "Not", "23" => "Not", "24" => "Not", "25" => "Not", "26" => "Not"]);
$this->quest->save();
}
public function setDone9(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Done", "5" => "Done", "6" => "Done", "7" => "Done", "8" => "Done", "9" => "Done", "10" => "Not", "11" => "Not", "12" => "Not", "13" => "Not", "14" => "Not", "15" => "Not", "16" => "Not", "17" => "Not", "18" => "Not", "19" => "Not", "20" => "Not", "21" => "Not", "22" => "Not", "23" => "Not", "24" => "Not", "25" => "Not", "26" => "Not"]);
$this->quest->save();
}
public function setDone10(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Done", "5" => "Done", "6" => "Done", "7" => "Done", "8" => "Done", "9" => "Done", "10" => "Done", "11" => "Not", "12" => "Not", "13" => "Not", "14" => "Not", "15" => "Not", "16" => "Not", "17" => "Not", "18" => "Not", "19" => "Not", "20" => "Not", "21" => "Not", "22" => "Not", "23" => "Not", "24" => "Not", "25" => "Not", "26" => "Not"]);
$this->quest->save();
}
public function setDone11(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Done", "5" => "Done", "6" => "Done", "7" => "Done", "8" => "Done", "9" => "Done", "10" => "Done", "11" => "Done", "12" => "Not", "13" => "Not", "14" => "Not", "15" => "Not", "16" => "Not", "17" => "Not", "18" => "Not", "19" => "Not", "20" => "Not", "21" => "Not", "22" => "Not", "23" => "Not", "24" => "Not", "25" => "Not", "26" => "Not"]);
$this->quest->save();
}
public function setDone12(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Done", "5" => "Done", "6" => "Done", "7" => "Done", "8" => "Done", "9" => "Done", "10" => "Done", "11" => "Done", "12" => "Done", "13" => "Not", "14" => "Not", "15" => "Not", "16" => "Not", "17" => "Not", "18" => "Not", "19" => "Not", "20" => "Not", "21" => "Not", "22" => "Not", "23" => "Not", "24" => "Not", "25" => "Not", "26" => "Not"]);
$this->quest->save();
}
public function setDone13(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Done", "5" => "Done", "6" => "Done", "7" => "Done", "8" => "Done", "9" => "Done", "10" => "Done", "11" => "Done", "12" => "Done", "13" => "Done", "14" => "Not", "15" => "Not", "16" => "Not", "17" => "Not", "18" => "Not", "19" => "Not", "20" => "Not", "21" => "Not", "22" => "Not", "23" => "Not", "24" => "Not", "25" => "Not", "26" => "Not"]);
$this->quest->save();
}
public function setDone14(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Done", "5" => "Done", "6" => "Done", "7" => "Done", "8" => "Done", "9" => "Done", "10" => "Done", "11" => "Done", "12" => "Done", "13" => "Done", "14" => "Done", "15" => "Not", "16" => "Not", "17" => "Not", "18" => "Not", "19" => "Not", "20" => "Not", "21" => "Not", "22" => "Not", "23" => "Not", "24" => "Not", "25" => "Not", "26" => "Not"]);
$this->quest->save();	
}
public function setDone15(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Done", "5" => "Done", "6" => "Done", "7" => "Done", "8" => "Done", "9" => "Done", "10" => "Done", "11" => "Done", "12" => "Done", "13" => "Done", "14" => "Done", "15" => "Done", "16" => "Not", "17" => "Not", "18" => "Not", "19" => "Not", "20" => "Not", "21" => "Not", "22" => "Not", "23" => "Not", "24" => "Not", "25" => "Not", "26" => "Not"]);
$this->quest->save();
}
public function setDone16(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Done", "5" => "Done", "6" => "Done", "7" => "Done", "8" => "Done", "9" => "Done", "10" => "Done", "11" => "Done", "12" => "Done", "13" => "Done", "14" => "Done", "15" => "Done", "16" => "Done", "17" => "Not", "18" => "Not", "19" => "Not", "20" => "Not", "21" => "Not", "22" => "Not", "23" => "Not", "24" => "Not", "25" => "Not", "26" => "Not"]);
$this->quest->save();
}
public function setDone17(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Done", "5" => "Done", "6" => "Done", "7" => "Done", "8" => "Done", "9" => "Done", "10" => "Done", "11" => "Done", "12" => "Done", "13" => "Done", "14" => "Done", "15" => "Done", "16" => "Done", "17" => "Done", "18" => "Not", "19" => "Not", "20" => "Not", "21" => "Not", "22" => "Not", "23" => "Not", "24" => "Not", "25" => "Not", "26" => "Not"]);
$this->quest->save();
}
public function setDone18(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Done", "5" => "Done", "6" => "Done", "7" => "Done", "8" => "Done", "9" => "Done", "10" => "Done", "11" => "Done", "12" => "Done", "13" => "Done", "14" => "Done", "15" => "Done", "16" => "Done", "17" => "Done", "18" => "Done", "19" => "Not", "20" => "Not", "21" => "Not", "22" => "Not", "23" => "Not", "24" => "Not", "25" => "Not", "26" => "Not"]);
$this->quest->save();
}
public function setDone19(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Done", "5" => "Done", "6" => "Done", "7" => "Done", "8" => "Done", "9" => "Done", "10" => "Done", "11" => "Done", "12" => "Done", "13" => "Done", "14" => "Done", "15" => "Done", "16" => "Done", "17" => "Done", "18" => "Done", "19" => "Done", "20" => "Not", "21" => "Not", "22" => "Not", "23" => "Not", "24" => "Not", "25" => "Not", "26" => "Not"]);
$this->quest->save();
}
public function setDone20(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Done", "5" => "Done", "6" => "Done", "7" => "Done", "8" => "Done", "9" => "Done", "10" => "Done", "11" => "Done", "12" => "Done", "13" => "Done", "14" => "Done", "15" => "Done", "16" => "Done", "17" => "Done", "18" => "Done", "19" => "Done", "20" => "Done", "21" => "Not", "22" => "Not", "23" => "Not", "24" => "Not", "25" => "Not", "26" => "Not"]);
$this->quest->save();
}
public function setDone21(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Done", "5" => "Done", "6" => "Done", "7" => "Done", "8" => "Done", "9" => "Done", "10" => "Done", "11" => "Done", "12" => "Done", "13" => "Done", "14" => "Done", "15" => "Done", "16" => "Done", "17" => "Done", "18" => "Done", "19" => "Done", "20" => "Done", "21" => "Done", "22" => "Not", "23" => "Not", "24" => "Not", "25" => "Not", "26" => "Not"]);
$this->quest->save();
}
public function setDone22(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Done", "5" => "Done", "6" => "Done", "7" => "Done", "8" => "Done", "9" => "Done", "10" => "Done", "11" => "Done", "12" => "Done", "13" => "Done", "14" => "Done", "15" => "Done", "16" => "Done", "17" => "Done", "18" => "Done", "19" => "Done", "20" => "Done", "21" => "Done", "22" => "Done", "23" => "Not", "24" => "Not", "25" => "Not", "26" => "Not"]);
$this->quest->save();
}
public function setDone23(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Done", "5" => "Done", "6" => "Done", "7" => "Done", "8" => "Done", "9" => "Done", "10" => "Done", "11" => "Done", "12" => "Done", "13" => "Done", "14" => "Done", "15" => "Done", "16" => "Done", "17" => "Done", "18" => "Done", "19" => "Done", "20" => "Done", "21" => "Done", "22" => "Done", "23" => "Done", "24" => "Not", "25" => "Not", "26" => "Not"]);
$this->quest->save();
}
public function setDone24(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Done", "5" => "Done", "6" => "Done", "7" => "Done", "8" => "Done", "9" => "Done", "10" => "Done", "11" => "Done", "12" => "Done", "13" => "Done", "14" => "Done", "15" => "Done", "16" => "Done", "17" => "Done", "18" => "Done", "19" => "Done", "20" => "Done", "21" => "Done", "22" => "Done", "23" => "Done", "24" => "Done", "25" => "Not", "26" => "Not"]);
$this->quest->save();
}
public function setDone25(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Done", "5" => "Done", "6" => "Done", "7" => "Done", "8" => "Done", "9" => "Done", "10" => "Done", "11" => "Done", "12" => "Done", "13" => "Done", "14" => "Done", "15" => "Done", "16" => "Done", "17" => "Done", "18" => "Done", "19" => "Done", "20" => "Done", "21" => "Done", "22" => "Done", "23" => "Done", "24" => "Done", "25" => "Done", "26" => "Not"]);
$this->quest->save();
}
public function setDone26(Player $player){
$this->quest->set(strtolower($player->getName()), ["1" => "Done", "2" => "Done", "3" => "Done", "4" => "Done", "5" => "Done", "6" => "Done", "7" => "Done", "8" => "Done", "9" => "Done", "10" => "Done", "11" => "Done", "12" => "Done", "13" => "Done", "14" => "Done", "15" => "Done", "16" => "Done", "17" => "Done", "18" => "Done", "19" => "Done", "20" => "Done", "21" => "Done", "22" => "Done", "23" => "Done", "24" => "Done", "25" => "Done", "26" => "Done"]);
$this->quest->save();
}
public function onTap(SlapperHitEvent $ev){
$entity = $ev->getEntity();
$damager = $ev->getDamager();
if(!$entity instanceof SlapperHuman && $entity->getName() !== "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp"){
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getLevel($damager) >= 10 && $this->get1($damager) == "Not" && $this->get2($damager) == "Not"){
$this->UIquest1($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getLevel($damager) >= 15 && $this->get1($damager) == "Done" && $this->get2($damager) == "Not"){
$this->UIquest2($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getLevel($damager) >= 20 && $this->get2($damager) == "Done" && $this->get3($damager) == "Not"){
$this->UIquest3($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getlevel($damager) >= 25 && $this->get3($damager) == "Done" && $this->get4($damager) == "Not"){
$this->UIquest4($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getLevel($damager) >= 30 && $this->get4($damager) == "Done" && $this->get5($damager) == "Not"){
$this->UIquest5($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getLevel($damager) >= 40 && $this->get5($damager) == "Done" && $this->get6($damager) == "Not"){
$this->UIquest6($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getlevel($damager) >= 50 && $this->get6($damager) == "Done" && $this->get7($damager) == "Not"){
$this->UIquest7($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getlevel($damager) >= 60 && $this->get7($damager) == "Done" && $this->get8($damager) == "Not"){
$this->UIquest8($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getLevel($damager) >= 70 && $this->get8($damager) == "Done" && $this->get9($damager) == "Not"){
$this->UIquest9($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getLevel($damager) >= 80 && $this->get8($damager) == "Done" && $this->get10($damager) == "Not"){
$this->UIquest10($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getLevel($damager) >= 90 && $this->get8($damager) == "Done" && $this->get11($damager) == "Not"){
$this->UIquest11($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getLevel($damager) >= 100 && $this->get8($damager) == "Done" && $this->get12($damager) == "Not"){
$this->UIquest12($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getLevel($damager) >= 120 && $this->get8($damager) == "Done" && $this->get13($damager) == "Not"){
$this->UIquest13($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getLevel($damager) >= 140 && $this->get8($damager) == "Done" && $this->get14($damager) == "Not"){
$this->UIquest14($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getLevel($damager) >= 160 && $this->get8($damager) == "Done" && $this->get15($damager) == "Not"){
$this->UIquest15($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getLevel($damager) >= 180 && $this->get8($damager) == "Done" && $this->get16($damager) == "Not"){
$this->UIquest16($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getLevel($damager) >= 200 && $this->get8($damager) == "Done" && $this->get17($damager) == "Not"){
$this->UIquest17($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getLevel($damager) >= 230 && $this->get8($damager) == "Done" && $this->get18($damager) == "Not"){
$this->UIquest18($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getLevel($damager) >= 260 && $this->get8($damager) == "Done" && $this->get19($damager) == "Not"){
$this->UIquest19($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getLevel($damager) >= 290 && $this->get8($damager) == "Done" && $this->get20($damager) == "Not"){
$this->UIquest20($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getLevel($damager) >= 320 && $this->get8($damager) == "Done" && $this->get21($damager) == "Not"){
$this->UIquest21($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getLevel($damager) >= 350 && $this->get8($damager) == "Done" && $this->get22($damager) == "Not"){
$this->UIquest22($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getLevel($damager) >= 380 && $this->get8($damager) == "Done" && $this->get23($damager) == "Not"){
$this->UIquest23($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getLevel($damager) >= 410 && $this->get8($damager) == "Done" && $this->get24($damager) == "Not"){
$this->UIquest24($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getLevel($damager) >= 450 && $this->get8($damager) == "Done" && $this->get25($damager) == "Not"){
$this->UIquest25($damager);
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getLevel($damager) >= 500 && $this->get8($damager) == "Done" && $this->get26($damager) == "Not"){
$this->UIquest26($damager);
return true;
}
//------------------------------------------------------------------------------------------------------------------------------------------------------
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->get26($damager) == "Done"){
$this->UIthongbao($damager, "§f•§a Nhẫn Giả đã nhận hết quà Phúc Lợi Cấp!");
return true;
}
//------------------------------------------------------------------------------------------------------------------------------------------------------
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getlevel($damager) < 10){
$this->UIthongbao($damager, "§f•§a Nhẫn Giả chưa đạt cấp§6 10§a chưa thể nhận quà này!");
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getlevel($damager) < 15){
$this->UIthongbao($damager, "§f•§a Nhẫn Giả chưa đạt cấp§6 15§a chưa thể nhận quà này!");
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getlevel($damager) < 20){
$this->UIthongbao($damager, "§f•§a Nhẫn Giả chưa đạt cấp§6 20§a chưa thể nhận quà này!");
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getlevel($damager) < 25){
$this->UIthongbao($damager, "§f•§a Nhẫn Giả chưa đạt cấp§6 25§a chưa thể nhận quà này!");
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getlevel($damager) < 30){
$this->UIthongbao($damager, "§f•§a Nhẫn Giả chưa đạt cấp§6 30§a chưa thể nhận quà này!");
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getlevel($damager) < 40){
$this->UIthongbao($damager, "§f•§a Nhẫn Giả chưa đạt cấp§6 40§a chưa thể nhận quà này!");
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getlevel($damager) < 50){
$this->UIthongbao($damager, "§f•§a Nhẫn Giả chưa đạt cấp§6 50§a chưa thể nhận quà này!");
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getlevel($damager) < 60){
$this->UIthongbao($damager, "§f•§a Nhẫn Giả chưa đạt cấp§6 60§a chưa thể nhận quà này!");
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getlevel($damager) < 70){
$this->UIthongbao($damager, "§f•§a Nhẫn Giả chưa đạt cấp§6 70§a chưa thể nhận quà này!");
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getlevel($damager) < 80){
$this->UIthongbao($damager, "§f•§a Nhẫn Giả chưa đạt cấp§6 80§a chưa thể nhận quà này!");
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getlevel($damager) < 90){
$this->UIthongbao($damager, "§f•§a Nhẫn Giả chưa đạt cấp§6 90§a chưa thể nhận quà này!");
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getlevel($damager) < 100){
$this->UIthongbao($damager, "§f•§a Nhẫn Giả chưa đạt cấp§6 100§a chưa thể nhận quà này!");
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getlevel($damager) < 120){
$this->UIthongbao($damager, "§f•§a Nhẫn Giả chưa đạt cấp§6 120§a chưa thể nhận quà này!");
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getlevel($damager) < 140){
$this->UIthongbao($damager, "§f•§a Nhẫn Giả chưa đạt cấp§6 140§a chưa thể nhận quà này!");
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getlevel($damager) < 160){
$this->UIthongbao($damager, "§f•§a Nhẫn Giả chưa đạt cấp§6 160§a chưa thể nhận quà này!");
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getlevel($damager) < 180){
$this->UIthongbao($damager, "§f•§a Nhẫn Giả chưa đạt cấp§6 180§a chưa thể nhận quà này!");
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getlevel($damager) < 200){
$this->UIthongbao($damager, "§f•§a Nhẫn Giả chưa đạt cấp§6 200§a chưa thể nhận quà này!");
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getlevel($damager) < 230){
$this->UIthongbao($damager, "§f•§a Nhẫn Giả chưa đạt cấp§6 230§a chưa thể nhận quà này!");
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getlevel($damager) < 260){
$this->UIthongbao($damager, "§f•§a Nhẫn Giả chưa đạt cấp§6 260§a chưa thể nhận quà này!");
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getlevel($damager) < 290){
$this->UIthongbao($damager, "§f•§a Nhẫn Giả chưa đạt cấp§6 290§a chưa thể nhận quà này!");
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getlevel($damager) < 320){
$this->UIthongbao($damager, "§f•§a Nhẫn Giả chưa đạt cấp§6 320§a chưa thể nhận quà này!");
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getlevel($damager) < 350){
$this->UIthongbao($damager, "§f•§a Nhẫn Giả chưa đạt cấp§6 350§a chưa thể nhận quà này!");
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getlevel($damager) < 380){
$this->UIthongbao($damager, "§f•§a Nhẫn Giả chưa đạt cấp§6 380§a chưa thể nhận quà này!");
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getlevel($damager) < 410){
$this->UIthongbao($damager, "§f•§a Nhẫn Giả chưa đạt cấp§6 410§a chưa thể nhận quà này!");
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getlevel($damager) < 450){
$this->UIthongbao($damager, "§f•§a Nhẫn Giả chưa đạt cấp§6 450§a chưa thể nhận quà này!");
return true;
}
if($entity instanceof SlapperHuman && $entity->getName() == "§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp" && $this->level->getlevel($damager) < 500){
$this->UIthongbao($damager, "§f•§a Nhẫn Giả chưa đạt cấp§6 500§a chưa thể nhận quà này!");
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
$form->setTitle("§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp");
$form->setContent($message);
$form->addButton("§l§1Đã Hiểu");
$form->sendToPlayer($player);
return $form;
}
//-----------------------------------------------------------------------------------------------------------LV 10
public function UIquest1($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$player->addTitle("§l§a【§6PHÚC LỢI CẤP§a】\n§r§cChúc Mừng Nhẫn Giả Đã Nhận Được Quà Phúc lợi Cấp!\n\n\n§f➣§aCấp 15 Hãy Đến Nhận Quà Tiếp Nha");
$nhatvi = Item::get(339, 0, 5);
$nhatvi->setCustomName("§r§aBùa Nổ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 2));
$player->getInventory()->addItem($nhatvi);
$this->level->addExp($player, 1000);
$this->vang->addVang($player, 2);
$this->bac->addBac($player, 100);
$this->xu->addXu($player, 20);
$this->stats->addStats($player, 2);
$this->setDone1($player);
break;
}
});
$form->setTitle("§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp");
$form->setContent("§fNhẫn Giả Đã Đạt Được Cấp Độ 10 Hãy Nhận Phần Thưởng Của Mình!.
\n\n§f•§c 1000§a EXP.
\n\n§f•§c 20§a Xu.
\n\n§f•§c 100§a Bạc.
\n\n§f•§c 2§a Vàng.
\n\n§f•§c 2§a Điểm Tiềm Năng.
\n\n§f•§c 5§a Bùa Nổ.\n\n");
$form->addButton("§l§6NHẬN THƯỞNG");
$form->sendToPlayer($player);
return $form;
}
//-----------------------------------------------------------------------------------------------------------LV 15
public function UIquest2($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$player->addTitle("§l§a【§6PHÚC LỢI CẤP§a】\n§r§cChúc Mừng Nhẫn Giả Đã Nhận Được Quà Phúc lợi Cấp!\n\n\n§f➣§aCấp 20 Hãy Đến Nhận Quà Tiếp Nha");
$nhatvi = Item::get(370, 0, 5);
$nhatvi->setCustomName("§r§cMảnh Hồn §aNhị Vĩ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 2));
$player->getInventory()->addItem($nhatvi);
$nhatvi = Item::get(339, 0, 10);
$nhatvi->setCustomName("§r§aBùa Nổ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 2));
$player->getInventory()->addItem($nhatvi);
$this->level->addExp($player, 1500);
$this->vang->addVang($player, 3);
$this->bac->addBac($player, 200);
$this->xu->addXu($player, 30);
$this->stats->addStats($player, 2);
$this->setDone2($player);
break;
}
});
$form->setTitle("§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp");
$form->setContent("§fNhẫn Giả Đã Đạt Được Cấp Độ 15 Hãy Nhận Phần Thưởng Của Mình!.
\n\n§f•§c 1500§a EXP.
\n\n§f•§c 30§a Xu.
\n\n§f•§c 200§a Bạc.
\n\n§f•§c 3§a Vàng.
\n\n§f•§c 2§a Điểm Tiềm Năng.
\n\n§f•§c 5§a MẢNH HỒN NHỊ VĨ.
\n\n§f•§c 10§a Bùa Nổ.\n\n");
$form->addButton("§l§6NHẬN THƯỞNG");
$form->sendToPlayer($player);
return $form;
}
//-----------------------------------------------------------------------------------------------------------LV 20
public function UIquest3($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$player->addTitle("§l§a【§6PHÚC LỢI CẤP§a】\n§r§cChúc Mừng Nhẫn Giả Đã Nhận Được Quà Phúc lợi Cấp!\n\n\n§f➣§aCấp 25 Hãy Đến Nhận Quà Tiếp Nha");
$nhatvi = Item::get(370, 0, 5);
$nhatvi->setCustomName("§r§cMảnh Hồn §aNhị Vĩ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 2));
$player->getInventory()->addItem($nhatvi);
$nhatvi = Item::get(339, 0, 15);
$nhatvi->setCustomName("§r§aBùa Nổ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 2));
$player->getInventory()->addItem($nhatvi);
$this->level->addExp($player, 2000);
$this->vang->addVang($player, 4);
$this->bac->addBac($player, 300);
$this->xu->addXu($player, 40);
$this->stats->addStats($player, 2);
$this->setDone3($player);
break;
}
});
$form->setTitle("§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp");
$form->setContent("§fNhẫn Giả Đã Đạt Được Cấp Độ 20 Hãy Nhận Phần Thưởng Của Mình!.
\n\n§f•§c 2000§a EXP.
\n\n§f•§c 40§a Xu.
\n\n§f•§c 300§a Bạc.
\n\n§f•§c 4§a Vàng.
\n\n§f•§c 2§a Điểm Tiềm Năng.
\n\n§f•§c 5§a MẢNH HỒN NHỊ VĨ.
\n\n§f•§c 15§a Bùa Nổ.\n\n");
$form->addButton("§l§6NHẬN THƯỞNG");
$form->sendToPlayer($player);
return $form;
}
//-----------------------------------------------------------------------------------------------------------LV 25
public function UIquest4($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$player->addTitle("§l§a【§6PHÚC LỢI CẤP§a】\n§r§cChúc Mừng Nhẫn Giả Đã Nhận Được Quà Phúc lợi Cấp!\n\n\n§f➣§aCấp 30 Hãy Đến Nhận Quà Tiếp Nha");
$nhatvi = Item::get(370, 0, 5);
$nhatvi->setCustomName("§r§cMảnh Hồn §aNhị Vĩ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 2));
$player->getInventory()->addItem($nhatvi);
$nhatvi = Item::get(339, 0, 20);
$nhatvi->setCustomName("§r§aBùa Nổ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 2));
$player->getInventory()->addItem($nhatvi);
$this->level->addExp($player, 2500);
$this->vang->addVang($player, 5);
$this->bac->addBac($player, 400);
$this->xu->addXu($player, 50);
$this->stats->addStats($player, 2);
$this->setDone4($player);
break;
}
});
$form->setTitle("§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp");
$form->setContent("§fNhẫn Giả Đã Đạt Được Cấp Độ 25 Hãy Nhận Phần Thưởng Của Mình!.
\n\n§f•§c 2500§a EXP.
\n\n§f•§c 50§a Xu.
\n\n§f•§c 400§a Bạc.
\n\n§f•§c 5§a Vàng.
\n\n§f•§c 2§a Điểm Tiềm Năng.
\n\n§f•§c 5§a MẢNH HỒN NHỊ VĨ.
\n\n§f•§c 20§a Bùa Nổ.\n\n");
$form->addButton("§l§6NHẬN THƯỞNG");
$form->sendToPlayer($player);
return $form;
}
//-----------------------------------------------------------------------------------------------------------LV 30
public function UIquest5($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$player->addTitle("§l§a【§6PHÚC LỢI CẤP§a】\n§r§cChúc Mừng Nhẫn Giả Đã Nhận Được Quà Phúc lợi Cấp!\n\n\n§f➣§aCấp 40 Hãy Đến Nhận Quà Tiếp Nha");
$nhatvi = Item::get(370, 0, 5);
$nhatvi->setCustomName("§r§cMảnh Hồn §aNhị Vĩ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 2));
$player->getInventory()->addItem($nhatvi);
$nhatvi = Item::get(339, 0, 25);
$nhatvi->setCustomName("§r§aBùa Nổ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 2));
$player->getInventory()->addItem($nhatvi);
$this->level->addExp($player, 3000);
$this->vang->addVang($player, 6);
$this->bac->addBac($player, 500);
$this->xu->addXu($player, 60);
$this->stats->addStats($player, 3);
$this->setDone5($player);
break;
}
});
$form->setTitle("§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp");
$form->setContent("§fNhẫn Giả Đã Đạt Được Cấp Độ 30 Hãy Nhận Phần Thưởng Của Mình!.
\n\n§f•§c 3000§a EXP.
\n\n§f•§c 60§a Xu.
\n\n§f•§c 500§a Bạc.
\n\n§f•§c 6§a Vàng.
\n\n§f•§c 3§a Điểm Tiềm Năng.
\n\n§f•§c 5§a MẢNH HỒN NHỊ VĨ.
\n\n§f•§c 25§a Bùa Nổ.\n\n");
$form->addButton("§l§6NHẬN THƯỞNG");
$form->sendToPlayer($player);
return $form;
}
//-----------------------------------------------------------------------------------------------------------LV 40
public function UIquest6($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$player->addTitle("§l§a【§6PHÚC LỢI CẤP§a】\n§r§cChúc Mừng Nhẫn Giả Đã Nhận Được Quà Phúc lợi Cấp!\n\n\n§f➣§aCấp 50 Hãy Đến Nhận Quà Tiếp Nha");
$nhatvi = Item::get(370, 0, 10);
$nhatvi->setCustomName("§r§cMảnh Hồn §aNhị Vĩ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 2));
$player->getInventory()->addItem($nhatvi);
$nhatvi = Item::get(339, 0, 30);
$nhatvi->setCustomName("§r§aBùa Nổ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 2));
$player->getInventory()->addItem($nhatvi);
$this->level->addExp($player, 3500);
$this->vang->addVang($player, 7);
$this->bac->addBac($player, 600);
$this->xu->addXu($player, 70);
$this->stats->addStats($player, 3);
$this->setDone6($player);
break;
}
});
$form->setTitle("§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp");
$form->setContent("§fNhẫn Giả Đã Đạt Được Cấp Độ 40 Hãy Nhận Phần Thưởng Của Mình!.
\n\n§f•§c 3500§a EXP.
\n\n§f•§c 70§a Xu.
\n\n§f•§c 600§a Bạc.
\n\n§f•§c 7§a Vàng.
\n\n§f•§c 3§a Điểm Tiềm Năng.
\n\n§f•§c 10§a MẢNH HỒN NHỊ VĨ.
\n\n§f•§c 30§a Bùa Nổ.\n\n");
$form->addButton("§l§6NHẬN THƯỞNG");
$form->sendToPlayer($player);
return $form;
}
//-----------------------------------------------------------------------------------------------------------LV 50
public function UIquest7($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$player->addTitle("§l§a【§6PHÚC LỢI CẤP§a】\n§r§cChúc Mừng Nhẫn Giả Đã Nhận Được Quà Phúc lợi Cấp!\n\n\n§f➣§aCấp 60 Hãy Đến Nhận Quà Tiếp Nha");
$nhatvi = Item::get(370, 0, 10);
$nhatvi->setCustomName("§r§cMảnh Hồn §aNhị Vĩ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 2));
$player->getInventory()->addItem($nhatvi);
$nhatvi = Item::get(339, 0, 35);
$nhatvi->setCustomName("§r§aBùa Nổ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 2));
$player->getInventory()->addItem($nhatvi);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->vang->addVang($player, 8);
$this->bac->addBac($player, 700);
$this->xu->addXu($player, 80);
$this->stats->addStats($player, 4);
$this->setDone7($player);
break;
}
});
$form->setTitle("§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp");
$form->setContent("§fNhẫn Giả Đã Đạt Được Cấp Độ 50 Hãy Nhận Phần Thưởng Của Mình!.
\n\n§f•§c 4000§a EXP.
\n\n§f•§c 80§a Xu.
\n\n§f•§c 700§a Bạc.
\n\n§f•§c 8§a Vàng.
\n\n§f•§c 4§a Điểm Tiềm Năng.
\n\n§f•§c 10§a MẢNH HỒN NHỊ VĨ.
\n\n§f•§c 35§a Bùa Nổ.\n\n");
$form->addButton("§l§6NHẬN THƯỞNG");
$form->sendToPlayer($player);
return $form;
}
//-----------------------------------------------------------------------------------------------------------LV 60
public function UIquest8($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$player->addTitle("§l§a【§6PHÚC LỢI CẤP§a】\n§r§cChúc Mừng Nhẫn Giả Đã Nhận Được Quà Phúc lợi Cấp!\n\n\n§f➣§aCấp 70 Hãy Đến Nhận Quà Tiếp Nha");
$nhatvi = Item::get(339, 0, 40);
$nhatvi->setCustomName("§r§aBùa Nổ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 2));
$player->getInventory()->addItem($nhatvi);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->vang->addVang($player, 9);
$this->bac->addBac($player, 800);
$this->xu->addXu($player, 90);
$this->stats->addStats($player, 4);
$this->setDone8($player);
break;
}
});
$form->setTitle("§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp");
$form->setContent("§fNhẫn Giả Đã Đạt Được Cấp Độ 60 Hãy Nhận Phần Thưởng Của Mình!.
\n\n§f•§c 4500§a EXP.
\n\n§f•§c 90§a Xu.
\n\n§f•§c 800§a Bạc.
\n\n§f•§c 9§a Vàng.
\n\n§f•§c 4§a Điểm Tiềm Năng.
\n\n§f•§c 10§a MẢNH HỒN CỬU VĨ.
\n\n§f•§c 40§a Bùa Nổ.\n\n");
$form->addButton("§l§6NHẬN THƯỞNG");
$form->sendToPlayer($player);
return $form;
}
//-----------------------------------------------------------------------------------------------------------LV 70
public function UIquest9($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$player->addTitle("§l§a【§6PHÚC LỢI CẤP§a】\n§r§cChúc Mừng Nhẫn Giả Đã Nhận Được Quà Phúc lợi Cấp!\n\n\n§f➣§aCấp 80 Hãy Đến Nhận Quà Tiếp Nha");
$nhatvi = Item::get(339, 0, 45);
$nhatvi->setCustomName("§r§aBùa Nổ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 2));
$player->getInventory()->addItem($nhatvi);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->vang->addVang($player, 10);
$this->bac->addBac($player, 900);
$this->xu->addXu($player, 100);
$this->stats->addStats($player, 4);
$this->setDone9($player);
break;
}
});
$form->setTitle("§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp");
$form->setContent("§fNhẫn Giả Đã Đạt Được Cấp Độ 70 Hãy Nhận Phần Thưởng Của Mình!.
\n\n§f•§c 5000§a EXP.
\n\n§f•§c 100§a Xu.
\n\n§f•§c 900§a Bạc.
\n\n§f•§c 10§a Vàng.
\n\n§f•§c 4§a Điểm Tiềm Năng.
\n\n§f•§c 45§a Bùa Nổ.\n\n");
$form->addButton("§l§6NHẬN THƯỞNG");
$form->sendToPlayer($player);
return $form;
}
//-----------------------------------------------------------------------------------------------------------LV 80
public function UIquest10($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$player->addTitle("§l§a【§6PHÚC LỢI CẤP§a】\n§r§cChúc Mừng Nhẫn Giả Đã Nhận Được Quà Phúc lợi Cấp!\n\n\n§f➣§aCấp 90 Hãy Đến Nhận Quà Tiếp Nha");
$nhatvi = Item::get(339, 0, 45);
$nhatvi->setCustomName("§r§aBùa Nổ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 2));
$player->getInventory()->addItem($nhatvi);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->vang->addVang($player, 10);
$this->bac->addBac($player, 1000);
$this->xu->addXu($player, 200);
$this->stats->addStats($player, 4);
$this->setDone10($player);
break;
}
});
$form->setTitle("§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp");
$form->setContent("§fNhẫn Giả Đã Đạt Được Cấp Độ 80 Hãy Nhận Phần Thưởng Của Mình!.
\n\n§f•§c 6000§a EXP.
\n\n§f•§c 200§a Xu.
\n\n§f•§c 1000§a Bạc.
\n\n§f•§c 10§a Vàng.
\n\n§f•§c 4§a Điểm Tiềm Năng.
\n\n§f•§c 45§a Bùa Nổ.\n\n");
$form->addButton("§l§6NHẬN THƯỞNG");
$form->sendToPlayer($player);
return $form;
}
//-----------------------------------------------------------------------------------------------------------LV 90
public function UIquest11($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$player->addTitle("§l§a【§6PHÚC LỢI CẤP§a】\n§r§cChúc Mừng Nhẫn Giả Đã Nhận Được Quà Phúc lợi Cấp!\n\n\n§f➣§aCấp 100 Hãy Đến Nhận Quà Tiếp Nha");
$nhatvi = Item::get(339, 0, 45);
$nhatvi->setCustomName("§r§aBùa Nổ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 2));
$player->getInventory()->addItem($nhatvi);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->vang->addVang($player, 10);
$this->bac->addBac($player, 2000);
$this->xu->addXu($player, 300);
$this->stats->addStats($player, 4);
$this->setDone11($player);
break;
}
});
$form->setTitle("§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp");
$form->setContent("§fNhẫn Giả Đã Đạt Được Cấp Độ 90 Hãy Nhận Phần Thưởng Của Mình!.
\n\n§f•§c 8000§a EXP.
\n\n§f•§c 300§a Xu.
\n\n§f•§c 2000§a Bạc.
\n\n§f•§c 10§a Vàng.
\n\n§f•§c 4§a Điểm Tiềm Năng.
\n\n§f•§c 45§a Bùa Nổ.\n\n");
$form->addButton("§l§6NHẬN THƯỞNG");
$form->sendToPlayer($player);
return $form;
}
//-----------------------------------------------------------------------------------------------------------LV 100
public function UIquest12($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$player->addTitle("§l§a【§6PHÚC LỢI CẤP§a】\n§r§cChúc Mừng Nhẫn Giả Đã Nhận Được Quà Phúc lợi Cấp!\n\n\n§f➣§aCấp 120 Hãy Đến Nhận Quà Tiếp Nha");
$nhatvi = Item::get(339, 0, 45);
$nhatvi->setCustomName("§r§aBùa Nổ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 2));
$player->getInventory()->addItem($nhatvi);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->vang->addVang($player, 10);
$this->bac->addBac($player, 5000);
$this->xu->addXu($player, 400);
$this->stats->addStats($player, 5);
$this->setDone12($player);
break;
}
});
$form->setTitle("§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp");
$form->setContent("§fNhẫn Giả Đã Đạt Được Cấp Độ 100 Hãy Nhận Phần Thưởng Của Mình!.
\n\n§f•§c 10000§a EXP.
\n\n§f•§c 400§a Xu.
\n\n§f•§c 5000§a Bạc.
\n\n§f•§c 10§a Vàng.
\n\n§f•§c 5§a Điểm Tiềm Năng.
\n\n§f•§c 45§a Bùa Nổ.\n\n");
$form->addButton("§l§6NHẬN THƯỞNG");
$form->sendToPlayer($player);
return $form;
}
//-----------------------------------------------------------------------------------------------------------LV 120
public function UIquest13($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$player->addTitle("§l§a【§6PHÚC LỢI CẤP§a】\n§r§cChúc Mừng Nhẫn Giả Đã Nhận Được Quà Phúc lợi Cấp!\n\n\n§f➣§aCấp 140 Hãy Đến Nhận Quà Tiếp Nha");
$nhatvi = Item::get(339, 0, 45);
$nhatvi->setCustomName("§r§aBùa Nổ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 2));
$player->getInventory()->addItem($nhatvi);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->vang->addVang($player, 10);
$this->bac->addBac($player, 7000);
$this->xu->addXu($player, 500);
$this->stats->addStats($player, 5);
$this->setDone13($player);
break;
}
});
$form->setTitle("§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp");
$form->setContent("§fNhẫn Giả Đã Đạt Được Cấp Độ 120 Hãy Nhận Phần Thưởng Của Mình!.
\n\n§f•§c 12000§a EXP.
\n\n§f•§c 500§a Xu.
\n\n§f•§c 7000§a Bạc.
\n\n§f•§c 10§a Vàng.
\n\n§f•§c 5§a Điểm Tiềm Năng.
\n\n§f•§c 45§a Bùa Nổ.\n\n");
$form->addButton("§l§6NHẬN THƯỞNG");
$form->sendToPlayer($player);
return $form;
}
//-----------------------------------------------------------------------------------------------------------LV 140
public function UIquest14($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$player->addTitle("§l§a【§6PHÚC LỢI CẤP§a】\n§r§cChúc Mừng Nhẫn Giả Đã Nhận Được Quà Phúc lợi Cấp!\n\n\n§f➣§aCấp 160 Hãy Đến Nhận Quà Tiếp Nha");
$nhatvi = Item::get(339, 0, 45);
$nhatvi->setCustomName("§r§aBùa Nổ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 2));
$player->getInventory()->addItem($nhatvi);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->vang->addVang($player, 10);
$this->bac->addBac($player, 8000);
$this->xu->addXu($player, 600);
$this->stats->addStats($player, 5);
$this->setDone14($player);
break;
}
});
$form->setTitle("§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp");
$form->setContent("§fNhẫn Giả Đã Đạt Được Cấp Độ 140 Hãy Nhận Phần Thưởng Của Mình!.
\n\n§f•§c 14000§a EXP.
\n\n§f•§c 600§a Xu.
\n\n§f•§c 8000§a Bạc.
\n\n§f•§c 10§a Vàng.
\n\n§f•§c 5§a Điểm Tiềm Năng.
\n\n§f•§c 45§a Bùa Nổ.\n\n");
$form->addButton("§l§6NHẬN THƯỞNG");
$form->sendToPlayer($player);
return $form;
}
//-----------------------------------------------------------------------------------------------------------LV 160
public function UIquest15($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$player->addTitle("§l§a【§6PHÚC LỢI CẤP§a】\n§r§cChúc Mừng Nhẫn Giả Đã Nhận Được Quà Phúc lợi Cấp!\n\n\n§f➣§aCấp 180 Hãy Đến Nhận Quà Tiếp Nha");
$nhatvi = Item::get(339, 0, 45);
$nhatvi->setCustomName("§r§aBùa Nổ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 2));
$player->getInventory()->addItem($nhatvi);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->vang->addVang($player, 10);
$this->bac->addBac($player, 9000);
$this->xu->addXu($player, 700);
$this->stats->addStats($player, 6);
$this->setDone15($player);
break;
}
});
$form->setTitle("§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp");
$form->setContent("§fNhẫn Giả Đã Đạt Được Cấp Độ 160 Hãy Nhận Phần Thưởng Của Mình!.
\n\n§f•§c 16000§a EXP.
\n\n§f•§c 700§a Xu.
\n\n§f•§c 9000§a Bạc.
\n\n§f•§c 10§a Vàng.
\n\n§f•§c 6§a Điểm Tiềm Năng.
\n\n§f•§c 45§a Bùa Nổ.\n\n");
$form->addButton("§l§6NHẬN THƯỞNG");
$form->sendToPlayer($player);
return $form;
}
//-----------------------------------------------------------------------------------------------------------LV 180
public function UIquest16($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$player->addTitle("§l§a【§6PHÚC LỢI CẤP§a】\n§r§cChúc Mừng Nhẫn Giả Đã Nhận Được Quà Phúc lợi Cấp!\n\n\n§f➣§aCấp 200 Hãy Đến Nhận Quà Tiếp Nha");
$nhatvi = Item::get(339, 0, 45);
$nhatvi->setCustomName("§r§aBùa Nổ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 2));
$player->getInventory()->addItem($nhatvi);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->vang->addVang($player, 10);
$this->bac->addBac($player, 10000);
$this->xu->addXu($player, 800);
$this->stats->addStats($player, 6);
$this->setDone16($player);
break;
}
});
$form->setTitle("§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp");
$form->setContent("§fNhẫn Giả Đã Đạt Được Cấp Độ 180 Hãy Nhận Phần Thưởng Của Mình!.
\n\n§f•§c 18000§a EXP.
\n\n§f•§c 800§a Xu.
\n\n§f•§c 10000§a Bạc.
\n\n§f•§c 10§a Vàng.
\n\n§f•§c 6§a Điểm Tiềm Năng.
\n\n§f•§c 45§a Bùa Nổ.\n\n");
$form->addButton("§l§6NHẬN THƯỞNG");
$form->sendToPlayer($player);
return $form;
}
//-----------------------------------------------------------------------------------------------------------LV 200
public function UIquest17($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$player->addTitle("§l§a【§6PHÚC LỢI CẤP§a】\n§r§cChúc Mừng Nhẫn Giả Đã Nhận Được Quà Phúc lợi Cấp!\n\n\n§f➣§aCấp 230 Hãy Đến Nhận Quà Tiếp Nha");
$nhatvi = Item::get(339, 0, 45);
$nhatvi->setCustomName("§r§aBùa Nổ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 2));
$player->getInventory()->addItem($nhatvi);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->vang->addVang($player, 10);
$this->bac->addBac($player, 11000);
$this->xu->addXu($player, 900);
$this->stats->addStats($player, 7);
$this->setDone17($player);
break;
}
});
$form->setTitle("§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp");
$form->setContent("§fNhẫn Giả Đã Đạt Được Cấp Độ 200 Hãy Nhận Phần Thưởng Của Mình!.
\n\n§f•§c 20000§a EXP.
\n\n§f•§c 900§a Xu.
\n\n§f•§c 11000§a Bạc.
\n\n§f•§c 10§a Vàng.
\n\n§f•§c 7§a Điểm Tiềm Năng.
\n\n§f•§c 45§a Bùa Nổ.\n\n");
$form->addButton("§l§6NHẬN THƯỞNG");
$form->sendToPlayer($player);
return $form;
}
//-----------------------------------------------------------------------------------------------------------LV 230
public function UIquest18($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$player->addTitle("§l§a【§6PHÚC LỢI CẤP§a】\n§r§cChúc Mừng Nhẫn Giả Đã Nhận Được Quà Phúc lợi Cấp!\n\n\n§f➣§aCấp 260 Hãy Đến Nhận Quà Tiếp Nha");
$nhatvi = Item::get(339, 0, 45);
$nhatvi->setCustomName("§r§aBùa Nổ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 2));
$player->getInventory()->addItem($nhatvi);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->vang->addVang($player, 10);
$this->bac->addBac($player, 12000);
$this->xu->addXu($player, 1000);
$this->stats->addStats($player, 7);
$this->setDone18($player);
break;
}
});
$form->setTitle("§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp");
$form->setContent("§fNhẫn Giả Đã Đạt Được Cấp Độ 230 Hãy Nhận Phần Thưởng Của Mình!.
\n\n§f•§c 22000§a EXP.
\n\n§f•§c 1000§a Xu.
\n\n§f•§c 12000§a Bạc.
\n\n§f•§c 10§a Vàng.
\n\n§f•§c 7§a Điểm Tiềm Năng.
\n\n§f•§c 45§a Bùa Nổ.\n\n");
$form->addButton("§l§6NHẬN THƯỞNG");
$form->sendToPlayer($player);
return $form;
}
//-----------------------------------------------------------------------------------------------------------LV 260
public function UIquest19($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$player->addTitle("§l§a【§6PHÚC LỢI CẤP§a】\n§r§cChúc Mừng Nhẫn Giả Đã Nhận Được Quà Phúc lợi Cấp!\n\n\n§f➣§aCấp 290 Hãy Đến Nhận Quà Tiếp Nha");
$nhatvi = Item::get(339, 0, 45);
$nhatvi->setCustomName("§r§aBùa Nổ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 2));
$player->getInventory()->addItem($nhatvi);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->vang->addVang($player, 10);
$this->bac->addBac($player, 13000);
$this->xu->addXu($player, 1100);
$this->stats->addStats($player, 7);
$this->setDone19($player);
break;
}
});
$form->setTitle("§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp");
$form->setContent("§fNhẫn Giả Đã Đạt Được Cấp Độ 260 Hãy Nhận Phần Thưởng Của Mình!.
\n\n§f•§c 24000§a EXP.
\n\n§f•§c 1100§a Xu.
\n\n§f•§c 13000§a Bạc.
\n\n§f•§c 10§a Vàng.
\n\n§f•§c 7§a Điểm Tiềm Năng.
\n\n§f•§c 45§a Bùa Nổ.\n\n");
$form->addButton("§l§6NHẬN THƯỞNG");
$form->sendToPlayer($player);
return $form;
}
//-----------------------------------------------------------------------------------------------------------LV 290
public function UIquest20($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$player->addTitle("§l§a【§6PHÚC LỢI CẤP§a】\n§r§cChúc Mừng Nhẫn Giả Đã Nhận Được Quà Phúc lợi Cấp!\n\n\n§f➣§aCấp 320 Hãy Đến Nhận Quà Tiếp Nha");
$nhatvi = Item::get(339, 0, 45);
$nhatvi->setCustomName("§r§aBùa Nổ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 2));
$player->getInventory()->addItem($nhatvi);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->vang->addVang($player, 10);
$this->bac->addBac($player, 14000);
$this->xu->addXu($player, 1200);
$this->stats->addStats($player, 7);
$this->setDone20($player);
break;
}
});
$form->setTitle("§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp");
$form->setContent("§fNhẫn Giả Đã Đạt Được Cấp Độ 290 Hãy Nhận Phần Thưởng Của Mình!.
\n\n§f•§c 26000§a EXP.
\n\n§f•§c 1200§a Xu.
\n\n§f•§c 14000§a Bạc.
\n\n§f•§c 10§a Vàng.
\n\n§f•§c 7§a Điểm Tiềm Năng.
\n\n§f•§c 45§a Bùa Nổ.\n\n");
$form->addButton("§l§6NHẬN THƯỞNG");
$form->sendToPlayer($player);
return $form;
}
//-----------------------------------------------------------------------------------------------------------LV 320
public function UIquest21($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$player->addTitle("§l§a【§6PHÚC LỢI CẤP§a】\n§r§cChúc Mừng Nhẫn Giả Đã Nhận Được Quà Phúc lợi Cấp!\n\n\n§f➣§aCấp 350 Hãy Đến Nhận Quà Tiếp Nha");
$nhatvi = Item::get(339, 0, 45);
$nhatvi->setCustomName("§r§aBùa Nổ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 2));
$player->getInventory()->addItem($nhatvi);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->vang->addVang($player, 10);
$this->bac->addBac($player, 15000);
$this->xu->addXu($player, 1300);
$this->stats->addStats($player, 8);
$this->setDone21($player);
break;
}
});
$form->setTitle("§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp");
$form->setContent("§fNhẫn Giả Đã Đạt Được Cấp Độ 320 Hãy Nhận Phần Thưởng Của Mình!.
\n\n§f•§c 28000§a EXP.
\n\n§f•§c 1300§a Xu.
\n\n§f•§c 15000§a Bạc.
\n\n§f•§c 10§a Vàng.
\n\n§f•§c 8§a Điểm Tiềm Năng.
\n\n§f•§c 45§a Bùa Nổ.\n\n");
$form->addButton("§l§6NHẬN THƯỞNG");
$form->sendToPlayer($player);
return $form;
}
//-----------------------------------------------------------------------------------------------------------LV 350
public function UIquest22($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$player->addTitle("§l§a【§6PHÚC LỢI CẤP§a】\n§r§cChúc Mừng Nhẫn Giả Đã Nhận Được Quà Phúc lợi Cấp!\n\n\n§f➣§aCấp 380 Hãy Đến Nhận Quà Tiếp Nha");
$nhatvi = Item::get(339, 0, 45);
$nhatvi->setCustomName("§r§aBùa Nổ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 2));
$player->getInventory()->addItem($nhatvi);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->vang->addVang($player, 10);
$this->bac->addBac($player, 16000);
$this->xu->addXu($player, 1400);
$this->stats->addStats($player, 8);
$this->setDone22($player);
break;
}
});
$form->setTitle("§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp");
$form->setContent("§fNhẫn Giả Đã Đạt Được Cấp Độ 350 Hãy Nhận Phần Thưởng Của Mình!.
\n\n§f•§c 30000§a EXP.
\n\n§f•§c 1400§a Xu.
\n\n§f•§c 16000§a Bạc.
\n\n§f•§c 10§a Vàng.
\n\n§f•§c 8§a Điểm Tiềm Năng.
\n\n§f•§c 45§a Bùa Nổ.\n\n");
$form->addButton("§l§6NHẬN THƯỞNG");
$form->sendToPlayer($player);
return $form;
}
//-----------------------------------------------------------------------------------------------------------LV 380
public function UIquest23($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$player->addTitle("§l§a【§6PHÚC LỢI CẤP§a】\n§r§cChúc Mừng Nhẫn Giả Đã Nhận Được Quà Phúc lợi Cấp!\n\n\n§f➣§aCấp 410 Hãy Đến Nhận Quà Tiếp Nha");
$nhatvi = Item::get(339, 0, 45);
$nhatvi->setCustomName("§r§aBùa Nổ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 2));
$player->getInventory()->addItem($nhatvi);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->vang->addVang($player, 10);
$this->bac->addBac($player, 17000);
$this->xu->addXu($player, 1500);
$this->stats->addStats($player, 8);
$this->setDone23($player);
break;
}
});
$form->setTitle("§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp");
$form->setContent("§fNhẫn Giả Đã Đạt Được Cấp Độ 380 Hãy Nhận Phần Thưởng Của Mình!.
\n\n§f•§c 32000§a EXP.
\n\n§f•§c 1500§a Xu.
\n\n§f•§c 17000§a Bạc.
\n\n§f•§c 10§a Vàng.
\n\n§f•§c 8§a Điểm Tiềm Năng.
\n\n§f•§c 45§a Bùa Nổ.\n\n");
$form->addButton("§l§6NHẬN THƯỞNG");
$form->sendToPlayer($player);
return $form;
}
//-----------------------------------------------------------------------------------------------------------LV 410
public function UIquest24($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$player->addTitle("§l§a【§6PHÚC LỢI CẤP§a】\n§r§cChúc Mừng Nhẫn Giả Đã Nhận Được Quà Phúc lợi Cấp!\n\n\n§f➣§aCấp 450 Hãy Đến Nhận Quà Tiếp Nha");
$nhatvi = Item::get(339, 0, 45);
$nhatvi->setCustomName("§r§aBùa Nổ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 2));
$player->getInventory()->addItem($nhatvi);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->vang->addVang($player, 10);
$this->bac->addBac($player, 18000);
$this->xu->addXu($player, 1600);
$this->stats->addStats($player, 9);
$this->setDone24($player);
break;
}
});
$form->setTitle("§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp");
$form->setContent("§fNhẫn Giả Đã Đạt Được Cấp Độ 410 Hãy Nhận Phần Thưởng Của Mình!.
\n\n§f•§c 34000§a EXP.
\n\n§f•§c 1600§a Xu.
\n\n§f•§c 18000§a Bạc.
\n\n§f•§c 10§a Vàng.
\n\n§f•§c 9§a Điểm Tiềm Năng.
\n\n§f•§c 45§a Bùa Nổ.\n\n");
$form->addButton("§l§6NHẬN THƯỞNG");
$form->sendToPlayer($player);
return $form;
}
//-----------------------------------------------------------------------------------------------------------LV 450
public function UIquest25($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$player->addTitle("§l§a【§6PHÚC LỢI CẤP§a】\n§r§cChúc Mừng Nhẫn Giả Đã Nhận Được Quà Phúc lợi Cấp!\n\n\n§f➣§aCấp 500 Hãy Đến Nhận Quà Tiếp Nha");
$nhatvi = Item::get(339, 0, 45);
$nhatvi->setCustomName("§r§aBùa Nổ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 2));
$player->getInventory()->addItem($nhatvi);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->vang->addVang($player, 10);
$this->bac->addBac($player, 19000);
$this->xu->addXu($player, 1700);
$this->stats->addStats($player, 9);
$this->setDone25($player);
break;
}
});
$form->setTitle("§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp");
$form->setContent("§fNhẫn Giả Đã Đạt Được Cấp Độ 450 Hãy Nhận Phần Thưởng Của Mình!.
\n\n§f•§c 36000§a EXP.
\n\n§f•§c 1700§a Xu.
\n\n§f•§c 19000§a Bạc.
\n\n§f•§c 10§a Vàng.
\n\n§f•§c 9§a Điểm Tiềm Năng.
\n\n§f•§c 45§a Bùa Nổ.\n\n");
$form->addButton("§l§6NHẬN THƯỞNG");
$form->sendToPlayer($player);
return $form;
}
//-----------------------------------------------------------------------------------------------------------LV 500
public function UIquest26($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
$player->addTitle("§l§a【§6PHÚC LỢI CẤP§a】\n§r§cChúc Mừng Nhẫn Giả Đã Nhận Được Quà Phúc lợi Cấp!\n\n\n§f➣§aNhẫn Giả Đã Nhận Mốc Tối Đa");
$nhatvi = Item::get(370, 0, 5);
$nhatvi->setCustomName("§r§cMảnh Hồn §aCửu Vĩ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 9));
$player->getInventory()->addItem($nhatvi);
$nhatvi = Item::get(339, 0, 45);
$nhatvi->setCustomName("§r§aBùa Nổ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 2));
$player->getInventory()->addItem($nhatvi);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->level->addExp($player, 2000);
$this->vang->addVang($player, 10);
$this->bac->addBac($player, 20000);
$this->xu->addXu($player, 2000);
$this->stats->addStats($player, 10);
$this->setDone26($player);
break;
}
});
$form->setTitle("§l§e【§cSự Kiện§e】§r§f Phúc Lợi Cấp");
$form->setContent("§fNhẫn Giả Đã Đạt Được Cấp Độ 500 Hãy Nhận Phần Thưởng Của Mình!.
\n\n§f•§c 40000§a EXP.
\n\n§f•§c 2000§a Xu.
\n\n§f•§c 20000§a Bạc.
\n\n§f•§c 10§a Vàng.
\n\n§f•§c 10§a Điểm Tiềm Năng.
\n\n§f•§c 5§a MẢNH HỒN CỬU VĨ.
\n\n§f•§c 45§a Bùa Nổ.\n\n");
$form->addButton("§l§6NHẬN THƯỞNG");
$form->sendToPlayer($player);
return $form;
}
}
