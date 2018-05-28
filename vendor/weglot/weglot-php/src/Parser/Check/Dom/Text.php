<?php

namespace Weglot\Parser\Check\Dom;

use Weglot\Client\Api\Enum\WordType;
use Weglot\Util\Text as TextUtil;

/**
 * Class Text
 * @package Weglot\Parser\Check
 */
class Text extends AbstractDomChecker
{
    /**
     * {@inheritdoc}
     */
    const DOM = 'text';

    /**
     * {@inheritdoc}
     */
    const PROPERTY = 'outertext';

    /**
     * {@inheritdoc}
     */
    const WORD_TYPE = WordType::VALUE;

    /**
     * {@inheritdoc}
     */
    protected function check()
    {
        return ($this->node->parent()->tag != 'script'
            && $this->node->parent()->tag != 'style'
            && !is_numeric(TextUtil::fullTrim($this->node->outertext))
            && !preg_match('/^\d+%$/', TextUtil::fullTrim($this->node->outertext))
            && strpos($this->node->outertext, '[vc_') === false
            && strpos($this->node->outertext, '<?php') === false);
    }
}
