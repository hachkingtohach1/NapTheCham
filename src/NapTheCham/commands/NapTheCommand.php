<?php

declare(strict_types=1);

/**
 * Copyright 2020 DragoVN
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace NapTheCham\commands;
use NapTheCham\Main;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginIdentifiableCommand;
use pocketmine\Player;
use pocketmine\plugin\Plugin;

class NapTheCommand extends Command implements PluginIdentifiableCommand {

    protected $plugin;		

    public function __construct(Main $plugin) 
	{
        $this->plugin = $plugin;		
        parent::__construct("", "Nạp thẻ command", \null, ["napthe"]);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) 
	{
        if(!isset($args[0]) && !isset($args[1]) && !isset($args[2]) && !isset($args[3])) {
            $sender->sendMessage("Usage: /napthe [mã thẻ] [seri thẻ] [giá trị] [nhà mạng]");
            return;
        }
        $this->plugin->submitPaymentForm($sender->getName(), $args[0], $args[1], $args[2], $args[3]);
	}

    public function getPlugin(): Plugin 
	{
        return $this->plugin;
    }
}
