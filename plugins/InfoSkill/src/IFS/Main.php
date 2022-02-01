<?php

namespace IFS;

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
        $this->chakra = $this->getServer()->getPluginManager()->getPlugin("NGVS_Mana");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args):bool{
        switch($cmd->getName()){
        case "nhanthuat":
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
            $this->skillUI($player, "Ám Sát Thuật", "Hỏa", "Tạo ra vòng tròn lửa xung quanh đối phương. Đối phương dính Nhẫn Thuật sẽ bị nhiễm lửa cấp độ 2.", "5", "10 Chakra", "Công", "Không");
            break;
            case 1:
            $this->skillUI($player, "Bát Quái Không Chưởng", "Phong", "Người dính Nhẫn Thuật sẽ bị đánh văng ra xa kèm hiệu ứng nổ tung. Đồng thời dính hiệu ứng Làm Chậm cấp 2 trong vòng 1 giây, Rút Máu cấp 1 trong vòng 3 giây.", "5", "30 Chakra", "Công", "Hyuaga");
            break;
            case 2:
            $this->skillUI($player, "Byakugan", "Phong", "Khi dùng sẽ thấy được toàn bộ thông tin chỉ số của đối phương. Bản thân được Buff hiệu ứng Chạy Nhanh cấp 20 trong vòng 5 giây.", "5", "50 Chakra", "Buff Hiệu Ứng", "Hyuaga");
            break;
            case 3:
            $this->skillUI($player, "Đao Thuật Tâm Pháp", "Không", "Sử dụng 5 Sinh Lực của bản thân để hồi lại toàn bộ Chakra.", "5", "5 Máu", "Buff Hiệu Ứng", "Không");
            break;
            case 4:
            $this->skillUI($player, "Luân Thuật Tâm Pháp", "Lôi", "Triệu hồi ra xoáy điện, Sinh Lực bản thân được cộng 1 và được Buff hiệu ứng Chạy Nhanh cấp 1 trong 3 giây.", "5", "10 Chakra", "Buff Hiệu Ứng", "Không");
            break;
            case 5:
            $this->skillUI($player, "Niên Hạ Hỏa Độn", "Hỏa", "Triệu hồi ra ký hiệu ửa, những đối phương xung quanh sẽ bị dính lửa dựa theo cấp độ của người sử dụng Nhẫn Thuật và nhiễm hiệu ứng Gây Choáng cấp 5 trong vòng 3 giây.", "5", "70 Chakra", "Công, Diện Rộng", "Uchiha");
            break;
            case 6:
            $this->skillUI($player, "Sharingan", "Hỏa", "Người dùng thuật sẽ làm cho đối phương nhiễm hiệu ứng Gây Choáng cấp 20 trong vòng 2 giây và hiệu ứng Mù Lòa cấp 20 trong vòng 3 giây.", "5", "50 Chakra", "Buff Hiệu Ứng", "Uchiha");
            break;
            case 7:
            $this->skillUI($player, "Tăng Sinh Chi Thuật", "Không", "Khu sử dụng, cả đối phương và bản thân người dùng thuật đều sẽ được hồi 2 Sinh Lực.", "5", "10 Chakra", "Buff Hiệu Ứng", "Không");
            break;
            case 8:
            $this->skillUI($player, "Tâm Trung Đoạn Thủ", "Lôi", "Triệu hồi ra xoáy điện, người dính Thuật sẽ bị rút đi 8 Chakra và nhiễm hiệu ứng Yếu Ớt cấp 2 trong vòng 20 giây.", "5", "10 Chakra", "Buff Hiệu Ứng", "Không");
            break;
            case 9:
            $this->skillUI($player, "Thế Thân", "Không", "Triệu hồi ra hình nhân của người dùng thuật trong vòng 3 giây, người dùng thuật được Buff hiệu ứng Tàng Hình cấp 1 trong vòng 2 giây.", "5", "70 Chakra", "Phòng Thủ", "Không");
            break;
            case 10:
            $this->skillUI($player, "Thi Quỷ Phong Tận", "Không", "Triệu hồi ra hình khối xung quanh đối phương dính thuật và nhiễm hiệu ứng Đi Chậm cấp 30 trong vòng 2 giây.", "5", "50 Chakra", "Buff Hiệu Ứng", "Uzumaki");
            break;
            case 11:
            $this->skillUI($player, "Thủy Lao Thuật", "Thủy", "Chỉ khi người dùng thuật sở hữu dưới 5 máu mới có khỏ năng dùng. Khi dùng sẽ triệu hồi ra xoáy nước, toàn bộ số máu của người dùng sẽ được hồi về mức cao nhất nhưng bị nhiễm hiệu ứng Đi Chậm cấp 2 trong vòng 3 giây.", "5", "50 Chakra", "Buff Hiệu Ứng", "Không");
            break;
            case 12:
            $this->skillUI($player, "Thủy Long Đàn Thuật", "Thủy", "Đối phương dính thuật sẽ bị nhiễm hiệu ứng Đi Chậm cấp 2 trong vòng 3 giây và bị rút 5 Chakra.", "5", "10 Chakra", "Buff Hiệu Ứng", "Không");
            break;
            }
        });
        $form->setTitle("§l§1HỆ THỐNG NHẪN THUẬT");
        $form->setContent("§f♦§a Vui lòng chọn một Nhẫn Thuật mà Nhẫn Giả muốn xem thông tin:");
        $form->addButton("§l§2ÁM SÁT THUẬT", 1, "https://nhangiavosong.vn/public/static/uploads/ap-hai.png");
        $form->addButton("§l§2BÁT QUÁI KHÔNG CHƯỞNG", 1, "https://nhangiavosong.vn/public/static/uploads/screenshot_80.png");
        $form->addButton("§l§2BYAKUGAN", 1, "https://nhangiavosong.vn/public/static/uploads/screenshot_109.png");
        $form->addButton("§l§2ĐAO THUẬT TÂM PHÁP", 1, "https://nhangiavosong.vn/public/static/uploads/screenshot_57.png");
        $form->addButton("§l§2LUÂN THUẬT TÂM PHÁP", 1, "https://nhangiavosong.vn/public/static/uploads/screenshot_114.png");

        $form->addButton("§l§2NIÊN HẠ HỎA ĐỘN", 1, "https://nhangiavosong.vn/public/static/uploads/dai-oan-ngu.png");
        $form->addButton("§l§2SHARINGAN", 1, "https://nhangiavosong.vn/public/static/uploads/itachi-saringan.png");
        $form->addButton("§l§2TĂNG SINH CHI THUẬT", 1, "https://nhangiavosong.vn/public/static/uploads/screenshot_61.png");
        $form->addButton("§l§2TÂM TRUNG ĐOẠN THỦ", 1, "https://nhangiavosong.vn/public/static/uploads/screenshot_121.png");
        $form->addButton("§l§2THẾ THÂN", 1, "https://nhangiavosong.vn/public/static/uploads/screenshot_115.png");
        $form->addButton("§l§2THI QUỶ PHONG TẬN", 1, "https://nhangiavosong.vn/public/static/uploads/screenshot_69.png");
        $form->addButton("§l§2THỦY LAO THUẬT", 1, "https://nhangiavosong.vn/public/static/uploads/screenshot_94.png");
        $form->addButton("§l§2THỦY LONG ĐÀN THUẬT", 1, "https://nhangiavosong.vn/public/static/uploads/screenshot_90.png");
        $form->sendToPlayer($sender);
        }
return true;
}
public function skillUI($player, $ten, $he, $noidung, $cap, $chakra, $loai, $giatoc){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null) use ($ten, $he, $noidung, $cap, $chakra, $loai, $giatoc){
$result = $data;
if($result === null){
$this->getServer()->getCommandMap()->dispatch($player, "nhanthuat");
return true;
}
switch($result){
case 0:
$this->getServer()->getCommandMap()->dispatch($player, "nhanthuat");
break;
}
});
$form->setTitle("§l§1".$ten);
$form->setContent("§f•§c Tên Nhẫn Thuật:§a ".$ten."\n§f•§c Hệ:§a ".$he."\n§f•§c Nội Dung:§a ".$noidung."\n§f•§c Cấp Yêu Cầu:§a ".$cap."\n§f•§c Cần Tiêu Hao:§a ".$chakra."\n§f•§c Thuộc Hàng:§a ".$loai."\n§f•§c Gia Tộc:§a ".$giatoc);
$form->addButton("§l§1Quay Lại");
$form->sendToPlayer($player);
return $form;
}
}


