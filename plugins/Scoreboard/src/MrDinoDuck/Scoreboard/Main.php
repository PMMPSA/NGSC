<?php

declare(strict_types=1);

namespace MrDinoDuck\Scoreboard;

use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use MrDinoDuck\Scoreboard\task\Updating;

class Main extends PluginBase{
	
	public function onEnable() : void{
		$this->getScheduler()->scheduleRepeatingTask(new Updating($this), 3);
		$this->level = $this->getServer()->getPluginManager()->getPlugin("NGVS_Level");
	$this->xu = $this->getServer()->getPluginManager()->getPlugin("NGVS_Xu");
	$this->vang = $this->getServer()->getPluginManager()->getPlugin("NGVS_Vang");
	$this->he = $this->getServer()->getPluginManager()->getPlugin("NGVS_He");
	$this->stats = $this->getServer()->getPluginManager()->getPlugin("NGVS_Stats");
	}
	
public function SBLevel(Player $player){
$level = $this->level->getLevel($player);
return $level;
}
public function SBExp(Player $player){
$exp = $this->level->getExp($player);
return $exp;
}
public function SBMaxExp(Player $player){
$maxexp = $this->level->getMaxExp($player);
return $maxexp;
}
public function SBXu(Player $player){
$xu = $this->xu->getXu($player);
return $xu;
}
public function SBVang(Player $player){
$vang = $this->vang->getVang($player);
return $vang;
}
public function SBHe(Player $player){
$he = $this->he->getHe($player);
return $he;
}
public function SBSpeed(Player $player){
$speed = $this->stats->getCurrentSpeed($player);
return $speed;
}
public function SBJump(Player $player){
$jump = $this->stats->getCurrentJump($player);
return $jump;
}

}
