<?php

namespace BMVT;

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
        case "manh":
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
            $this->UIViThu($player, "Nhất Vĩ", "50", "30");
            break;
            case 1:
            $this->UIViThu($player, "Nhị Vĩ", "50", "30");
            break;
			case 2:
            $this->UIViThu($player, "Tam Vĩ", "50", "35");
            break;
            case 3:
            $this->UIViThu($player, "Tứ Vĩ", "50", "40");
            break;
            case 4:
            $this->UIViThu($player, "Ngũ Vĩ", "50", "40");
            break;
			case 5:
            $this->UIViThu($player, "Lục Vĩ", "60", "40");
            break;
            case 6:
            $this->UIViThu($player, "Thất Vĩ", "60", "45");
            break;
            case 7:
            $this->UIViThu($player, "Bát Vĩ", "60", "50");
            break;
            case 8:
            $this->UIViThu($player, "Cửu Vĩ", "80", "50");
            break;
            }
        });
        $myvang = $this->vang->getVang($sender);
        $form->setTitle("§l§1HỆ THỐNG MẢNH VĨ THÚ");
        $form->setContent("§c•§6 Vàng đang có: §a".$myvang."§c Vàng\n§aVui lòng chọn Mảnh Vĩ Thú:");
        $form->addButton("§l§2MẢNH NHẤT VĨ\n§r§050 Vàng/Mảnh, cần 30 Mảnh để Ảo Hóa");
        $form->addButton("§l§2MẢNH NHỊ VĨ\n§r§050 Vàng/Mảnh, cần 30 Mảnh để Ảo Hóa");
		$form->addButton("§l§2MẢNH TAM VĨ\n§r§050 Vàng/Mảnh, cần 35 Mảnh để Ảo Hóa");
        $form->addButton("§l§2MẢNH TỨ VĨ\n§r§050 Vàng/Mảnh, cần 40 Mảnh để Ảo Hóa");
        $form->addButton("§l§2MẢNH NGŨ VĨ\n§r§050 Vàng/Mảnh, cần 40 Mảnh để Ảo Hóa");
		$form->addButton("§l§2MẢNH LỤC VĨ\n§r§060 Vàng/Mảnh, cần 40 Mảnh để Ảo Hóa");
        $form->addButton("§l§2MẢNH THẤT VĨ\n§r§060 Vàng/Mảnh, cần 45 Mảnh để Ảo Hóa");
        $form->addButton("§l§2MẢNH BÁT VĨ\n§r§060 Vàng/Mảnh, cần 50 Mảnh để Ảo Hóa");
        $form->addButton("§l§2MẢNH CỬU VĨ\n§r§080 Vàng/Mảnh, cần 50 Mảnh để Ảo Hóa");
        $form->sendToPlayer($sender);
        }
return true;
}
public function UIViThu($player, $vithu, $can, $max){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null) use ($vithu, $can, $max){
$result = $data;
if($result === null){
$this->getServer()->dispatchCommand($player, "manh");
return true;
}
switch($result){
case 0:
if($this->vang->getVang($player) < $can && $vithu == "Nhất Vĩ"){
$this->ThongBao($player, "§f•§c Nhẫn Giả không có đủ ".$can." Vàng để mua 1 Mảnh Nhất Vĩ");
return true;
}
if($this->vang->getVang($player) < $can && $vithu == "Nhị Vĩ"){
$this->ThongBao($player, "§f•§c Nhẫn Giả không có đủ ".$can." Vàng để mua 1 Mảnh Nhị Vĩ");
return true;
}
if($this->vang->getVang($player) < $can && $vithu == "Tam Vĩ"){
$this->ThongBao($player, "§f•§c Nhẫn Giả không có đủ ".$can." Vàng để mua 1 Mảnh Tam Vĩ");
return true;
}
if($this->vang->getVang($player) < $can && $vithu == "Tứ Vĩ"){
$this->ThongBao($player, "§f•§c Nhẫn Giả không có đủ ".$can." Vàng để mua 1 Mảnh Tứ Vĩ");
return true;
}
if($this->vang->getVang($player) < $can && $vithu == "Ngũ Vĩ"){
$this->ThongBao($player, "§f•§c Nhẫn Giả không có đủ ".$can." Vàng để mua 1 Mảnh Ngũ Vĩ");
return true;
}
if($this->vang->getVang($player) < $can && $vithu == "Lục Vĩ"){
$this->ThongBao($player, "§f•§c Nhẫn Giả không có đủ ".$can." Vàng để mua 1 Mảnh Lục Vĩ");
return true;
}
if($this->vang->getVang($player) < $can && $vithu == "Thất Vĩ"){
$this->ThongBao($player, "§f•§c Nhẫn Giả không có đủ ".$can." Vàng để mua 1 Mảnh Thất Vĩ");
return true;
}
if($this->vang->getVang($player) < $can && $vithu == "Bát Vĩ"){
$this->ThongBao($player, "§f•§c Nhẫn Giả không có đủ ".$can." Vàng để mua 1 Mảnh Bát Vĩ");
return true;
}
if($this->vang->getVang($player) < $can && $vithu == "Cửu Vĩ"){
$this->ThongBao($player, "§f•§c Nhẫn Giả không có đủ ".$can." Vàng để mua 1 Mảnh Cửu Vĩ");
return true;
}
if($this->vang->getVang($player) >= $can && $vithu == "Nhất Vĩ"){
$this->ThongBao($player, "§f•§a Nhẫn Giả đã mua thành công §c1 Mảnh Nhất Vĩ§a với giá §c".$can);
$this->vang->reduceVang($player, $can);
$nhatvi = Item::get(370, 0, 1);
$nhatvi->setCustomName("§r§cMảnh Hồn §aNhất Vĩ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 1));
$player->getInventory()->addItem($nhatvi);
return true;
}
if($this->vang->getVang($player) >= $can && $vithu == "Nhị Vĩ"){
$this->ThongBao($player, "§f•§a Nhẫn Giả đã mua thành công §c1 Mảnh Nhị Vĩ§a với giá §c".$can);
$this->vang->reduceVang($player, $can);
$nhatvi = Item::get(370, 0, 1);
$nhatvi->setCustomName("§r§cMảnh Hồn §aNhị Vĩ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 2));
$player->getInventory()->addItem($nhatvi);
return true;
}
if($this->vang->getVang($player) >= $can && $vithu == "Tam Vĩ"){
$this->ThongBao($player, "§f•§a Nhẫn Giả đã mua thành công §c1 Mảnh Tam Vĩ§a với giá §c".$can);
$this->vang->reduceVang($player, $can);
$nhatvi = Item::get(370, 0, 1);
$nhatvi->setCustomName("§r§cMảnh Hồn §aTam Vĩ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 2));
$player->getInventory()->addItem($nhatvi);
return true;
}
if($this->vang->getVang($player) >= $can && $vithu == "Tứ Vĩ"){
$this->ThongBao($player, "§f•§a Nhẫn Giả đã mua thành công §c1 Mảnh Tứ Vĩ§a với giá §c".$can);
$this->vang->reduceVang($player, $can);
$nhatvi = Item::get(370, 0, 1);
$nhatvi->setCustomName("§r§cMảnh Hồn §aTứ Vĩ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 4));
$player->getInventory()->addItem($nhatvi);
return true;
}
if($this->vang->getVang($player) >= $can && $vithu == "Ngũ Vĩ"){
$this->ThongBao($player, "§f•§a Nhẫn Giả đã mua thành công §c1 Mảnh Ngũ Vĩ§a với giá §c".$can);
$this->vang->reduceVang($player, $can);
$nhatvi = Item::get(370, 0, 1);
$nhatvi->setCustomName("§r§cMảnh Hồn §aNgũ Vĩ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 5));
$player->getInventory()->addItem($nhatvi);
return true;
}
if($this->vang->getVang($player) >= $can && $vithu == "Lục Vĩ"){
$this->ThongBao($player, "§f•§a Nhẫn Giả đã mua thành công §c1 Mảnh Lục Vĩ§a với giá §c".$can);
$this->vang->reduceVang($player, $can);
$nhatvi = Item::get(370, 0, 1);
$nhatvi->setCustomName("§r§cMảnh Hồn §aLục Vĩ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 5));
$player->getInventory()->addItem($nhatvi);
return true;
}
if($this->vang->getVang($player) >= $can && $vithu == "Thất Vĩ"){
$this->ThongBao($player, "§f•§a Nhẫn Giả đã mua thành công §c1 Mảnh Thất Vĩ§a với giá §c".$can);
$this->vang->reduceVang($player, $can);
$nhatvi = Item::get(370, 0, 1);
$nhatvi->setCustomName("§r§cMảnh Hồn §aThất Vĩ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 5));
$player->getInventory()->addItem($nhatvi);
return true;
}
if($this->vang->getVang($player) >= $can && $vithu == "Bát Vĩ"){
$this->ThongBao($player, "§f•§a Nhẫn Giả đã mua thành công §c1 Mảnh Bát Vĩ§a với giá §c".$can);
$this->vang->reduceVang($player, $can);
$nhatvi = Item::get(370, 0, 1);
$nhatvi->setCustomName("§r§cMảnh Hồn §aBát Vĩ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 8));
$player->getInventory()->addItem($nhatvi);
return true;
}
if($this->vang->getVang($player) >= $can && $vithu == "Cửu Vĩ"){
$this->ThongBao($player, "§f•§a Nhẫn Giả đã mua thành công §c1 Mảnh Cửu Vĩ§a với giá §c".$can);
$this->vang->reduceVang($player, $can);
$nhatvi = Item::get(370, 0, 1);
$nhatvi->setCustomName("§r§cMảnh Hồn §aCửu Vĩ");
$nhatvi->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 9));
$player->getInventory()->addItem($nhatvi);
return true;
}
break;
case 1:
$this->getServer()->dispatchCommand($player, "manh");
break;
}
});
$form->setTitle("§l§1HỆ THỐNG MẢNH VĨ THÚ");
$form->setContent("§f•§a Nhẫn Giả có xác nhận muốn mua §c1 Mảnh ".$vithu."§a với giá §c".$can." Vàng§a?");
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
$this->getServer()->dispatchCommand($player, "manh");
return true;
}
switch($result){
case 0:
$this->getServer()->dispatchCommand($player, "manh");
break;
}
});
$form->setTitle("§l§1HỆ THỐNG MẢNH VĨ THÚ");
$form->setContent($message);
$form->addButton("§l§1Đã Hiểu");
$form->sendToPlayer($player);
return $form;
}
}