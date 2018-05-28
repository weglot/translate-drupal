<?php

namespace Weglot\Util;

use Weglot\Client\Api\Enum\WordType;
use Weglot\Client\Api\Exception\InvalidWordTypeException;
use Weglot\Client\Api\WordCollection;
use Weglot\Client\Api\WordEntry;

/**
 * Class JsonLd
 * @package Weglot\Parser\Util
 */
class JsonLd
{
    /**
     * @param array $data
     * @param string $key
     * @return mixed
     */
    public static function get(array $data, $key)
    {
        if (isset($data[$key])) {
            return $data[$key];
        }
        return null;
    }

    /**
     * @param WordCollection $words
     * @param string $value
     * @throws InvalidWordTypeException
     */
    public static function add(WordCollection $words, $value)
    {
        $words->addOne(new WordEntry($value, WordType::TEXT));
    }

    /**
     * @param WordCollection $words
     * @param mixed $data
     * @param null $index
     * @param int $nextJson
     * @return array
     */
    public static function set(WordCollection $words, $data, $index, &$nextJson)
    {
        $data[$index] = $words[$nextJson]->getWord();
        ++$nextJson;

        return $data;
    }
}
