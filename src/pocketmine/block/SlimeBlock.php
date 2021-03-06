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

namespace pocketmine\block;


use pocketmine\entity\Entity;
use pocketmine\math\AxisAlignedBB;

class SlimeBlock extends Transparent{ //Partial (does not block light, mob spawning possible)

	protected $id = self::SLIME_BLOCK;

	public function __construct(){ }

	public function getName(): string{
		return "Slime Block";
	}

	public function getHardness(): float{
		return 0.0;
	}

	public function getResistance(): float{
		return 0.0;
	}

	public function hasEntityCollision(): bool{
		return true;
	}

	public function isSolid(): bool{
		return false; //todo check
	}

	public function onEntityCollide(Entity $entity): void{
		if (!$entity->isSneaking()){
			$entity->resetFallDistance();
			$entity->onGround = true;
		} else parent::onEntityCollide($entity);
	}

	/**
	 * @return AxisAlignedBB
	 */
	protected function recalculateBoundingBox():?AxisAlignedBB{ //Temporary fix for fall damage
		return new AxisAlignedBB(
			$this->x,
			$this->y,
			$this->z,
			$this->x + 1,
			$this->y + 1.5,
			$this->z + 1
		);
	}
}