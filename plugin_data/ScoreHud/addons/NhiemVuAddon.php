<?php
declare(strict_types = 1);

/**
 * @name NhiemVuAddon
 * @version 1.0.0
 * @main JackMD\ScoreHud\Addons\NhiemVuAddon
 * @depend NGVS_Quest
 */
namespace JackMD\ScoreHud\Addons
{
	use JackMD\ScoreHud\addon\AddonBase;
	use DH\Main;
	use pocketmine\Player;

	class NhiemVuAddon extends AddonBase{

		/** @var NGVS_Quest */
		private $nhiemvu;

		public function onEnable(): void{
			$this->nhiemvu = $this->getServer()->getPluginManager()->getPlugin("NGVS_Quest");
		}

		/**
		 * @param Player $player
		 * @return array
		 */
		public function getProcessedTags(Player $player): array{
			return [
				"{nhiemvu}" => $this->nhiemvu->getNhiemVu($player),
				"{cantim}" => $this->nhiemvu->getCanGap($player),
				"{toado}" => $this->nhiemvu->getViTri($player)
			];
		}
	}
}