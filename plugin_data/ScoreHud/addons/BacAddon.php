<?php
declare(strict_types = 1);

/**
 * @name BacAddon
 * @version 1.0.0
 * @main JackMD\ScoreHud\Addons\BacAddon
 * @depend NGVS_Bac
 */
namespace JackMD\ScoreHud\Addons
{
	use JackMD\ScoreHud\addon\AddonBase;
	use HTB\Main;
	use pocketmine\Player;

	class BacAddon extends AddonBase{

		/** @var NGVS_Bac */
		private $vang;

		public function onEnable(): void{
			$this->bac = $this->getServer()->getPluginManager()->getPlugin("NGVS_Bac");
		}

		/**
		 * @param Player $player
		 * @return array
		 */
		public function getProcessedTags(Player $player): array{
			return [
				"{bac}" => $this->bac->getBac($player)
			];
		}
	}
}