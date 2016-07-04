<?php

namespace Managon\cutepia;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\math\Vector3;
use pocketmine\item\Item;

use Managon\cutepia\CutepiaEntity;
use Managon\cutepia\cutepiaentity\CutepiaEntityManager;

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

class Cutepia extends \pocketmine\plugin\PluginBase implements \pocketmine\event\Listener
{
	public $entities = [];

	private $damageList = [
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

	public function onEnable()
	{
		$this->server = Server::getInstance();
		$this->server->getPluginManager()->registerEvents($this,$this);
		$this->manager = new CutepiaEntityManager($this);
		$this->manager->registerEntities();
	}

	public function onTap(\pocketmine\event\player\PlayerInteractEvent $event)
	{
		$player = $event->getPlayer();
		$item = $player->getItemInHand();
		if($item->getId() === 383)
		{
			$block = $event->getBlock();
		    $x = $block->x;
		    $y = $block->y + 1;
		    $z = $block->z;
		    $pos = new Vector3($x, $y, $z);
			$this->entity->spawn($pos, $player->getLevel(), $item->getDamage());
		}
	}
	

	public function make()//自分が楽するためですグフ
	{
    	foreach ($this->damageList as $key => $name) 
		{ 		
			$data = 
<<<EOL
<?php
namesapce Managon\cutepia\cutepiaentity\cutepia;

use pocketmine\entity\

class {$name} extends {$name} implements Cutepia??
{
	
}
EOL;

			file_put_contents($this->getDataFolder()."txt.txt",$data."\n", FILE_APPEND);
		}
	}*/
}
