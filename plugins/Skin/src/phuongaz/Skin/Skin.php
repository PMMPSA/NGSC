<?php

namespace phuongaz\Skin;

use pocketmine\plugin\PluginBase;
use pocketmine\{Server, Player};
use phuongaz\Skin\{
	Commands\SkinCommand,
	form\MainForm
};
use pocketmine\command\ConsoleCommandSender;

use pocketmine\utils\Config;

use doramine\economyapi\EconomyAPI as PointAPI;

use pocketmine\event\{Listener, player\PlayerJoinEvent};

//use pocketmine\entity\Skin as CT;
Class Skin extends PLuginBase implements Listener{

	private static $instance;

	public static $skins = [];

	public $shops = [];

	public static function getInstance() {
		return self::$instance;
	}

	public function onJoin(PlayerJoinEvent $event){
		$player = $event->getPlayer();
		$name = strtolower($player->getName());
		$this->saveSkin(strtolower($player->getName()), $player->getSkin(), $this->getDataFolder());
	}

    public function setDefaultSkin(Player $player) {
        $skin = $player->getSkin();
        $name = $player->getName();
        $path = $this->getDataFolder()."saveskin/".$name.".png";
        $path2 = $this->getDataFolder()."saveskin/".$name.".txt";
        $size = 0;
        if(filesize($path2) == 65536){
            $size = 128;
        }else {
            $size = 64;
        }
        $img = @imagecreatefrompng($path);
        $skinbytes = "";
        $s = (int)@getimagesize($path)[1];

        for($y = 0; $y < $s; $y++) {
            for($x = 0; $x < $size; $x++) {
                $colorat = @imagecolorat($img, $x, $y);
                $a = ((~((int)($colorat >> 24))) << 1) & 0xff;
                $r = ($colorat >> 16) & 0xff;
                $g = ($colorat >> 8) & 0xff;
                $b = $colorat & 0xff;
                $skinbytes .= chr($r) . chr($g) . chr($b) . chr($a);
            }
        }
        @imagedestroy($img);
        $player->setSkin(new \pocketmine\entity\Skin($skin->getSkinId(), $skinbytes, "", "geometry.humanoid.custom",file_get_contents($this->getDataFolder(). "steve.json")));
        $player->sendSkin();
    }
	public static function saveSkin(string $name, \pocketmine\entity\Skin $skin, string $path){
        if(!file_exists($path."saveskin")){
            mkdir($path."saveskin", 0777);
        }
        if(file_exists($path."saveskin/".$name.".txt")){
            unlink($path."saveskin/".$name.".txt");
        }
        file_put_contents($path."saveskin/".$name.".txt",$skin->getSkinData());
        $img = null;
		if(filesize($path."saveskin/".$name.".txt") == 65536){
            $img = self::toImage($skin->getSkinData(),128,128);
        }else{
            $img = self::toImage($skin->getSkinData(),64,64);
        }
        imagepng($img, $path . "saveskin/"."$name.png");
	}

	public static function toImage($data, $height = 64, $width = 64){
        if (!extension_loaded("gd")) {
            Server::getInstance()->getLogger()->error("GD library is not enabled! Please uncomment gd2 in php.ini!");
        }
		$pixelarray = str_split(bin2hex($data), 8);
		$image = imagecreatetruecolor($width, $height);
		imagealphablending($image, false);//do not touch
		imagesavealpha($image, true);
		$position = count($pixelarray) - 1;
		while (!empty($pixelarray)){
			$x = $position % $width;
			$y = ($position - $x) / $height;
			$walkable = str_split(array_pop($pixelarray), 2);
			$color = array_map(function ($val){ return hexdec($val); }, $walkable);
			$alpha = array_pop($color); // equivalent to 0 for imagecolorallocatealpha()
			$alpha = ((~((int)$alpha)) & 0xff) >> 1; // back = (($alpha << 1) ^ 0xff) - 1
			array_push($color, $alpha);
			imagesetpixel($image, $x, $y, imagecolorallocatealpha($image, ...$color));
			$position--;
		}
		return $image;
	}

	public function onEnable() :void {
		self::$instance = $this;
        $this->saveResource("shop\Minion.json");
        $this->saveResource("shop\Minion.png");
        $this->saveResource("shop.yml");
        $this->saveResource("steve.json");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getServer()->getCommandMap()->register("skin", new SkinCommand());
	}

	public static function getSkinManager(Player $player, string $skin) :SkinManager {
		return new SkinManager($player, $skin);
	}

	public static function sendForm(Player $player): void {
		$form = new MainForm($player);
		$form->sendToPlayer();
	}

	public function getShopConfig() :Config {
		return new Config($this->getDataFolder(). "shop.yml", Config::YAML);
	}

	public function buySkin(Player $player, string $skin){
		$mymoney = PointAPI::getInstance()->myMoney($player);
		$price = $this->getShopConfig()->get($skin);
		if($mymoney >= $price){
			$name = $player->getName();
			$this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setuperm $name $skin.skin");
			var_dump($skin);
			$player->sendMessage("§l§1•§f Mua thành công skin§6 $skin");
		}else {
			$player->sendMessage("§l§cBạn không đủ tiền để mua nó");
		}
	}

}