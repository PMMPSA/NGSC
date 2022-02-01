<?php
declare(strict_types = 1);

/**
 * @name XuAddon
 * @version 1.0.0
 * @main JackMD\ScoreHud\Addons\XuAddon
 * @depend NGVS_Xu
 */
namespace JackMD\ScoreHud\Addons
{
	use JackMD\ScoreHud\addon\AddonBase;
	use HTX\Main;
	use pocketmine\Player;

	class XuAddon extends AddonBase{

		/** @var NGVS_Xu */
		private $vang;

		public function onEnable(): void{
			$this->xu = $this->getServer()->getPluginManager()->getPlugin("NGVS_Xu");
		}

		/**
		 * @param Player $player
		 * @return array
		 */
		public function getProcessedTags(Player $player): array{
			return [
				"{xu}" => $this->xu->getXu($player)
			];
		}
	}
}