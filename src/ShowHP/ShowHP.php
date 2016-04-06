<?php

namespace ShowHP;

use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\entity\EntityRegainHealthEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\player\PlayerJoinEvent
use pocketmine\Player;
use pocketmine\Server;
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
	public function onRegainHealth(EntityRegainHealthEvent $event){
        $entity = $event->getEntity();
        if($entity instanceof Player){
            $health = $entity->getHealth() + $event->getAmount();
            if($health > $entity->getMaxHealth()){
                $health = $entity->getMaxHealth();
            }
            $this->plugin->updateHealthBar($entity, $health);
        }
    }
}
 public function onHealthLose(EntityDamageEvent $event){
        $entity = $event->getEntity();
        if($entity instanceof Player){
            $gamemode = $entity->getServer()->getGamemodeFromString($entity->getGamemode());
            if($gamemode === 1 or $gamemode === 3){
                $event->setCancelled(true);
            }else{
                $health = $entity->getHealth() - $event->getFinalDamage();
                $this->plugin->updateHealthBar($entity, $health);
            }
        }
    }
} 
