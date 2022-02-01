<?php
declare(strict_types = 1);

/**
 * @name ChakraAddon
 * @version 1.0.0
 * @main JackMD\ScoreHud\Addons\ChakraAddon
 * @depend NGVS_Mana
 */
namespace JackMD\ScoreHud\Addons
{
	use JackMD\ScoreHud\addon\AddonBase;
	use NGVS\NGVS_Mana\Main;
	use pocketmine\Player;

	class ChakraAddon extends AddonBase{

		/** @var NGVS_Chakra */
		private $chakra;

		public function onEnable(): void{
			$this->chakra = $this->getServer()->getPluginManager()->getPlugin("NGVS_Mana");
		}

		/**
		 * @param Player $player
		 * @return array
		 */
		public function getProcessedTags(Player $player): array{
			return [
				"{chakra}" => $this->chakra->getMana($player)
			];
		}
	}
}