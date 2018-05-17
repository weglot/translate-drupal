<?php

namespace Weglot\Parser\Formatter;

/**
 * Class IgnoredNodes
 * @package Weglot\Parser\Formatter
 */
class IgnoredNodes
{
    /**
     * @var string
     */
    protected $source;

    /**
     * Nodes to ignore in DOM
     * @var array
     */
    protected $ignoredNodes = [
        ['<strong>', '</strong>'],
        ['<em>', '</em>'],
        ['<abbr>', '</abbr>'],
        ['<acronym>', '</acronym>'],
        ['<b>', '</b>'],
        ['<bdo>', '</bdo>'],
        ['<big>', '</big>'],
        ['<cite>', '</cite>'],
        ['<kbd>', '</kbd>'],
        ['<q>', '</q>'],
        ['<small>', '</small>'],
        ['<sub>', '</sub>'],
        ['<sup>', '</sup>'],
    ];

    /**
     * IgnoredNodes constructor.
     * @param string $source
     */
    public function __construct($source)
    {
        $this
            ->setSource($source)
            ->handle();
    }

    /**
     * @param string $source
     * @return $this
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @return array
     */
    public function getIgnoredNodes()
    {
        return $this->ignoredNodes;
    }

    /**
     * Convert < & > for some dom tags to let them able
     * to go through API calls.
     */
    public function handle()
    {
        foreach ($this->getIgnoredNodes() as $ignore) {
            $pattern = '#' . $ignore[0] . '([^>]*)?' . $ignore[1] . '#';
            $replace = htmlentities($ignore[0]) . '$1' . htmlentities($ignore[1]);
            $this->setSource(preg_replace($pattern, $replace, $this->getSource()));
        }
    }
}
