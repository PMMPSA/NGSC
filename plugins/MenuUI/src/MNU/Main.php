<?php

namespace MNU;

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
        case "menu":
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
            $this->getServer()->getCommandMap()->dispatch($player, "stats");
            break;
            case 1:
            $this->getServer()->getCommandMap()->dispatch($player, "rank");
            break;
            case 2:
            $this->getServer()->getCommandMap()->dispatch($player, "mycode");
            break;
			case 3:
            $this->getServer()->getCommandMap()->dispatch($player, "vithu");
            break;
			case 4:
            $this->getServer()->getCommandMap()->dispatch($player, "akatsuki");
            break;
            case 5:
            $this->getServer()->getCommandMap()->dispatch($player, "dichchuyen");
            break;
            case 6:
            $this->getServer()->getCommandMap()->dispatch($player, "loa");
            break;
            case 7:
            $this->getServer()->getCommandMap()->dispatch($player, "khoe");
            break;
            }
        });
        $myxu = $this->xu->getXu($sender);
        $myvang = $this->vang->getVang($sender);
        $mybac = $this->bac->getBac($sender);
        $myqidacoin = $this->qidacoin->getQidaCoin($sender);
        $form->setTitle("§l§1HỆ THỐNG DỊCH CHUYỂN");
        $form->setContent("§c•§6 Xu đang có: §a".$myxu."§c Xu\n§c•§6 Bạc đang có: §a".$mybac."§c Bạc\n§c•§6 Vàng đang có: §a".$myvang."§c Vàng\n§c•§6 QidaCoin đang có: §a".$myqidacoin."§c QidaCoin");
        $form->addButton("§l§2ĐIỂM TIỀM NĂNG");
        $form->addButton("§l§2CẤP BẬC NHẪN GIẢ");
        $form->addButton("§l§2MÃ QUÀ TẶNG");
		$form->addButton("§l§2HỆ THỐNG SĂN VĨ THÚ");
		$form->addButton("§l§2HỆ THỐNG SĂN AKATSUKI");
        $form->addButton("§l§2HỆ THỐNG DỊCH CHUYỂN");
        $form->addButton("§l§2HỆ THỐNG LOA");
        $form->addButton("§l§2HỆ THỐNG KHOE VẬT PHẨM");
        $form->sendToPlayer($sender);
        }
return true;
}
}

