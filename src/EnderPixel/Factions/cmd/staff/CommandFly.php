<?php

namespace EnderPixel\Factions\cmd\staff;

use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat as Text;
use pocketmine\Player;

use EnderPixel\Factions\Main;
use EnderPixel\Factions\cmd\BaseCommand;

class CommandFly extends BaseCommand {

	public function __construct(Main $plugin){
        parent::__construct($plugin, "fly", "Enable or disable fly mode!", "/fly");
        $this->setPermission("epFactions.fly");
    }

	public function execute(CommandSender $sender, $label, array $args){
		if(!$this->testPermission($sender)){
			$sender->sendMessage($this->prefix . "§cYou don't have permission for that!");
			return true;
		}
		if(!$sender instanceof Player){
			$sender->sendMessage(Text::RED."Please run this command in game!");
			return true;
		}

		if ($this->getPlugin()->isFlying($sender)) {
			$sender->sendMessage($this->prefix . "Disabling flight mode");
			$this->getPlugin()->removeFlying($sender);
		} else {
			$sender->sendMessage($this->prefix . "Enabling flight mode");
			$this->getPlugin()->addFlying($sender);
		}
	}
}
