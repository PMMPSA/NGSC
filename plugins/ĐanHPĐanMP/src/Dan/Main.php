<?php

namespace Dan;

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
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\network\protocol\SetTitlePacket;

class Main extends PluginBase implements Listener{
public function onEnable(){
$this->getServer()->getPluginManager()->registerEvents($this, $this);
$this->chakra = $this->getServer()->getPluginManager()->getPlugin("NGVS_Mana");
$this->ck = $this->getServer()->getPluginManager()->getPlugin("NGVS_DCK");
$this->stats = $this->getServer()->getPluginManager()->getPlugin("NGVS_Stats");
$this->bac = $this->getServer()->getPluginManager()->getPlugin("NGVS_Bac");
$this->vang = $this->getServer()->getPluginManager()->getPlugin("NGVS_Vang");
$this->xu = $this->getServer()->getPluginManager()->getPlugin("NGVS_Xu");
}

public function onInteract(PlayerInteractEvent $event){
$player = $event->getPlayer();
if($player->getInventory()->getItemInHand()->getCustomName() == "§r§l§bĐan Hồi Phục Chakra" && $this->chakra->getMana($player)+5 <= 250){
$player->sendMessage("§c•§6 Nhẫn Giả§e đã sử dụng thành công §61 Đan Tăng 5 Chakra");
$this->chakra->setMana($player, $this->chakra->getMana($player) + 5);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() -1);
$player->getInventory()->setItemInHand($item);
return true;
}
if($player->getInventory()->getItemInHand()->getCustomName() == "§r§l§bĐan Hồi Phục Chakra" && $this->chakra->getMana($player)+5 > 250){
$player->sendMessage("§c•§6 Nhẫn Giả§e không thể sử dụng §61 Đan Tăng 5 Chakra");
return true;
}
if($player->getInventory()->getItemInHand()->getCustomName() == "§r§l§cĐan Hồi Phục Sinh Lực" && $player->getHealth()+2 <= $player->getMaxHealth()){
$player->sendMessage("§c•§6 Nhẫn Giả§e đã sử dụng thành công §61 Đan Tăng 2 Máu");
$player->setHealth($player->getHealth()+2);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() -1);
$player->getInventory()->setItemInHand($item);
return true;
}
if($player->getInventory()->getItemInHand()->getCustomName() == "§r§l§cĐan Hồi Phục Sinh Lực" && $player->getHealth()+2 > $player->getMaxHealth()){
$player->sendMessage("§c•§6 Nhẫn Giả§e không thể sử dụng §61 Đan Tăng 2 Máu");
return true;
}
if($player->getInventory()->getItemInHand()->getCustomName() == "§r§c•§a Ngọc Dịch Chuyển §c•§b Ông Tazuna"){
$coords = [56, 36, -236];
$player->teleport(new Vector3(56, 36, -236));
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() -1);
$player->getInventory()->setItemInHand($item);
$player->sendPopup("§c༺§b Dịch Chuyển Thành Công §c༻");
return true;
}

if($player->getInventory()->getItemInHand()->getCustomName() == "§r§c•§a Giải Cứu Kazekage §c•§b Sasori"){
$coords = [-277, 3, -357];
$player->teleport(new Vector3(-277, 3, -357));
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() -1);
$player->getInventory()->setItemInHand($item);
$player->sendPopup("§c༺§b Dịch Chuyển Thành Công §c༻");
return true;
}

if($player->getInventory()->getItemInHand()->getCustomName() == "§r§l§bĐan Hồi Phục Chakra §c(§fĐại§c)" && $this->chakra->getMana($player)+50 <= 250){
$player->sendMessage("§c•§6 Nhẫn Giả§e đã sử dụng thành công §61 Đan Tăng 50 Chakra");
$this->chakra->setMana($player, $this->chakra->getMana($player) + 50);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() -1);
$player->getInventory()->setItemInHand($item);
return true;
}
if($player->getInventory()->getItemInHand()->getCustomName() == "§r§l§bĐan Hồi Phục Chakra §c(§fĐại§c)" && $this->chakra->getMana($player)+5 > 250){
$player->sendMessage("§c•§6 Nhẫn Giả§e không thể sử dụng §61 Đan Tăng 50 Chakra");
return true;
}
if($player->getInventory()->getItemInHand()->getCustomName() == "§r§l§bĐan Hồi Phục Sinh Lực §c(§fĐại§c)" && $player->getHealth()+10 <= $player->getMaxHealth()){
$player->sendMessage("§c•§6 Nhẫn Giả§e đã sử dụng thành công §61 Đan Tăng 10 Máu");
$player->setHealth($player->getHealth()+10);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() -1);
$player->getInventory()->setItemInHand($item);
return true;
}
if($player->getInventory()->getItemInHand()->getCustomName() == "§r§l§bĐan Hồi Phục Sinh Lực §c(§fĐại§c)" && $player->getHealth()+10 > $player->getMaxHealth()){
$player->sendMessage("§c•§6 Nhẫn Giả§e không thể sử dụng §61 Đan Tăng 10 Máu");
return true;
}

if($player->getInventory()->getItemInHand()->getCustomName() == "§l§cĐan Chakra Tổng - Tiểu"){
$player->sendMessage("§c•§6 Nhẫn Giả§e đã sử dụng thành công §61 Đan Chakra +10 Chakra Tổng");
$this->ck->addChakra($player, 10);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() -1);
$player->getInventory()->setItemInHand($item);
return true;
}
if($player->getInventory()->getItemInHand()->getCustomName() == "§l§cĐan Chakra Tổng - Đại"){
$player->sendMessage("§c•§6 Nhẫn Giả§e đã sử dụng thành công §61 Đan Chakra +20 Chakra tổng");
$this->ck->addChakra($player, 20);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() -1);
$player->getInventory()->setItemInHand($item);
return true;
}

if($player->getInventory()->getItemInHand()->getCustomName() == "§l§cĐan Chakra Tổng - Nổ"){
$player->sendMessage("§c•§6 Nhẫn Giả§e đã sử dụng thành công §61 Đan Chakra +50 Chakra Tổng");
$this->ck->addChakra($player, 50);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() -1);
$player->getInventory()->setItemInHand($item);
return true;
}

if($player->getInventory()->getItemInHand()->getCustomName() == "§l§6Lệnh Nhẫn Giả"){
$player->sendMessage("§c•§6 Nhẫn Giả§e đã sử dụng thành công §61 Lệnh Nhẫn Giả +2 Tiềm Năng");
$this->stats->addStats($player, 2);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() -1);
$player->getInventory()->setItemInHand($item);
return true;
}

if($player->getInventory()->getItemInHand()->getCustomName() == "§r§l§bTúi Bạc Nhỏ"){
$player->sendMessage("§c•§6 Nhẫn Giả§e đã sử dụng thành công Túi Bạc Nhỏ +100 Bạc");
$this->bac->addBac($player, 100);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() -1);
$player->getInventory()->setItemInHand($item);
return true;
}

if($player->getInventory()->getItemInHand()->getCustomName() == "§r§l§bTúi Bạc Lớn"){
$player->sendMessage("§c•§6 Nhẫn Giả§e đã sử dụng thành công Túi Bạc Lớn +200 Bạc");
$this->bac->addBac($player, 200);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() -1);
$player->getInventory()->setItemInHand($item);
return true;
}

if($player->getInventory()->getItemInHand()->getCustomName() == "§r§l§bLệnh Tiềm Năng"){
$player->sendMessage("§c•§6 Nhẫn Giả§e đã sử dụng thành công Lệnh Tiềm Năng +6 Điểm Tiềm Năng");
$this->stats->addStats($player, 6);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() -1);
$player->getInventory()->setItemInHand($item);
return true;
}

if($player->getInventory()->getItemInHand()->getCustomName() == "§r§l§bLệnh Chakra Tổng"){
$player->sendMessage("§c•§6 Nhẫn Giả§e đã sử dụng thành công Lệnh Chakra Tổng +50 Chakra Tổng");
$this->ck->addChakra($player, 50);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() -1);
$player->getInventory()->setItemInHand($item);
return true;
}

if($player->getInventory()->getItemInHand()->getCustomName() == "§r§l§bTúi Xu Lớn"){
$player->sendMessage("§c•§6 Nhẫn Giả§e đã sử dụng thành công Túi Xu Lớn +1000 Xu");
$this->bac->addBac($player, 1000);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() -1);
$player->getInventory()->setItemInHand($item);
return true;
}

if($player->getInventory()->getItemInHand()->getCustomName() == "§r§l§bTúi Xu Nhỏ"){
$player->sendMessage("§c•§6 Nhẫn Giả§e đã sử dụng thành công Túi Xu Nhỏ +500 Xu");
$this->xu->addXu($player, 500);
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() -1);
$player->getInventory()->setItemInHand($item);
return true;
}
//==========================================================================================================================================================


}
}