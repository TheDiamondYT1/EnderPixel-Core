<?php

namespace EnderPixel\Factions\cmd\donators;

use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat as Text;
use pocketmine\Player;

use EnderPixel\Factions\Main;
use EnderPixel\Factions\cmd\BaseCommand;

class CommandFeed extends BaseCommand {

	public function __construct(Main $plugin){
        parent::__construct($plugin, "feed", "Fill your hunger bar.", "/feed", ['eat']);
        $this->setPermission("epcore.feed");
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

		if(isset($args[1])){
            $target = $this->getPlugin()->getServer()->getPlayer($args[1]);

            if(!($target instanceof Player)){
                $sender->sendMessage(Text::RED."The player $args[1] is not online");
                return true;
            }

            $target->setFood(20);
        	$target->sendMessage(Text::GREEN."You have been fed by ".Text::YELLOW. $sender->getName());
        	$sender->sendMessage(Text::GOLD."You fed ".Text::YELLOW. $target->getName());
        } else {
            $sender->setFood(20);
            $sender->sendMessage(Text::GREEN."Your appetite has been sated");
        }
    }
}
