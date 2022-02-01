<?php

declare(strict_types=1);

namespace MrDinoDuck\Scoreboard\type;

class Glow{
	
	public $array = [];
	private $current = -1;
	
	public function __construct(string $string, string $default, string $hightlight){
		$i = 0;
		$this->array[] = "&l" . $default . $string;
		$this->array[] = "&l" . $default . $string;
		$this->array[] = "&l" . $default . $string;
		while($i < strlen($string)){
			$highlighted = "&l" . $default . substr($string, 0, $i) . $hightlight. $string{$i}  . $default . substr($string, $i + 1, strlen($string));
			$this->array[] = $highlighted;
			$i++;
		}
	}
	
	public function getNext() : string{
		$this->current++;
		if($this->current === count($this->array)){
			$this->current = 0;
		}
		return $this->array[$this->current];
	}
}