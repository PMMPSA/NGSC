<?php

namespace SVT;

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
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args):bool{
        switch($cmd->getName()){
        case "vithu":
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
            /*case 0:
            $this->getServer()->getCommandMap()->dispatch($player, "dvt1🐍");
            break;
            case 1:
            $this->getServer()->getCommandMap()->dispatch($player, "dvt2🐍");
            break;
            case 2:
            $this->getServer()->getCommandMap()->dispatch($player, "dvt3🐍");
            break;*/
            case 0:
            $this->getServer()->getCommandMap()->dispatch($player, "dvt7卍卐");
            break;
            /*case 4:
            $this->getServer()->getCommandMap()->dispatch($player, "dvt5🐍");
            break;
            case 5:
            $this->getServer()->getCommandMap()->dispatch($player, "dvt6🐍");
            break;
			case 6:
            $this->getServer()->getCommandMap()->dispatch($player, "dvt7🐍");
            break;
            case 7:
            $this->getServer()->getCommandMap()->dispatch($player, "dvt8🐍");
            break;*/
			case 1:
            $this->getServer()->getCommandMap()->dispatch($player, "dvt9卍卐");
            break;
            }
        });
        $form->setTitle("§l§1HỆ THỐNG SĂN VĨ THÚ");
       // $form->addButton("§l§2NHẤT VĨ SHUKAKU\n§r§f§c(Cấp 10 được tham chiến)");
       // $form->addButton("§l§2NHỊ VĨ NEKOMATA\n§r§f§c(Cấp 20 được tham chiến)");
        //$form->addButton("§l§2TAM VĨ ISONADE\n§r§f§c(Cấp 25 được tham chiến)");
        $form->addButton("§l§2NHẤT VĨ SHUKAKU\n§r§f§c(Cấp 25 được tham chiến)");
        /*$form->addButton("§l§2NGŨ VĨ HOUKOU\n§r§f§c(Cấp 35 được tham chiến)");
        $form->addButton("§l§2LỤC VĨ RAIJUU\n§r§f§c(Cấp 50 được tham chiến)");
		$form->addButton("§l§2THẤT VĨ KAKU\n§r§f§c(Cấp 60 được tham chiến)");
		$form->addButton("§l§2BÁT VĨ HACHIBI\n§r§f§c(Cấp 80 được tham chiến)");*/
		//$form->addButton("§l§2CỬU VĨ KURAMA\n§r§f§c(Cấp 10 được tham chiến)");
        $form->sendToPlayer($sender);
        }
return true;
}
}

