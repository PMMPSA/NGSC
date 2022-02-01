<?php

namespace NGVS\NGVS_Mana\Mana;

use NGVS\NGVS_Mana\Main;
use pocketmine\scheduler\Task;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\utils\Config;

class ManaTask extends Task {

  public function __construct(Main $plugin) {
    $this->plugin = $plugin;
  }

  public function getPlugin () {
    return $this->plugin;
  }

  public function onRun (int $currentTick) {
    foreach($this->getPlugin()->getServer()->getOnlinePlayers () as $player) {
        if($this->getPlugin()->mana->get(strtolower($player->getName())) == 250 || $this->getPlugin()->mana->get(strtolower($player->getName())) > 250){
          $this->getPlugin()->mana->set(strtolower($player->getName()), 250);
        }else{
          $mana = $this->getPlugin()->mana->get(strtolower($player->getName()));
          $this->getPlugin()->mana->set(strtolower($player->getName()), $mana + 1);
          $player->sendTip("§d༺§b Lượng Chakra Còn: §c".$mana."§b/§c250 §d༻");
          
        }
    }
      }
    }