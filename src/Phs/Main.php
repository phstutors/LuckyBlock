<?php

namespace Phs;

use pocketmine\entity\Effect;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\item\Item;
use pocketmine\level\sound\AnvilFallSound;
use pocketmine\level\sound\Sound;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;


class Main extends PluginBase implements Listener{



    /*
     * |-----------|       |         |        __________
     * |           |       |         |        |
     * |           |       |---------|        |_________                   |
     * |-----------|       |         |                 |               ____|_____          _________
     * |                   |         |        _________|                   |    ___________
     *                                                                     |
     */
    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this,$this);
        $this->getLogger()->info("§cPlugin ativado");
    }

    public function onBreak(BlockBreakEvent $event){

        $player = $event->getPlayer();

        if($event->getBlock()->getId() == 19){
            $items = array(Item::STONE_SWORD, Item::DIRT,Item::GOLDEN_APPLE,Item::IRON_CHESTPLATE, Item::DIAMOND_CHESTPLATE, Item::TNT, Item::BOW, Item::ARROW);
            $event->setDrops(array_rand($items));
            $player->sendPopup("§eVocê Quebrou uma LuckyBlock");

            $dado = random_int(0, 8);
            if($dado == 6){
                $player->getInventory()->clearAll();
                $sound1 = new AnvilFallSound($player);
                $player->sendPopup("§cVocê deu azar, seu inventario foi limpo!");
                $player->getLevel()->addSound($sound1, [$player]);
            }
            elseif($dado == 5){
                $player->kick("§cVocê deu Azar !!!");
            }
            elseif($dado == 4){
                $player->kill();
                $player->sendMessage("§cVocê foi morto por azar!!!");
            }
            elseif($dado == 3){
                $hp = $player->getHealth();
                $player->setHealth($hp-6);
            }
            elseif($dado == 2){
                $player->setGamemode(2);
                $player->sendMessage("§cVocê virou um fantama");
            }
            elseif($dado == 1){
                $player->addEffect(Effect::SPEED);
                $player->addEffect(Effect::JUMP);
                $player->sendPopup("§Voce deu SORTE!!!!!!!!!!");
            }


        }
    }


}