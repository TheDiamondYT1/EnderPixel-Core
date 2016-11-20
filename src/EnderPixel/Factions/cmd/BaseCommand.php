<?php

namespace EnderPixel\Factions\cmd;

use pocketmine\command\Command;
use pocketmine\command\PluginIdentifiableCommand;

use EnderPixel\Factions\Main;

abstract class BaseCommand extends Command implements PluginIdentifiableCommand {

    public $prefix = "§8[§aEP§8]§6 ";
	private $plugin;

	public function __construct(Main $plugin, $name, $desc = "", $usage, array $aliases = []){
		parent::__construct($name, $desc, $usage, $aliases);

		$this->plugin = $plugin;	
       }

	public function getPlugin(){
		return $this->plugin;
	}
}
