<?php

namespace phuongaz\Skin\form;

use jojoe77777\FormAPI\{SimpleForm, CustomForm};

use pocketmine\Player;

use phuongaz\Skin\{Skin, SkinManager};

Class MainForm {

	private $player;
	private $plugin; 
	public $skinplayer = [];
	private $shops = [];

	public function __construct(Player $player){
		$this->player = $player;
	}

	public function sendToPlayer():void {
		$form = new SimpleForm(function(Player $player, $data){
			if(is_null($data)) return;
			if($data == 0) $this->PlayerSkin();
			if($data == 1) $this->ShopSkin();
		});
		$form->setTitle("§l§4✾§1 HỆ THỐNG ẢO HÓA §4✾");
		$form->addButton("§l§1ẢO HÓA §4VĨ THÚ");
		//$form->addButton("§l§1• §fCửa hàng §1•");
		$form->sendToPlayer($this->player);
	}

	public function PlayerSkin() {
		$skins = [];
		foreach($this->getAllSkin() as $skin => $price){
			if($this->player->hasPermission("$skin.aohoa.vithu")){
				$skins[] = $skin;		
			}
		}
		$form = new CustomForm(function(Player $player, $data) use ($skins){
			if(is_null($data)) $this->sendToPlayer($player);
			if($data[0] == "me"){
				Skin::getInstance()->setDefaultSkin($player);
				$player->sendSkin();
			}
			if(!in_array($data[0], $skins) and $data[0] !== "me"){
				$player->sendMessage("§c❖§e §6Nhẫn Giả§e đã biến đổi lại vị trí ban đầu.");
			}else{
				if($data[0] !== "me") Skin::getSkinManager($player, $data[0])->setSkin();
			}
		});
		$form->setTitle("§l§4✾§1 ẢO HÓA VĨ THÚ §4✾");
		$form->addInput("§c✎§e Vui lòng nhập tên Ảo Hóa", "kurama");
		$form->addLabel("§c✎§e Ảo Hóa Nhẫn Giả đang sở hữu:");
		$i = 0;
		foreach ($skins as $skin) {
			$form->addLabel("§c•§e $skin");
			$i++;
		}
		if($i == 0) $form->addLabel("§6Nhẫn Giả§e không sở hữu Ảo Hóa.");
		$form->addLabel("§c✎§e Gõ <§6me§e> vào khung để trở về Ảo Hóa ban đầu.");
		$form->sendToPlayer($this->player);
	}

	public function ShopSkin() {
		$form = new SimpleForm(function(Player $player, $data){
			if(is_null($data)) return;
			$skin = array_keys($this->shops)[$data];
			if($player->hasPermission("$skin.skin")){
				$player->sendMessage("§l§cBạn đã mua skin này rồi");
				return;
			}
			Skin::getInstance()->buySkin($player, $skin);
			var_dump($skin);
		});
		$form->setTitle("§l§1SKIN SHOP");
		foreach ($this->getAllSkin() as $skin => $price) {
			if($this->player->hasPermission("$skin.skin")){
				$form->addButton("§l§1SKIN:§l§a $skin \n§e$price Point");
			}else $form->addButton("§l§1SKIN:§l§c $skin \n§e$price Point");
			
		}
		$form->sendToPlayer($this->player);
	}

	public function getAllSkin() :?array {
		$config = Skin::getInstance()->getShopConfig()->getAll();
		foreach ($config as $skin => $price) {
			$this->shops[$skin] = $price; 
		}
		return $this->shops;
	}
} 