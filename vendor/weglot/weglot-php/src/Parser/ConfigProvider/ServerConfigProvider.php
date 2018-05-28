<?php

namespace Weglot\Parser\ConfigProvider;

use Weglot\Client\Api\Enum\BotType;
use Weglot\Util\Server;

/**
 * Class ServerConfigProvider
 * @package Weglot\Parser\ConfigProvider
 */
class ServerConfigProvider extends AbstractConfigProvider
{
    /**
     * ServerConfigProvider constructor.
     * @param null|string $title    Don't set this title if you want the Parser to parse title from DOM
     */
    public function __construct($title = null)
    {
        parent::__construct('', BotType::HUMAN, $title);
    }

    /**
     * Is used to load server data, you have to run it manually !
     */
    public function loadFromServer()
    {
        $this
            ->setUrl(Server::fullUrl($_SERVER))
            ->setBot(Server::detectBot($_SERVER));
    }
}
