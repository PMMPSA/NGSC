<?php

declare(strict_types=1);

namespace MrDinoDuck\Scoreboard\task;

use pocketmine\scheduler\Task;
use MrDinoDuck\Scoreboard\type\{Typewriter, Pulse, Scroller, Glow};
use MrDinoDuck\Scoreboard\{Main, Scoreboard};
use pocketmine\utils\TextFormat;

class Updating extends Task{
	
	private $plugin;
	private $position = [];
	
	public $glow = [];
	
	public function __construct(Main $plugin){
		$this->plugin = $plugin;
		$this->scoreboard = new Scoreboard();
		$this->position["typewrite"] = 0;
		$this->position["glow"] = 0;
		$this->title = new Glow("FLOATING HEAVEN", "&a", "&6");
		$this->news = new Typewriter("CHÀO MỪNG PHIÊN BẢN BETA");
		var_dump($this->news->array);
	}
	
	public function onRun(int $currentTick) : void{
		$title = "&l&6《&c【&eNHẪN GIẢ SONG CHIẾN&c】&6》";
		$news = $this->news->getNext($this->position["typewrite"]++);
		foreach($this->plugin->getServer()->getOnlinePlayers() as $player){
			$name = $player->getName();
			$xu = $this->plugin->SBXu($player);
			$he = $this->plugin->SBHe($player);
			$level = $this->plugin->SBLevel($player);
			$exp = $this->plugin->SBExp($player);
			$maxexp = $this->plugin->SBMaxexp($player);
			$vang = $this->plugin->SBVang($player);
			$speed = $this->plugin->SBSpeed($player);
			$jump = $this->plugin->SBJump($player);
			$this->scoreboard->setScore($player, TextFormat::colorize($title));
			$this->scoreboard->setScoreLine($player, 10, TextFormat::colorize("&f•&a Thông Tin Nhân Vật &f•"));
			$this->scoreboard->setScoreLine($player, 9, TextFormat::colorize("&f-&c Tên Tài Khoản:&a $name"));
			$this->scoreboard->setScoreLine($player, 8, TextFormat::colorize("&f-&c Hệ Phái:&a Hệ $he"));
			$this->scoreboard->setScoreLine($player, 7, TextFormat::colorize("&f-&c Cấp Độ Hiện Tại:&a $level&7 - (&c$exp&7/&a$maxexp&7)"));
			$this->scoreboard->setScoreLine($player, 6, TextFormat::colorize("&f-&c Số Xu Đang Có:&a $xu Xu"));
			$this->scoreboard->setScoreLine($player, 5, TextFormat::colorize("&f-&c Số Vàng Đang Có:&a $vang Vàng"));
			$this->scoreboard->setScoreLine($player, 4, TextFormat::colorize("&f-&c Chỉ Số Linh Hoạt:&a $speed Điểm"));
			$this->scoreboard->setScoreLine($player, 3, TextFormat::colorize("&f-&c Chỉ Số Thân Lực:&a $jump Điểm"));
			$this->scoreboard->setScoreLine($player, 2, TextFormat::colorize("&f•&c Vote cho SV tại:&a bit.ly/V_NGSC"));
			
			$this->scoreboard->setScoreLine($player, 1, "§c " . $news);
		}
	}
}
