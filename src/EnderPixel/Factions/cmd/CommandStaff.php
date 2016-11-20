<?php

namespace EnderPixel\Factions\cmd;

use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat as Text;
use pocketmine\Player;

use EnderPixel\Factions\Main;

class CommandStaff extends BaseCommand {

	public function __construct(Main $plugin){
        parent::__construct($plugin, "staff", "Display server staff.", "/staff");
        $this->setPermission("epcore.staff");
    }

	public function execute(CommandSender $sender, $label, array $args){
		if(!$this->testPermission($sender)){
			$sender->sendMessage($this->prefix . "§cYou don't have permission for that!");
			return true;
		}

        $sender->sendMessage(Text::GOLD."--------");
        $sender->sendMessage(Text::AQUA."Owners: ".Text::YELLOW."PragaKart67z, StaticGamerYT");
        $sender->sendMessage(Text::AQUA."Admins: ".Text::YELLOW."CaseyFTW_XD, TheDiamondYT7, BlueElk");
        $sender->sendMessage(Text::AQUA."Helpers: ".Text::YELLOW."Bluedeath01");
        $sender->sendMessage(Text::GOLD."--------");
	}
}
