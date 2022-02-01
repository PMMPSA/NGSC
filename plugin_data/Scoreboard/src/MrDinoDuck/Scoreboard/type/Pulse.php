<?php

declare(strict_types=1);

namespace MrDinoDuck\Scoreboard\type;

class Pulse{
	
	private $array = [];
		
	public function __construct(string $string){
		$this->array[] = "&0" . $string;
		$this->array[] = "&8" . $string;
		$this->array[] = "&2" . $string;
		$this->array[] = "&a" . $string;
        for($b = 0; $b < 10; $b++){
			$this->array[] = "&a" . $string;
		}
		$this->array[] = "&a" . $string;
		$this->array[] = "&2" . $string;
		$this->array[] = "&8" . $string;
		$this->array[] = "&0" . $string;
	}
	
	public function getNext(int $pos) : string{
		return (string) $this->array[$pos % count($this->array)];
	}
}