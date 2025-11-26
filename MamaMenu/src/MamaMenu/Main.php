<?php

namespace MamaMenu;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use jojoe77777\FormAPI\SimpleForm;

class Main extends PluginBase {

    public function onEnable(): void {
        $this->getLogger()->info("MamaMenu yüklendi!");
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
        if ($command->getName() === "mama") {
            if (!$sender instanceof Player) {
                $sender->sendMessage("Bu komutu sadece oyuncular kullanabilir!");
                return true;
            }
            if (!$sender->hasPermission("mamamenu.command")) {
                $sender->sendMessage("Bu komutu kullanma izniniz yok!");
                return true;
            }
            $this->openMamaMenu($sender);
            return true;
        }
        return false;
    }

    private function openMamaMenu(Player $player): void {
        $form = new SimpleForm(function (Player $player, ?int $data) {
            if ($data === null) {
                return;
            }
            
            switch ($data) {
                case 0:
                    $player->sendMessage("Buton 1'e tıkladınız!");
                    break;
                case 1:
                    $player->sendMessage("Buton 2'ye tıkladınız!");
                    break;
                case 2:
                    $player->sendMessage("Buton 3'e tıkladınız!");
                    break;
                case 3:
                    $player->sendMessage("Buton 4'e tıkladınız!");
                    break;
                case 4:
                    $player->sendMessage("Buton 5'e tıkladınız!");
                    break;
            }
        });

        $form->setTitle("Mama Menü");
        $form->setContent("Bir buton seçin:");
        $form->addButton("Buton 1");
        $form->addButton("Buton 2");
        $form->addButton("Buton 3");
        $form->addButton("Buton 4");
        $form->addButton("Buton 5");

        $player->sendForm($form);
    }
}
