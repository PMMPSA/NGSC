<?php

namespace phuongaz\Skin;

use pocketmine\entity\Skin;
use pocketmine\Player;
use phuongaz\Skin\Skin as Main;
class SkinManager {

	private $skin;
	private $player;

	public function __construct(Player $player, string $skin = ""){
		$this->skin = $skin;
		$this->player = $player;
	}

	public function getSkinName() :?String{
		return $this->skin;
	}

	public function setSkin(){
        $skin = $this->getSkin();
		$this->player->setSkin($skin);
        $this->player->sendSkin();
	}

	public function getSkin(){
		$fileName = $this->getSkinName();
		$path = Main::getInstance()->getDataFolder() ."shop/". $fileName . ".png";
        if(!is_file($path)){
            return null;
        }
        $img = @imagecreatefrompng($path);
        $bytes = '';
        $l = (int) @getimagesize($path)[1];
        for ($y = 0; $y < $l; $y++) {
            for ($x = 0; $x < 64; $x++) {
                $rgba = @imagecolorat($img, $x, $y);
                $a = ((~((int)($rgba >> 24))) << 1) & 0xff;
                $r = ($rgba >> 16) & 0xff;
                $g = ($rgba >> 8) & 0xff;
                $b = $rgba & 0xff;
                $bytes .= chr($r) . chr($g) . chr($b) . chr($a);
            }
        }
        @imagedestroy($img);
        return new Skin("skin.$fileName", $bytes, "", "geometry.$fileName", file_get_contents(Main::getInstance()->getDataFolder(). "shop/".$fileName.".json"));
	}

    public function FixSkin(){
    	$filename = $this->getSkinName();
        $path = Main::getInstance()->getDataFolder()."shop/" .  $filename. ".png";
        $img = $this->CornvertSize($path,64,64);
        imagepng($img, $this->getDataFolder()."shop/". $filename.".png");
    }

   public function CornvertSize($file, $w, $h, $crop=FALSE) {
        list($width, $height) = getimagesize($file);
        $r = $width / $height;
        if ($crop) {
            if ($width > $height) {
                $width = ceil($width-($width*abs($r-$w/$h)));
            } else {
                $height = ceil($height-($height*abs($r-$w/$h)));
            }
            $newwidth = $w;
            $newheight = $h;
        } else {
            if ($w/$h > $r) {
                $newwidth = $h*$r;
                $newheight = $h;
            } else {
                $newheight = $w/$r;
                $newwidth = $w;
            }
        }
        $src = imagecreatefrompng($file);
        $dst = imagecreatetruecolor($w, $h);
        imagecolortransparent($dst, imagecolorallocatealpha($dst, 0, 0, 0, 127));
        imagealphablending($dst, false);
        imagesavealpha($dst, true);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        return $dst;
    }
}