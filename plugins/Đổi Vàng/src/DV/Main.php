<?php

namespace DV;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use jojoe77777\FormAPI;
use pocketmine\Player;
use pocketmine\math\Vector3;
use pocketmine\Server;
use pocketmine\event\Listener;

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
        case "doivang":
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
            $this->doiQida($player, 180, 200, 200);
            break;
            case 1:
            $this->doiQida($player, 450, 500, 500);
            break;
            case 2:
            $this->doiQida($player, 900, 1000, 1000);
            break;
            case 3:
            $this->doiQida($player, 1800, 2000, 2000);
            break;
            case 4:
            $this->doiQida($player, 4500, 5000, 5000);
            break;
            case 5:
            $this->doiQida($player, 9000, 10000, 10000);
            break;
            }
        });
        $myqidacoin = $this->qidacoin->getQidaCoin($sender);
        $form->setTitle("§l§1HỆ THỐNG ĐỔI QIDACOIN - VÀNG");
        $form->setContent("§c•§6 Số QidaCoin Nhẫn Giả đang có:§a ".$myqidacoin);
		$form->setContent("§c•§6 Khuyến Mãi Bạc Khi Đổi Qidacoin");
        $form->addButton("§l§e180 §0Qidacoin §0Nhận §e200 §0Vàng\n§l§e(§cThưởng:§f 200 Bạc§e)");
        $form->addButton("§l§e450 §0Qidacoin §0Nhận §e500 §0Vàng\n§l§e(§cThưởng:§f 500 Bạc)");
        $form->addButton("§l§e900 §0Qidacoin §0Nhận §e1.000 §0Vàng\n§l§e(§cThưởng:§f 1.000 Bạc)");
        $form->addButton("§l§e1.800 §0Qidacoin §0Nhận §e2.000 §0Vàng\n§l§e(§cThưởng:§f 2.000 Bạc)");
        $form->addButton("§l§e4.500 §0Qidacoin §0Nhận §e5.000 §0Vàng\n§l§e(§cThưởng:§f 5.000 Bạc)");
        $form->addButton("§l§e9.000 §0Qidacoin §0Nhận §e10.000 §0Vàng\n§l§e(§cThưởng:§f 10.000 Bạc)");
        $form->sendToPlayer($sender);
        }
return true;
}
public function doiQida($player, $coin, $nhan, $kmai){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null) use ($coin, $nhan, $kmai){
$result = $data;
if($result === null){
$this->getServer()->dispatchCommand($player, "doivang");
return true;
}
switch($result){
case 0:
if($this->qidacoin->getQidaCoin($player) < $coin){
$this->ThongBao($player, "§f•§c Số QidaCoin bạn đang có không đủ để đổi! Hãy nạp thêm tại /qidacoin");
return true;
}
$this->qidacoin->reduceQidaCoin($player, $coin);
$this->vang->addVang($player, $nhan);
$this->bac->addBac($player, $kmai);
$this->ThongBao($player, "§f•§a Đổi thành công §c".$coin." QidaCoin§a sang §f".$nhan." Vàng§a. Nhận Khuyến Mãi §f".$kmai." Bạc");
break;
case 1:
break;
}
});
$form->setTitle("§l§1HỆ THỐNG ĐỔI QIDACOIN - VÀNG");
$form->setContent("§f•§a Bạn có xác nhận muốn đổi §c".$coin." QidaCoin§a sang §c".$nhan." Vàng§a?");
$form->addButton("§l§1XÁC NHẬN ĐỔI");
$form->addButton("§l§1HỦY");
$form->sendToPlayer($player);
return $form;
}
public function ThongBao($player, $message){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
$this->getServer()->dispatchCommand($player, "doivang");
return true;
}
switch($result){
case 0:
$this->getServer()->dispatchCommand($player, "doivang");
break;
}
});
$form->setTitle("§l§1HỆ THỐNG ĐỔI QIDACOIN - VÀNG");
$form->setContent($message);
$form->addButton("§l§1Đã Hiểu");
$form->sendToPlayer($player);
return $form;
}
}