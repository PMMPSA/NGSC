<?php
declare(strict_types = 1);

/**
 * @name QidaCoinAddon
 * @version 1.0.0
 * @main JackMD\ScoreHud\Addons\QidaCoinAddon
 * @depend NGVS_QidaCoin
 */
namespace JackMD\ScoreHud\Addons
{
	use JackMD\ScoreHud\addon\AddonBase;
	use QDC\Main;
	use pocketmine\Player;

	class QidaCoinAddon extends AddonBase{

		/** @var NGVS_QidaCoin */
		private $vang;

		public function onEnable(): void{
			$this->qidacoin = $this->getServer()->getPluginManager()->getPlugin("NGVS_QidaCoin");
		}

		/**
		 * @param Player $player
		 * @return array
		 */
		public function getProcessedTags(Player $player): array{
			return [
				"{qidacoin}" => $this->qidacoin->getQidaCoin($player)
			];
		}
	}
}