<?php
declare(strict_types = 1);

/**
 * @name SucManhAddon
 * @version 1.0.0
 * @main JackMD\ScoreHud\Addons\SucManhAddon
 * @depend NGVS_SucManh
 */
namespace JackMD\ScoreHud\Addons
{
	use JackMD\ScoreHud\addon\AddonBase;
	use SM\Main;
	use pocketmine\Player;

	class SucManhAddon extends AddonBase{

		/** @var NGVS_SucManh */
		private $sucmanh;

		public function onEnable(): void{
			$this->sucmanh = $this->getServer()->getPluginManager()->getPlugin("NGVS_SucManh");
		}

		/**
		 * @param Player $player
		 * @return array
		 */
		public function getProcessedTags(Player $player): array{
			return [
				"{sm}" => $this->sucmanh->getSucManh($player)
			];
		}
	}
}