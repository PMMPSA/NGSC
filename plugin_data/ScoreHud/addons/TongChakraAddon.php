<?php
declare(strict_types = 1);

/**
 * @name TongChakraAddon
 * @version 1.0.0
 * @main JackMD\ScoreHud\Addons\TongChakraAddon
 * @depend NGVS_DCK
 */
namespace JackMD\ScoreHud\Addons
{
	use JackMD\ScoreHud\addon\AddonBase;
	use DCK\Main;
	use pocketmine\Player;

	class TongChakraAddon extends AddonBase{

		/** @var NGVS_DCK */
		private $chakra;

		public function onEnable(): void{
			$this->chakra = $this->getServer()->getPluginManager()->getPlugin("NGVS_DCK");
		}

		/**
		 * @param Player $player
		 * @return array
		 */
		public function getProcessedTags(Player $player): array{
			return [
				"{chakra}" => $this->chakra->getChakra($player)
			];
		}
	}
}