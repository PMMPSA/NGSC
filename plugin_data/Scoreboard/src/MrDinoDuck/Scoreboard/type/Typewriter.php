<?php

declare(strict_types=1);

namespace MrDinoDuck\Scoreboard\type;

class Typewriter{
	
	public $array;
	
	public function __construct(string $string){
		$this->array = [];
		$str = "_";
		$i = 5;
		$bool = true;
		$stringBuilder = "";
		$j = 0;
		for ($k = 0; $k < $i; $k++) {
			$this->array[] = " ";
			$this->array[] = " ";
			$this->array[] = $str;
			$this->array[] = $str;
		} 
		foreach(str_split($string) as $c){
			$stringBuilder = $stringBuilder . $c;
			$j = $this->a($this->array, $str, $stringBuilder, $j);
		} 
		for($k = 0; $k < $i; $k++)
			$j = $this->a($this->array, $str, $stringBuilder, $j); 
		if($bool)
			for($k = strlen($string); $k > 0; $k--) {
				$stringBuilder = substr_replace($stringBuilder, "", $k - 1, 1);
				$j = $this->a($this->array, $str, $stringBuilder, $j);
		}
	}
	
	private function a(array $array, string $string, string $stringbuilder, int $paramInt) : int{
		if($paramInt < 2) {
			$this->array[] = $stringbuilder . " ";
		}else{
			$this->array[] = $stringbuilder . $string;
		}			
		if($paramInt == 4){
			$paramInt = 0;
		}else{
			$paramInt++;
		} 
		return $paramInt;
	}
	
	public function getNext(int $pos) : string{
		return (string) $this->array[$pos % count($this->array)];
	}
}