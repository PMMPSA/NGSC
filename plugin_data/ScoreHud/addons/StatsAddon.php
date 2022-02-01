<?php
declare(strict_types = 1);

/**
 * @name StatsAddon
 * @version 1.0.0
 * @main JackMD\ScoreHud\Addons\StatsAddon
 * @depend NGVS_Stats
 */
namespace JackMD\ScoreHud\Addons
{
	use JackMD\ScoreHud\addon\AddonBase;
	use NGVS\NGVS_Stats\Main;
	use pocketmine\Player;

	class StatsAddon extends AddonBase{

		/** @var NGVS_Stats */
		private $stats;

		public function onEnable(): void{
			$this->stats = $this->getServer()->getPluginManager()->getPlugin("NGVS_Stats");
		}

		/**
		 * @param Player $player
		 * @return array
		 */
		public function getProcessedTags(Player $player): array{
			return [
				"{stats}" => $this->stats->getCurrentStats($player),
				"{jump}" => $this->stats->getCurrentJump($player),
				"{speed}" => $this->stats->getCurrentSpeed($player),
				"{crit}" => $this->stats->getCurrentCrit($player),
				"{damage}" => $this->stats->getCurrentDamage($player),
				"{health}" => $this->stats->getCurrentHealth($player)
			];
		}
	}
}