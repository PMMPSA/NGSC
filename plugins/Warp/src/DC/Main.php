<?php

namespace DC;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use jojoe77777\FormAPI;
use pocketmine\Player;
use pocketmine\math\Vector3;
use pocketmine\Server;
use pocketmine\event\Listener;
use muqsit\chunkloader\ChunkRegion;
use pocketmine\level\Position;
class Main extends PluginBase implements Listener {
    
    public function onEnable(){
        $this->level = $this->getServer()->getPluginManager()->getPlugin("NGVS_Level");
        $this->chakra = $this->getServer()->getPluginManager()->getPlugin("NGVS_Mana");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args):bool{
        switch($cmd->getName()){
        case "dichchuyen":
        if(!($sender instanceof Player)){
                $sender->sendMessage("§cVui lòng dùng lệnh trong Game");
                return true;
        }
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, int $data = null){
            $result = $data;
            if ($result === null) {
            }
            switch ($result) {
            case 0:
            break;
            case 1:
            if($this->chakra->getMana($sender) < 5){
            $this->ThongBaoUI($sender, "§c♦§e Chakra quá thấp, không thể dịch chuyển!");
            return true;
            }
            $this->teleport($sender, $this->getServer()->getLevelByName("Konoha")->getSafeSpawn());
            $this->ThongBaoUI($sender, "§c♦§6 Nhẫn Giả§e đã dịch chuyển đến §aLàng Lá§e thành công.");
            $this->chakra->setMana($sender, $this->chakra->getMana($sender) - 5);
            break;
                    case 2:
                    if($this->chakra->getMana($sender) < 5){
            $this->ThongBaoUI($sender, "§c♦§e Chakra quá thấp, không thể dịch chuyển!");
          return true;
            }
            if($this->level->getLevel($sender) < 5){
            $this->ThongBaoUI($sender, "§c♦§e Cấp Độ quá thấp, không thể dịch chuyển!");
            return true;
            }
            $this->teleport($sender, $this->getServer()->getLevelByName("NRT")->getSafeSpawn());
            $this->ThongBaoUI($sender, "§c♦§6 Nhẫn Giả§e đã dịch chuyển đến §aLàng Cát§e thành công.");
            $this->chakra->setMana($sender, $this->chakra->getMana($sender) - 5);
                        break;
                    case 3:
                   if($this->chakra->getMana($sender) < 5){
            $this->ThongBaoUI($sender, "§c♦§e Chakra quá thấp, không thể dịch chuyển!");
            return true;
            }
            $this->teleport($sender, $this->getServer()->getLevelByName("PVP")->getSafeSpawn());
            $this->ThongBaoUI($sender, "§c♦§6 Nhẫn Giả§e đã dịch chuyển đến §aVõ Đài§e thành công.");
            $this->chakra->setMana($sender, $this->chakra->getMana($sender) - 5);
            break;
                    case 4:
                    if($this->chakra->getMana($sender) < 5){
            $this->ThongBaoUI($sender, "§c♦§e Chakra quá thấp, không thể dịch chuyển!");
          return true;
            }
            if($this->level->getLevel($sender) < 5){
            $this->ThongBaoUI($sender, "§c♦§e Cấp Độ quá thấp, không thể dịch chuyển!");
            return true;
            }
            $this->teleport($sender, $this->getServer()->getLevelByName("trian2")->getSafeSpawn());
			 //$this->ThongBaoUI($sender, "§c♦§6 Bảo Trì");
            $this->ThongBaoUI($sender, "§c♦§6 Nhẫn Giả§e đã dịch chuyển đến §aKhu Farm Genin§e thành công.");
            $this->chakra->setMana($sender, $this->chakra->getMana($sender) - 5);
                        break;
					case 5:
                    if($this->chakra->getMana($sender) < 5){
            $this->ThongBaoUI($sender, "§c♦§e Chakra quá thấp, không thể dịch chuyển!");
          return true;
            }
            if($this->level->getLevel($sender) < 50){
            $this->ThongBaoUI($sender, "§c♦§e Cấp Độ quá thấp, không thể dịch chuyển!");
            return true;
            }
            $this->teleport($sender, $this->getServer()->getLevelByName("dropnew")->getSafeSpawn());
            $this->ThongBaoUI($sender, "§c♦§6 Nhẫn Giả§e đã dịch chuyển đến §aKhu Farm Anbu§e thành công.");
            $this->chakra->setMana($sender, $this->chakra->getMana($sender) - 5);
                        break;
            }
        });
        $form->setTitle("§l§1HỆ THỐNG DỊCH CHUYỂN");
        $form->setContent("§c♦§e Vui lòng chọn khu vực mà §6Nhẫn Giả§e muốn đến:");
        $form->addButton("§l§2THOÁT");
        $form->addButton("§l§2LÀNG LÁ\n§l§0Cấp độ: 0, Chakra: 5", 1, "https://uphinh.vn/images/2020/03/18/83a49a9f3bc02de60983e15e37979637.png");
        $form->addButton("§l§2LÀNG CÁT\n§l§0Cấp độ: 50, Chakra: 5", 1, "https://uphinh.vn/images/2020/03/18/27e02f17742ed0531d9f5fe699244fbb.png");
        $form->addButton("§l§2VÕ ĐÀI\n§l§0Cấp độ: 0, Chakra: 5", 1, "https://www.upsieutoc.com/images/2020/03/18/Warp-Du-Trung.png");
        $form->addButton("§l§2KHU FARM GENIN\n§l§0Cấp độ: 5 --> 50, Chakra: 5", 1, "https://uphinh.vn/images/2020/03/18/210a6f71a58f878c9de23ad2116cced0.png");
		$form->addButton("§l§2KHU FARM ANBU\n§l§0Cấp độ: 50 trở lên, Chakra: 5", 1, "https://uphinh.vn/images/2020/03/18/210a6f71a58f878c9de23ad2116cced0.png");
        $form->sendToPlayer($sender);
        }
return true;
}
public function ThongBaoUI($player, $message){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
$this->getServer()->dispatchCommand($player, "dichchuyen");
return true;
}
switch($result){
case 0:
$this->getServer()->dispatchCommand($player, "dichchuyen");
break;
}
});
$form->setTitle("§l§1HỆ THỐNG DỊCH CHUYỂN");
$form->setContent($message);
$form->addButton("§l§1Đã Hiểu");
$form->sendToPlayer($player);
return $form;
}

    public function teleport(Player $player, Position $pos){
		$level = $pos->getLevel();
		$x = $pos->getX();
		$z = $pos->getZ();
        ChunkRegion::onChunkGenerated($level, $x >> 4, $z >> 4, function() use($player, $pos){
            $player->teleport($pos);
        });
    }
}