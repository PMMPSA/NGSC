<?php

namespace LH;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\utils\TextFormat;
use pocketmine\event\Listener;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use onebone\economyapi\EconomyAPI;
use pocketmine\item\Item;
use pocketmine\event\player\{PlayerInteractEvent, PlayerItemHeldEvent, PlayerJoinEvent, PlayerChatEvent};
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\block\Block;
use pocketmine\math\Vector3;
use pocketmine\utils\Config;
use pocketmine\Inventory;
use pocketmine\level\Level;
use pocketmine\entity\human;
use pocketmine\entity\Effect;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\network\protocol\SetTitlePacket;

class Main extends PluginBase implements Listener {
    
    public function onEnable(){
        $this->level = $this->getServer()->getPluginManager()->getPlugin("NGVS_Level");
        $this->chakra = $this->getServer()->getPluginManager()->getPlugin("NGVS_Mana");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args):bool{
        switch($cmd->getName()){
        case "layhang":
        if(!$sender->isOp()){
        $sender->sendMessage("§f•§c Đây là lệnh dành cho Staff.");
        return true;
        }
        if($sender->getLevel()->getName() !== "Konoha"){
        $sender->sendMessage("§f•§c Vui lòng chỉ lấy hàng khi đang có mặt tại Làng Lá");
        return true;
        }
        if(!($sender instanceof Player)){
        $sender->sendMessage("§f• §cVui lòng dùng lệnh trong Game");
        return true;
        }
        if(empty($args[0])){
        $sender->sendMessage("§f•§c Vui lòng nhập số lượng cần lấy");
        return true;
        }
        if(!is_numeric($args[0])){
        $sender->sendMessage("§f•§c Số lượng hàng cần lấy phải là số, nhập lại đi đcm tml wanglei/");
        return true;
        }
        $dan_chakra = Item::get(351, 12, $args[0]);
        $dan_chakra->setCustomName("§r§l§bĐan Hồi Phục Chakra §c(§fĐại§c)");
        $dan_hp = Item::get(351, 1, $args[0]);
        $dan_hp->setCustomName("§r§l§bĐan Hồi Phục Sinh Lực §c(§fĐại§c)");
        $sender->getInventory()->addItem($dan_chakra);
        $sender->getInventory()->addItem($dan_hp);
        $sender->sendMessage("§f•§c Lấy hàng thành công với số lượng §a".$args[0]."§c Đan");
//return true;
}
return true;
}
}