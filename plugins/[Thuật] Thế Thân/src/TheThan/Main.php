<?php

declare(strict_types=1);

namespace TheThan;

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
use pocketmine\event\player\{PlayerInteractEvent, PlayerItemHeldEvent, PlayerJoinEvent, PlayerChatEvent};
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
use pocketmine\scheduler\ClosureTask;

class Main extends PluginBase implements Listener{

    public function onEnable() : void{
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->mana = $this->getServer()->getPluginManager()->getPlugin("NGVS_Mana");
        $this->level = $this->getServer()->getPluginManager()->getPlugin("NGVS_Level");
    }
    /**
     * @param PlayerDeathEvent $event
     * @return void
     */
    public function onJoin(PlayerJoinEvent $event){
    if($event->getPlayer()->isOp()){
    $a = Item::get(Item::NETHER_STAR, 0, 1);
    $a->setCustomName("§r§c『§6THUẬT§c』§a Thế Thân");
    $event->getPlayer()->getInventory()->addItem($a);
    }
    }
    public function onTap(PlayerInteractEvent $event){
        $player = $event->getPlayer();
        if($event->getPlayer()->getInventory()->getItemInHand()->getCustomName() === "§r§c『§6THUẬT§c』§a Thế Thân" && $this->mana->getMana($player) < 30){
        $player->sendMessage("§c✿§e Số Charka §6Nhẫn Giả§e đang có không đủ để thi triển thuật này!");
        return true;
        }
    if($event->getPlayer()->getInventory()->getItemInHand()->getCustomName() === "§r§c『§6THUẬT§c』§a Thế Thân" && $this->level->getLevel($player) < 2){
        $player->sendMessage("§c✿§e Cấp độ hiện tại của §6Nhẫn Giả§e không phù hợp để thi triển thuật này!");
        return true;
        }
    if($event->getPlayer()->getInventory()->getItemInHand()->getCustomName() === "§r§c『§6THUẬT§c』§a Thế Thân" && $this->mana->getMana($player) >= 30 && $this->level->getLevel($player) >= 2){
    $this->mana->setMana($player, $this->mana->getMana($player) - 30);
$location[] = (new Vector3($player->x, $player->y, $player->z))->floor();
		$location[] = (new Vector3($player->x, $player->y + 1, $player->z))->floor();
		$level = $player->getLevel();
		foreach($location as $loc){
			$level->setBlockIdAt($loc->x, $loc->y, $loc->z, 17);
		}
		$this->getScheduler()->scheduleDelayedTask(new ClosureTask(
        function(int $currentTick) use($level, $location) : void{
			foreach($location as $loc){
                $level->setBlockIdAt($loc->x, $loc->y, $loc->z, 0);
            }
        }), 100);
$level = $player->getLevel();
$level1 = $player->getLevel();
$direction = $player->getDirectionVector();
$time = 1;
$pi = 3.14159;
$time = $time+0.1/$pi;
for($i = 0; $i <= 2*$pi; $i+=$pi/8){
$x = $player->getX();
$y = $player->getY();
$z = $player->getZ();
$vector = new Vector3($x, $y, $z);
$px = $time*cos($i);
$py = exp(-0.1*$time)*sin($time)+1.5;
$pz = $time*sin($i);
$vector1 = $vector->add($px, $py, $pz);
$level->addParticle(new SmokeParticle($vector1));
$level->addParticle(new SmokeParticle($vector1));
$directvector = $player->getDirectionVector();
$unitVector = new Vector3(-$directvector->x, -$directvector->y, -$directvector->z);
$unitVector = $unitVector->normalize();
$player->setMotion($unitVector->multiply(2));
$hand = $player->getInventory()->getItemInHand();
$item = $hand->setCount($hand->getCount() -1);
$player->getInventory()->setItemInHand($item);
    }
//return true;
   }
}
}