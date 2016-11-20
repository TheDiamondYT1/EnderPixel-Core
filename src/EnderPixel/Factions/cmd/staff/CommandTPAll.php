<?php

namespace EnderPixel\Factions\cmd\staff;

use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat as Text;
use pocketmine\Player;

use EnderPixel\Factions\Main;
use EnderPixel\Factions\cmd\BaseCommand;

class CommandTPAll extends BaseCommand {

	public function __construct(Main $plugin){
        parent::__construct($plugin, "tpall", "Teleport all players to you", "/tpall");
        $this->setPermission("epFactions.tpall");
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
		if(count($args) > 0){
            $sender->sendMessage(Text::RED . "Usage: /tpall");
            return true;
        }

        foreach($this->getPlugin()->getServer()->getOnlinePlayers() as $p){
            $p->teleport($sender);
            $p->sendMessage($this->prefix . Text::YELLOW . $sender->getName() . Text::GOLD . " teleported everyone to them!");
        }
    }
}
