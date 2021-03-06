<?php
/**
 ** OVERVIEW:Basic Usage
 **
 ** COMMANDS
 **
 ** * lvdat : Show/Modify level.dat variables
 **   usage: /mw **lvdat** _<world>_ _[attr=value]_
 **
 **   Change directly some **level.dat** values/attributes.  Supported
 **   attributes:
 **   - spawn=x,y,z : Sets spawn point
 **   - seed=randomseed : seed used for terrain generation
 **   - name=string : Level name
 **   - generator=flat|normal : Terrain generator
 **   - preset=string : Presets string.
 **
 ** * fixname : fixes name mismatches
 **   usage: /mw **fixname** _<world>_
 **
 **   Fixes a world's **level.dat** file so that the name matches the
 **   folder name.
 **/

namespace aliuly\manyworlds;

use aliuly\manyworlds\common\BasicCli;
use aliuly\manyworlds\common\mc;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\level\format\io\BaseLevelProvider;
use pocketmine\math\Vector3;
use pocketmine\utils\TextFormat;

class MwLvDat extends BasicCli{
	public function __construct($owner){
		parent::__construct($owner);
		$this->enableSCmd("lvdat", ["usage" => mc::_("<world> [attr=value]"),
			"help" => mc::_("Change level.dat values"),
			"permission" => "mw.cmd.lvdat",
			"aliases" => ["lv"]]);
		$this->enableSCmd("fixname", ["usage" => mc::_("<world>"),
			"help" => mc::_("Fixes world name"),
			"permission" => "mw.cmd.lvdat",
			"aliases" => ["fix"]]);
	}

	public function onSCommand(CommandSender $c, Command $cc, $scmd, $data, array $args){
		if(count($args) === 0){
			return false;
		}
		if($scmd === "fixname"){
			$world = implode(" ", $args);
			$c->sendMessage(TextFormat::AQUA . mc::_("Running /mw lvdat %1% name=%1%", $world));
			$args = [$world, "name=$world"];
		}
		$world = array_shift($args);
		if(!$this->owner->autoLoad($c, $world)){
			$c->sendMessage(TextFormat::RED . mc::_("[MW] %1% is not loaded!", $world));

			return true;
		}
		$level = $this->owner->getServer()->getLevelByName($world);
		if(!$level){
			$c->sendMessage(TextFormat::RED . mc::_("[MW] Unexpected error"));

			return true;
		}
		//==== provider
		$provider = $level->getProvider();
		assert($provider instanceof BaseLevelProvider);
		$changed = false;
		$unload = false;
		foreach($args as $kv){
			$kv = explode("=", $kv, 2);
			if(count($kv) !== 2){
				$c->sendMessage(mc::_("Invalid element: %1%, ignored", $kv[0]));
				break;
			}
			list($k, $v) = $kv;
			switch(strtolower($k)){
				case "spawn":
					$pos = explode(",", $v);
					if(count($pos) !== 3){
						$c->sendMessage(mc::_("Invalid spawn location: %1%", implode(",", $pos)));
						break;
					}
					list($x, $y, $z) = $pos;
					$cpos = $provider->getSpawn();
					if(($x = (int) $x) == $cpos->getX() &&
						($y = (int) $y) == $cpos->getY() &&
						($z = (int) $z) == $cpos->getZ()){
						$c->sendMessage(mc::_("Spawn location is unchanged"));
						break;
					}
					$changed = true;
					$provider->setSpawn(new Vector3($x, $y, $z));
					break;
				case "seed":
					$v = (int) $v;
					if($provider->getSeed() === $v){
						$c->sendMessage(mc::_("Seed unchanged"));
						break;
					}
					$changed = true;
					$unload = true;
					$provider->setSeed($v);
					break;
				case "name": // LevelName String
					if($provider->getName() === $v){
						$c->sendMessage(mc::_("Name unchanged"));
						break;
					}
					$changed = true;
					$unload = true;
					$provider->getLevelData()->setString("LevelName", $v);
					break;
				case "generator":
					if($provider->getLevelData()->getString("generatorName") === $v){
						$c->sendMessage(mc::_("Generator unchanged"));
						break;
					}
					$changed = true;
					$unload = true;
					$provider->getLevelData()->setString("generatorName", $v);
					break;
				case "preset":    // StringTag("generatorOptions");
					if($provider->getLevelData()->getString("generatorOptions", "") === $v){
						$c->sendMessage(mc::_("Preset unchanged"));
						break;
					}
					$changed = true;
					$unload = true;
					$provider->getLevelData()->setString("generatorOptions", $v);
					break;
				default:
					$c->sendMessage(mc::_("Unknown key %1%, ignored", $k));
					break;
			}
		}
		if($changed){
			$c->sendMessage(mc::_("Updating level.dat for %1%", $world));
			$provider->saveLevelData();
			if($unload){
				$c->sendMessage(TextFormat::RED .
								mc::_("CHANGES WILL NOT TAKE EFFECT UNTIL UNLOAD"));
			}
		}else{
			$c->sendMessage(mc::_("Nothing happens"));
		}

		return true;
	}
}
