<?php
declare(strict_types = 1);

/**
 * @name RankAddon
 * @version 1.0.0
 * @main JackMD\ScoreHud\Addons\RankAddon
 * @depend NGVS_Rank
 */
namespace JackMD\ScoreHud\Addons
{
	use JackMD\ScoreHud\addon\AddonBase;
	use CB\Main;
	use pocketmine\Player;

	class RankAddon extends AddonBase{

		/** @var NGVS_Rank */
		private $rank;

		public function onEnable(): void{
			$this->rank = $this->getServer()->getPluginManager()->getPlugin("NGVS_Rank");
		}

		/**
		 * @param Player $player
		 * @return array
		 */
		public function getProcessedTags(Player $player): array{
			return [
				"{capbac}" => $this->rank->getRank($player)
			];
		}
	}
}