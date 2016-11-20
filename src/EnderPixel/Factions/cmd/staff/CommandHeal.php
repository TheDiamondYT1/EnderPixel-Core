<?php

namespace EnderPixel\Core\cmd\staff;

use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat as Text;
use pocketmine\Player;

use EnderPixel\Core\Main;
use EnderPixel\Core\cmd\BaseCommand;

class CommandHeal extends BaseCommand {

	public function __construct(Main $plugin){
        parent::__construct($plugin, "heal", "Heal yourself or other player", "/heal [player]");
        $this->setPermission("epcore.heal");
    }

	public function execute(CommandSender $sender, $alias, array $args){
		if(!$this->testPermission($sender)){
			$sender->sendMessage($this->prefix . "§cYou don't have permission for that!");
			return true;
		}
		if(!$sender instanceof Player){
			$sender->sendMessage(Text::RED . "Please run this command in game!");
			return true;
	    }
	    if(count($args) < 0 or count($args) > 1){
	        $sender->sendMessage(Text::RED . "Usage: /heal [player]");
	        return true;
	    }
		
		if(isset($args[0])){
		    $target = $this->getPlugin()->getServer()->getPlayer($args[0]);

            if(!($target instanceof Player)){
                $sender->sendMessage(Text::RED . "The player '$args[0]' is not online");
                return true;
            }

		    $target->setHealth(20);
		    $target->sendMessage(Text::GREEN . "You have been healed by " . Text::YELLOW . $sender->getName());
		    $sender->sendMessage(Text::GOLD . "You healed " . Text::YELLOW . $target->getName());
		} else {
		    $sender->setHealth(20);
		    $sender->sendMessage(Text::GREEN . "You have been healed");
		}
	}
}
