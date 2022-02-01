<?php

namespace HTK;

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
use DaPigGuy\PiggyCustomEnchants\CustomEnchantManager;
use pocketmine\network\protocol\SetTitlePacket;

class Main extends PluginBase implements Listener {
    
    public function onEnable(){
        $this->level = $this->getServer()->getPluginManager()->getPlugin("NGVS_Level");
        $this->xu = $this->getServer()->getPluginManager()->getPlugin("NGVS_Xu");
        $this->vang = $this->getServer()->getPluginManager()->getPlugin("NGVS_Vang");
        $this->bac = $this->getServer()->getPluginManager()->getPlugin("NGVS_Bac");
        $this->qidacoin = $this->getServer()->getPluginManager()->getPlugin("NGVS_QidaCoin");
        $this->chakra = $this->getServer()->getPluginManager()->getPlugin("NGVS_Mana");
        $this->kit = $this->getServer()->getPluginManager()->getPlugin("NGVS_Kit");
        $this->rank = $this->getServer()->getPluginManager()->getPlugin("NGVS_Rank");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args):bool{
        switch($cmd->getName()){
        case "kit":
        if(!($sender instanceof Player)){
                $sender->sendMessage("§cVui lòng dùng lệnh trong Game");
                return true;
        }
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
            switch ($result) {
            case 0:
            $this->kitVang($player);
            break;
            case 1:
            $this->kitBac($player);
            break;
            case 2:
            $this->kitXu($player);
            break;
            }
        });
        $myxu = $this->xu->getXu($sender);
        $myvang = $this->vang->getVang($sender);
        $mybac = $this->bac->getBac($sender);
        $form->setTitle("§l§1HỆ THỐNG KIT");
        $form->setContent("§f•§a Số Vàng đang có: §c".$myvang." Vàng\n§f•§a Số Bạc đang có: §c".$mybac." Bạc\n§f•§a Số Xu đang có: §c".$myxu." Xu\n§f•§6 Vui lòng chọn phương thức mua Kit");
        $form->addButton("§l§0MUA KIT BẰNG VÀNG");
        $form->addButton("§l§0MUA KIT BẰNG BẠC");
        $form->addButton("§l§0MUA KIT BẰNG XU");
        $form->sendToPlayer($sender);
        }
return true;
}
public function kitVang($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
$this->getServer()->dispatchCommand($player, "kit");
return true;
}
switch($result){
case 0:
$this->kitGeninVang($player);
break;
case 1:
$this->kitJoninVang($player);
break;
case 2:
$this->kitAnbuVang($player);
break;
case 3:
$this->kitAkatsukiVang($player);
break;
}
});
$myxu = $this->xu->getXu($player);
        $myvang = $this->vang->getVang($player);
        $mybac = $this->bac->getBac($player);
$form->setTitle("§l§1HỆ THỐNG KIT VÀNG");
$form->setContent("§f•§a Số Vàng đang có: §c".$myvang." Vàng\n§f•§a Số Bạc đang có: §c".$mybac." Bạc\n§f•§a Số Xu đang có: §c".$myxu." Xu\n§f•§a Vui lòng chọn loại KIT muốn mua bằng Vàng");
$form->addButton("§l§0KIT GENIN\n§280 Vàng");
$form->addButton("§l§0KIT JONIN\n§2180 Vàng");
$form->addButton("§l§0KIT ANBU\n§2400 Vàng");
$form->addButton("§l§0KIT AKATSUKI\n§21.500 Vàng");
$form->sendToPlayer($player);
return $form;
}


public function kitBac($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
$this->getServer()->dispatchCommand($player, "kit");
return true;
}
switch($result){
case 0:
$this->getServer()->dispatchCommand($player, "kit");
break;
}
});
$myxu = $this->xu->getXu($player);
        $myvang = $this->vang->getVang($player);
        $mybac = $this->bac->getBac($player);
$form->setTitle("§l§1HỆ THỐNG KIT BẠC");
$form->setContent("§cHệ thống này hiện chưa ra mắt!");
$form->addButton("§l§cHỦY");
$form->sendToPlayer($player);
return $form;
}


public function kitXu($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
$this->getServer()->dispatchCommand($player, "kit");
return true;
}
switch($result){
case 0:
$this->kitGeninXu($player);
break;
}
});
$myxu = $this->xu->getXu($player);
        $myvang = $this->vang->getVang($player);
        $mybac = $this->bac->getBac($player);
$form->setTitle("§l§1HỆ THỐNG KIT XU");
$form->setContent("§f•§a Số Vàng đang có: §c".$myvang." Vàng\n§f•§a Số Bạc đang có: §c".$mybac." Bạc\n§f•§a Số Xu đang có: §c".$myxu." Xu\n§f•§a Vui lòng chọn loại KIT muốn mua bằng Xu");
$form->addButton("§l§0KIT GENIN\n§2475.000 Xu");
$form->sendToPlayer($player);
return $form;
}
public function ThongBaoXu1($player, $message){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
$this->kitXu($player);
return true;
}
switch($result){
case 0:
$this->kitXu($player);
break;
}
});
$form->setTitle("§l§1HỆ THỐNG KIT XU");
$form->setContent($message);
$form->addButton("§l§1Đã Hiểu");
$form->sendToPlayer($player);
return $form;
}
public function ThongBaoXu2($player, $message){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
//$this->kitXu($player);
return true;
}
switch($result){
case 0:
//$this->kitXu($player);
break;
}
});
$form->setTitle("§l§1HỆ THỐNG KIT XU");
$form->setContent($message);
$form->addButton("§l§1Đã Hiểu");
$form->sendToPlayer($player);
return $form;
}
public function kitGeninXu($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
$this->kitXu($player);
return true;
}
switch($result){
case 0:
if($this->xu->getXu($player) < 475000){
$this->ThongBaoXu1($player, "§f•§c Nhẫn Giả không có đủ 475.000 Xu để mua Kit Genin");
return true;
}
if($this->rank->getRank($player) == "Tập Sự"){
$this->ThongBaoXu1($player, "§f•§c Nhẫn Giả hiện chưa đạt cấp bậc Genin nên không thể mua!");
return true;
}
$this->kit->kitGenin($player);
$this->xu->reduceXu($player, 475000);
$this->ThongBaoXu2($player, "§f•§a Nhẫn Giả đã mua thành công Kit Genin!");
break;
case 1:
$this->kitXu($player);
break;
}
});


//--------------------------------------------------------------------------------------------------------------------------------------//
$form->setTitle("§l§1XÁC NHẬN MUA KIT GENIN?");
$form->setContent("§l§c•§6 Set Đồ Lưới:\n§r§b+§a Protection:§e 3\n§r§b+§a Fire Protection:§e 1\n§r§b+§a Projectile Protection:§e 2\n§l§c•§6 Kiếm Đá:\n§r§b+§a Sharpness:§e 2\n§r§b+§a Fire Aspect:§e 1");
$form->addButton("§l§0MUA");
$form->addButton("§l§0HỦY");
$form->sendToPlayer($player);
return $form;
}
public function kitGeninVang($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
$this->kitVang($player);
return true;
}
switch($result){
case 0:
if($this->vang->getVang($player) < 80){
$this->ThongBaoVang1($player, "§f•§c Nhẫn Giả không có đủ 80 Vàng để mua Kit Genin");
return true;
}
if($this->rank->getRank($player) == "Tập Sự"){
$this->ThongBaoVang1($player, "§f•§c Nhẫn Giả hiện chưa đạt cấp bậc Genin nên không thể mua!");
return true;
}
$this->kit->kitGenin($player);
$this->vang->reduceVang($player, 80);
$this->ThongBaoVang2($player, "§f•§a Nhẫn Giả đã mua thành công Kit Genin!");
break;
case 1:
$this->kitVang($player);
break;
}
});



$form->setTitle("§l§1XÁC NHẬN MUA KIT GENIN?");
$form->setContent("§l§c•§6 Set Đồ Lưới:\n§r§b+§a Protection:§e 3\n§r§b+§a Fire Protection:§e 1\n§r§b+§a Projectile Protection:§e 2\n§l§c•§6 Kiếm Đá:\n§r§b+§a Sharpness:§e 2\n§r§b+§a Fire Aspect:§e 1");
$form->addButton("§l§0MUA");
$form->addButton("§l§0HỦY");
$form->sendToPlayer($player);
return $form;
}

public function kitJoninVang($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
$this->kitVang($player);
return true;
}
switch($result){
case 0:
if($this->vang->getVang($player) < 180){
$this->ThongBaoVang1($player, "§f•§c Nhẫn Giả không có đủ 180 Vàng để mua Kit Jonin");
return true;
}
if($this->rank->getRank($player) == "Tập Sự" || $this->rank->getRank($player) == "Genin" || $this->rank->getRank($player) == "Chunnin"){
$this->ThongBaoVang1($player, "§f•§c Nhẫn Giả hiện chưa đạt cấp bậc Jonin nên không thể mua!");
return true;
}
$this->kit->kitJonin($player);
$this->vang->reduceVang($player, 180);
$this->ThongBaoVang2($player, "§f•§a Nhẫn Giả đã mua thành công Kit Jonin!");
break;
case 1:
$this->kitVang($player);
break;
}
});



$form->setTitle("§l§1XÁC NHẬN MUA KIT JONIN?");
$form->setContent("§l§c•§6 Set Đồ Lưới:\n§r§b+§a Protection:§e 5\n§r§b+§a Fire Protection:§e 3\n§r§b+§a Projectile Protection:§e 4\n§r§b+§a Thorns:§e 2\n§r§b+§a AntiKnockback:§e 1\n§r§b+§a Charge:§e 1\n§l§c•§6 Kiếm Sắt:\n§r§b+§a Sharpness:§e 4\n§r§b+§a Fire Aspect:§e 3\n§r§b+§a Poison:§e 1");
$form->addButton("§l§0MUA");
$form->addButton("§l§0HỦY");
$form->sendToPlayer($player);
return $form;
}

public function kitAnbuVang($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
$this->kitVang($player);
return true;
}
switch($result){
case 0:
if($this->vang->getVang($player) < 400){
$this->ThongBaoVang1($player, "§f•§c Nhẫn Giả không có đủ 400 Vàng để mua Kit Jonin");
return true;
}
if($this->rank->getRank($player) == "Tập Sự" || $this->rank->getRank($player) == "Genin" || $this->rank->getRank($player) == "Chunnin" || $this->rank->getRank($player) == "Jonin" || $this->rank->getRank($player) == "Jonin 1 Sao" || $this->rank->getRank($player) == "Jonin 2 Sao" || $this->rank->getRank($player) == "Jonin 3 Sao"){
$this->ThongBaoVang1($player, "§f•§c Nhẫn Giả hiện chưa đạt cấp bậc Anbu nên không thể mua!");
return true;
}
$this->kit->kitAnbu($player);
$this->vang->reduceVang($player, 400);
$this->ThongBaoVang2($player, "§f•§a Nhẫn Giả đã mua thành công Kit Anbu!");
break;
case 1:
$this->kitVang($player);
break;
}
});



$form->setTitle("§l§1XÁC NHẬN MUA KIT ANBU?");
$form->setContent("§l§c•§6 Set Đồ Sắt:\n§r§b+§a Protection:§e 5\n§r§b+§a Fire Protection:§e 3\n§r§b+§a Projectile Protection:§e 4\n§r§b+§a Thorns:§e 2\n§r§b+§a AntiKnockback:§e 1\n§r§b+§a Charge:§e 1\n§r§b+§a Gears:§e 1\n§r§b+§a Glowing:§e 1\n§r§b+§a Blessed:§e 1\n§r§b+§a Cloaking:§e 1\n§l§c•§6 Kiếm Sắt:\n§r§b+§a Sharpness:§e 5\n§r§b+§a Fire Aspect:§e 5\n§r§b+§a Poison:§e 2\n§r§b+§a Mending:§e 1\n§r§b+§a Paralyze:§e 1\n§l§c•§6 Cung Tên:\n§r§b+§a Grappling:§e 1");
$form->addButton("§l§0MUA");
$form->addButton("§l§0HỦY");
$form->sendToPlayer($player);
return $form;
}
public function kitAkatsukiVang($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
$this->kitVang($player);
return true;
}
switch($result){
case 0:
if($this->vang->getVang($player) < 1500){
$this->ThongBaoVang1($player, "§f•§c Nhẫn Giả không có đủ 1.500 Vàng để mua Kit Jonin");
return true;
}
if($this->rank->getRank($player) == "Tập Sự" || $this->rank->getRank($player) == "Genin" || $this->rank->getRank($player) == "Chunnin" || $this->rank->getRank($player) == "Jonin" || $this->rank->getRank($player) == "Jonin 1 Sao" || $this->rank->getRank($player) == "Jonin 2 Sao" || $this->rank->getRank($player) == "Jonin 3 Sao"){
$this->ThongBaoVang1($player, "§f•§c Nhẫn Giả hiện chưa đạt cấp bậc Anbu nên không thể mua!");
return true;
}
$this->kit->kitAkatsuki($player);
$this->vang->reduceVang($player, 1500);
$this->ThongBaoVang2($player, "§f•§a Nhẫn Giả đã mua thành công Kit Akatsuki!");
break;
case 1:
$this->kitVang($player);
break;
}
});



$form->setTitle("§l§1XÁC NHẬN MUA KIT AKATSUKI?");
$form->setContent("§l§c•§6 Set Đồ Vàng:\n§r§b+§a Protection:§e 10\n§r§b+§a Fire Protection:§e 3\n§r§b+§a Projectile Protection:§e 4\n§r§b+§a Thorns:§e 5\n§r§b+§a AntiKnockback:§e 3\n§r§b+§a Charge:§e 2\n§r§b+§a Gears:§e 2\n§r§b+§a Glowing:§e 1\n§r§b+§a Blessed:§e 1\n§r§b+§a Cloaking:§e 1\n§r§b+§a Feather Falling:§e 2\n§r§b+§a SelfDestruct:§e 1\n§r§b+§a Overload:§e 1\n§r§b+§a Enlighted:§e 1\n§r§b+§a Berserker:§e 1\n§l§c•§6 Kiếm Vàng:\n§r§b+§a Sharpness:§e 10\n§r§b+§a Fire Aspect:§e 5\n§r§b+§a Poison:§e 2\n§r§b+§a Mending:§e 1\n§r§b+§a Paralyze:§e 1\n§r§b+§a Hallucination:§e 1\n§l§c•§6 Cung Tên:\n§r§b+§a Blaze:§e 1");
$form->addButton("§l§0MUA");
$form->addButton("§l§0HỦY");
$form->sendToPlayer($player);
return $form;
}
public function ThongBaoVang1($player, $message){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
$this->kitVang($player);
return true;
}
switch($result){
case 0:
$this->kitVang($player);
break;
}
});



$form->setTitle("§l§1HỆ THỐNG KIT VÀNG");
$form->setContent($message);
$form->addButton("§l§1Đã Hiểu");
$form->sendToPlayer($player);
return $form;
}
public function ThongBaoVang2($player, $message){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
return true;
}
switch($result){
case 0:
break;
}
});
$form->setTitle("§l§1HỆ THỐNG KIT VÀNG");
$form->setContent($message);
$form->addButton("§l§1Đã Hiểu");
$form->sendToPlayer($player);
return $form;
}
}