<?php

namespace DVT;

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
$this->mana = $this->getServer()->getPluginManager()->getPlugin("NGVS_Mana");
$this->xu = $this->getServer()->getPluginManager()->getPlugin("NGVS_Xu");
$this->bac = $this->getServer()->getPluginManager()->getPlugin("NGVS_Bac");
$this->vang= $this->getServer()->getPluginManager()->getPlugin("NGVS_Vang");
$this->sm= $this->getServer()->getPluginManager()->getPlugin("NGVS_SucManh");
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
if($boss->getName() == "§l§c【§6NHẤT VĨ§c】§a SHUKAKU"){
$this->xu->addXu($damager, 9999);
$this->level->addExp($damager, 5000);
$this->bac->addBac($damager, 100);
$this->stats->addStats($damager, 5);
$this->chakra->addChakra($damager, 500);
$nhatvi = Item::get(370, 0, 2);
$nhatvi->setCustomName("§r§cMảnh Hồn §aNhất Vĩ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 1));
$damager->getInventory()->addItem($nhatvi);
$this->getServer()->broadcastMessage("§l§c✾§6 Nhẫn Giả §e".$damager->getName()."§6 đã tiêu diệt thành công NHẤT VĨ.");
$level = $boss->getLevel();
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$damager->sendMessage("§f•§a Nhẫn Giả nhận được:§c 9.999§a Xu,§c 5.000§a Kinh Nghiệm,§c 100§a Bạc,§c 5§a Điểm Tiềm Năng,§c 500§a Điểm Chakra Tổng, §l§b2 MẢNH HỒN NHẤT VĨ");
return true;
}
if($boss->getName() == "§l§c【§6NHỊ VĨ§c】§a NEKOMATA"){
$this->xu->addXu($damager, 9999);
$this->level->addExp($damager, 10000);
$this->bac->addBac($damager, 500);
$this->stats->addStats($damager, 10);
$this->chakra->addChakra($damager, 800);
$nhatvi = Item::get(370, 0, 3);
$damager->sendMessage("§f•§a Nhẫn Giả nhận được:§c 9.999§a Xu,§c 10.000§a Kinh Nghiệm,§c 500§a Bạc,§c 10§a Điểm Tiềm Năng,§c 800§a Điểm Chakra Tổng, §l§b3 MẢNH HỒN NHỊ VĨ");
$nhatvi->setCustomName("§r§cMảnh Hồn §aNhị Vĩ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 2));
$damager->getInventory()->addItem($nhatvi);
$this->getServer()->broadcastMessage("§l§c✾§6 Nhẫn Giả §e".$damager->getName()."§6 đã tiêu diệt thành công NHỊ VĨ.");
$level = $boss->getLevel();
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
return true;
}
if($boss->getName() == "§l§c【§6TAM VĨ§c】§a ISONADE"){
$this->xu->addXu($damager, 9999);
$this->level->addExp($damager, 10000);
$this->bac->addBac($damager, 600);
$this->stats->addStats($damager, 10);
$nhatvi = Item::get(370, 0, 1);
$damager->sendMessage("§f•§a Nhẫn Giả nhận được:§c 9.999§a Xu,§c 10.000§a Kinh Nghiệm,§c 600§a Bạc,§c 10§a Điểm Tiềm Năng, §l§b1 MẢNH HỒN TAM VĨ");
$nhatvi->setCustomName("§r§cMảnh Hồn §aTam Vĩ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 3));
$damager->getInventory()->addItem($nhatvi);
$this->getServer()->broadcastMessage("§l§c✾§6 Nhẫn Giả §e".$damager->getName()."§6 đã tiêu diệt thành công TAM VĨ.");
$level = $boss->getLevel();
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
return true;
}
if($boss->getName() == "§l§c【§6TỨ VĨ§c】§a SOKOU"){
$this->xu->addXu($damager, 9999);
$this->level->addExp($damager, 10000);
$this->bac->addBac($damager, 100);
$this->stats->addStats($damager, 5);
$this->vang->addVang($damager, 10);
$nhatvi = Item::get(370, 0, 3);
$nhatvi->setCustomName("§r§cMảnh Hồn §aTứ Vĩ");
$damager->sendMessage("§f•§a Nhẫn Giả nhận được:§c 9.999§a Xu,§c 10.000§a Kinh Nghiệm,§c 100§a Bạc,§c 10§a Vàng,§c 5§a Điểm Tiềm Năng, §l§b3 MẢNH HỒN TỨ VĨ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 4));
$damager->getInventory()->addItem($nhatvi);
$this->getServer()->broadcastMessage("§l§c✾§6 Nhẫn Giả §e".$damager->getName()."§6 đã tiêu diệt thành công TỨ VĨ.");
$level = $boss->getLevel();
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
return true;
}
if($boss->getName() == "§l§c【§6NGŨ VĨ§c】§a KOKUOU"){
$this->xu->addXu($damager, 99999);
$this->level->addExp($damager, 30000);
$this->bac->addBac($damager, 1000);
$this->stats->addStats($damager, 20);
$nhatvi = Item::get(370, 0, 1);
$nhatvi->setCustomName("§r§cMảnh Hồn §aNgũ Vĩ");
$damager->sendMessage("§f•§a Nhẫn Giả nhận được:§c 99.999§a Xu,§c 30.000§a Kinh Nghiệm,§c 1000§a Bạc,§c 20§a Điểm Tiềm Năng, §l§b1 MẢNH HỒN NGŨ VĨ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 5));
$damager->getInventory()->addItem($nhatvi);
$this->getServer()->broadcastMessage("§l§c✾§6 Nhẫn Giả §e".$damager->getName()."§6 đã tiêu diệt thành công NGŨ VĨ.");
$level = $boss->getLevel();
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
return true;
}
if($boss->getName() == "§l§c【§6LỤC VĨ§c】§a RAIJUU"){
$this->xu->addXu($damager, 99999);
$this->level->addExp($damager, 40000);
$this->bac->addBac($damager, 1500);
$this->stats->addStats($damager, 20);
$nhatvi = Item::get(370, 0, 1);
$damager->sendMessage("§f•§a Nhẫn Giả nhận được:§c 99.999§a Xu,§c 40.000§a Kinh Nghiệm,§c 1500§a Bạc,§c 20§a Điểm Tiềm Năng, §l§b1 MẢNH HỒN LỤC VĨ");
$nhatvi->setCustomName("§r§cMảnh Hồn §aLục Vĩ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 6));
$damager->getInventory()->addItem($nhatvi);
$this->getServer()->broadcastMessage("§l§c✾§6 Nhẫn Giả §e".$damager->getName()."§6 đã tiêu diệt thành công LỤC VĨ.");
$level = $boss->getLevel();
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
return true;
}
if($boss->getName() == "§l§c【§6THẤT VĨ§c】§a KAKU"){
$this->xu->addXu($damager, 99999);
$this->level->addExp($damager, 50000);
$this->bac->addBac($damager, 2000);
$this->stats->addStats($damager, 25);
$nhatvi = Item::get(370, 0, 1);
$nhatvi->setCustomName("§r§cMảnh Hồn §aThất Vĩ");
$damager->sendMessage("§f•§a Nhẫn Giả nhận được:§c 99.999§a Xu,§c 50.000§a Kinh Nghiệm,§c 2000§a Bạc,§c 25§a Điểm Tiềm Năng, §l§b1 MẢNH HỒN THẤT VĨ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 7));
$damager->getInventory()->addItem($nhatvi);
$this->getServer()->broadcastMessage("§l§c✾§6 Nhẫn Giả §e".$damager->getName()."§6 đã tiêu diệt thành công THẤT VĨ.");
$level = $boss->getLevel();
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
return true;
}
/*Nhất Vĩ:
Ảo Hóa Nhất Vĩ, 9.999Xu, 5.000 EXP, 100 Bạc, 5 Điểm Tiềm Năng, Ngẫu nhiên rơi set đồ Genin
Nhị Vĩ:
Ảo Hóa Nhị Vị, 9.999Xu, 10.000 EXP, 500 Bạc, 10 Điểm Tiềm Năng, Ngẫu nhiên rơi set đồ Genin
Tứ Vĩ:
Ảo Hóa Tứ Vĩ, 9.999Xu, 20.000 EXP, 800 Bạc, 15 Điểm Tiềm Năng
Ngũ Vĩ:
Ảo Hóa Ngũ Vĩ, 99.999Xu, 30.000 EXP, 1.000 Bạc, 20 Điểm Tiềm Năng
Thất Vĩ:
Ảo Hóa Thất Vĩ, 99.999Xu, 50.000 EXP, 2.000 Bạc, 25 Điểm Tiềm Nằn
Bát Vĩ:
Ảo Hóa Bát Vĩ, 99.999 Xu, 80.000 EXP, 3.000 Bạc, 40 Điểm Tiềm Năng, Ngẫu nhiên rơi set đồ Kage, Phong Bộ
Cửu Vĩ:
Ảo Hóa Cửu Vĩ, 999.999 Xu, 90.000 EXP, 4.000 Bạc, 50 Điểm Tiềm Năng, Ngẫu nhiên rơi set đồ Lục Đạo, Hỏa Bộ*/
if($boss->getName() == "§l§c【§6BÁT VĨ§c】§a HACHIBI"){
$this->xu->addXu($damager, 99999);
$this->level->addExp($damager, 80000);
$this->bac->addBac($damager, 3000);
$this->stats->addStats($damager, 40);
$nhatvi = Item::get(370, 0, 1);
$nhatvi->setCustomName("§r§cMảnh Hồn §aBát Vĩ");
$damager->sendMessage("§f•§a Nhẫn Giả nhận được:§c 99.999§a Xu,§c 80.000§a Kinh Nghiệm,§c 3000§a Bạc,§c 40§a Điểm Tiềm Năng, §l§b1 MẢNH HỒN BÁT VĨ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 8));
$damager->getInventory()->addItem($nhatvi);
$this->getServer()->broadcastMessage("§l§c✾§6 Nhẫn Giả §e".$damager->getName()."§6 đã tiêu diệt thành công BÁT VĨ.");
$level = $boss->getLevel();
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
return true;
}
if($boss->getName() == "§l§c【§6CỬU VĨ§c】§a KURAMA"){
$this->xu->addXu($damager, 999999);
$this->level->addExp($damager, 20000);
$this->bac->addBac($damager, 3000);
$this->stats->addStats($damager, 50);
$nhatvi = Item::get(370, 0, 5);
$nhatvi->setCustomName("§r§cMảnh Hồn §aCửu Vĩ");
$damager->sendMessage("§f•§a Nhẫn Giả nhận được:§c 999.999§a Xu,§c 2000§a Kinh Nghiệm,§c 3000§a Bạc,§c 50§a Điểm Tiềm Năng, §l§b5 MẢNH HỒN CỬU VĨ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 9));
$damager->getInventory()->addItem($nhatvi);
$this->getServer()->broadcastMessage("§l§c✾§6 Nhẫn Giả §e".$damager->getName()."§6 đã tiêu diệt thành công CỬU VĨ.");
$level = $boss->getLevel();
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
$level->addParticle(new HugeExplodeSeedParticle($boss->getPosition()));
//$damager
return true;
}

}
}
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------
public function onInteract(PlayerInteractEvent $event){
$player = $event->getPlayer();
if($player->getInventory()->getItemInHand()->getCustomName() == "§r§cMảnh Hồn §aNhất Vĩ" && $player->getInventory()->getItemInHand()->getCount() >= 30){
$this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setuperm ".$player->getName()." shukaku.aohoa.vithu");
$this->sm->addSucmanh($player, 20000);
$this->getServer()->broadcastMessage("§l§f❖§a NHẪN GIẢ §c".$player->getName()."§a ĐÃ PHONG ẤN THÀNH CÔNG §cNHẤT VĨ§a VÀO CƠ THỂ!");
$player->sendMessage("§f•§a Hãy sử dụng§c /aohoa§a để biến thân thành Shukaku\n§f•§a +20000 Sức Mạnh");
$this->stats->upgradeHealth($player);
$player->setMaxHealth($this->stats->getCurrentHealth($player)*7);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 30);
$player->getInventory()->setItemInHand($item);
return true;

}
if($player->getInventory()->getItemInHand()->getCustomName() == "§r§cMảnh Hồn §aNhị Vĩ" && $player->getInventory()->getItemInHand()->getCount() >= 30){
$this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setuperm ".$player->getName()." matatabi.aohoa.vithu");
$this->sm->addSucmanh($player, 40000);
$this->getServer()->broadcastMessage("§l§f❖§a NHẪN GIẢ §c".$player->getName()."§a ĐÃ PHONG ẤN THÀNH CÔNG §cNHỊ VĨ§a VÀO CƠ THỂ!");
$player->sendMessage("§f•§a Hãy sử dụng§c /aohoa§a để biến thân thành Matatabi\n§f•§a +40000 Sức Mạnh");
$this->stats->upgradeHealth($player);
$player->setMaxHealth($this->stats->getCurrentHealth($player)*7);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 30);
$player->getInventory()->setItemInHand($item);
return true;
}
if($player->getInventory()->getItemInHand()->getCustomName() == "§r§cMảnh Hồn §aTam Vĩ" && $player->getInventory()->getItemInHand()->getCount() >= 35){
$this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setuperm ".$player->getName()." isobu.aohoa.vithu");
$this->sm->addSucmanh($player, 60000);
$this->getServer()->broadcastMessage("§l§f❖§a NHẪN GIẢ §c".$player->getName()."§a ĐÃ PHONG ẤN THÀNH CÔNG §cTAM VĨ§a VÀO CƠ THỂ!");
$player->sendMessage("§f•§a Hãy sử dụng§c /aohoa§a để biến thân thành Isobu\n§f•§a +60000 Sức Mạnh");
$this->stats->upgradeHealth($player);
$player->setMaxHealth($this->stats->getCurrentHealth($player)*7);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 35);
$player->getInventory()->setItemInHand($item);
return true;
}
if($player->getInventory()->getItemInHand()->getCustomName() == "§r§cMảnh Hồn §aTứ Vĩ" && $player->getInventory()->getItemInHand()->getCount() >= 40){
$this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setuperm ".$player->getName()." son_goku.aohoa.vithu");
$this->sm->addSucmanh($player, 80000);
$this->getServer()->broadcastMessage("§l§f❖§a NHẪN GIẢ §c".$player->getName()."§a ĐÃ PHONG ẤN THÀNH CÔNG §cTỨ VĨ§a VÀO CƠ THỂ!");
$player->sendMessage("§f•§a Hãy sử dụng§c /aohoa§a để biến thân thành Songoku\n§f•§a +80000 Sức Mạnh");
$this->stats->upgradeHealth($player);
$player->setMaxHealth($this->stats->getCurrentHealth($player)*8);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 40);
$player->getInventory()->setItemInHand($item);
return true;
}
if($player->getInventory()->getItemInHand()->getCustomName() == "§r§cMảnh Hồn §aNgũ Vĩ" && $player->getInventory()->getItemInHand()->getCount() >= 40){
$this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setuperm ".$player->getName()." kokuou.aohoa.vithu");
$this->sm->addSucmanh($player, 100000);
$this->getServer()->broadcastMessage("§l§f❖§a NHẪN GIẢ §c".$player->getName()."§a ĐÃ PHONG ẤN THÀNH CÔNG §cNGŨ VĨ§a VÀO CƠ THỂ!");
$player->sendMessage("§f•§a Hãy sử dụng§c /aohoa§a để biến thân thành Kokuou\n§f•§a +100000 Sức Mạnh");
$this->stats->upgradeHealth($player);
$player->setMaxHealth($this->stats->getCurrentHealth($player)*10);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 40);
$player->getInventory()->setItemInHand($item);
return true;
}
if($player->getInventory()->getItemInHand()->getCustomName() == "§r§cMảnh Hồn §aLục Vĩ" && $player->getInventory()->getItemInHand()->getCount() >= 40){
$this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setuperm ".$player->getName()." juubi.aohoa.vithu");
$this->sm->addSucmanh($player, 120000);
$this->getServer()->broadcastMessage("§l§f❖§a NHẪN GIẢ §c".$player->getName()."§a ĐÃ PHONG ẤN THÀNH CÔNG §cLỤC VĨ§a VÀO CƠ THỂ!");
$player->sendMessage("§f•§a Hãy sử dụng§c /aohoa§a để biến thân thành Juubi\n§f•§a +120000 Sức Mạnh");
$this->stats->upgradeHealth($player);
$player->setMaxHealth($this->stats->getCurrentHealth($player)*11);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 40);
$player->getInventory()->setItemInHand($item);
return true;
}
if($player->getInventory()->getItemInHand()->getCustomName() == "§r§cMảnh Hồn §aThất Vĩ" && $player->getInventory()->getItemInHand()->getCount() >= 45){
$this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setuperm ".$player->getName()." chomei.aohoa.vithu");
$this->sm->addSucmanh($player, 140000);
$this->getServer()->broadcastMessage("§l§f❖§a NHẪN GIẢ §c".$player->getName()."§a ĐÃ PHONG ẤN THÀNH CÔNG §cTHẤT VĨ§a VÀO CƠ THỂ!");
$player->sendMessage("§f•§a Hãy sử dụng§c /aohoa§a để biến thân thành Chomei\n§f•§a +140000 Sức Mạnh");
$this->stats->upgradeHealth($player);
$player->setMaxHealth($this->stats->getCurrentHealth($player)*12);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 35);
$player->getInventory()->setItemInHand($item);
return true;
}
if($player->getInventory()->getItemInHand()->getCustomName() == "§r§cMảnh Hồn §aBát Vĩ" && $player->getInventory()->getItemInHand()->getCount() >= 50){
$this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setuperm ".$player->getName()." giuki.aohoa.vithu");
$this->sm->addSucmanh($player, 160000);
$this->getServer()->broadcastMessage("§l§f❖§a NHẪN GIẢ §c".$player->getName()."§a ĐÃ PHONG ẤN THÀNH CÔNG §cBÁT VĨ§a VÀO CƠ THỂ!");
$player->sendMessage("§f•§a Hãy sử dụng§c /aohoa§a để biến thân thành Giuki\n§f•§a +160000 Sức Mạnh");
$this->stats->upgradeHealth($player);
$player->setMaxHealth($this->stats->getCurrentHealth($player)*14);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 40);
$player->getInventory()->setItemInHand($item);
return true;
}
if($player->getInventory()->getItemInHand()->getCustomName() == "§r§cMảnh Hồn §aCửu Vĩ" && $player->getInventory()->getItemInHand()->getCount() >= 50){
$this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setuperm ".$player->getName()." kurama.aohoa.vithu");
$this->sm->addSucmanh($player, 180000);
$this->getServer()->broadcastMessage("§l§f❖§a NHẪN GIẢ §c".$player->getName()."§a ĐÃ PHONG ẤN THÀNH CÔNG §cCỬU VĨ§a VÀO CƠ THỂ!");
$player->sendMessage("§f•§a Hãy sử dụng§c /aohoa§a để biến thân thành Kurama\n§f•§a +180000 Sức Mạnh");
$this->stats->upgradeHealth($player);
$this->stats->upgradeHealth($player);
$player->setMaxHealth($this->stats->getCurrentHealth($player)*15);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 50);
$player->getInventory()->setItemInHand($item);
return true;
}

if($player->getInventory()->getItemInHand()->getCustomName() == "§r§cMảnh Hồn §aCửu Vĩ_Chakra" && $player->getInventory()->getItemInHand()->getCount() >= 64){
$this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setuperm ".$player->getName()." kurama_chakra.aohoa.vithu");
$this->sm->addSucmanh($player, 200000);
$this->getServer()->broadcastMessage("§l§f❖§a NHẪN GIẢ §c".$player->getName()."§a ĐÃ PHONG ẤN THÀNH CÔNG §cCỬU VĨ CHAKRA§a VÀO CƠ THỂ!");
$player->sendMessage("§f•§a Hãy sử dụng§c /aohoa§a để biến thân thành Kurama_Chakra\n§f•§a +200000 Sức Mạnh");
$this->stats->upgradeHealth($player);
$this->stats->upgradeHealth($player);
$player->setMaxHealth($this->stats->getCurrentHealth($player)*30);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$this->stats->upgradeDamage($player);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() - 64);
$player->getInventory()->setItemInHand($item);
return true;
}


}


}