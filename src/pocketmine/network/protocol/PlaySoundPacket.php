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


namespace pocketmine\network\protocol;

#include <rules/DataPacket.h>

class PlaySoundPacket extends DataPacket{
	const NETWORK_ID = Info::PLAY_SOUND_PACKET;

	public $string1;
	public $x;
	public $y;
	public $z;
	public $float1;
	public $float2;

	public function decode(){
		$this->string1 = $this->getString();
		$this->getBlockCoords($this->x, $this->y, $this->z);
		$this->float1 = $this->getLFloat();
		$this->float2 = $this->getLFloat();
	}

	public function encode(){
		$this->reset();
		$this->putString($this->string1);
		$this->putBlockCoords($this->x, $this->y, $this->z);
		$this->putLFloat($this->float1);
		$this->putLFloat($this->float2);
	}
}