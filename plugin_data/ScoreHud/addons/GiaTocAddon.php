<?php
declare(strict_types = 1);

/**
 * @name GiaTocAddon
 * @version 1.0.0
 * @main JackMD\ScoreHud\Addons\GiaTocAddon
 * @depend NGVS_GiaToc
 */
namespace JackMD\ScoreHud\Addons
{
	use JackMD\ScoreHud\addon\AddonBase;
	use GT\Main;
	use pocketmine\Player;

	class GiaTocAddon extends AddonBase{

		/** @var NGVS_GiaToc */
		private $he;

		public function onEnable(): void{
			$this->giatoc = $this->getServer()->getPluginManager()->getPlugin("NGVS_GiaToc");
		}

		/**
		 * @param Player $player
		 * @return array
		 */
		public function getProcessedTags(Player $player): array{
			return [
				"{giatoc}" => $this->giatoc->getGiaToc($player)
			];
		}
	}
}