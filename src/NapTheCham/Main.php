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

namespace NapTheCham;
use NapTheCham\Commands\NapTheCommand;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;
use pocketmine\math\Vector3;
use pocketmine\utils\Config;
use pocketmine\event\player\PlayerJoinEvent;

class Main extends PluginBase implements Listener {
	
	public $commands = [];
	
	public function onEnable()
	{			
		$this->getData();
		$this->registerEvents();
		$this->getLoggerPlugin();
		$this->getServer()->getCommandMap()->register("napthe", $this->commands[] = new NapTheCommand($this));
	}
	
	public function getLoggerPlugin() 
	{
		$this->getLogger()->info(TextFormat::GREEN . "Khi chạy bạn tìm file ngoài với tên là card.log để check card đã nạp!");
	}
	
	public function registerEvents() 
	{
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}
	
	public function getData() 
	{
		@mkdir($this->getDataFolder());
		$this->saveDefaultConfig();
		$this->getResource("config.yml");
	}
	
	public function saveData($fh, $name, $ma, $seri, $nhamang, $amount, $time) 
	{
		$space = " | ";
		fwrite($fh,
		    "User: ".$name.$space.
		    "Mã thẻ: ".$ma.$space.
            "Seri thẻ: ".$seri.$space.
		    "Loại thẻ: ".$nhamang.$space.
		    "Mệnh giá: ".$amount.$space.
		    "Time: ".$time
		);
		fwrite($fh,"\r\n");
	    fclose($fh);
	}
	
	public function submitPaymentForm($name, $ma, $seri, $amount, $nhamang)
	{
		$file = "card.log"; 
		$fh = fopen($file,"a") or die("can't open this file can have some bugs!");	
        $time = time(); 		
	    $this->saveData($fh, $name, $ma, $seri, $nhamang, $amount, $time);
	}	
}	
	
	
	