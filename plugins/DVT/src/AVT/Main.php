<?php

namespace AVT;

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
    case "dvt1卍卐":
        if($sender->getLevel()->getName() == "ViThu"){
        return true;
        }
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
            if($this->level->getLevel($player) < 10){
            $player->sendMessage("§c✾§e Nhẫn Giả chưa đủ cấp để tham chiến!");
            return true;
            }
            $player->teleport($this->getServer()->getLevelByName("warzone")->getSafeSpawn());
            $player->sendMessage("§c✾§e Dịch chuyển đến khu vực săn §6Nhất Vĩ§e thành công.");
            break;
            }
        });
        $form->setTitle("§l§1HỆ THỐNG SĂN VĨ THÚ");
        $form->setContent("§f♦§a BOSS§c NHẤT VĨ§a đã được HỒI SINH.§c Nhẫn Giả§a hãy mau mau tới tiêu diệt! ");
        $form->addButton("§l§2THAM CHIẾN");
        $form->addButton("§l§2KHÔNG THAM CHIẾN");
        $form->sendToPlayer($sender);
        }

	   switch($cmd->getName()){
    case "dvt2卍卐":
        if($sender->getLevel()->getName() == "ViThu"){
        return true;
        }
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
            if($this->level->getLevel($player) < 20){
            $player->sendMessage("§c✾§e Nhẫn Giả chưa đủ cấp để tham chiến!");
            return true;
            }
            $player->teleport($this->getServer()->getLevelByName("lobby")->getSafeSpawn());
            $player->sendMessage("§c✾§e Dịch chuyển đến khu vực săn §6Nhị Vĩ§e thành công.");
            break;
            case 1:
            break;
            }
        });
        $form->setTitle("§l§1HỆ THỐNG SĂN VĨ THÚ");
        $form->setContent("§f♦§a BOSS§c NHỊ VĨ§a đã được HỒI SINH.§c Nhẫn Giả§a hãy mau mau tới tiêu diệt! ");
        $form->addButton("§l§2THAM CHIẾN");
        $form->addButton("§l§2KHÔNG THAM CHIẾN");
        $form->sendToPlayer($sender);
        }

switch($cmd->getName()){
    case "dvt3卍卐":
        if($sender->getLevel()->getName() == "ViThu"){
        return true;
        }
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
            if($this->level->getLevel($player) < 25){
            $player->sendMessage("§c✾§e Nhẫn Giả chưa đủ cấp để tham chiến!");
            return true;
            }
            $player->teleport($this->getServer()->getLevelByName("TamVi")->getSafeSpawn());
            $player->sendMessage("§c✾§e Dịch chuyển đến khu vực săn §6Tam Vĩ§e thành công.");
            break;
            case 1:
            break;
            }
        });
        $form->setTitle("§l§1HỆ THỐNG SĂN VĨ THÚ");
        $form->setContent("§f♦§a BOSS§c TAM VĨ§a đã được HỒI SINH.§c Nhẫn Giả§a hãy mau mau tới tiêu diệt! ");
        $form->addButton("§l§2THAM CHIẾN");
        $form->addButton("§l§2KHÔNG THAM CHIẾN");
        $form->sendToPlayer($sender);
        }

		switch($cmd->getName()){
    case "dvt4卍卐":
        if($sender->getLevel()->getName() == "ViThu"){
        return true;
        }
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
            if($this->level->getLevel($player) < 20){
            $player->sendMessage("§c✾§e Nhẫn Giả chưa đủ cấp để tham chiến!");
            return true;
            }
            $player->teleport($this->getServer()->getLevelByName("warzone")->getSafeSpawn());
            $player->sendMessage("§c✾§e Dịch chuyển đến khu vực săn §6Tứ Vĩ§e thành công.");
            break;
            case 1:
            break;
            }
        });
        $form->setTitle("§l§1HỆ THỐNG SĂN VĨ THÚ");
        $form->setContent("§f♦§a BOSS§c TỨ VĨ§a đã được HỒI SINH.§c Nhẫn Giả§a hãy mau mau tới tiêu diệt! ");
        $form->addButton("§l§2THAM CHIẾN");
        $form->addButton("§l§2KHÔNG THAM CHIẾN");
        $form->sendToPlayer($sender);
        }

		switch($cmd->getName()){
    case "dvt5卍卐":
        if($sender->getLevel()->getName() == "ViThu"){
        return true;
        }
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
            if($this->level->getLevel($player) < 35){
            $player->sendMessage("§c✾§e Nhẫn Giả chưa đủ cấp để tham chiến!");
            return true;
            }
            $player->teleport($this->getServer()->getLevelByName("NguVi")->getSafeSpawn());
            $player->sendMessage("§c✾§e Dịch chuyển đến khu vực săn §6Ngũ Vĩ§e thành công.");
            break;
            case 1:
            break;
            }
        });
        $form->setTitle("§l§1HỆ THỐNG SĂN VĨ THÚ");
        $form->setContent("§f♦§a BOSS§c NGŨ VĨ§a đã được HỒI SINH.§c Nhẫn Giả§a hãy mau mau tới tiêu diệt! ");
        $form->addButton("§l§2THAM CHIẾN");
        $form->addButton("§l§2KHÔNG THAM CHIẾN");
        $form->sendToPlayer($sender);
        }
		
	switch($cmd->getName()){
    case "dvt6卍卐":
        if($sender->getLevel()->getName() == "ViThu"){
        return true;
        }
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
            if($this->level->getLevel($player) < 50){
            $player->sendMessage("§c✾§e Nhẫn Giả chưa đủ cấp để tham chiến!");
            return true;
            }
            $player->teleport($this->getServer()->getLevelByName("LucVi")->getSafeSpawn());
            $player->sendMessage("§c✾§e Dịch chuyển đến khu vực săn §6Lục Vĩ§e thành công.");
            break;
            case 1:
            break;
            }
        });
        $form->setTitle("§l§1HỆ THỐNG SĂN VĨ THÚ");
        $form->setContent("§f♦§a BOSS§c LỤC VĨ§a đã được HỒI SINH.§c Nhẫn Giả§a hãy mau mau tới tiêu diệt! ");
        $form->addButton("§l§2THAM CHIẾN");
        $form->addButton("§l§2KHÔNG THAM CHIẾN");
        $form->sendToPlayer($sender);
        }
		
		switch($cmd->getName()){
    case "dvt7卍卐":
        if($sender->getLevel()->getName() == "ViThu"){
        return true;
        }
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
            if($this->level->getLevel($player) < 60){
            $player->sendMessage("§c✾§e Nhẫn Giả chưa đủ cấp để tham chiến!");
            return true;
            }
            $player->teleport($this->getServer()->getLevelByName("warzone")->getSafeSpawn());
            $player->sendMessage("§c✾§e Dịch chuyển đến khu vực săn §6Thất Vĩ§e thành công.");
            break;
            case 1:
            break;
            }
        });
        $form->setTitle("§l§1HỆ THỐNG SĂN VĨ THÚ");
        $form->setContent("§f♦§a BOSS§c THẤT VĨ§a đã được HỒI SINH.§c Nhẫn Giả§a hãy mau mau tới tiêu diệt! ");
        $form->addButton("§l§2THAM CHIẾN");
        $form->addButton("§l§2KHÔNG THAM CHIẾN");
        $form->sendToPlayer($sender);
        }

		switch($cmd->getName()){
    case "dvt8卍卐":
        if($sender->getLevel()->getName() == "ViThu"){
        return true;
        }
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
            if($this->level->getLevel($player) < 80){
            $player->sendMessage("§c✾§e Nhẫn Giả chưa đủ cấp để tham chiến!");
            return true;
            }
            $player->teleport($this->getServer()->getLevelByName("BatVi")->getSafeSpawn());
            $player->sendMessage("§c✾§e Dịch chuyển đến khu vực săn §6Bát Vĩ§e thành công.");
            break;
            case 1:
            break;
            }
        });
        $form->setTitle("§l§1HỆ THỐNG SĂN VĨ THÚ");
        $form->setContent("§f♦§a BOSS§c BÁT VĨ§a đã được HỒI SINH.§c Nhẫn Giả§a hãy mau mau tới tiêu diệt! ");
        $form->addButton("§l§2THAM CHIẾN");
        $form->addButton("§l§2KHÔNG THAM CHIẾN");
        $form->sendToPlayer($sender);
        }

	 switch($cmd->getName()){
    case "dvt9卍卐":
        if($sender->getLevel()->getName() == "ViThu"){
        return true;
        }
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
            if($this->level->getLevel($player) < 10){
            $player->sendMessage("§c✾§e Nhẫn Giả chưa đủ cấp để tham chiến!");
            return true;
            }
            $player->teleport($this->getServer()->getLevelByName("Konoha")->getSafeSpawn());
            $player->sendMessage("§c✾§e Dịch chuyển đến khu vực săn §6Cửu Vĩ§e thành công.");
            break;
            case 1:
            break;
            }
        });
        $form->setTitle("§l§1HỆ THỐNG SĂN VĨ THÚ");
        $form->setContent("§f♦§a BOSS§c CỬU VĨ§a đã được HỒI SINH.§c Nhẫn Giả§a hãy mau mau tới tiêu diệt! ");
        $form->addButton("§l§2THAM CHIẾN");
        $form->addButton("§l§2KHÔNG THAM CHIẾN");
        $form->sendToPlayer($sender);
        }

return true;
}
public function ThongBaoUI($player, $message){
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
$form->setTitle("§l§1HỆ THỐNG SĂN VĨ THÚ");
$form->setContent($message);
$form->addButton("§l§1Đã Hiểu");
$form->sendToPlayer($player);
return $form;
}
}