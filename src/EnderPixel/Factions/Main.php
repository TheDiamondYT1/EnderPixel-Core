<?php

namespace EnderPixel\Factions;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

use pocketmine\level\Position;
use pocketmine\level\Level;

use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\player\PlayerCommandPreprocessEvent;

use EnderPixel\Factions\cmd\staff\CommandHeal;
use EnderPixel\Factions\cmd\staff\CommandFly;
use EnderPixel\Factions\cmd\staff\CommandColor;
use EnderPixel\Factions\cmd\staff\CommandTPAll;
use EnderPixel\Factions\cmd\staff\CommandSpy;

use EnderPixel\Factions\cmd\donators\CommandFeed;

use EnderPixel\Factions\cmd\CommandStaff;

class Main extends PluginBase implements Listener {
	
	public $prefix = "§8[§aEP§8]§6 ";

	public $chatDisabled = false;
	
	public $flying = array();
	public $godmode = array();
	public $commandspy = array();
	
	public function onEnable() {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->registerCommands();
	}

	private function registerCommands() {
	        $map = $this->getServer()->getCommandMap();

            //Staff commands
	        $map->register("heal" , new CommandHeal($this));
			$map->register("fly" , new CommandFly($this));
			//$map->register("chat", new CommandChat($this));
			$map->register("color", new CommandColor($this));
			$map->register("tpall", new CommandTPAll($this));
			$map->register("commandspy", new CommandSpy($this));

			//Donator commands
			$map->register("feed", new CommandFeed($this));

			//Player commands
			$map->register("staff", new CommandStaff($this));
	}
	
	/*
	 * Get rid of that void! (Probably doesnt work)
	 */
	public function onMove(PlayerMoveEvent $event){
        if($event->getTo()->getFloorY() < 0){
            $player = $event->getPlayer();
            $x = $this->getServer()->getDefaultLevel()->getSafeSpawn()->getFloorX();
            $y = $this->getServer()->getDefaultLevel()->getSafeSpawn()->getFloorY();
            $z = $this->getServer()->getDefaultLevel()->getSafeSpawn()->getFloorZ();
            
            $level = $this->getServer()->getDefaultLevel();
            $player->teleport(new Position($x, $y, $z, $level));
            $player->setHealth($player->getHealth(20));
        }
    }

	/*
	 * • Prevent damaging players when flying
	 * • GOD MODE!!
	 */
	public function onEntityDamage(EntityDamageEvent $event) {
	    $entity = $event->getEntity();
        if($event instanceof EntityDamageByEntityEvent) {
            $damager = $event->getDamager();
               if($damager instanceof Player && $this->isFlying($damager)) {
                  $event->setCancelled(true);
               }          
        }
		
        if($entity instanceof Player && isset($this->enabled[$entity->getName()])) {
              if($this->godmode[$entity->getName()]) {
                $event->setCancelled();
              }
        }
    }
    
	/*
	 * Spy on peoples commands...
	 */
    public function onCommandProcess(PlayerCommandPreprocessEvent $e){
        foreach($this->getServer()->getOnlinePlayers() as $p){
            if($this->hasCommandSpy($e->getPlayer())){
                $p->sendMessage(TextFormat::YELLOW . TextFormat::ITALIC . $e->getPlayer()->getName() . ": /" . $e->getMessage());
            }
        }
    }
    
	/*
	 * Chat disable
	 */
    public function onChat(PlayerChatEvent $event) {
        if($this->chatDisabled) {
            $event->setCancelled(true);
            $event->getPlayer()->sendMessage(TextFormat::GOLD . "Chat is currently disabled");
        }
    }


	///////// Functions used by other clases ///////// 

	    public function addFlying(Player $player) {
            $this->flying[$player->getName()] = $player->getName();
        }
        
        public function isFlying(Player $player) {
            return in_array($player->getName(), $this->flying);
        }
        
        public function removeFlying(Player $player) {
            unset($this->flying[$player->getName()]);
        }
        
        
        public function hasCommandSpy($player) {
            return in_array($player->getName(), $this->commandspy);
        }
    
        public function disableCommandSpy($player) {
            $this->commandspy[$player->getName()] = $player->getName();
        }
    
        public function enableCommandSpy($player) {
            unset($this->commandspy[$player->getName()]);
        }
}
