<?php

namespace NapThe;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\command\Command;
use pocketmine\Player;
use pocketmine\event\Listener;
use joejoe77777\FormAPI;

Class Main extends PluginBase implements Listener{

	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info("\n\n§l§cDonate [Auto] has been enabled \n\n");
		$this->qidacoin = $this->getServer()->getPluginManager()->getPlugin("NGVS_QidaCoin");
		$this->stats = $this->getServer()->getPluginManager()->getPlugin("NGVS_Stats");
		$trans_id = time();
	}

	public function onCommand(CommandSender $sender, Command $cmd,string $label, array $args):bool{
		if($cmd->getName() == "qidacoin"){
			if(!(isset($args[0]) || isset($args[1]) || isset($args[2]) || isset($args[3]))){
			//Bảng help
				$sender->sendMessage("§f•§a Để mua §l§cQidaCoin§r§a, bạn vui lòng gõ lệnh:\n§f-§a /qidacoin §7<§aSố Thẻ§7> <§aSố Serial§7> <§aGiá Trị Thẻ:§c 10000, 20000, 50000, 100000, 200000, 500000, 1000000§7> <§aNhà Mạng:§c 1 §7=§a Viettel, §c2 §7=§a Mobifone, §c3 §7=§a Vinaphone, §c4 §7=§a Zing, §c5§7 = §aGate, §c6§7 = §aVCoin§7>\n§f-§a Ví dụ:§c /qidacoin 91639174017 0184629104826 1000000 5\n§f•§l§c QidaCoin§r§a là một loại đơn vị nạp độc quyền của §l§cQida§r§7 (§aChuỗi máy chủ MCBE lấy cảm hứng từ các bộ Manga nổi tiếng§7)§a, dưới đây là bảng giá §l§cQidaCoin§r§a bạn sẽ nhận được khi nạp:\n§6§l⇩§bBảng Giá Nạp Thẻ Khuyến Mãi 120%§6⇩\n§f-§a 10.000VNĐ §7= §c50 QidaCoin §f+ §e60\n§f-§a 20.000VNĐ §7=§c 102 QidaCoin §f+ §e122\n§f-§a 50.000VNĐ §7=§c 310 QidaCoin §f+ §e372\n§f-§a 100.000VNĐ §7=§c 625 QidaCoin §f+ §e750\n§f-§a 200.000VNĐ §7=§c 1.260 QidaCoin §f+ §e1512\n§f-§a 500.000VNĐ §7=§c 3.160 QidaCoin §f+ §e3792\n§f-§a 1.000.000VNĐ §7=§c 6.350 QidaCoin §f+ §e7620\n§l§cLƯU Ý:§r§a Khi nạp, vui lòng chọn đúng thông tin về thẻ. Nếu sai sẽ xảy ra lỗi & Admin sẽ không chịu trách nhiệm!");
				return true;
			}
			if(!(is_numeric($args[0]) || is_numeric($args[1]) || is_numeric($args[2]))){
			//cảnh báo khi seri + pin + giá trị k phải là số
			$sender->sendMessage("§f•§c Số Serial/Số PIN/Giá Trị bạn vừa nhập không phải là số, hãy thử lại!");
			return true;
			}
			if(empty($args[0]) || empty($args[1]) || empty($args[2])){
			$sender->sendMessage("§f•§c Vui lòng không nhập thiếu dữ liệu");
			return true;
			}
			if(!($args[2] == 10000 || $args[2] == 20000 || $args[2] == 50000 || $args[2] == 100000 || $args[2] == 200000 || $args[2] == 500000 || $args[2] == 1000000 || $args[2] == 30000 || $args[2] == 300000)){
			$sender->sendMessage("§f•§c Giá Trị thẻ cào bạn vừa nhập không tồn tại, hãy thử lại!");
			return true;
			}
			if($args[3] > 6 || $args[3] < 1){
			$sender->sendMessage("§f•§c Loại mã nhà mạng bạn vừa nhập không tồn tại, hãy thử lại!");
			return true;
			}
			switch($args[3]){
				case "1":
				$ten = "Viettel";
					$mang = 1;
				break;
				case "2":
				$ten = "Mobifone";
					$mang = 2;
				break;
				case "3":
                $ten = "Vinaphone";
					$mang = 3;
					break;
                case "4":
                $ten = "Zing";
                 $mang = 4;
           break;
                 case "5":
                 $ten = "Gate";
                 $mang = 5;
                 break;
                 case "6":
                 $ten = "VCoin";
                 $mang = 6;
                 break;
			}
//ID khi đăng ký trên napthengay.com
$merchant_id = "5383";
//email đăng ký trên đó
$api_email = "nhuthao19112005@gmail.com";
//key khi đăng ký
$secure_code = "59ce7b73d60d07fa5c9155da687d635f";
$api_url = "http://api.napthengay.com/v2/";
$trans_id = time();
				$seri = $args[1];
                $sopin = $args[0];
                $card_value = $args[2];
                $mang = $mang;
                $user = $sender->getName();
			$arrayPost = array(
	"merchant_id"=>intval($merchant_id),
	"api_email"=>trim($api_email),
	"trans_id"=>trim($trans_id),
	"card_id"=>trim($mang),
	"card_value"=> intval($card_value),
	"pin_field"=>trim($sopin),
	"seri_field"=>trim($seri),
	"algo_mode"=>"hmac"
);
$data_sign = hash_hmac("SHA1",implode("",$arrayPost),$secure_code);

$arrayPost["data_sign"] = $data_sign;

$curl = curl_init($api_url);

curl_setopt_array($curl, array(
	CURLOPT_POST=>true,
	CURLOPT_HEADER=>false,
	CURLINFO_HEADER_OUT=>true,
	CURLOPT_TIMEOUT=>120,
	CURLOPT_RETURNTRANSFER=>true,
	CURLOPT_SSL_VERIFYPEER => false,
	CURLOPT_POSTFIELDS=>http_build_query($arrayPost)
));

$data = curl_exec($curl);

$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

$result = json_decode($data, true);

$time = time();

if($status==200){
    $amount = $result["amount"];
	switch($amount) {
		//cái zcoin là loại coin bạn đã khai báo ở đầu
		        case 10000: $qidacoin = 110; $stats = 0; break;
	            case 20000: $qidacoin = 224; $stats = 0; break;
				case 30000: $qidacoin = 224; $stats = 0; break;
	            case 50000: $qidacoin = 682; $stats = 3; break;
	            case 100000: $qidacoin = 1375; $stats = 6; break;
	            case 200000: $qidacoin = 2772; $stats = 12; break;
	            case 300000: $qidacoin = 6952; $stats = 18; break;
	            case 500000: $qidacoin = 6952; $stats = 40; break;
	            case 1000000: $qidacoin = 13970; $stats = 80; break;
	}
				
	if($result["code"] == 100){
		$file = "carddung.log";
		$fh = fopen($file,"a") or die("cant open file");
		fwrite($fh,"Tai khoan: ".$user.", Loai the: ".$ten.", Menh gia: ".$amount.", Thoi gian: ".$time);
		fwrite($fh,"\r\n");
		fclose($fh);
		//lời nhắn khi nạp thành công
		$sender->sendMessage("§f•§a Bạn đã nạp thành công ".$qidacoin." §l§cQidaCoin");
		$sender->sendMessage("§f•§a Khuyến Mãi ".$stats." §l§cĐiểm Tiềm Năng");
		$sender->sendMessage("§f•§a Bạn hãy đến gặp NPC §l§e【§cSự Kiện§e】§r§f Quà Nạp QidaCoin§a Để nhận quà trước khi sử dụng QuidaCoin nha.§c HÃY NHẬN TRƯỚC KHI SỬ DỤNG NHA");
		$this->qidacoin->addQidaCoin($sender, $qidacoin);
		$this->stats->addStats($sender, $stats);
	}else{
		$sender->sendMessage("§f•§c Nạp thẻ không thành công, mã lỗi:§a ".$result["code"]);  
		$error = $result["msg"];
		$file = "cardsai.log";
		$fh = fopen($file,"a") or die("cant open file");
		fwrite($fh,"Tai khoan: ".$user.", Ma the: ".$sopin.", Seri: ".$seri.", Noi dung loi: ".$error.", Thoi gian: ".$time);
		fwrite($fh,"\r\n");
		fclose($fh);
       //Gửi lỗi (từ napthengay.com trả về)
		$sender->sendMessage("§f•§c Lỗi§a: ".$error);
	}
}
else{ 
       //thông báo khi id - key đăng ký trên napthengay.com không khớp
	$sender->sendMessage("§f•§c Dữ liệu không khớp!");
}
	}
	return true;
	}
}