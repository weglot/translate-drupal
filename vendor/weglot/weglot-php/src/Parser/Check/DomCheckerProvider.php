<?php

namespace Weglot\Parser\Check;

use SimpleHtmlDom\simple_html_dom;
use SimpleHtmlDom\simple_html_dom_node;
use Weglot\Client\Api\Exception\InvalidWordTypeException;
use Weglot\Client\Api\WordEntry;
use Weglot\Parser\Check\Dom\AbstractDomChecker;
use Weglot\Parser\Parser;
use Weglot\Util\Text;

class DomCheckerProvider
{
    const DEFAULT_CHECKERS_NAMESPACE = '\\Weglot\\Parser\\Check\\Dom\\';

    /**
     * @var Parser
     */
    protected $parser = null;

    /**
     * @var array
     */
    protected $checkers = [];

    /**
     * @var array
     */
    protected $discoverCaching = [];

    /**
     * DomChecker constructor.
     * @param Parser $parser
     */
    public function __construct(Parser $parser)
    {
        $this->setParser($parser);
        $this->loadDefaultCheckers();
    }

    /**
     * @param Parser $parser
     * @return $this
     */
    public function setParser(Parser $parser)
    {
        $this->parser = $parser;

        return $this;
    }

    /**
     * @return Parser
     */
    public function getParser()
    {
        return $this->parser;
    }

    /**
     * @param $checker
     * @return $this
     */
    public function addChecker($checker)
    {
        $this->checkers[] = $checker;

        return $this;
    }

    /**
     * @param array $checkers
     * @return $this
     */
    public function addCheckers(array $checkers)
    {
        $this->checkers = array_merge($this->checkers, $checkers);

        return $this;
    }

    /**
     * @return array
     */
    public function getCheckers()
    {
        $this->resetDiscoverCaching();

        return $this->checkers;
    }

    /**
     * @return $this
     */
    public function resetDiscoverCaching()
    {
        $this->discoverCaching = [];

        return $this;
    }

    /**
     * @param $domToSearch
     * @param simple_html_dom $dom
     * @return simple_html_dom_node
     */
    public function discoverCachingGet($domToSearch, simple_html_dom $dom)
    {
        if (!isset($discoverCaching[$domToSearch])) {
            $this->discoverCaching[$domToSearch] = $dom->find($domToSearch);
        }

        return $this->discoverCaching[$domToSearch];
    }

    /**
     * Load default checkers
     */
    protected function loadDefaultCheckers()
    {
        $files = array_diff(scandir(__DIR__ . '/Dom'), ['AbstractChecker.php', '..', '.']);
        $checkers = array_map(function ($filename) {
            return self::DEFAULT_CHECKERS_NAMESPACE . Text::removeFileExtension($filename);
        }, $files);

        $this->addCheckers($checkers);
    }

    /**
     * @param string $checker   Class of the Checker to add
     * @return bool
     */
    public function register($checker)
    {
        if ($checker instanceof AbstractDomChecker) {
            $this->addChecker($checker);
            return true;
        }
        return false;
    }

    /**
     * @param string $class
     * @return array
     */
    protected function getClassDetails($class)
    {
        $class = self::CHECKERS_NAMESPACE. $class;
        return [
            $class,
            $class::DOM,
            $class::PROPERTY,
            $class::WORD_TYPE
        ];
    }

    /**
     * @param simple_html_dom $dom
     * @return array
     * @throws InvalidWordTypeException
     */
    public function handle(simple_html_dom $dom)
    {
        $nodes = [];
        $checkers = $this->getCheckers();

        foreach ($checkers as $class) {
            list($selector, $property, $wordType) = $class::toArray();

            $discoveringNodes = $this->discoverCachingGet($selector, $dom);
            foreach ($discoveringNodes as $k => $node) {
                $instance = new $class($node, $property);

                if ($instance->handle()) {
                    $this->getParser()->getWords()->addOne(new WordEntry($node->$property, $wordType));

                    $nodes[] = [
                        'node' => $node,
                        'class' => $class,
                        'property' => $property,
                    ];
                }
            }
        }

        return $nodes;
    }
}
