<?php

namespace phuongaz\Skin\Commands;

use pocketmine\command\{
	Command,
	CommandSender
};

use phuongaz\Skin\Skin;
use pocketmine\Player;

Class SkinCommand extends Command {

	public function __construct(){
		parent::__construct("aohoa", "Hệ Thống Ảo Hóa");
	}

	public function execute(CommandSender $sender, string $label, array $args) :bool {
		if($sender instanceof Player){
			Skin::sendForm($sender);
		}else $sender->sendMessage("use command in game");
		return true;
	}
}