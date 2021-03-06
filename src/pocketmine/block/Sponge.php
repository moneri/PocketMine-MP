<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 *
 *
*/

declare(strict_types=1);

namespace pocketmine\block;

use pocketmine\event\block\BlockUpdateEvent;
use pocketmine\item\Item;
use pocketmine\math\Vector3;
use pocketmine\Player;

class Sponge extends Solid{

	protected $id = self::SPONGE;

	public function __construct(int $meta = 0){
		$this->meta = $meta;
	}

	public function getHardness(): float{
		return 0.6;
	}

	public function getResistance(): float{
		return 3.0;
	}

	public function getName(): string{
		return "Sponge";
	}

	public function dryArea(){
		for ($ix = ($this->getX() - 2); $ix <= ($this->getX() + 2); $ix++){
			for ($iy = ($this->getY() - 2); $iy <= ($this->getY() + 2); $iy++){
				for ($iz = ($this->getZ() - 2); $iz <= ($this->getZ() + 2); $iz++){
					$b = $this->getLevel()->getBlock(new Vector3($ix, $iy, $iz));
					if ($b instanceof Water){
						$this->getLevel()->setBlock($b, new Air());
						$wet = clone $this;
						$wet->setDamage(1);
						$this->getLevel()->setBlock($this, $wet);
					}
				}
			}
		}
	}

	public function place(Item $item, Block $block, Block $target, int $face, Vector3 $facePos, Player $player = null): bool{
		$this->getLevel()->setBlock($block, $this);
		$this->dryArea();
		return true;
	}

	public function onWaterFlow(BlockUpdateEvent $event){
		if ($this->getDamage() === 0){
			if ($event->getBlock() instanceof Water){
				$event->setCancelled();//r u sure?
				$this->dryArea();
			}
		}
	}
}