<?php
declare(strict_types = 1);

/**
 * @name VangAddon
 * @version 1.0.0
 * @main JackMD\ScoreHud\Addons\VangAddon
 * @depend NGVS_Vang
 */
namespace JackMD\ScoreHud\Addons
{
	use JackMD\ScoreHud\addon\AddonBase;
	use HTV\Main;
	use pocketmine\Player;

	class VangAddon extends AddonBase{

		/** @var NGVS_Vang */
		private $vang;

		public function onEnable(): void{
			$this->vang = $this->getServer()->getPluginManager()->getPlugin("NGVS_Vang");
		}

		/**
		 * @param Player $player
		 * @return array
		 */
		public function getProcessedTags(Player $player): array{
			return [
				"{vang}" => $this->vang->getVang($player)
			];
		}
	}
}