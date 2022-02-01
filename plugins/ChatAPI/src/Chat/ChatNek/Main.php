<?php

namespace Chat\ChatNek;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\utils\TextFormat;
use pocketmine\event\Listener;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use onebone\economyapi\EconomyAPI;
use pocketmine\item\Item;
use pocketmine\event\player\{PlayerInteractEvent, PlayerItemHeldEvent, PlayerJoinEvent, PlayerChatEvent};
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\block\Block;
use pocketmine\math\Vector3;
use pocketmine\utils\Config;
use pocketmine\Inventory;
use pocketmine\level\Level;
use pocketmine\entity\human;
use pocketmine\entity\Effect;
use pocketmine\network\protocol\SetTitlePacket;

class Main extends PluginBase implements Listener{
public function onEnable(){
$this->getServer()->getPluginManager()->registerEvents($this, $this);
$this->level = $this->getServer()->getPluginManager()->getPlugin("NGVS_Level");
$this->rank = $this->getServer()->getPluginManager()->getPlugin("NGVS_Rank");
$this->giatoc = $this->getServer()->getPluginManager()->getPlugin("NGVS_GiaToc");
}
public function getPlayerClan(Player $player){
return $this->clan->getPlayer($player)->getClan() === null ? "" : $this->clan->getPlayer($player)->getClan()->getName();
}

public function onChat(PlayerChatEvent $event){
$player = $event->getPlayer();
$giatoc = $this->giatoc->getGiaToc($player);
$level = $this->level->getLevel($player);
$rank = $this->rank->getRank($player);
$this->getServer()->broadcastMessage("§c❃§e §e【§b".$giatoc."§e】§e【§bCấp ".$level."§e】§e【§b".$rank."§e】§r§e ".$player->getName()."§r§f ⋙ ".$event->getMessage());
$event->setCancelled(true);
}
}
