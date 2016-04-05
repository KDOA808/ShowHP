<?php

namespace ShowHP;

use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\utils\TextFormat;
use pocketmine\event\Listener;

class ShowHP extends PluginBase implements Listener {
	public function onEnable() {
		$this->getServer ()->getLogger ()->info ( "[ ShowHP ] Plugin has been activated!" );
		$this->getServer ()->getLogger ()->error ( "[ ShowHP ] Users of this plugin is considered to be agreed by the GPLv3 license. !" );
		$this->getServer ()->getLogger ()->info ( "[ ShowHP ] Hello!" );
		$this->getServer ()->getPluginManager ()->registerEvents ( $this, $this );
	}
	public function onChat(PlayerChatEvent $event) {
		$hp = $event->getPlayer ()->getHealth () - 0;
		$color = TextFormat::GREEN;
		if($hp < 0) $hp = 0;
		if($hp <= 5) $color = TextFormat::RED;
		else if($hp <= 10) $color = TextFormat::YELLOW;
		$event->setMessage ( $color . "HP: " . $hp . TextFormat::WHITE . ">" . $event->getMessage () );
	}
}
?>
