<?php

namespace LousWiteMC;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\{Command, CommandSender, ConsoleCommandSender};
use pocketmine\event\Listener;

class HubLobbySpawn extends PluginBase implements Listener{
	
	public function onEnable(){
		$this->getLogger()->info("Enabled HubLobbySpawn By LousWite MC 1.1");
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool{
		switch($cmd->getName()){
			case "hub":
			case "lobby":
			case "spawn":
			$player = $sender->getPlayer();
			$player->teleport($this->getServer()->getLevelByName("Konoha")->getSafeSpawn());
			$player->sendMessage("§c•§6 Nhẫn Giả§e đã quay trở về sảnh chính");
			break;
			//return true;
            case "city⛄":
            $player = $sender->getPlayer();
			$player->teleport($this->getServer()->getLevelByName("Future")->getSafeSpawn());
			break;
		}
		return true;
	}
}
