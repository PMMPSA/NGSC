<?php

namespace SRK;

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
use pocketmine\event\entity\ExplosionPrimeEvent;
use onebone\economyapi\EconomyAPI;
use pocketmine\item\Item;
use pocketmine\event\player\{PlayerInteractEvent, PlayerItemHeldEvent, PlayerJoinEvent, PlayerChatEvent};
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\block\Block;
use pocketmine\level\particle\{AngryVillagerParticle,BubbleParticle,CriticalParticle,DestroyBlockParticle,DustParticle,EnchantmentTableParticle,EnchantParticle,EntityFlameParticle,LargeExplodeParticle,FlameParticle,HappyVillagerParticle,HeartParticle,InkParticle,InstantEnchantParticle,ItemBreakParticle,LavaDripParticle,LavaParticle,MobSpellParticle,PortalParticle,RainSplashParticle,RedstoneParticle,SmokeParticle,SpellParticle,SplashParticle,SporeParticle,TerrainParticle,WaterDripParticle,WaterParticle,WhiteSmokeParticle, HugeExplodeSeedParticle};
use pocketmine\math\Vector3;
use pocketmine\entity\Entity;
use pocketmine\utils\Config;
use pocketmine\Inventory;
use pocketmine\level\Level;
use pocketmine\entity\human;
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\network\protocol\SetTitlePacket;

class DC extends PluginBase implements Listener{

public function onEnable() : void{
$this->getServer()->getPluginManager()->registerEvents($this, $this);
$this->mana = $this->getServer()->getPluginManager()->getPlugin("NGVS_Mana");
$this->level = $this->getServer()->getPluginManager()->getPlugin("NGVS_Level");
$this->stats = $this->getServer()->getPluginManager()->getPlugin("NGVS_Stats");
$this->getLogger()->info("Shuriken đã bật");
}

public function onExplode(ExplosionPrimeEvent $event){
$event->setBlockBreaking(false);
}
public function HitArrow(EntityDamageEvent $event){
$entity = $event->getEntity();
if($event instanceof EntityDamageByEntityEvent){
$damager = $event->getDamager();
$cause = $event->getCause();
if($damager instanceof Player && $cause == EntityDamageEvent::CAUSE_PROJECTILE && $damager->getInventory()->getItemInHand()->getId() == 332){
$level = $entity->getLevel();
$level->addParticle(new HugeExplodeSeedParticle($entity->getPosition()));
$item = $damager->getInventory()->getItemInHand()->setCustomName("§r§aShuriken");
$damager->getInventory()->setItemInHand($item);
return true;
}
}
}
}


