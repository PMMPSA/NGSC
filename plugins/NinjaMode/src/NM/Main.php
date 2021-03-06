<?php

namespace NM;

use pocketmine\nbt\tag\{CompoundTag, ListTag, DoubleTag, FloatTag};
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
use pocketmine\event\player\{PlayerInteractEvent, PlayerItemHeldEvent, PlayerJoinEvent, PlayerChatEvent, PlayerToggleSneakEvent};
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\block\Block;
use pocketmine\level\particle\{AngryVillagerParticle,BubbleParticle,CriticalParticle,DestroyBlockParticle,DustParticle,EnchantmentTableParticle,EnchantParticle,EntityFlameParticle,LargeExplodeParticle,FlameParticle,HappyVillagerParticle,HeartParticle,InkParticle,InstantEnchantParticle,ItemBreakParticle,LavaDripParticle,LavaParticle,MobSpellParticle,PortalParticle,RainSplashParticle,RedstoneParticle,SmokeParticle,SpellParticle,SplashParticle,SporeParticle,TerrainParticle,WaterDripParticle,WaterParticle,WhiteSmokeParticle};
use pocketmine\math\Vector3;
use pocketmine\entity\Entity;
use pocketmine\utils\Config;
use pocketmine\Inventory;
use pocketmine\level\Level;
use pocketmine\entity\human;
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\network\protocol\SetTitlePacket;
use TheThan\DTheThanEntity;

class Main extends PluginBase implements Listener{

    public function onEnable() : void{
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->mana = $this->getServer()->getPluginManager()->getPlugin("NGVS_Mana");
        $this->stats = $this->getServer()->getPluginManager()->getPlugin("NGVS_Stats");
        $this->level = $this->getServer()->getPluginManager()->getPlugin("NGVS_Level");
}
public function PlayerToggleSneakEvent(PlayerToggleSneakEvent $event){
$player = $event->getPlayer();
if($player->getInventory()->getItemInHand()->getId() == 0 && $player->isSneaking() && $this->mana->getMana($player) < 50 && $player->getLevel() !== "Future"){
$player->sendMessage("??c?????e S??? Chakra trong ng?????i ??6Nh???n Gi?????e kh??ng ????? ????? b???t ??ach??? ????? Nh???n Gi?????e!");
return true;
}
if($player->getInventory()->getItemInHand()->getId() == 0 && $player->isSneaking() && $this->level->getLevel($player) < 3 && $player->getLevel() !== "Future"){
$player->sendMessage("??c?????e C???p ????? hi???n t???i c???a ??6Nh???n Gi?????e kh??ng ph?? h???p ????? thi tri???n ??ach??? ????? Nh???n Gi?????e!");
return true;
}
if($player->getInventory()->getItemInHand()->getId() == 0 && $player->isSneaking() && $this->mana->getMana($player) >= 50 && $this->level->getLevel($player) >= 3 && $player->getLevel() !== "Future"){
$this->mana->setMana($player, $this->mana->getMana($player) - 50);
$st_sp = $this->stats->getCurrentSpeed($player);
$st_j = $this->stats->getCurrentJump($player);
$effect_speed = Effect::getEffect(1); 
$speed = new EffectInstance($effect_speed, 15*20*$st_sp, 1*$st_sp);
$player->addEffect($speed);
$effect_jump = Effect::getEffect(8); 
$jump = new EffectInstance($effect_jump, 15*20*$st_j, 1*$st_j);
$player->addEffect($jump);
$player->setMaxHealth($this->stats->getCurrentHealth($player)*2);
$player->sendPopup("??f??? ??cCh??? ????? ??l??aNh???n Gi?????r??c ???? ???????c b???t??f ???");
}

}


}