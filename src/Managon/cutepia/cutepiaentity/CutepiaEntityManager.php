<?php

namespace Managon\cutepia\cutepiaentity;

use Managon\cutepia\Cutepia;
use Managon\cutepia\CutepiaEntity;
use pocketmine\entity\Entity;

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


class CutepiaEntityManager
{
	public static $instance;
	public $damageList = [
	33 => "CutepiaCreeper",
	34 => "CutepiaSkeleton",
	35 => "CutepiaSpider",
	32 => "CutepiaZombie",
	37 => "CutepiaSlime",
	41 => "CutepiaGhast",
	36 => "CutepiaZombiePigman",
	38 => "CutepiaEnderman",
    40 => "CutepiaCaveSpider",
	39 => "CutepiaSilverfish",
	43 => "CutepiaBlaze",
	42 => "CutepiaMagmaCube",
	19 => "CutepiaBat",
	12 => "CutepiaPig",
	13 => "CutepiaSheep",
	11 => "CutepiaCow",
	10 => "CutepiaChicken",
	17 => "CutepiaSquid",
	14 => "CutepiaWolf",
	16 => "CutepiaMooshroom",
	22 => "CutepiaOcelot",
	23 => "CutepiaHorse",
	18 => "CutepiaRabbit",
	15 => "CutepiaVillager",
	24 => "CutepiaDonkey",
	25 => "CutepiaMule",
	26 => "CutepiaSkeletonHorse",
	27 => "CutepiaZombieHorse",
	46 => "CutepiaStray",
	47 => "CutepiaHusk",
	48 => "CutepiaWitherSkeleton",
	45 => "CutepiaWhich"
	];
	public function __construct(Cutepia $main)
	{
		$this->main = $main;
		self::$instance = $this;
	}

	public static function getInstance()
	{
		return self::$instance;
	}

	public function registerEntities()
	{
		Entity::registerEntity(CutepiaCreeper::class);
		Entity::registerEntity(CutepiaSkeleton::class);
		Entity::registerEntity(CutepiaSpider::class);
		Entity::registerEntity(CutepiaZombie::class);
		Entity::registerEntity(CutepiaSlime::class);
		Entity::registerEntity(CutepiaGhast::class);
		Entity::registerEntity(CutepiaZombiePigman::class);
		Entity::registerEntity(CutepiaEnderman::class);
		Entity::registerEntity(CutepiaCaveSpider::class);
		Entity::registerEntity(CutepiaSilverfish::class);
		Entity::registerEntity(CutepiaBlaze::class);
		Entity::registerEntity(CutepiaMagmaCube::class);
		Entity::registerEntity(CutepiaBat::class);
		Entity::registerEntity(CutepiaPig::class);
		Entity::registerEntity(CutepiaSheep::class);
		Entity::registerEntity(CutepiaCow::class);
		Entity::registerEntity(CutepiaChicken::class);
		Entity::registerEntity(CutepiaSquid::class);
		Entity::registerEntity(CutepiaWolf::class);
		Entity::registerEntity(CutepiaMooshroom::class);
		Entity::registerEntity(CutepiaOcelot::class);
		Entity::registerEntity(CutepiaHorse::class);
		Entity::registerEntity(CutepiaRabbit::class);
		Entity::registerEntity(CutepiaVillager::class);
		Entity::registerEntity(CutepiaDonkey::class);
		Entity::registerEntity(CutepiaMule::class);
		Entity::registerEntity(CutepiaSkeletonHorse::class);
		Entity::registerEntity(CutepiaZombieHorse::class);
		Entity::registerEntity(CutepiaStray::class);
		Entity::registerEntity(CutepiaHusk::class);
		Entity::registerEntity(CutepiaWitherSkeleton::class);
		Entity::registerEntity(CutepiaWhich::class);
	}
}