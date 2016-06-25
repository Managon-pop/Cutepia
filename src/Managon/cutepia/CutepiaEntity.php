<?php

namespace Managon\cutepia;

use Managon\cutepia\cutepiaentity\animals\CutepiaBat;
use Managon\cutepia\cutepiaentity\animals\CutepiaChicken;
use Managon\cutepia\cutepiaentity\animals\CutepiaCow;
use Managon\cutepia\cutepiaentity\animals\CutepiaDonkey;
use Managon\cutepia\cutepiaentity\animals\CutepiaHorse;
use Managon\cutepia\cutepiaentity\animals\CutepiaMooshroom;
use Managon\cutepia\cutepiaentity\animals\CutepiaMule;
use Managon\cutepia\cutepiaentity\animals\CutepiaOcelot;
use Managon\cutepia\cutepiaentity\animals\CutepiaPig;
use Managon\cutepia\cutepiaentity\animals\CutepiaRabbit;
use Managon\cutepia\cutepiaentity\animals\CutepiaSheep;
use Managon\cutepia\cutepiaentity\animals\CutepiaSkeletonHorse;
use Managon\cutepia\cutepiaentity\animals\CutepiaSquid;
use Managon\cutepia\cutepiaentity\animals\CutepiaWolf;
use Managon\cutepia\cutepiaentity\animals\CutepiaZombieHorse;

use Managon\cutepia\cutepiaentity\monsters\CutepiaBlaze;
use Managon\cutepia\cutepiaentity\monsters\CutepiaCaveSpider;
use Managon\cutepia\cutepiaentity\monsters\CutepiaCreeper;
use Managon\cutepia\cutepiaentity\monsters\CutepiaEnderman;
use Managon\cutepia\cutepiaentity\monsters\CutepiaGhast;
use Managon\cutepia\cutepiaentity\monsters\CutepiaHusk;
use Managon\cutepia\cutepiaentity\monsters\CutepiaMagmaCube;
use Managon\cutepia\cutepiaentity\monsters\CutepiaSilverfish;
use Managon\cutepia\cutepiaentity\monsters\CutepiaSkeleton;
use Managon\cutepia\cutepiaentity\monsters\CutepiaSlime;
use Managon\cutepia\cutepiaentity\monsters\CutepiaSpider;
use Managon\cutepia\cutepiaentity\monsters\CutepiaStray;
use Managon\cutepia\cutepiaentity\monsters\CutepiaWhich;
use Managon\cutepia\cutepiaentity\monsters\CutepiaWitherSkeleton;
use Managon\cutepia\cutepiaentity\monsters\CutepiaZombie;
use Managon\cutepia\cutepiaentity\monsters\CutepiaZombiePigman;

use Managon\cutepia\cutepiaentity\npc\CutepiaVillager;

use pocketmine\nbt\tag\ByteTag;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\DoubleTag;
use pocketmine\nbt\tag\ListTag;
use pocketmine\nbt\tag\FloatTag;
use pocketmine\nbt\tag\IntTag;
use pocketmine\nbt\tag\LongTag;
use pocketmine\nbt\tag\ShortTag;
use pocketmine\nbt\tag\StringTag;

use pocketmine\Player;
use pocketmine\math\Vector3;
use pocketmine\level\Level;
use pocketmine\level\format\Chunk;
use pocketmine\level\format\FullChunk;
use pocketmine\entity\Entity;

use pocketmine\network\protocol\SetEntityMotionPacket;
use pocketmine\network\protocol\AddEntityPacket;

class CutepiaEntity extends Entity
{
	public $entityId = 0;
	public static $instance = null;
	public $entities = [];
	public $entityIds = [];
	private $networkId;
	public $pos = null;
	public $lastPos = null;
	public $nextPos = null;
	public $targetPos = null;
	public $level = null;


	public function __construct(FullChunk $chunk, CompoundTag $nbt, CutepiaEntity $entity)
	{
		parent::__construct($chunk, $nbt);
		array_push($this->entities, $entity);
		$this->server = \pocketmine\Server::getInstance();
		$this->server->getScheduler()->scheduleRepeatingTask(new CallbackTask(
			[$this,
			"move"],
			[$this->nextPos === null ? $this->pos : $this->nextPos]), 8);
		
	}

	public function spawn(Vector3 $pos, Level $level, int $damage)
	{
		$className = $this->manager->damageList[$damage];
		$nbt = $this->getNBT($pos);
		$chunk = $level->getChunk($pos->x >> 4, $pos->y >> 4);
		$entity = new $className($chunk, $nbt);
		$entity->spawnToAll();
		$this->pos = $pos;
		$this->lastPos = $pos;
		$this->nextPos = $pos;
		$this->level = $level;
		$this->networkId = $damage;
	}


	public function getDistanceEntity($distance)
	{
		$a = [];
		foreach ($this->entities as $key => $near) 
		{
			$entityPos = $this->pos;
			$nearPos = $near->pos;
			if($entityPos->distanceSquared($nearPos) <= $distance**2)
			{
			    array_push($a, $near);
			}
		}
		    return (array) $a;
	}

	public function go(Vector3 $targetPos)
	{
		$nextPos = $this->nextPos($targetPos);
		$disX = $nextPos->x - $this->pos->x;
		$disY = $nextPos->y - $this->pos->y;
		$disZ = $nextPos->z - $this->pos->z;
		$pk = new SetEntityMotionPacket();
		$pk->id = $this->getId();
		$pk->motionX = $disx/10;
		$pk->motionY = $disY/10;
		$pk->motionZ = $disZ/10;
		foreach ($this->getViewers() as $player) 
		{
			$player->dataPacket($pk);
		}
		$this->lastPos = $this->pos;
		$this->pos = new Vector3($this->pos->x + $pk->motionX, $this->pos->y + $pk->motionY, $this->pos->z + $pk->motionZ);
		if($this->pos->distance($this->nextPos) < 0.1)
		{
			$this->nextPos = $this->nextPos($this->targetPos === null ? $this->pos : $this->targetPos);
		}
	}

	public function nextPos(Vector3 $targetPos)
	{
		if($this->pos->distance($targetPos) < 0.01) return null;
		if($targetPos->y - $this->pos->y < 3)
		{
			$base = $targetPos->x - $this->pos->x;
			$height = $targetPos->z - $this->pos->z;
			$yaw = atan2($height, $base);
			$nextX = 1.2*cos(deg2rad($yaw));
			$nextY = 1.2*sin(deg2rad($yaw));
			if($this->level->getBlock($pos = new Vector3($this->pos->x + $nextX, $this->pos->y, $this->pos->z + $nextZ)) === 0)
				return $pos;
			else
				return new Vector3($pos->x, $pos->y + 1.2, $pos->z);
		}
	}

	public function warp(Vector3 $targetPos)
	{
		$this->setPosition($targetPos);
		$this->remove($this);
		$this->spawn($targetPos, $this->getLevel(), $this->networkId);
	}

	public function getNBT(Vector3 $pos)
	{
		$nbt = new CompoundTag("", [
			"Pos" => new ListTag("Pos", [
				new DoubleTag("", $pos->x),
				new DoubleTag("", $pos->y),
				new DoubleTag("", $pos->z)
			]),
			"Motion" => new ListTag("Motion", [
				new DoubleTag("", 0),
				new DoubleTag("", 0),
				new DoubleTag("", 0)
			]),
			"Rotation" => new ListTag("Rotation", [
				new FloatTag("", 0),
				new FloatTag("", 0)
			]),
		]);
		return $nbt;
	}

	public function Attach(Player $player)
	{

	}

	public function getEntity_fromId($id)
	{
		return isset($this->entityIds[$id]) ? $this->entityIds[$id] : null;
	}
}