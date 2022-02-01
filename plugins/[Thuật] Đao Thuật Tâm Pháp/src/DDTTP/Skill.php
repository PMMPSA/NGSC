<?php

namespace DDTTP;

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

class Skill extends PluginBase implements Listener{

public function onEnable() : void{
$this->getServer()->getPluginManager()->registerEvents($this, $this);
$this->mana = $this->getServer()->getPluginManager()->getPlugin("NGVS_Mana");
$this->level = $this->getServer()->getPluginManager()->getPlugin("NGVS_Level");
$this->getLogger()->info("Kỹ Năng: Đao Thuật Tâm Pháp đã bật!");
}
public function onJoin(PlayerJoinEvent $event){
if($event->getPlayer()->getName() == "KenKeyJ"){
$a = Item::get(Item::NETHER_STAR, 0, 1);
$a->setCustomName("§r§7【§cTHUẬT§7】§c Đao Thuật Tâm Pháp§7 (§cCấp 5§7) - (§c5 Máu§7) - (§c•§7)");
$event->getPlayer()->getInventory()->addItem($a);
return true;
}
}
public function getDirection($pos) : Vector3
    {
        $y = -sin(deg2rad($pos->pitch));
        $xz = cos(deg2rad($pos->pitch));
        $x = -$xz * sin(deg2rad($pos->yaw));
        $z = $xz * cos(deg2rad($pos->yaw));
        return new Vector3($x, $y, $z);
    }

    public function genCircle(int $radius, int $vertLines, int $dotsPerLine, $center)
    {
        $pitchDelta = (float)180 / $dotsPerLine;
        $yawDelta = (float)360 / $vertLines;

        $results = [];
        for ($i = 0; $i < $vertLines; ++$i) {
            for ($j = 0; $j < $dotsPerLine; ++$j) {
                $loc = clone($center);
                $loc->yaw = -180 + ($i * $yawDelta);
                $loc->pitch = -90 + ($j * $pitchDelta);
                $v = $this->getDirection($loc)->normalize()->multiply($radius);
                $results[] = $v;
            }
        }
        return $results;
    }

    public function makeSphere($player, $radius = 5) {
        $data = $this->genCircle($radius, 20, 20, $player->getLocation());
        foreach ($data as $pos) $player->getLevel()->addParticle(new HeartParticle($player->add($pos->x, $pos->y, $pos->z)));
    }
public function onFight(EntityDamageEvent $event) {
if($event instanceof EntityDamageByEntityEvent) {
$hit = $event->getEntity();
$damager = $event->getDamager();
if($damager instanceof Player) {
if($hit->getName() == "KenKeyJ" && !$event->isCancelled()){
$event->setCancelled();
$damager->sendPopup("§f•§a Nhẫn Giả không thể đánh §cHokage§f •\n\n\n");
}
}
if(!$damager instanceof Player){
return false;
}
/*if(!$hit instanceof Player){
return false;
}*/
if($damager->getHealth() < 10 && $damager->getInventory()->getItemInHand()->getCustomName() === "§r§7【§cTHUẬT§7】§c Đao Thuật Tâm Pháp§7 (§cCấp 5§7) - (§c5 Máu§7) - (§c•§7)"){
$damager->sendPopup("§c❖§e Số máu của §6Nhẫn Giả§e không đủ để thi triển thuật!\n\n\n");
return true;
}
if($this->level->getLevel($damager) < 5 && $damager->getInventory()->getItemInHand()->getCustomName() === "§r§7【§cTHUẬT§7】§c Đao Thuật Tâm Pháp§7 (§cCấp 5§7) - (§c5 Máu§7) - (§c•§7)"){
$damager->sendPopup("§c❖§e Cấp của §6Nhẫn Giả§e chưa đạt để thi triển thuật!\n\n\n");
return true;
}
if($event->isCancelled() && $damager->getInventory()->getItemInHand()->getCustomName() === "§r§7【§cTHUẬT§7】§c Đao Thuật Tâm Pháp§7 (§cCấp 5§7) - (§c5 Máu§7) - (§c•§7)"){
$damager->sendPopup("§c❖§e Khu vực này không cho phép sử dụng nhẫn thuật.\n\n\n");
return true;
}
if($damager->getHealth() >= 10 && $this->level->getLevel($damager) >= 5 && !$event->isCancelled() && $damager->getInventory()->getItemInHand()->getCustomName() === "§r§7【§cTHUẬT§7】§c Đao Thuật Tâm Pháp§7 (§cCấp 5§7) - (§c5 Máu§7) - (§c•§7)"){
$this->mana->setMana($damager, 250);
$damager->addEffect(new EffectInstance(Effect::getEffect(14), 5*20, 2));
$damager->setHealth($damager->getHealth() - 5);
//$hit->addTitle("§bĐao Thuật Tâm Pháp");
//$hit->setOnFire($this->level->getLevel($damager));
$this->makeSphere($damager);
}
}
}











}