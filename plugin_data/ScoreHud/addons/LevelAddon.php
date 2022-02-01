<?php
declare(strict_types = 1);

/**
 * @name LevelAddon
 * @version 1.0.0
 * @main JackMD\ScoreHud\Addons\LevelAddon
 * @depend NGVS_Level
 */
namespace JackMD\ScoreHud\Addons
{
	use JackMD\ScoreHud\addon\AddonBase;
	use Level\Main;
	use pocketmine\Player;

	class LevelAddon extends AddonBase{

		/** @var NGVS_Level */
		private $level;

		public function onEnable(): void{
			$this->level = $this->getServer()->getPluginManager()->getPlugin("NGVS_Level");
		}

		/**
		 * @param Player $player
		 * @return array
		 */
		public function getProcessedTags(Player $player): array{
			return [
				"{level}" => $this->level->getLevel($player),
				"{exp}" => $this->level->getExp($player),
				"{maxexp}" => $this->level->getMaxExp($player)
			];
		}
	}
}