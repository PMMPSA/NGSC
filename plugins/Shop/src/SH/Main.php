<?php

namespace SH;

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
        $this->vang = $this->getServer()->getPluginManager()->getPlugin("NGVS_Vang");
        $this->bac = $this->getServer()->getPluginManager()->getPlugin("NGVS_Bac");
        $this->qidacoin = $this->getServer()->getPluginManager()->getPlugin("NGVS_QidaCoin");
        $this->chakra = $this->getServer()->getPluginManager()->getPlugin("NGVS_Mana");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args):bool{
        switch($cmd->getName()){
        case "shop":
        if(!($sender instanceof Player)){
                $sender->sendMessage("§cVui lòng dùng lệnh trong Game");
                return true;
        }
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
$player->sendMessage("§c✿§e Cảm ơn cháu đã ghé thăm quán Ramen của ta!");
return true;
}
            switch ($result) {
            case 0:
            $this->UIViThu($player, "TÚI BẠC NHỎ", "100", "1");
            break;
            case 1:
            $this->UIViThu($player, "TÚI BẠC LỚN", "200", "1");
            break;
			case 2:
            $this->UIViThu($player, "ĐAN HP", "50", "1");
            break;
            case 3:
            $this->UIViThu($player, "ĐAN MP", "50", "1");
            break;
            case 4:
            $this->UIViThu($player, "LỆNH TIỀM NĂNG", "100", "1");
            break;
			case 5:
            $this->UIViThu($player, "LỆNH CHAKRA TỔNG", "200", "1");
            break;
            case 6:
            $this->UIViThu($player, "NGỌC DỊCH CHUYỂN TAZUNA", "50", "1");
            break;
            case 7:
            $this->UIViThu($player, "TÚI XU NHỎ", "50", "1");
            break;
            case 8:
            $this->UIViThu($player, "TÚI XU LỚN", "100", "1");
            break;
			case 9:
            $this->UIViThu($player, "KIẾM ANBU CÙI", "1000", "1");
            break;
			case 10:
            $this->UIViThu($player, "RƯƠNG CHỨA ĐỒ", "1000", "1");
            break;
            }
        });
        $myvang = $this->vang->getVang($sender);
		$mybac = $this->bac->getBac($sender);
		$myxu = $this->xu->getXu($sender);
        $form->setTitle("§l§1SHOP NGSC");
        $form->setContent("§c•§6 Vàng đang có: §a".$myvang."§c Vàng\n§c•§6 Bạc đang có: §a".$mybac."§c Bạc\n§c•§6 Xu đang có: §a".$myxu."§c Xu");
        $form->addButton("§l§2TÚI BẠC NHỎ\n§r§0100 Vàng/Túi");
        $form->addButton("§l§2TÚI BẠC LỚN\n§r§0200 Vàng/Túi");
		$form->addButton("§l§2ĐAN HP\n§r§0100 Bạc/Đan");
        $form->addButton("§l§2ĐAN MP\n§r§0100 Bạc/Đan");
        $form->addButton("§l§2LỆNH TIỀM NĂNG\n§r§0100 Vàng/Lệnh (+6 Tiềm năng)");
		$form->addButton("§l§2LỆNH CHAKRA TỔNG\n§r§0200 Vàng/Lệnh");
        $form->addButton("§l§2NGỌC DỊCH CHUYỂN TAZUNA\n§r§050 Xu/Ngọc");
        $form->addButton("§l§2TÚI XU NHỎ\n§r§050 Bạc/Túi");
        $form->addButton("§l§2TÚI XU LỚN\n§r§0100 Bạc/Túi");
		$form->addButton("§l§2KIẾM ANBU (CÙI)\n§r§01000 Bạc/Cây");
		$form->addButton("§l§2RƯƠNG CHỨA ĐỒ\n§r§01000 Bạc/Rương");
        $form->sendToPlayer($sender);
        }
return true;
}
public function UIViThu($player, $vithu, $can, $max){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null) use ($vithu, $can, $max){
$result = $data;
if($result === null){
$this->getServer()->dispatchCommand($player, "shop");
return true;
}
switch($result){
case 0:
if($this->vang->getVang($player) < $can && $vithu == "TÚI BẠC NHỎ"){
$this->ThongBao($player, "§f•§c Nhẫn Giả không có đủ ".$can." Vàng để mua 1 Túi Bạc Nhỏ");
return true;
}
if($this->vang->getVang($player) < $can && $vithu == "TÚI BẠC LỚN"){
$this->ThongBao($player, "§f•§c Nhẫn Giả không có đủ ".$can." Vàng để mua 1 Túi Bạc Lớn");
return true;
}
if($this->bac->getBac($player) < $can && $vithu == "ĐAN HP"){
$this->ThongBao($player, "§f•§c Nhẫn Giả không có đủ ".$can." Bạc để mua 1 Đan HP");
return true;
}
if($this->bac->getBac($player) < $can && $vithu == "ĐAN MP"){
$this->ThongBao($player, "§f•§c Nhẫn Giả không có đủ ".$can." Bạc để mua 1 Đan MP");
return true;
}
if($this->vang->getVang($player) < $can && $vithu == "LỆNH TIỀM NĂNG"){
$this->ThongBao($player, "§f•§c Nhẫn Giả không có đủ ".$can." Vàng để mua 1 Lệnh Tiềm Năng");
return true;
}
if($this->vang->getVang($player) < $can && $vithu == "LỆNH CHAKRA TỔNG"){
$this->ThongBao($player, "§f•§c Nhẫn Giả không có đủ ".$can." Vàng để mua 1 Lệnh Chakra Tổng");
return true;
}
if($this->xu->getXu($player) < $can && $vithu == "NGỌC DỊCH CHUYỂN TAZUNA"){
$this->ThongBao($player, "§f•§c Nhẫn Giả không có đủ ".$can." Xu để mua 1 Ngọc Dịch Chuyển Tazuna");
return true;
}
if($this->bac->getBac($player) < $can && $vithu == "TÚI XU NHỎ"){
$this->ThongBao($player, "§f•§c Nhẫn Giả không có đủ ".$can." Bạc để mua 1 Túi Xu Nhỏ");
return true;
}
if($this->bac->getBac($player) < $can && $vithu == "TÚI XU LỚN"){
$this->ThongBao($player, "§f•§c Nhẫn Giả không có đủ ".$can." Bạc để mua 1 Túi Xu Lớn");
return true;
}
if($this->bac->getBac($player) < $can && $vithu == "KIẾM ANBU CÙI"){
$this->ThongBao($player, "§f•§c Nhẫn Giả không có đủ ".$can." Bạc để mua 1 Kiếm Anbu (Cùi)");
return true;
}
if($this->bac->getBac($player) < $can && $vithu == "RƯƠNG CHỨA ĐỒ"){
$this->ThongBao($player, "§f•§c Nhẫn Giả không có đủ ".$can." Bạc để mua 1 Rương Chứa Đồ");
return true;
}
//-------------------------------------------------------------------------------------------------------------------------------------
if($this->vang->getVang($player) >= $can && $vithu == "TÚI BẠC NHỎ"){
$this->ThongBao($player, "§f•§a Nhẫn Giả đã mua thành công §c1 Túi Bạc Nhỏ§a với giá §c".$can);
$this->vang->reduceVang($player, $can);
$nhatvi = Item::get(432, 0, 1);
$nhatvi->setCustomName("§r§l§bTúi Bạc Nhỏ");
$player->getInventory()->addItem($nhatvi);
return true;
}
//-------------------------------------------------------------------------------------------------------------------------------------
if($this->vang->getVang($player) >= $can && $vithu == "TÚI BẠC LỚN"){
$this->ThongBao($player, "§f•§a Nhẫn Giả đã mua thành công §c1 Túi Bạc Lớn§a với giá §c".$can);
$this->vang->reduceVang($player, $can);
$nhatvi = Item::get(433, 0, 1);
$nhatvi->setCustomName("§r§l§bTúi Bạc Lớn");
$player->getInventory()->addItem($nhatvi);
return true;
}
//-------------------------------------------------------------------------------------------------------------------------------------
if($this->bac->getBac($player) >= $can && $vithu == "ĐAN HP"){
$this->ThongBao($player, "§f•§a Nhẫn Giả đã mua thành công §c1 Đan HP§a với giá §c".$can);
$this->bac->reduceBac($player, $can);
$nhatvi = Item::get(351, 1, 1);
$nhatvi->setCustomName("§r§l§bĐan Hồi Phục Sinh Lực §c(§fĐại§c)");
$player->getInventory()->addItem($nhatvi);
return true;
}
//-------------------------------------------------------------------------------------------------------------------------------------
if($this->bac->getBac($player) >= $can && $vithu == "ĐAN MP"){
$this->ThongBao($player, "§f•§a Nhẫn Giả đã mua thành công §c1 Đan MP§a với giá §c".$can);
$this->vang->reduceVang($player, $can);
$nhatvi = Item::get(351, 12, 1);
$nhatvi->setCustomName("§r§l§bĐan Hồi Phục Chakra §c(§fĐại§c)");
$player->getInventory()->addItem($nhatvi);
return true;
}
//-------------------------------------------------------------------------------------------------------------------------------------
if($this->vang->getVang($player) >= $can && $vithu == "LỆNH TIỀM NĂNG"){
$this->ThongBao($player, "§f•§a Nhẫn Giả đã mua thành công §c1 Lệnh Tiềm Năng§a với giá §c".$can);
$this->vang->reduceVang($player, $can);
$nhatvi = Item::get(288, 0, 1);
$nhatvi->setCustomName("§r§l§bLệnh Tiềm Năng");
$player->getInventory()->addItem($nhatvi);
return true;
}
//-------------------------------------------------------------------------------------------------------------------------------------
if($this->vang->getVang($player) >= $can && $vithu == "LỆNH CHAKRA TỔNG"){
$this->ThongBao($player, "§f•§a Nhẫn Giả đã mua thành công §c1 Lệnh Chakra Tổng§a với giá §c".$can);
$this->vang->reduceVang($player, $can);
$nhatvi = Item::get(351, 15, 1);
$nhatvi->setCustomName("§r§l§bLệnh Chakra Tổng");
$player->getInventory()->addItem($nhatvi);
return true;
}
//-------------------------------------------------------------------------------------------------------------------------------------
if($this->xu->getXu($player) >= $can && $vithu == "NGỌC DỊCH CHUYỂN TAZUNA"){
$this->ThongBao($player, "§f•§a Nhẫn Giả đã mua thành công §c1 Ngọc Dịch Chuyển Tazuna§a với giá §c".$can);
$this->xu->reduceXu($player, $can);
$dc = Item::get(Item::EMERALD, 0, 1);
$dc->setCustomName("§r§c•§a Ngọc Dịch Chuyển §c•§b Ông Tazuna");
$player->getInventory()->addItem($dc);
return true;
}
//-------------------------------------------------------------------------------------------------------------------------------------
if($this->bac->getBac($player) >= $can && $vithu == "TÚI XU NHỎ"){
$this->ThongBao($player, "§f•§a Nhẫn Giả đã mua thành công §c1 Túi Xu Nhỏ§a với giá §c".$can);
$this->bac->reduceBac($player, $can);
$nhatvi = Item::get(175, 3, 1);
$nhatvi->setCustomName("§r§l§bTúi Xu Nhỏ");
$player->getInventory()->addItem($nhatvi);
return true;
}
//-------------------------------------------------------------------------------------------------------------------------------------
if($this->bac->getBac($player) >= $can && $vithu == "TÚI XU LỚN"){
$this->ThongBao($player, "§f•§a Nhẫn Giả đã mua thành công §c1 Túi Xu Lớn§a với giá §c".$can);
$this->bac->reduceBac($player, $can);
$nhatvi = Item::get(31, 2, 1);
$nhatvi->setCustomName("§r§l§bTúi Xu Lớn");
$player->getInventory()->addItem($nhatvi);
return true;
}
//-------------------------------------------------------------------------------------------------------------------------------------
if($this->bac->getBac($player) >= $can && $vithu == "KIẾM ANBU CÙI"){
$this->ThongBao($player, "§f•§a Nhẫn Giả đã mua thành công §c1 Kiếm Anbu (Cùi)§a với giá §c".$can);
$this->bac->reduceBac($player, $can);
$kiem = Item::get(267, 0, 1);
  $kiem->setCustomName("§r§l§gKIẾM ANBU (CÙI)");
  $kiem->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(9), 2));
    $kiem->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(13), 2));
	$kiem->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 5));
	$player->getInventory()->addItem($kiem);
return true;
}
//-------------------------------------------------------------------------------------------------------------------------------------
if($this->bac->getBac($player) >= $can && $vithu == "RƯƠNG CHỨA ĐỒ"){
$this->ThongBao($player, "§f•§a Nhẫn Giả đã mua thành công §c1 Rương Chứa Đồ§a với giá §c".$can);
$this->bac->reduceBac($player, $can);
$ruong = Item::get(54, 0, 1);
  $ruong->setCustomName("§r§l§gRƯƠNG CHỨA ĐỒ");
	$player->getInventory()->addItem($ruong);
return true;
}
//-------------------------------------------------------------------------------------------------------------------------------------
break;
case 1:
$this->getServer()->dispatchCommand($player, "shop");
break;
}
});
$form->setTitle("§l§1SHOP NGSC");
$form->setContent("§f•§a Nhẫn Giả có xác nhận muốn mua §c".$vithu."§a không?");
$form->addButton("§l§1XÁC NHẬN MUA");
$form->addButton("§l§1HỦY");
$form->sendToPlayer($player);
return $form;
}
public function ThongBao($player, $message){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
$this->getServer()->dispatchCommand($player, "shop");
return true;
}
switch($result){
case 0:
$this->getServer()->dispatchCommand($player, "shop");
break;
}
});
$form->setTitle("§l§1SHOP NGSC");
$form->setContent($message);
$form->addButton("§l§1Đã Hiểu");
$form->sendToPlayer($player);
return $form;
}
}