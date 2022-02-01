<?php

namespace KA;

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
use pocketmine\event\entity\EntityDeathEvent;
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
use pocketmine\math\AxisAlignedBB;
//use pocketmine\math\Vector3;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\entity\EffectInstance;
use pocketmine\network\protocol\SetTitlePacket;

class Main extends PluginBase implements Listener {
    
    public function onEnable(){
        $this->level = $this->getServer()->getPluginManager()->getPlugin("NGVS_Level");
        $this->xu = $this->getServer()->getPluginManager()->getPlugin("NGVS_Xu");
        $this->vang = $this->getServer()->getPluginManager()->getPlugin("NGVS_Vang");
        $this->bac = $this->getServer()->getPluginManager()->getPlugin("NGVS_Bac");
        $this->qidacoin = $this->getServer()->getPluginManager()->getPlugin("NGVS_QidaCoin");
        $this->chakra = $this->getServer()->getPluginManager()->getPlugin("NGVS_Mana");
        $this->kit = $this->getServer()->getPluginManager()->getPlugin("NGVS_Kit");
        $this->rank = $this->getServer()->getPluginManager()->getPlugin("NGVS_Rank");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    public function onHeld(PlayerItemHeldEvent $event){
    $player = $event->getPlayer();
    if($player->getInventory()->getItemInHand()->getName() == "§r§l§gMŨ JONIN"){
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ antiknockback 1");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ charge 1");
    return true;
    }
    if($player->getInventory()->getItemInHand()->getName() == "§r§l§gGIÁP JONIN"){
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ antiknockback 1");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ charge 1");
    return true;
    }
    if($player->getInventory()->getItemInHand()->getName() == "§r§l§gQUẦN JONIN"){
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ antiknockback 1");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ charge 1");
    return true;
    }
    if($player->getInventory()->getItemInHand()->getName() == "§r§l§gGIÀY JONIN"){
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ antiknockback 1");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ charge 1");
    return true;
    }
    if($player->getInventory()->getItemInHand()->getName() == "§r§l§gKIẾM JONIN"){
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ poison 1");
    return true;
    }
    if($player->getInventory()->getItemInHand()->getName() == "§r§l§gMŨ ANBU"){
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ antiknockback 1");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ charge 1");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ gears 1");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ glowing 1");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ blessed 1");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ cloaking 1");
    return true;
    }
    if($player->getInventory()->getItemInHand()->getName() == "§r§l§gGIÁP ANBU"){
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ antiknockback 1");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ charge 1");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ gears 1");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ glowing 1");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ blessed 1");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ cloaking 1");
    return true;
    }
    if($player->getInventory()->getItemInHand()->getName() == "§r§l§gQUẦN ANBU"){
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ antiknockback 1");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ charge 1");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ gears 1");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ glowing 1");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ blessed 1");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ cloaking 1");
    return true;
    }
    if($player->getInventory()->getItemInHand()->getName() == "§r§l§gGIÀY ANBU"){
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ antiknockback 1");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ charge 1");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ gears 1");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ glowing 1");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ blessed 1");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ cloaking 1");
    return true;
    }
    if($player->getInventory()->getItemInHand()->getName() == "§r§l§gKIẾM ANBU"){
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ poison 2");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ paralyze 1");
    return true;
    }
    if($player->getInventory()->getItemInHand()->getName() == "§r§l§gCUNG ANBU"){
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ grappling 1");
    return true;
    }
    if($player->getInventory()->getItemInHand()->getName() == "§r§l§cMŨ AKATSUKI"){
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ antiknockback 3");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ charge 2");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ gears 2");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ glowing 1");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ blessed 1");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ cloaking 1");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ featherfalling 2");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ selfdestruct 1");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ overload 1");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ enlighted 1");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ berserker 1");
    return true;
    }
    if($player->getInventory()->getItemInHand()->getName() == "§r§l§cGIÁP AKATSUKI"){
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ antiknockback 3");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ charge 2");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ gears 2");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ glowing 1");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ blessed 1");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ cloaking 1");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ featherfalling 2");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ selfdestruct 1");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ overload 1");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ enlighted 1");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ berserker 1");
    return true;
    }
    if($player->getInventory()->getItemInHand()->getName() == "§r§l§cQUẦN AKATSUKI"){
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ antiknockback 3");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ charge 2");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ gears 2");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ glowing 1");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ blessed 1");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ cloaking 1");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ featherfalling 2");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ selfdestruct 1");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ overload 1");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ enlighted 1");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ berserker 1");
    return true;
    }
    if($player->getInventory()->getItemInHand()->getName() == "§r§l§cGIÀY AKATSUKI"){
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ antiknockback 3");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ charge 2");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ gears 2");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ glowing 1");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ blessed 1");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ cloaking 1");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ featherfalling 2");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ selfdestruct 1");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ overload 1");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ enlighted 1");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ berserker 1");
    return true;
    }
    if($player->getInventory()->getItemInHand()->getName() == "§r§l§cCUNG AKATSUKI"){
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ blaze 1");
    return true;
    }
    if($player->getInventory()->getItemInHand()->getName() == "§r§l§cKIẾM AKATSUKI"){
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ poison 2");
    $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ paralyze 1");
   $this->getServer()->getCommandMap()->dispatch($player, "ce⛄ enchant⛄ hallucination 1");
    return true;
    }
    
    }
    public function kitAnbu(Player $player){
    $mu = Item::get(Item::IRON_HELMET);
    $mu->setCustomName("§r§l§gMŨ ANBU");
    $mu->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(0), 5));
    $mu->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(1), 3));
    $mu->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(4), 4));
    $mu->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(5), 2));
    
    $giap = Item::get(Item::IRON_CHESTPLATE);
    $giap->setCustomName("§r§l§gGIÁP ANBU");
    $giap->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(0), 5));
    $giap->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(1), 3));
    $giap->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(4), 4));
    $giap->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(5), 2));

    $quan = Item::get(Item::IRON_LEGGINGS);
    $quan->setCustomName("§r§l§gQUẦN ANBU");
    $quan->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(0), 5));
    $quan->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(1), 3));
    $quan->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(4), 4));
    $quan->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(5), 2));
    
    $giay = Item::get(Item::IRON_BOOTS);
    $giay->setCustomName("§r§l§gGIÀY ANBU");
    $giay->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(0), 5));
    $giay->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(1), 3));
    $giay->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(4), 4));
    $giay->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(5), 2));
  
  $kiem = Item::get(Item::IRON_SWORD);
  $kiem->setCustomName("§r§l§gKIẾM ANBU");
  $kiem->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(26), 1));
  $kiem->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(9), 5));
    $kiem->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(13), 5));
  
  $cung = Item::get(Item::BOW);
  $cung->setCustomName("§r§l§gCUNG ANBU");

    $player->getInventory()->addItem($mu);
    $player->getInventory()->addItem($giap);
    $player->getInventory()->addItem($quan);
    $player->getInventory()->addItem($giay);
    $player->getInventory()->addItem($kiem);
    $player->getInventory()->addItem($cung);
    }
    
    public function kitAkatsuki(Player $player){
    $mu = Item::get(Item::GOLD_HELMET);
    $mu->setCustomName("§r§l§cMŨ AKATSUKI");
    $mu->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(0), 10));
    $mu->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(1), 3));
    $mu->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(4), 4));
    $mu->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(5), 5));
    
    $giap = Item::get(Item::GOLD_CHESTPLATE);
    $giap->setCustomName("§r§l§cGIÁP AKATSUKI");
    $giap->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(0), 10));
    $giap->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(1), 3));
    $giap->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(4), 4));
    $giap->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(5), 5));
    
    $quan = Item::get(Item::GOLD_LEGGINGS);
    $quan->setCustomName("§r§l§cQUẦN AKATSUKI");
    $quan->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(0), 10));
    $quan->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(1), 3));
    $quan->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(4), 4));
    $quan->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(5), 5));
    
    $giay = Item::get(Item::GOLD_BOOTS);
    $giay->setCustomName("§r§l§cGIÀY AKATSUKI");
    $giay->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(0), 10));
    $giay->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(1), 3));
    $giay->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(4), 4));
    $giay->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(5), 5));
$kiem = Item::get(Item::GOLD_SWORD);
  $kiem->setCustomName("§r§l§cKIẾM AKATSUKI");
  $kiem->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(26), 1));
  $kiem->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(9), 10));
    $kiem->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(13), 5));
  $cung = Item::get(Item::BOW);
  $cung->setCustomName("§r§l§cCUNG AKATSUKI");

    $player->getInventory()->addItem($mu);
    $player->getInventory()->addItem($giap);
    $player->getInventory()->addItem($quan);
    $player->getInventory()->addItem($giay);
    $player->getInventory()->addItem($kiem);
    $player->getInventory()->addItem($cung);
    
    }
    public function kitGenin(Player $player){
    $mu = Item::get(Item::CHAIN_HELMET);
    $mu->setCustomName("§r§l§gMŨ GENIN");
    $mu->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(0), 3));
    $mu->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(1), 1));
    $mu->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(4), 2));
    
    $giap = Item::get(Item::CHAIN_CHESTPLATE);
    $giap->setCustomName("§r§l§gGIÁP GENIN");
    $giap->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(0), 3));
    $giap->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(1), 1));
    $giap->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(4), 2));

    $quan = Item::get(Item::CHAIN_LEGGINGS);
    $quan->setCustomName("§r§l§gQUẦN GENIN");
    $quan->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(0), 3));
    $quan->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(1), 1));
    $quan->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(4), 2));
 
    $giay = Item::get(Item::CHAIN_BOOTS);
    $giay->setCustomName("§r§l§gGIÀY GENIN");
    $giay->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(0), 3));
    $giay->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(1), 1));
    $giay->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(4), 2));

    $kiem = Item::get(Item::IRON_SWORD);
    $kiem->setCustomName("§r§l§gKIẾM GENIN");
    $kiem->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(9), 2));
    $kiem->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(13), 1));
    
    $player->getInventory()->addItem($mu);
    $player->getInventory()->addItem($giap);
    $player->getInventory()->addItem($quan);
    $player->getInventory()->addItem($giay);
    $player->getInventory()->addItem($kiem);
    }
    public function kitJonin(Player $player){
    $mu = Item::get(Item::CHAIN_HELMET);
    $mu->setCustomName("§r§l§gMŨ JONIN");
    $mu->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(0), 5));
    $mu->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(1), 3));
    $mu->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(4), 4));
    $mu->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(5), 2));
    
    $giap = Item::get(Item::CHAIN_CHESTPLATE);
    $giap->setCustomName("§r§l§gGIÁP JONIN");
    $giap->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(0), 5));
    $giap->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(1), 3));
    $giap->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(4), 4));
    $giap->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(5), 2));


    $quan = Item::get(Item::CHAIN_LEGGINGS);
    $quan->setCustomName("§r§l§gQUẦN JONIN");
    $quan->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(0), 5));
    $quan->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(1), 3));
    $quan->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(4), 4));
    $quan->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(5), 2));
 
    $giay = Item::get(Item::CHAIN_BOOTS);
    $giay->setCustomName("§r§l§gGIÀY JONIN");
    $giay->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(0), 5));
    $giay->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(1), 3));
    $giay->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(4), 4));
    $giay->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(5), 2));

    $kiem = Item::get(Item::IRON_SWORD);
    $kiem->setCustomName("§r§l§gKIẾM JONIN");
    $kiem->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(9), 4));
    $kiem->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(13), 3));
    
    $player->getInventory()->addItem($mu);
    $player->getInventory()->addItem($giap);
    $player->getInventory()->addItem($quan);
    $player->getInventory()->addItem($giay);
    $player->getInventory()->addItem($kiem);
    }
}