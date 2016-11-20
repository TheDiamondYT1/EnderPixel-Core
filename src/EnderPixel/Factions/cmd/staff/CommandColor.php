<?php

namespace EnderPixel\Factions\cmd\staff;

use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat as Text;
use pocketmine\Player;

use EnderPixel\Factions\Main;
use EnderPixel\Factions\cmd\BaseCommand;

class CommandColor extends BaseCommand {

	public function __construct(Main $plugin){
        parent::__construct($plugin, "color", "Change nickname color", "/color");
        $this->setPermission("epFactions.color");
    }

	public function execute(CommandSender $sender, $label, array $args){
		if(!$this->testPermission($sender)){
			$sender->sendMessage($this->prefix . "§cYou don't have permission for that!");
			return true;
		}
        if(!$sender instanceof Player){
        	$sender->sendMessage(Text::RED . "Please run this command in game!");
        	return true;
        }
        if(count($args) < 0 or count($args) > 1){
         	$sender->sendMessage(Text::RED . "Usage: /color <none/color>");
         	return true;
        }

        switch($args[0]){
            case "none":
                $sender->kick(Text::AQUA . "Please reconnect. You will have default color.", false);
                break;
            case "green":
                $sender->setDisplayName(Text::GREEN . $sender->getName() . Text::WHITE);
                $sender->sendMessage($this->prefix . "Your name color is now " . Text::GREEN . "green!");
                break;
            case "darkgreen":
                $sender->setDisplayName(Text::DARK_GREEN . $sender->getName() . Text::WHITE);
                $sender->sendMessage($this->prefix . "Your name color is now " . Text::DARK_GREEN . "dark green!");
                break;
            case "red":
                $sender->setDisplayName(Text::RED . $sender->getName() . Text::WHITE);
                $sender->sendMessage($this->prefix . "Your name color is now " . Text::RED . "red!");
                break;
            case "darkred":
                $sender->setDisplayName(Text::DARK_RED . $sender->getName() . Text::WHITE);
                $sender->sendMessage($this->prefix . "Your name color is now " . Text::DARK_RED . "dark red!");
                break;
            case "aqua":
                $sender->setDisplayName(Text::AQUA . $sender->getName() . Text::WHITE);
                $sender->sendMessage($this->prefix . "Your name color is now " . Text::AQUA . "aqua!");
                break;
            case "blue":
                $sender->setDisplayName(Text::BLUE . $sender->getName() . Text::WHITE);
                $sender->sendMessage($this->prefix . "Your name color is now " . Text::BLUE . "blue!");
                break;
            case "cyan":
                $sender->setDisplayName(Text::CYAN . $sender->getName() . Text::WHITE);
                $sender->sendMessage($this->prefix . "Your name color is now " . Text::CYAN . "cyan!");
                break;
            case "darkpurple":
            case "purple":
                $sender->setDisplayName(Text::DARK_PURPLE . $sender->getName() . Text::WHITE);
                $sender->sendMessage($this->prefix . "Your name color is now " . Text::DARK_PURPLE . "purple!");
                break;
            case "lightpurple":
            case "pink":
                $sender->setDisplayName(Text::LIGHT_PURPLE . $sender->getName() . Text::WHITE);
                $sender->sendMessage($this->prefix . "Your name color is now " . Text::LIGHT_PURPLE . "pink!");
                break;
            case "gold":
                $sender->setDisplayName(Text::GOLD . $sender->getName() . Text::WHITE);
                $sender->sendMessage($this->prefix . "Your name color is now " . Text::GOLD . "gold!");
                break;
            case "black":
            case "gray":
            case "darkgray":
                $sender->sendMessage($this->prefix . "These colours are too dark!");
                break;
            default:
                $sender->sendMessage($this->prefix . Text::RED . "Unknown colour '$args[0]'");
                break;
        }
	}
}


