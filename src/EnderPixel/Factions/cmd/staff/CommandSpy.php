<?php

namespace EnderPixel\Factions\cmd\staff;

use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat as Text;
use pocketmine\Player;

use EnderPixel\Factions\Main;
use EnderPixel\Factions\cmd\BaseCommand;

class CommandSpy extends BaseCommand {

	public function __construct(Main $plugin){
        parent::__construct($plugin, "commandspy", "Spy on others commands!", "/commandspy", ['cmdspy']);
        $this->setPermission("epFactions.commandspy");
    }

	public function execute(CommandSender $sender, $label, array $args){
		if(!$this->testPermission($sender)){
			$sender->sendMessage($this->prefix . "§cYou don't have permission for that!");
			return true;
		}
		
		if ($this->getPlugin()->hasCommandSpy($sender)) {
			$sender->sendMessage($this->prefix . "You have disabled Command Spy");
			$this->getPlugin()->removeCommandSpy($sender);
			return true;
		} else {
			$sender->sendMessage($this->prefix . "You have enabled Command Spy");
			$this->getPlugin()->enableCommandSpy($sender);
			return true;
		}
	}
}
