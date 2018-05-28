<?php

namespace Weglot\Parser\Check\Dom;

use Weglot\Client\Api\Enum\WordType;
use Weglot\Util\Text as TextUtil;

/**
 * Class Placeholder
 * @package Weglot\Parser\Check\Dom
 */
class Placeholder extends AbstractDomChecker
{
    /**
     * {@inheritdoc}
     */
    const DOM = 'input[type="text"],input[type="password"],input[type="search"],input[type="email"],input:not([type]),textarea';

    /**
     * {@inheritdoc}
     */
    const PROPERTY = 'placeholder';

    /**
     * {@inheritdoc}
     */
    const WORD_TYPE = WordType::PLACEHOLDER;

    /**
     * {@inheritdoc}
     */
    protected function check()
    {
        return (!is_numeric(TextUtil::fullTrim($this->node->placeholder))
            && !preg_match('/^\d+%$/', TextUtil::fullTrim($this->node->placeholder)));
    }
}
