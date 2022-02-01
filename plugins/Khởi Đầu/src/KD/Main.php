<?php

namespace KD;

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
use pocketmine\utils\Config;
use pocketmine\Inventory;
use pocketmine\level\Level;
use pocketmine\entity\human;
use pocketmine\entity\Effect;
use pocketmine\network\protocol\SetTitlePacket;
//use PTK\coinapi\Coin;

class Main extends PluginBase implements Listener{

public $data;
private $config, $amount;

public function onEnable(){
$this->vang = $this->getServer()->getPluginManager()->getPlugin("NGVS_Vang");
$this->xu = $this->getServer()->getPluginManager()->getPlugin("NGVS_Xu");
$this->getServer()->getPluginManager()->registerEvents($this,$this);
}
public function onJoin(PlayerJoinEvent $event){
$player = $event->getPlayer();
if(!$player->hasPlayedBefore()){
$this->getServer()->getCommandMap()->dispatch(new ConsoleCommandSender(), "mw load --all");
$this->CotTruyen1($player);
return true;
}
$this->getServer()->getCommandMap()->dispatch(new ConsoleCommandSender(), "mw load --all");
$this->CotTruyen1($player);
}

public function CotTruyen1($player){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
$form = $api->createSimpleForm(function (Player $player, int $data = null){
$result = $data;
if($result === null){
$this->CotTruyen1($player);
return true;
}
switch($result){
case 0:
//$this->CotTruyen2($player);
break;
}
});
$form->setTitle("§2§lNHẪN GIẢ SONG CHIẾN - KHỞI CHIẾN HÀNH TRÌNH");
$form->setContent("卐Sau thời gian dài nhận được sự quan tâm hết sức\nđặc biệt của cộng đồng Minecraft Bedrock Việt\nNam . Máy chủ Nhẫn Giả Song Chiến - Máy chủ nhẫn\ngiả đầu tiên tại Việt Nam khơi sân cho 2021 - Đã\nchính thức mở bản thử nghiệm! \n\n- Thời gian khai mở : 12h00 ngày 26 tháng 04 năm\n2021.\n- Phiên bản Beta có x2.2 số tiền nạp cho\nphiên bản chính thức.\n\n卐Một thế giới nhẫn giả rộng lớn với đồ hoạ khối chân thật bậc nhất đã được mở ra! Chuyến hành trình huyền thoại của những nhẫn thuật độc đáo và tình đồng đội đầy cảm xúc đang chờ bạn khám phá!\n\n卐Tham gia ngay để tạo nên huyền thoại cho riêng bạn!\n\n-Hokage Đệ Nhất-");
$form->addButton("§l§6Đã Hiểu");
$form->sendToPlayer($player);
return $form;
}
}

