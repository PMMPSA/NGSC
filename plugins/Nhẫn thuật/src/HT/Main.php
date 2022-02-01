<?php

namespace HT;

use jojoe77777\FormAPI;
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

class Main extends PluginBase implements Listener {
    
    public function onEnable(){
        $this->level = $this->getServer()->getPluginManager()->getPlugin("NGVS_Level");
        $this->xu = $this->getServer()->getPluginManager()->getPlugin("NGVS_Xu");
        $this->chakra = $this->getServer()->getPluginManager()->getPlugin("NGVS_DCK");
        $this->bac = $this->getServer()->getPluginManager()->getPlugin("NGVS_Bac");
        $this->qidacoin = $this->getServer()->getPluginManager()->getPlugin("NGVS_QidaCoin");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args):bool{
        switch($cmd->getName()){
        case "hocskill":
        if(!($sender instanceof Player)){
                $sender->sendMessage("§cVui lòng dùng lệnh trong Game");
                return true;
        }
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
//$player->sendMessage("§c✿§e Cảm ơn cháu đã ghé thăm quán Ramen của ta!");
return true;
}
            switch ($result) {
            case 0:
            $this->UIViThu($player, "TÂM TRUNG ĐOẠN THỦ", "200", "200");
            break;
			case 1:
            $this->UIViThu($player, "THẾ THÂN", "20", "10");
            break;
			case 2:
            $this->UIViThu($player, "THỦY LAO THUẬT", "500", "600");
            break;
			case 3:
            $this->UIViThu($player, "ÁM SÁT THUẬT", "500", "400");
            break;
            case 4:
            $this->UIViThu($player, "TĂNG SINH CHI THUẬT", "400", "500");
            break;
            case 6:
            $this->UIViThu($player, "LUÂN THUẬT TÂM PHÁP", "1400", "1600");
            break;
            case 7:
            $this->UIViThu($player, "BYAKUGAN", "1600", "1800");
            break;
            case 8:
            $this->UIViThu($player, "SHARINGAN", "1800", "2000");
            break;
            }
        });
        $mychakra = $this->chakra->getChakra($sender);
		$mybac = $this->bac->getBac($sender);
        $form->setTitle("§l§1HỆ THỐNG HỌC NHẪN THUẬT");
        $form->setContent("§c•§6Chakra Tổng Đang Có: §a".$mychakra."§c Chakra\n§c•§6Bạc Đang Có: §a".$mybac."§c Bạc");
        $form->addButton("§l§2TÂM TRUNG ĐOẠN THỦ\n§r§0200 Điểm Chakra, 200 Bạc, Học 1 Nhẫn thuật");
		$form->addButton("§l§2THẾ THÂN\n§r§020 Điểm Chakra, 10 Bạc, Học 1 Nhẫn thuật");
		$form->addButton("§l§2THỦY LAO THUẬT\n§r§0500 Điểm Chakra, 600 Bạc, Học 1 Nhẫn thuật");
		$form->addButton("§l§2ÁM SÁT THUẬT\n§r§0500 Điểm Chakra, 400 Bạc, Học 1 Nhẫn thuật");
        $form->addButton("§l§2TĂNG SINH CHI THUẬT\n§r§0400 Điểm Chakra, 500 Bạc, Học 1 Nhẫn thuật");
        $form->addButton("§l§2LUÂN THUẬT TÂM PHÁP\n§r§01400 Điểm Chakra, 1600 Bạc, Học 1 Nhẫn thuật");
        $form->addButton("§l§2BYAKUGAN\n§r§01600 Điểm Chakra, 1800 Bạc, Học 1 Nhẫn thuật");
        $form->addButton("§l§2SHARINGAN\n§r§01800 Điểm Chakra, 2000 Bạc, Học 1 Nhẫn thuật");
        $form->sendToPlayer($sender);
        }
return true;
}
public function UIViThu($player, $vithu, $can, $max){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null) use ($vithu, $can, $max){
$result = $data;
if($result === null){
$this->getServer()->dispatchCommand($player, "hocskill");
return true;
}
switch($result){
case 0:
if($this->chakra->getChakra($player) < $can && $vithu == "TÂM TRUNG ĐOẠN THỦ"){
$this->ThongBao($player, "§f•§c Nhẫn Giả không có đủ ".$can." Điểm Chakra để học §l§2TÂM TRUNG ĐOẠN THỦ");
return true;
}
if($this->chakra->getChakra($player) < $can && $vithu == "THẾ THÂN"){
$this->ThongBao($player, "§f•§c Nhẫn Giả không có đủ ".$can." Điểm Chakra để học §l§2THẾ THÂN");
return true;
}
if($this->chakra->getChakra($player) < $can && $vithu == "THỦY LAO THUẬT"){
$this->ThongBao($player, "§f•§c Nhẫn Giả không có đủ ".$can." Điểm Chakra để học §l§2THỦY LAO THUẬT");
return true;
}
if($this->chakra->getChakra($player) < $can && $vithu == "ÁM SÁT THUẬT"){
$this->ThongBao($player, "§f•§c Nhẫn Giả không có đủ ".$can." Điểm Chakra để học §l§2ÁM SÁT THUẬT");
return true;
}
if($this->chakra->getChakra($player) < $can && $vithu == "TĂNG SINH CHI THUẬT"){
$this->ThongBao($player, "§f•§c Nhẫn Giả không có đủ ".$can." Điểm Chakra để học §l§2TĂNG SINH CHI THUẬT");
return true;
}
if($this->chakra->getChakra($player) < $can && $vithu == "LUÂN THUẬT TÂM PHÁP"){
$this->ThongBao($player, "§f•§c Nhẫn Giả không có đủ ".$can." Điểm Chakra để học §l§2LUÂN THUẬT TÂM PHÁP");
return true;
}
if($this->chakra->getChakra($player) < $can && $vithu == "BYAKUGAN"){
$this->ThongBao($player, "§f•§c Nhẫn Giả không có đủ ".$can." Điểm Chakra để học §l§2BYAKUGAN");
return true;
}
if($this->chakra->getChakra($player) < $can && $vithu == "SHARINGAN"){
$this->ThongBao($player, "§f•§c Nhẫn Giả không có đủ ".$can." Điểm Chakra để học §l§2SHARINGAN");
return true;
}


if($this->bac->getBac($player) < $max && $vithu == "TÂM TRUNG ĐOẠN THỦ"){
$this->ThongBao($player, "§f•§c Nhẫn Giả không có đủ ".$max." Bạc để học §l§2TÂM TRUNG ĐOẠN THỦ");
return true;
}
if($this->bac->getBac($player) < $max && $vithu == "THẾ THÂN"){
$this->ThongBao($player, "§f•§c Nhẫn Giả không có đủ ".$max." Bạc để học §l§2THẾ THÂN");
return true;
}
if($this->bac->getBac($player) < $max && $vithu == "THỦY LAO THUẬT"){
$this->ThongBao($player, "§f•§c Nhẫn Giả không có đủ ".$max." Bạc để học §l§2THỦY LAO THUẬT");
return true;
}
if($this->bac->getBac($player) < $max && $vithu == "ÁM SÁT THUẬT"){
$this->ThongBao($player, "§f•§c Nhẫn Giả không có đủ ".$max." Bạc để học §l§2ÁM SÁT THUẬT");
return true;
}
if($this->bac->getBac($player) < $max && $vithu == "TĂNG SINH CHI THUẬT"){
$this->ThongBao($player, "§f•§c Nhẫn Giả không có đủ ".$max." Bạc để học §l§2TĂNG SINH CHI THUẬT");
return true;
}
if($this->bac->getBac($player) < $max && $vithu == "LUÂN THUẬT TÂM PHÁP"){
$this->ThongBao($player, "§f•§c Nhẫn Giả không có đủ ".$max." Bạc để học §l§2LUÂN THUẬT TÂM PHÁP");
return true;
}
if($this->bac->getBac($player) < $max && $vithu == "BYAKUGAN"){
$this->ThongBao($player, "§f•§c Nhẫn Giả không có đủ ".$max." Bạc để học §l§2BYAKUGAN");
return true;
}
if($this->bac->getBac($player) < $max && $vithu == "SHARINGAN"){
$this->ThongBao($player, "§f•§c Nhẫn Giả không có đủ ".$max." Bạc để học §l§2SHARINGAN");
return true;
}


if($this->chakra->getChakra($player) >= $can && $vithu == "TÂM TRUNG ĐOẠN THỦ"){
$this->ThongBao($player, "§f•§a Nhẫn Giả đã học thành công nhẫn thuật §l§2TÂM TRUNG ĐOẠN THỦ§l§a với §c".$can. "Chakra Tổng,".$max. "Bạc");
$this->chakra->reduceChakra($player, $can);
$this->bac->reduceBac($player, $max);
$s1 = Item::get(Item::NETHER_STAR, 0, 1);
$s1->setCustomName("§r§7【§cTHUẬT§7】§e Tâm Trung Đoạn Thủ§7 (§cCấp 5§7) - (§c10 Chakra§7) - (§a•§7)");
$player->getInventory()->addItem($s1);
return true;
}
if($this->chakra->getChakra($player) >= $can && $vithu == "THẾ THÂN"){
$this->ThongBao($player, "§f•§a Nhẫn Giả đã học thành công nhẫn thuật §l§2THẾ THÂN§l§a với §c".$can. "Chakra Tổng,".$max. "Bạc");
$this->chakra->reduceChakra($player, $can);
$this->bac->reduceBac($player, $max);
$s1 = Item::get(Item::NETHER_STAR, 0, 1);
$s1->setCustomName("§r§c『§6THUẬT§c』§a Thế Thân");
$player->getInventory()->addItem($s1);
return true;
}
if($this->chakra->getChakra($player) >= $can && $vithu == "THỦY LAO THUẬT"){
$this->ThongBao($player, "§f•§a Nhẫn Giả đã học thành công nhẫn thuật §l§2THỦY LAO THUẬT§l§a với §c".$can. "Chakra Tổng,".$max. "Bạc");
$this->chakra->reduceChakra($player, $can);
$this->bac->reduceBac($player, $max);
$s1 = Item::get(Item::NETHER_STAR, 0, 1);
$s1->setCustomName("§r§7【§cTHUẬT§7】§b Thủy Lao Thuật§7 (§cCấp 10§7) - (§c50 Chakra§7) - (§a•§7)");
$player->getInventory()->addItem($s1);
return true;
}
if($this->chakra->getChakra($player) >= $can && $vithu == "ÁM SÁT THUẬT"){
$this->ThongBao($player, "§f•§a Nhẫn Giả đã học thành công nhẫn thuật §l§2ÁM SÁT THUẬT§l§a với §c".$can. "Chakra Tổng,".$max. "Bạc");
$this->chakra->reduceChakra($player, $can);
$this->bac->reduceBac($player, $max);
$s1 = Item::get(Item::NETHER_STAR, 0, 1);
$s1->setCustomName("§r§7【§cTHUẬT§7】§c Ám Sát Thuật§7 (§cCấp 5§7) - (§c10 Chakra§7) - (§a•§7)");
$player->getInventory()->addItem($s1);
return true;
}
if($this->chakra->getChakra($player) >= $can && $vithu == "TĂNG SINH CHI THUẬT"){
$this->ThongBao($player, "§f•§a Nhẫn Giả đã học thành công nhẫn thuật §l§2TĂNG SINH CHI THUẬT§l§a với §c".$can. "Chakra Tổng,".$max. "Bạc");
$this->chakra->reduceChakra($player, $can);
$this->bac->reduceBac($player, $max);
$t2 = Item::get(Item::NETHER_STAR, 0, 1);
$t2->setCustomName("§r§7【§cTHUẬT§7】§b Tăng Sinh Chi Thuật§7 (§cCấp 5§7) - (§c10 Chakra§7) - (§a•§7)");
$player->getInventory()->addItem($t2);
return true;
}
if($this->chakra->getChakra($player) >= $can && $vithu == "LUÂN THUẬT TÂM PHÁP"){
$this->ThongBao($player, "§f•§a Nhẫn Giả đã học thành công nhẫn thuật §l§2LUÂN THUẬT TÂM PHÁP§l§a với §c".$can. "Chakra Tổng,".$max. "Bạc");
$this->chakra->reduceChakra($player, $can);
$this->bac->reduceBac($player, $max);
$s2 = Item::get(Item::NETHER_STAR, 0, 1);
$s2->setCustomName("§r§7【§cTHUẬT§7】§e Luân Thuật Tâm Pháp§7 (§cCấp 5§7) - (§c10 Chakra§7) - (§c•§7)");
$player->getInventory()->addItem($s2);
return true;
}
if($this->chakra->getChakra($player) >= $can && $vithu == "BYAKUGAN"){
$this->ThongBao($player, "§f•§a Nhẫn Giả đã học thành công nhẫn thuật §l§2BYAKUGAN§l§a với §c".$can. "Chakra Tổng,".$max. "Bạc");
$this->chakra->reduceChakra($player, $can);
$this->bac->reduceBac($player, $max);
$a1 = Item::get(Item::NETHER_STAR, 0, 1);
$a1->setCustomName("§r§c『§6THUẬT§c』§b§l BYAKUGAN");
$player->getInventory()->addItem($a1);
return true;
}
if($this->chakra->getChakra($player) >= $can && $vithu == "SHARINGAN"){
$this->ThongBao($player, "§f•§a Nhẫn Giả đã học thành công nhẫn thuật §l§2SHARINGAN§l§a với §c".$can. "Chakra Tổng,".$max. "Bạc");
$this->chakra->reduceChakra($player, $can);
$this->bac->reduceBac($player, $max);
$a3 = Item::get(Item::NETHER_STAR, 0, 1);
$a3->setCustomName("§r§c『§6THUẬT§c』§c§l SHARINGAN");
$player->getInventory()->addItem($a3);
return true;
}
break;
case 1:
$this->getServer()->dispatchCommand($player, "hocskill");
break;
}
});
$form->setTitle("§l§1HỆ THỐNG HỌC NHẪN THUẬT");
$form->setContent("§f•§a Nhẫn Giả có xác nhận muốn Học §c ".$vithu."§a với §c".$can." Chakra Tổng, §c".$max." Bạc §aKhông?");
$form->addButton("§l§1HỌC NHẪN THUẬT");
$form->addButton("§l§1HỦY");
$form->sendToPlayer($player);
return $form;
}
public function ThongBao($player, $message){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
$this->getServer()->dispatchCommand($player, "hocskill");
return true;
}
switch($result){
case 0:
$this->getServer()->dispatchCommand($player, "hocskill");
break;
}
});
$form->setTitle("§l§1HỆ THỐNG HỌC NHẪN THUẬT");
$form->setContent($message);
$form->addButton("§l§1Đã Hiểu");
$form->sendToPlayer($player);
return $form;
}
}