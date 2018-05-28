<?php

namespace Weglot\Parser\Formatter;

use Weglot\Client\Api\TranslateEntry;
use Weglot\Parser\Parser;
use Weglot\Util\JsonLd;

/**
 * Class JsonLdFormatter
 * @package Weglot\Parser\Formatter
 */
class JsonLdFormatter extends AbstractFormatter
{
    /**
     * @var int
     */
    protected $nodesCount;

    /**
     * JsonLdFormatter constructor.
     * @param Parser $parser
     * @param TranslateEntry $translated
     * @param int $nodesCount
     */
    public function __construct(Parser $parser, TranslateEntry $translated, $nodesCount)
    {
        $this->setNodesCount($nodesCount);
        parent::__construct($parser, $translated);
    }

    /**
     * @param int $nodesCount
     * @return $this
     */
    public function setNodesCount($nodesCount)
    {
        $this->nodesCount = $nodesCount;

        return $this;
    }

    /**
     * @return int
     */
    public function getNodesCount()
    {
        return $this->nodesCount;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(array $jsons)
    {
        $translated_words = $this->getTranslated()->getOutputWords();

        for ($j = 0; $j < \count($jsons); $j++) {
            $data = $jsons[$j]['json'];
            $node = $jsons[$j]['node'];

            $value = JsonLd::get($data, 'description');

            if ($value !== null) {
                $data = JsonLd::set($translated_words, $data, 'description', $this->nodesCount);
            }

            $node->innertext = json_encode($data, JSON_PRETTY_PRINT);
        }
    }
}
