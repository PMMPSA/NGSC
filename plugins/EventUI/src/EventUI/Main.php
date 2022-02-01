<?php

namespace EventUI;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use jojoe77777\FormAPI;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\event\Listener;

class Main extends PluginBase implements Listener {
    
    public function onEnable(){
        $this->getLogger()->info("Enable EventUI V1.0 by RichHaoGaming...");
                $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->checkDepends();
    }

    public function checkDepends(){
        $this->formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        if(is_null($this->formapi)){
            $this->getLogger()->info("§4Please install FormAPI Plugin, disabling plugin...");
            $this->getPluginLoader()->disablePlugin($this);
        }
    }

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args):bool
    {
        switch($cmd->getName()){
        case "event":
        if(!($sender instanceof Player)){
                $sender->sendMessage("§7Please use this command In-Game");
                return true;
        }
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 0:
                        break;
            }
        });
        $form->setTitle("§l§b● §cBảng Event§b ●");
        $form->setContent("§l§a ✠ §dSự Kiện Dành Cho Dân Nạp\n\n§f§l==========================\n§b§lKHUYỄN MÃI 120% GIÁ TRỊ NẠP THẺ\n§l§f==========================\n\n§l§c➭§9Nạp Thẻ Đạt Mốc Nhận Quà Cực Hot!\n §fCác Mốc Nạp Bao Gồm:\n §r100 Qidacoin\n §r300 Qidacoin\n §r500 Qidacoin\n §r1000 Qidacoin\n §r3000 Qidacoin\n §r5000 Qidacoin\n §r9000 Qidacoin\n §r14000 Qidacoin (§aMốc Đặc Biệt Nhận Bộ Trang Bị HOKAGE BẬC S§f)\n §r20000 Qidacoin (§aMốc Đặc Biệt Nhận Bộ Trang Bị HOKAGE Bậc Ss§f)\n§r§l§cLƯU Ý: NHẪN GIẢ NẠP XONG VUI LÒNG NHẬN THƯỞNG MỐC NẠP TẠI NPC TRƯỚC KHI ĐỔI RA VÀNG ĐỂ TRÁNH BỊ LỖI\n\n§l§c➭§9 Đua Top Nạp Thẻ Nhận Quà Cực Hot!\n§eThời gian 26/4/2021 - 30/4/2021\n §rTop 1: Nhận Ngay 1 Giftcode top1nap\n §rTop 2: Nhận Ngay 1 Giftcode top2nap\n §rTop 3: Nhận Ngay 1 Giftcode top3nap\n§r§cYêu Cầu Phải Nạp Trên 100.000Đ\n§r§f(§eKhi sự kiện kết thúc Giftcode sẽ được gửi thẳng vào tài khoản đứng top §c/mycode §eđể xem code bạn sở hữu§f)\n\n§l§a ✠ §dSự Kiện Dành Cho Dân Cày\n\n§l§9 Đua Top Level Nhận quà Hấp Dẫn\n§eThời gian 26/4/2021 - 30/4/2021\n §rTop 1: Nhận ngay 1 Giftcode top1lv\n §rTop 2: Nhận ngay 1 Giftcode top2lv\n §rTop 3: Nhận ngay 1 Giftcode top3lv\n§r§f(§eKhi sự kiện kết thúc Giftcode sẽ được gửi thẳng vào tài khoản đứng top §c/mycode §eđể xem code bạn sở hữu§f)\n\n§l§9 Đua Top Sức Mạnh Nhận quà Hấp Dẫn\n§eThời gian 26/4/2021 - 30/4/2021\n §fTop 1: §rNhận ngay 1 Giftcode top1sm");
        $form->addButton("卐§l§9Thoát", 0);
        $form->sendToPlayer($sender);
        }
        return true;
    }

    public function onDisable(){
        $this->getLogger()->info("EventUI V1.0 by RichHaoGaming Disabled!");
    }
}