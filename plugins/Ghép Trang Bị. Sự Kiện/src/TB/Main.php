<?php

namespace TB;

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
use pocketmine\event\entity\EntityDeathEvent;
use onebone\economyapi\EconomyAPI;
use pocketmine\item\Item;
use pocketmine\event\player\{PlayerInteractEvent, PlayerItemHeldEvent, PlayerJoinEvent, PlayerChatEvent};
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\block\Block;
use pocketmine\level\particle\{AngryVillagerParticle,BubbleParticle,CriticalParticle,DestroyBlockParticle,DustParticle,EnchantmentTableParticle,EnchantParticle,EntityFlameParticle,LargeExplodeParticle,FlameParticle,HappyVillagerParticle,HeartParticle,InkParticle,InstantEnchantParticle,ItemBreakParticle,LavaDripParticle,LavaParticle,MobSpellParticle,PortalParticle,RainSplashParticle,RedstoneParticle,SmokeParticle,SpellParticle,SplashParticle,SporeParticle,TerrainParticle,WaterDripParticle,WaterParticle,WhiteSmokeParticle, HugeExplodeSeedParticle};
use pocketmine\math\Vector3;
use pocketmine\entity\Entity;
use pocketmine\utils\Config;
use pocketmine\Inventory;
use pocketmine\level\Level;
use pocketmine\entity\human;
use pocketmine\entity\Effect;
use pocketmine\math\AxisAlignedBB;
//use pocketmine\math\Vector3;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\entity\EffectInstance;
use pocketmine\network\protocol\SetTitlePacket;
use phuongaz\AuraBoss\Entity\ViThu;

class Main extends PluginBase implements Listener{

public function onEnable() : void{
$this->getServer()->getPluginManager()->registerEvents($this, $this);
$this->mana = $this->getServer()->getPluginManager()->getPlugin("NGVS_Mana");
$this->level = $this->getServer()->getPluginManager()->getPlugin("NGVS_Level");
$this->giatoc = $this->getServer()->getPluginManager()->getPlugin("NGVS_GiaToc");
$this->stats = $this->getServer()->getPluginManager()->getPlugin("NGVS_Stats");
$this->sm = $this->getServer()->getPluginManager()->getPlugin("NGVS_SucManh");
$this->xu = $this->getServer()->getPluginManager()->getPlugin("NGVS_Xu");
$this->bac = $this->getServer()->getPluginManager()->getPlugin("NGVS_Bac");
$this->vang= $this->getServer()->getPluginManager()->getPlugin("NGVS_Vang");
$this->ambo= $this->getServer()->getPluginManager()->getPlugin("NGVS_AmBo");
$this->chakra = $this->getServer()->getPluginManager()->getPlugin("NGVS_DCK");
}
public function onFight(EntityDamageEvent $event) {
if($event instanceof EntityDamageByEntityEvent) {
$hit = $event->getEntity();
$damager = $event->getDamager();


if($damager instanceof Player){
if($hit instanceof ViThu && $event->isCancelled()){
$event->setCancelled(false);
return true;
}


if($hit instanceof ViThu && !$event->isCancelled() && $hit->getName() == "§l§c【§6NHẤT VĨ§c】§a SHUKAKU"){

return true;
}


}
if(!$damager instanceof Player){
return false;
}

}
}

public function onDeath(EntityDeathEvent $event) {
$entity = $event->getEntity();
if($event->getEntity()->getLastDamageCause() instanceof EntityDamageByEntityEvent && $event->getEntity()->getLastDamageCause()->getDamager() instanceof Player){
$damager = $event->getEntity()->getLastDamageCause()->getDamager();
$boss = $event->getEntity();
$name = $damager->getName();
//========================================================================================================================================================================
if($boss->getName() == "§l§c【§6AKATSUKI§c】§a KONAN §eLV 150"){
$this->xu->addXu($damager, 1000);
$this->level->addExp($damager, 1000);
$this->level->addExp($damager, 1000);
$this->level->addExp($damager, 1000);
$this->level->addExp($damager, 1000);
$this->level->addExp($damager, 1000);
$this->bac->addBac($damager, 100);
$this->stats->addStats($damager, 2);
$damager->sendMessage("§f•§a Nhẫn Giả nhận được:§c 1000§a Xu,§c 5000§a Kinh Nghiệm,§c 100§a Bạc,§c 2§a Điểm Tiềm Năng");
$this->getServer()->broadcastMessage("§l§c✾§6 Nhẫn Giả §e".$damager->getName()."§6 đã tiêu diệt thành công §l§c【§6AKATSUKI§c】§a KONAN §eLV 150.");
$level = $boss->getLevel();
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
//$damager
return true;
}

if($boss->getName() == "§l§c【§6AKATSUKI§c】§a NAGATO §eLV 200"){
$this->xu->addXu($damager, 1500);
$this->level->addExp($damager, 1500);
$this->level->addExp($damager, 1500);
$this->level->addExp($damager, 1500);
$this->level->addExp($damager, 1500);
$this->level->addExp($damager, 1000);
$this->bac->addBac($damager, 200);
$this->stats->addStats($damager, 4);
$damager->sendMessage("§f•§a Nhẫn Giả nhận được:§c 1500§a Xu,§c 7000§a Kinh Nghiệm,§c 200§a Bạc,§c 4§a Điểm Tiềm Năng");
$this->getServer()->broadcastMessage("§l§c✾§6 Nhẫn Giả §e".$damager->getName()."§6 đã tiêu diệt thành công §l§c【§6AKATSUKI§c】§a NAGATO §eLV 200.");
$level = $boss->getLevel();
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
//$damager
return true;
}

if($boss->getName() == "§l§c【§6AKATSUKI§c】§a ZETSU §eLV 300"){
$this->xu->addXu($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->bac->addBac($damager, 500);
$this->stats->addStats($damager, 6);
$damager->sendMessage("§f•§a Nhẫn Giả nhận được:§c 2000§a Xu,§c 10000§a Kinh Nghiệm,§c 500§a Bạc,§c 6§a Điểm Tiềm Năng");
$this->getServer()->broadcastMessage("§l§c✾§6 Nhẫn Giả §e".$damager->getName()."§6 đã tiêu diệt thành công §l§c【§6AKATSUKI§c】§a ZETSU §eLV 300.");
$level = $boss->getLevel();
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
//$damager
return true;
}


if($boss->getName() == "§l§c【§6AKATSUKI§c】§a OBITO §eLV 450"){
$this->xu->addXu($damager, 4000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->bac->addBac($damager, 1000);
$this->stats->addStats($damager, 8);
$damager->sendMessage("§f•§a Nhẫn Giả nhận được:§c 4000§a Xu,§c 14000§a Kinh Nghiệm,§c 1000§a Bạc,§c 8§a Điểm Tiềm Năng");
$this->getServer()->broadcastMessage("§l§c✾§6 Nhẫn Giả §e".$damager->getName()."§6 đã tiêu diệt thành công §l§c【§6AKATSUKI§c】§a OBITO §eLV 450.");
$level = $boss->getLevel();
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
//$damager
return true;
}


if($boss->getName() == "§l§c【§6AKATSUKI§c】§a HIDAN §eLV 500"){
$this->xu->addXu($damager, 5000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->bac->addBac($damager, 1500);
$this->stats->addStats($damager, 10);
$damager->sendMessage("§f•§a Nhẫn Giả nhận được:§c 5000§a Xu,§c 20000§a Kinh Nghiệm,§c 1500§a Bạc,§c 10§a Điểm Tiềm Năng");
$this->getServer()->broadcastMessage("§l§c✾§6 Nhẫn Giả §e".$damager->getName()."§6 đã tiêu diệt thành công §l§c【§6AKATSUKI§c】§a HIDAN §eLV 500.");
$level = $boss->getLevel();
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
//$damager
return true;
}



if($boss->getName() == "§l§c【§6AKATSUKI§c】§a KISAME §eLV 550"){
$this->xu->addXu($damager, 5555);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2222);
$this->bac->addBac($damager, 1999);
$this->stats->addStats($damager, 13);
$damager->sendMessage("§f•§a Nhẫn Giả nhận được:§c 5555§a Xu,§c 22222§a Kinh Nghiệm,§c 1999§a Bạc,§c 13§a Điểm Tiềm Năng");
$this->getServer()->broadcastMessage("§l§c✾§6 Nhẫn Giả §e".$damager->getName()."§6 đã tiêu diệt thành công §l§c【§6AKATSUKI§c】§a KISAME §eLV 550.");
$level = $boss->getLevel();
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
//$damager
return true;
}


if($boss->getName() == "§l§c【§6AKATSUKI§c】§a KAKUZU §eLV 700"){
$this->xu->addXu($damager, 6500);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->bac->addBac($damager, 2500);
$this->stats->addStats($damager, 18);
$damager->sendMessage("§f•§a Nhẫn Giả nhận được:§c 6500§a Xu,§c 26000§a Kinh Nghiệm,§c 2500§a Bạc,§c 18§a Điểm Tiềm Năng");
$this->getServer()->broadcastMessage("§l§c✾§6 Nhẫn Giả §e".$damager->getName()."§6 đã tiêu diệt thành công §l§c【§6AKATSUKI§c】§a KAKUZU §eLV 700.");
$level = $boss->getLevel();
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
//$damager
return true;
}


if($boss->getName() == "§l§c【§6AKATSUKI§c】§a ITACHI §eLV 850"){
$this->xu->addXu($damager, 10000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->level->addExp($damager, 2000);
$this->bac->addBac($damager, 4000);
$this->stats->addStats($damager, 20);
$damager->sendMessage("§f•§a Nhẫn Giả nhận được:§c 10000§a Xu,§c 40000§a Kinh Nghiệm,§c 4000§a Bạc,§c 20§a Điểm Tiềm Năng");
$this->getServer()->broadcastMessage("§l§c✾§6 Nhẫn Giả §e".$damager->getName()."§6 đã tiêu diệt thành công §l§c【§6AKATSUKI§c】§a ITACHI §eLV 850.");
$level = $boss->getLevel();
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
//$damager
return true;
}
//------------------------------------------------------------------------------------------
if($boss->getName() == "§l§c【§6QUÁI§c】§r§f Baki §eLV 10"){
$this->xu->addXu($damager, 10);
$this->level->addExp($damager, 10);
$damager->sendMessage("§c✿§6 +10 EXP");
$level = $boss->getLevel();
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
//$damager
return true;
}
//------------------------------------------------------------------------------------------
if($boss->getName() == "§l§c【§6QUÁI§c】§r§f Dan_Hyuga §eLV 15"){
	$this->xu->addXu($damager, 20);
$this->level->addExp($damager, 20);
$damager->sendMessage("§c✿§6 +20 EXP");
$level = $boss->getLevel();
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
//$damager
return true;
}
//------------------------------------------------------------------------------------------
if($boss->getName() == "§l§c【§6QUÁI§c】§r§f Fugaku §eLV 20"){
$this->xu->addXu($damager, 50);
$this->level->addExp($damager, 50);
$damager->sendMessage("§c✿§6 +50 EXP");
$level = $boss->getLevel();
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
//$damager
return true;
}
//------------------------------------------------------------------------------------------
if($boss->getName() == "§l§c【§6QUÁI§c】§r§f Hiashi_Hyuga §eLV 30"){
$this->xu->addXu($damager, 80);
$this->level->addExp($damager, 80);
$damager->sendMessage("§c✿§6 +80 EXP");
$level = $boss->getLevel();
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
//$damager
return true;
}
//------------------------------------------------------------------------------------------
if($boss->getName() == "§l§c【§6QUÁI§c】§r§f Hizashi §eLV 40"){
$this->xu->addXu($damager, 100);
$this->level->addExp($damager, 100);
$damager->sendMessage("§c✿§6 +100 EXP");
$level = $boss->getLevel();
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
//$damager
return true;
}
//------------------------------------------------------------------------------------------
if($boss->getName() == "§l§c【§6QUÁI§c】§r§f Nohara_Rin §eLV 50"){
$this->xu->addXu($damager, 130);
$this->level->addExp($damager, 130);
$damager->sendMessage("§c✿§6 +130 EXP");
$level = $boss->getLevel();
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
//$damager
return true;
}
//------------------------------------------------------------------------------------------
if($boss->getName() == "§l§c【§6QUÁI§c】§r§f Shizune §eLV 60"){
$this->xu->addXu($damager, 150);
$this->level->addExp($damager, 150);
$damager->sendMessage("§c✿§6 +150 EXP");
$level = $boss->getLevel();
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
//$damager
return true;
}
//------------------------------------------------------------------------------------------
if($boss->getName() == "§l§c【§6QUÁI§c】§r§f Sát_Nhân §eLV 80"){
$this->xu->addXu($damager, 180);
$this->level->addExp($damager, 180);
$damager->sendMessage("§c✿§6 +180 EXP");
$level = $boss->getLevel();
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
//$damager
return true;
}
//------------------------------------------------------------------------------------------
if($boss->getName() == "§l§c【§6QUÁI§c】§r§f Hyuga §eLV 100"){
$this->xu->addXu($damager, 200);
$this->level->addExp($damager, 200);
$damager->sendMessage("§c✿§6 +200 EXP");
$level = $boss->getLevel();
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
//$damager
return true;
}
//------------------------------------------------------------------------------------------
if($boss->getName() == "§l§c【§6QUÁI§c】§r§f Haku §eLV 150"){
$this->xu->addXu($damager, 250);
$this->level->addExp($damager, 250);
$damager->sendMessage("§c✿§6 +250 EXP");
$level = $boss->getLevel();
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
//$damager
return true;
}
//------------------------------------------------------------------------------------------
}
}
//================================================================================Ghép Đồ GENIN===================================================================
public function onInteract(PlayerInteractEvent $event){
$player = $event->getPlayer();

if($player->getInventory()->getItemInHand()->getCustomName() == "§l§cMảnh Giáp GENIN" && $player->getInventory()->getItemInHand()->getCount() >= 30){
    $giap = Item::get(Item::CHAIN_CHESTPLATE);
    $giap->setCustomName("§r§l§gGIÁP GENIN");
    $giap->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(0), 1));
    $giap->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(1), 1));
    $giap->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(4), 1));
$player->getInventory()->addItem($giap);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 30);
$player->getInventory()->setItemInHand($item);
$player->sendMessage("§f•§aNhẫn Giả Chế Tạo Tự Động Được Giáp GENIN");
return true;
}

if($player->getInventory()->getItemInHand()->getCustomName() == "§l§cMảnh Giày GENIN" && $player->getInventory()->getItemInHand()->getCount() >= 30){
    $giay = Item::get(Item::CHAIN_BOOTS);
    $giay->setCustomName("§r§l§gGIÀY GENIN");
    $giay->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(0), 3));
    $giay->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(1), 1));
    $giay->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(4), 2));
$player->getInventory()->addItem($giay);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 30);
$player->getInventory()->setItemInHand($item);
$player->sendMessage("§f•§aNhẫn Giả Chế Tạo Tự Động Được Giày GENIN");
return true;
}

if($player->getInventory()->getItemInHand()->getCustomName() == "§l§cMảnh Kiếm GENIN" && $player->getInventory()->getItemInHand()->getCount() >= 40){
    $kiem = Item::get(Item::IRON_SWORD);
    $kiem->setCustomName("§r§l§gKIẾM GENIN");
    $kiem->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(9), 2));
    $kiem->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(13), 1));
$player->getInventory()->addItem($kiem);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 40);
$player->getInventory()->setItemInHand($item);
$player->sendMessage("§f•§aNhẫn Giả Chế Tạo Tự Động Được Kiếm GENIN");
return true;
}
if($player->getInventory()->getItemInHand()->getCustomName() == "§l§cMảnh Quần GENIN" && $player->getInventory()->getItemInHand()->getCount() >= 30){
 $quan = Item::get(Item::CHAIN_LEGGINGS);
    $quan->setCustomName("§r§l§gQUẦN GENIN");
    $quan->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(0), 1));
    $quan->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(1), 1));
    $quan->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(4), 1));
	$player->getInventory()->addItem($quan);
$player->sendMessage("§f•§aNhẫn Giả Chế Tạo Tự Động Được Quần GENIN");
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 30);
$player->getInventory()->setItemInHand($item);
return true;
}
if($player->getInventory()->getItemInHand()->getCustomName() == "§l§cMảnh Mũ GENIN" && $player->getInventory()->getItemInHand()->getCount() >= 30){
    $mu = Item::get(Item::CHAIN_HELMET);
    $mu->setCustomName("§r§l§gMŨ GENIN");
    $mu->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(0), 1));
    $mu->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(1), 1));
    $mu->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(4), 1));
	$player->getInventory()->addItem($mu);
$player->sendMessage("§f•§aNhẫn Giả Chế Tạo Tự Động Được Mũ GENIN");
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 30);
$player->getInventory()->setItemInHand($item);
return true;
}
//================================================================================Ghép SHURIKEN========================================================================================
if($player->getInventory()->getItemInHand()->getCustomName() == "§l§cCạnh Nhọn Shuriken" && $player->getInventory()->getItemInHand()->getCount() >= 6){
    $srk = Item::get(332, 0, 1);
    $srk->setCustomName("§r§aShuriken");
	$player->getInventory()->addItem($srk);
$player->sendMessage("§f•§aNhẫn Giả Chế Tạo Tự Động Được 1 Shuriken");
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 6);
$player->getInventory()->setItemInHand($item);
return true;
}
//=============================================================================Ghép Đồ ANBU===========================================================================================
if($player->getInventory()->getItemInHand()->getCustomName() == "§l§eMảnh Giày ANBU" && $player->getInventory()->getItemInHand()->getCount() >= 50){
    $giay = Item::get(Item::IRON_BOOTS);
    $giay->setCustomName("§r§l§gGIÀY ANBU");
    $giay->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(0), 5));
    $giay->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(1), 3));
    $giay->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(4), 4));
    $giay->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(5), 2));
$player->getInventory()->addItem($giay);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 50);
$player->getInventory()->setItemInHand($item);
$player->sendMessage("§f•§aNhẫn Giả Chế Tạo Tự Động Được Giày ANBU");
return true;
}
if($player->getInventory()->getItemInHand()->getCustomName() == "§l§eMảnh Kiếm ANBU" && $player->getInventory()->getItemInHand()->getCount() >= 60){
  $kiem = Item::get(Item::IRON_SWORD);
  $kiem->setCustomName("§r§l§gKIẾM ANBU");
  $kiem->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(26), 1));
  $kiem->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(9), 5));
    $kiem->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(13), 5));
$player->getInventory()->addItem($kiem);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 60);
$player->getInventory()->setItemInHand($item);
$player->sendMessage("§f•§aNhẫn Giả Chế Tạo Tự Động Được Kiếm ANBU");
return true;
}
if($player->getInventory()->getItemInHand()->getCustomName() == "§l§eMảnh Giáp ANBU" && $player->getInventory()->getItemInHand()->getCount() >= 50){
    $giap = Item::get(Item::IRON_CHESTPLATE);
    $giap->setCustomName("§r§l§gGIÁP ANBU");
    $giap->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(0), 1));
    $giap->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(1), 1));
    $giap->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(4), 1));
    $giap->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(5), 1));
$player->getInventory()->addItem($giap);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 50);
$player->getInventory()->setItemInHand($item);
$player->sendMessage("§f•§aNhẫn Giả Chế Tạo Tự Động Được Giáp ANBU");
return true;
}
if($player->getInventory()->getItemInHand()->getCustomName() == "§l§eMảnh Quần ANBU" && $player->getInventory()->getItemInHand()->getCount() >= 50){
    $quan = Item::get(Item::IRON_LEGGINGS);
    $quan->setCustomName("§r§l§gQUẦN ANBU");
    $quan->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(0), 1));
    $quan->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(1), 1));
    $quan->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(4), 1));
    $quan->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(5), 1));
	$player->getInventory()->addItem($quan);
$player->sendMessage("§f•§aNhẫn Giả Chế Tạo Tự Động Được Quần ANBU");
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 50);
$player->getInventory()->setItemInHand($item);
return true;
}
if($player->getInventory()->getItemInHand()->getCustomName() == "§l§eMảnh Mũ ANBU" && $player->getInventory()->getItemInHand()->getCount() >= 50){
    $mu = Item::get(Item::IRON_HELMET);
    $mu->setCustomName("§r§l§gMŨ ANBU");
    $mu->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(0), 1));
    $mu->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(1), 1));
    $mu->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(4), 1));
    $mu->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(5), 1));
	$player->getInventory()->addItem($mu);
$player->sendMessage("§f•§aNhẫn Giả Chế Tạo Tự Động Được Mũ ANBU");
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 50);
$player->getInventory()->setItemInHand($item);
return true;
}

if($player->getInventory()->getItemInHand()->getCustomName() == "§l§eMảnh Kiếm ANBU" && $player->getInventory()->getItemInHand()->getCount() >= 50){
  $kiem = Item::get(Item::IRON_SWORD);
  $kiem->setCustomName("§r§l§gKIẾM ANBU");
  $kiem->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(26), 1));
  $kiem->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(9), 5));
    $kiem->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(13), 5));
	    $player->getInventory()->addItem($kiem);
$player->sendMessage("§f•§aNhẫn Giả Chế Tạo Tự Động Được Kiếm ANBU");
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 50);
$player->getInventory()->setItemInHand($item);
return true;
}
//============================================================================Vật Phẩm SK Mở Open============================================================================================
if($player->getInventory()->getItemInHand()->getCustomName() == "§r§aBùa Nổ" && $player->getInventory()->getItemInHand()->getCount() >= 10){
    $bn = Item::get(378, 0, 1);
    $bn->setCustomName("§l§cĐan Chakra Tổng - Nổ");
    $bn->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 9));
		$player->getInventory()->addItem($bn);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 10);
$player->getInventory()->setItemInHand($item);
$player->sendMessage("§f•§aNhẫn đã dùng 5 bùa nổ đổi 1 Đan Chakra Tổng - Nổ");
return true;
}
//==========================================================================Ghép Đồ HOKAGE==============================================================================================
if($player->getInventory()->getItemInHand()->getCustomName() == "§l§cMảnh Mũ HOKAGE" && $player->getInventory()->getItemInHand()->getCount() >= 64){
    $mu = Item::get(Item::DIAMOND_HELMET);
    $mu->setCustomName("§r§l§cMŨ HOKAGE");
    $mu->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(0), 20));
    $mu->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(1), 8));
    $mu->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(4), 9));
    $mu->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(5), 10));
		$player->getInventory()->addItem($mu);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 64);
$player->getInventory()->setItemInHand($item);
$player->sendMessage("§f•§aNhẫn Giả Chế Tạo Tự Động Được Mũ HOKAGE");
return true;
}


if($player->getInventory()->getItemInHand()->getCustomName() == "§l§cMảnh Quần HOKAGE" && $player->getInventory()->getItemInHand()->getCount() >= 64){
    $quan = Item::get(Item::DIAMOND_LEGGINGS);
    $quan->setCustomName("§r§l§cQUẦN HOKAGE");
    $quan->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(0), 20));
    $quan->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(1), 8));
    $quan->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(4), 9));
    $quan->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(5), 10));
	$player->getInventory()->addItem($quan);
$player->sendMessage("§f•§aNhẫn Giả Chế Tạo Tự Động Được Quần HOKAGE");
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 64);
$player->getInventory()->setItemInHand($item);
return true;
}


if($player->getInventory()->getItemInHand()->getCustomName() == "§l§cMảnh Giáp HOKAGE" && $player->getInventory()->getItemInHand()->getCount() >= 64){
    $giap = Item::get(Item::DIAMOND_CHESTPLATE);
    $giap->setCustomName("§r§l§cGIÁP HOKAGE");
    $giap->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(0), 20));
    $giap->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(1), 8));
    $giap->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(4), 9));
    $giap->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(5), 10));
	$player->getInventory()->addItem($giap);
$player->sendMessage("§f•§aNhẫn Giả Chế Tạo Tự Động Được Giáp HOKAGE");
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 64);
$player->getInventory()->setItemInHand($item);
return true;
}


if($player->getInventory()->getItemInHand()->getCustomName() == "§l§cMảnh Giày HOKAGE" && $player->getInventory()->getItemInHand()->getCount() >= 64){
    $giay = Item::get(Item::DIAMOND_BOOTS);
    $giay->setCustomName("§r§l§cGIÀY HOKAGE");
    $giay->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(0), 20));
    $giay->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(1), 8));
    $giay->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(4), 9));
    $giay->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(5), 10));
	$player->getInventory()->addItem($giay);
$player->sendMessage("§f•§aNhẫn Giả Chế Tạo Tự Động Được Giày HOKAGE");
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 64);
$player->getInventory()->setItemInHand($item);
return true;
}
//=============================================================================Ghép Đồ JONIN===========================================================================================
if($player->getInventory()->getItemInHand()->getCustomName() == "§l§cMảnh Giáp JONIN" && $player->getInventory()->getItemInHand()->getCount() >= 40){
    $giap = Item::get(Item::CHAIN_CHESTPLATE);
    $giap->setCustomName("§r§l§gGIÁP JONIN");
    $giap->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(0), 5));
    $giap->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(1), 3));
    $giap->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(4), 4));
    $giap->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(5), 2));
$player->getInventory()->addItem($giap);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 40);
$player->getInventory()->setItemInHand($item);
$player->sendMessage("§f•§aNhẫn Giả Chế Tạo Tự Động Được Giáp JONIN");
return true;
}

if($player->getInventory()->getItemInHand()->getCustomName() == "§l§cMảnh Giày JONIN" && $player->getInventory()->getItemInHand()->getCount() >= 40){
    $giay = Item::get(Item::CHAIN_BOOTS);
    $giay->setCustomName("§r§l§gGIÀY JONIN");
    $giay->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(0), 5));
    $giay->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(1), 3));
    $giay->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(4), 4));
    $giay->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(5), 2));
$player->getInventory()->addItem($giay);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 40);
$player->getInventory()->setItemInHand($item);
$player->sendMessage("§f•§aNhẫn Giả Chế Tạo Tự Động Được Giày JONIN");
return true;
}

if($player->getInventory()->getItemInHand()->getCustomName() == "§l§cMảnh Kiếm JONIN" && $player->getInventory()->getItemInHand()->getCount() >= 50){
    $kiem = Item::get(Item::IRON_SWORD);
    $kiem->setCustomName("§r§l§gKIẾM JONIN");
    $kiem->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(9), 4));
    $kiem->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(13), 3));
$player->getInventory()->addItem($kiem);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 50);
$player->getInventory()->setItemInHand($item);
$player->sendMessage("§f•§aNhẫn Giả Chế Tạo Tự Động Được Kiếm JONIN");
return true;
}
if($player->getInventory()->getItemInHand()->getCustomName() == "§l§cMảnh Quần JONIN" && $player->getInventory()->getItemInHand()->getCount() >= 40){
    $quan = Item::get(Item::CHAIN_LEGGINGS);
    $quan->setCustomName("§r§l§gQUẦN JONIN");
    $quan->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(0), 5));
    $quan->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(1), 3));
    $quan->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(4), 4));
    $quan->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(5), 2));
	$player->getInventory()->addItem($quan);
$player->sendMessage("§f•§aNhẫn Giả Chế Tạo Tự Động Được Quần JONIN");
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 40);
$player->getInventory()->setItemInHand($item);
return true;
}
if($player->getInventory()->getItemInHand()->getCustomName() == "§l§cMảnh Mũ JONIN" && $player->getInventory()->getItemInHand()->getCount() >= 40){
    $mu = Item::get(Item::CHAIN_HELMET);
    $mu->setCustomName("§r§l§gMŨ JONIN");
    $mu->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(0), 5));
    $mu->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(1), 3));
    $mu->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(4), 4));
    $mu->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(5), 2));
	$player->getInventory()->addItem($mu);
$player->sendMessage("§f•§aNhẫn Giả Chế Tạo Tự Động Được Mũ JONIN");
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 40);
$player->getInventory()->setItemInHand($item);
return true;
}
//================================================================================Vật Phẩm Sự Kiện===================================================================== 
//==================================================================================Ngọc Nhiệm Vụ======================================================================================
if($player->getInventory()->getItemInHand()->getCustomName() == "§l§cMảnh Ngọc Giải Cứu Kazekage" && $player->getInventory()->getItemInHand()->getCount() >= 10){
$dc = Item::get(Item::EMERALD, 0, 1);
$dc->setCustomName("§r§c•§a Giải Cứu Kazekage §c•§b Sasori");
$player->getInventory()->addItem($dc);
$player->sendMessage("§f•§a+1 Ngọc Dịch Chuyển Nhiệm Vụ.");
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 10);
$player->getInventory()->setItemInHand($item);
return true;
}

//=============================================================================Ghép Đồ AKATSUKI===========================================================================================
if($player->getInventory()->getItemInHand()->getCustomName() == "§l§cMảnh Mũ AKATSUKI" && $player->getInventory()->getItemInHand()->getCount() >= 63){
    $mu = Item::get(Item::GOLD_HELMET);
    $mu->setCustomName("§r§l§cMŨ AKATSUKI");
    $mu->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(0), 10));
    $mu->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(1), 3));
    $mu->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(4), 4));
    $mu->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(5), 5));
		$player->getInventory()->addItem($mu);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 63);
$player->getInventory()->setItemInHand($item);
$player->sendMessage("§f•§aNhẫn Giả Chế Tạo Tự Động Được Mũ AKATSUKI");
return true;
}


if($player->getInventory()->getItemInHand()->getCustomName() == "§l§cMảnh Quần AKATSUKI" && $player->getInventory()->getItemInHand()->getCount() >= 63){
    $quan = Item::get(Item::GOLD_LEGGINGS);
    $quan->setCustomName("§r§l§cQUẦN AKATSUKI");
    $quan->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(0), 10));
    $quan->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(1), 3));
    $quan->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(4), 4));
    $quan->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(5), 5));
	$player->getInventory()->addItem($quan);
$player->sendMessage("§f•§aNhẫn Giả Chế Tạo Tự Động Được Quần AKATSUKI");
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 63);
$player->getInventory()->setItemInHand($item);
return true;
}


if($player->getInventory()->getItemInHand()->getCustomName() == "§l§cMảnh Giáp AKATSUKI" && $player->getInventory()->getItemInHand()->getCount() >= 63){
    $giap = Item::get(Item::GOLD_CHESTPLATE);
    $giap->setCustomName("§r§l§cGIÁP AKATSUKI");
    $giap->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(0), 10));
    $giap->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(1), 3));
    $giap->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(4), 4));
    $giap->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(5), 5));
	$player->getInventory()->addItem($giap);
$player->sendMessage("§f•§aNhẫn Giả Chế Tạo Tự Động Được Giáp AKATSUKI");
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 63);
$player->getInventory()->setItemInHand($item);
return true;
}


if($player->getInventory()->getItemInHand()->getCustomName() == "§l§cMảnh Giày AKATSUKI" && $player->getInventory()->getItemInHand()->getCount() >= 63){
    $giay = Item::get(Item::GOLD_BOOTS);
    $giay->setCustomName("§r§l§cGIÀY AKATSUKI");
    $giay->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(0), 10));
    $giay->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(1), 3));
    $giay->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(4), 4));
    $giay->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(5), 5));
	$player->getInventory()->addItem($giay);
$player->sendMessage("§f•§aNhẫn Giả Chế Tạo Tự Động Được Giày AKATSUKI");
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 63);
$player->getInventory()->setItemInHand($item);
return true;
}
//========================================================================Ám bộ===========================================================================================
if($player->getInventory()->getItemInHand()->getCustomName() == "§l§c~!§e Sách Ám Bộ§c !~"){
$player->sendMessage("§f•§aNhẫn Giả sử dụng thành công §l§c~!§e Sách Ám Bộ§c !~\n§f•§a 10 Vàng\n\n§f•§a 30 Bạc\n\n§f•§a 100 Điểm Ám Bộ\n\n§f•§a 30 Điểm Chakra Tổng\n\n");
$this->getServer()->broadcastMessage("§l§c✾§6 Nhẫn Giả §e".$player->getName()."§6 đã mở §l§c~!§e Sách Ám Bộ§c !~§6 tăng Sức Mạnh thật kinh khủng. Không ai sánh bằng");
$this->vang->addVang($player, 5);
$this->bac->addBac($player, 30);
$this->ambo->addAmbo($player, 100);
$this->chakra->addChakra($player, 30);
$this->sm->addSucManh($player, 100000);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 1);
$player->getInventory()->setItemInHand($item);
return true;
}
if($player->getInventory()->getItemInHand()->getCustomName() == "§l§c~!§e Sách Ám Bộ§a Bậc S§c !~"){
$player->sendMessage("§f•§aNhẫn Giả sử dụng thành công §l§c~!§e Sách Ám Bộ§c !~\n§f•§a 50 Vàng\n\n§f•§a 100 Bạc\n\n§f•§a 500 Điểm Ám Bộ\n\n§f•§a 100 Điểm Chakra Tổng\n\n");
$this->getServer()->broadcastMessage("§l§c✾§6 Nhẫn Giả §e".$player->getName()."§6 đã mở §l§c~!§e Sách Ám Bộ§a Bậc S§c !~§6 tăng Sức Mạnh thật kinh khủng. Không ai sánh bằng");
$this->vang->addVang($player, 15);
$this->bac->addBac($player, 100);
$this->ambo->addAmbo($player, 500);
$this->chakra->addChakra($player, 100);
$this->sm->addSucManh($player, 500000);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 1);
$player->getInventory()->setItemInHand($item);
return true;
}
if($player->getInventory()->getItemInHand()->getCustomName() == "§l§c~!§e Sách Ám Bộ§a Bậc Ss§c !~"){
$player->sendMessage("§f•§aNhẫn Giả sử dụng thành công §l§c~!§e Sách Ám Bộ§c !~\n§f•§a 40 Vàng\n\n§f•§a 200 Bạc\n\n§f•§a 1000 Điểm Ám Bộ\n\n§f•§a 200 Điểm Chakra Tổng\n\n");
$this->getServer()->broadcastMessage("§l§c✾§6 Nhẫn Giả §e".$player->getName()."§6 đã mở §l§c~!§e Sách Ám Bộ§a Bậc Ss§c !~§6 tăng Sức Mạnh thật kinh khủng. Không ai sánh bằng");
$this->vang->addVang($player, 20);
$this->bac->addBac($player, 200);
$this->ambo->addAmbo($player, 1000);
$this->chakra->addChakra($player, 200);
$this->sm->addSucManh($player, 1000000);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 1);
$player->getInventory()->setItemInHand($item);
return true;
}
}


}
