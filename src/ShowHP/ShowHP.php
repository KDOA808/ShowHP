<?php

namespace ShowHP;

use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\utils\TextFormat;
use pocketmine\event\Listener;

class ShowHP extends PluginBase implements Listener {
	public function onEnable() {
		$this->getServer ()->getLogger ()->info ( "[ ShowHP ] 플러그인이 활성화 되었습니다 !" );
		$this->getServer ()->getLogger ()->error ( "[ ShowHP ] 이 플러그인의 사용자는 GPLv3라이센스에 동의함으로 간주합니다. !" );
		$this->getServer ()->getLogger ()->info ( "[ ShowHP ] 추가적인 기능을 원하신다면 MCPE KOREA 게시글에 댓글 달아주세요 !" );
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
