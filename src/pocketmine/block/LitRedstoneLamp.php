<?php

/*
 *
 *  _                       _           _ __  __ _             
 * (_)                     (_)         | |  \/  (_)            
 *  _ _ __ ___   __ _  __ _ _  ___ __ _| | \  / |_ _ __   ___  
 * | | '_ ` _ \ / _` |/ _` | |/ __/ _` | | |\/| | | '_ \ / _ \ 
 * | | | | | | | (_| | (_| | | (_| (_| | | |  | | | | | |  __/ 
 * |_|_| |_| |_|\__,_|\__, |_|\___\__,_|_|_|  |_|_|_| |_|\___| 
 *                     __/ |                                   
 *                    |___/                                                                     
 * 
 * This program is a third party build by ImagicalMine.
 * 
 * PocketMine is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author ImagicalMine Team
 * @link http://forums.imagicalcorp.ml/
 * 
 *
*/

namespace pocketmine\block;

use pocketmine\item\Tool;
use pocketmine\item\Item;
use pocketmine\level\Level;
use pocketmine\Player;

class LitRedstoneLamp extends Solid implements Redstone,RedstoneTools{

	protected $id = self::LIT_REDSTONE_LAMP;

	public function __construct(){

	}
	
	public function getToolType(){
		return Tool::TYPE_PICKAXE;
	}

	public function onRedstoneUpdate($type,$power){
		if($type==Level::REDSTONE_UPDATE_NORMAL){
			if($power<=0){
				$this->id=123;
				$this->getLevel()->setBlock($this, $this, true, false);
			}
			return;
		}
		
		if($type==Level::REDSTONE_UPDATE_BREAK or $type==Level::REDSTONE_UPDATE_LOSTPOWER){
			if($this->fetchMaxPower()<=0){
				$this->id=123;
				$this->getLevel()->setBlock($this, $this, true, false);
			}
			return;
		}
	}
	
	public function getName(){
		return "Lit Redstone Lamp";
	}

	public function getHardness(){
		return 0.3;
	}
	
	public function getLightLevel(){
		return 15;
	}

	public function getDrops(Item $item){
		$drops = [];
		$drops[] = [Item::REDSTONE_LAMP, 0, 1];
		return $drops;
	}
}
