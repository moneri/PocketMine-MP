<?php
namespace pocketmine\entity;

use pocketmine\Player;
use pocketmine\network\protocol\AddEntityPacket;

class EnderDragon extends Monster implements ProjectileSource{
    const NETWORK_ID = 53;

    public $height = 2;
    public $width = 3;
    public $lenght = 1;//TODO: check
	
	protected $exp_min = 12500;
	protected $exp_max = 12500;

    public function initEntity(){
        $this->setMaxHealth(200);
        parent::initEntity();
    }

 	public function getName(){
        return "Ender Dragon";
    }

	public function spawnTo(Player $player){
		$pk = new AddEntityPacket();
		$pk->type = self::NETWORK_ID;
		$pk->eid = $this->getId();
		$pk->x = $this->x;
		$pk->y = $this->y;
		$pk->z = $this->z;
		$pk->speedX = $this->motionX;
		$pk->speedY = $this->motionY;
		$pk->speedZ = $this->motionZ;
		$pk->yaw = $this->yaw;
		$pk->pitch = $this->pitch;
		$pk->metadata = $this->dataProperties;
		$player->dataPacket($pk);

		parent::spawnTo($player);
	}
}
