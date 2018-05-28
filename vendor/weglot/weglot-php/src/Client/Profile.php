<?php

namespace Weglot\Client;

class Profile
{
    /**
     * @var int
     */
    protected $version;

    /**
     * @var bool
     */
    protected $ignoredNodes;

    /**
     * Profile constructor.
     * @param string $apiKey
     */
    public function __construct($apiKey)
    {
        $this->setup($apiKey);
    }

    /**
     * @param string $apiKey
     */
    protected function setup($apiKey)
    {
        $apiKeyLength = \strlen($apiKey);

        if ($apiKeyLength === 35) {
            $this
                ->setApiVersion(1)
                ->setIgnoredNodes(false);
        } elseif ($apiKeyLength === 36) {
            $this
                ->setApiVersion(2)
                ->setIgnoredNodes(true);
        }
    }

    /**
     * @param int $version
     * @return $this
     */
    public function setApiVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @return int
     */
    public function getApiVersion()
    {
        return $this->version;
    }

    /**
     * @param bool $ignoredNodes
     * @return $this
     */
    public function setIgnoredNodes($ignoredNodes)
    {
        $this->ignoredNodes = $ignoredNodes;

        return $this;
    }

    /**
     * @return bool
     */
    public function getIgnoredNodes()
    {
        return $this->ignoredNodes;
    }
}
