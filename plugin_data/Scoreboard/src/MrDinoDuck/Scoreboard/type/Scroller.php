<?php

declare(strict_types=1);

namespace MrDinoDuck\Scoreboard\type;

class Scroller{
	
	private $array = [];
	private $array2 = [];
	
	public function __construct(string $string, string $batbuoc = "&r&f"){
		$i = 23;
		$j = 23;
		$b1 = 0;
		if(strlen($string) < $i) {
			$sb1 = "";
			while (strlen($sb1) < $i)
				$sb1 = $sb1 . " ";
			$string = $string . $sb1;
		} 
		$i -= 2;
		for($b2 = 0; $b2 < strlen($string) - $i; $b2++)
			$this->array2[] = substr($string, $b2, $b2 + $i);
		$sb = "";
		for($b3 = 0; $b3 < $j; $b3++) {
			$this->array2[] = substr($string, strlen($string) - $i + (($b3 > $i) ? $i : $b3)) . $sb;
			if(strlen($sb) < $i)
				$sb = $sb . " ";
		} 
		for($b3 = 0; $b3 < $i - $j; $b3++)
			$this->array2[] = substr($string, strlen($string) - $i + $j + $b3) . $sb . substr($string, 0, $b3);
		for($b3 = 0; $b3 < $j && $b3 <= strlen($sb); $b3++)
			$this->array2[] = substr($sb, 0, strlen($sb) - $b3) . substr($string, 0, $i - (($j > $i) ? $i : $k) + $b3);
		$chatColor = $batbuoc;
		for($b4 = 0; $b4 < count($this->array2); $b4++) {
			$sb1 = $this->array2[$b1++ % count($this->array2)];
			if($sb1{strlen($sb1) - 1} === "&")
				$sb1{strlen($sb1)- 1} = " "; 
			if($sb1{0} == "&") {
				$chatColor = $this->checkColor($sb1{1});
				if($chatColor){
					$chatColor = "&" . $sb1{1};
					$sb1 = $this->array2[$b1++ % count($this->array2)];
					if($sb1{0} != ' ')
						$sb1 = substr_replace($sb1, "", 0, 1);
				} 
			}
			$this->array[] = $chatColor . substr($sb1, 1);
		} 
	}
	
	public function checkColor(string $code) : bool{
		$color = ["a", "b", "c", "d", "e", "f", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
		if(in_array($code, $color)){
			return true;
		}else{
			return false;
		}
	}
	
	public function getNext(int $pos) : string{
		return (string) $this->array[$pos % count($this->array)];
	}
}