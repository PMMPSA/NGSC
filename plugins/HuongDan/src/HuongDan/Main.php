<?php

namespace HuongDan;

use pocketmine\plugin\PluginBase;

use pocketmine\event\Listener;

use pocketmine\Player;
use pocketmine\Server;

use pocketmine\command\CommandSender;
use pocketmine\command\Command;

use pocketmine\utils\TextFormat as C;

use HuongDan\Main;

class Main extends PluginBase implements Listener {

	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}
	
	public function onCommand(CommandSender $player, Command $command, string $label, array $args) : bool {
		switch($command->getName()){
			case "huongdan":
			if($player instanceof Player){
			    $this->OpenMenu($player);
			} else {
				$player->sendMessage("§aLệnh này chỉ có thể sử dụng trong trò chơi");
					return true;
			}
			break;
		}
	    return true;
	}

	public function OpenMenu(Player $sender){
		$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $formapi->createSimpleForm(function (Player $sender, ?int $data = null){
		$result = $data;
		if($result === null){
			return;
		    }
			switch($result){
				case 0:
				break;
			}
		}); 
		$form->setTitle("§l§a♦ §6Hướng dẫn Tân Thủ §a♦");
		$form->setContent("§l§aChào mừng các Nhẫn Giả đến với Nhẫn Giả Song Chiến\n
 §c- §eĐể biết thêm về server chúng ta cùng xem Hướng dẫn tí nha\n
 §c- §eCác Nhẫn Giả đến các NPC để nhận và làm nhiệm vụ. Nhiệm vụ được tính theo số phía sau tên NPC #1,#2,#3,...\n
 §c- §eLàm nhiệm vụ các Nhẫn Giả nhận được rất nhiều EXP, Xu, Vàng, Bạc và cả Nhẫn Thuật\n
 §c- §eSẽ có các nhiệm vụ yêu cầu đến cấp độ. Các Nhẫn Giả hãy làm các nhiệm vụ Tiền Tố [Phụ] hoặc đi đánh quái đễ thu thập EXP Cấp Độ\n
 §c- §eCác Nhẫn Giả có điểm Tiềm nâng có thể tiến bậc nhẫn giả, và mua đồ theo bậc nhẫn giả trong hệ thống KIT (/kit)\n
 §c- §eCác Shinobi có thể cộng điểm Tiềm Nâng để mạnh hơn. Có thể dùng điểm Tổng Chakra để học Nhẫn Thuật nữa nha\n
 §c- §eServer Vĩ Thú xuất hiện sau 12 tiếng khi bị tiêu diệt. Có rất nhiều phần quà thú vị đang chờ\n
 §c- §eServer mở bán Mãnh Vĩ Thú, tích đủ mãnh có thể aohoa biến thân thành Vĩ Thú (Đủ mảnh click xuống đất nha.)\n
 §c- §eMãnh Vĩ Thú ngoài bán ra còn có thể tìm được ở săn vĩ thú\n
  §l§6SERVER-NARUTO CÓ NHIỀU THỨ THÚ VỊ ĐANG CHỜ SHINOBI KHÁM PHÁ");
		$form->addButton("§l§e• §cCHIẾN NÀO §l§e•");
		$form->sendToPlayer($sender);
			return $form;
	}
}