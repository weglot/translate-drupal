<?php

use Weglot\Client\Client;
use Weglot\Client\Endpoint\Languages;
use Weglot\Client\Api\LanguageCollection;

class LanguagesTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var LanguageCollection
     */
    protected $languages;

    /**
     * Init client
     */
    protected function _before()
    {
        $this->client = new Client(getenv('WG_API_KEY'));
        $endpoint = new Languages($this->client);
        $this->languages = $endpoint->handle();
    }

    // tests
    public function testCount()
    {
        $this->assertEquals(108, count($this->languages));
    }

    public function testGetCode()
    {
        $this->assertEquals('Finnish', $this->languages->getCode('fi')->getEnglishName());
        $this->assertEquals('Hrvatski', $this->languages->getCode('hr')->getLocalName());
        $this->assertNull($this->languages->getCode('foo'));
    }

    public function testSerialize()
    {
        $json = json_encode($this->languages->getCode('fr'));
        $expected = '{"code":"fr","english":"French","local":"Fran\u00e7ais"}';
        $this->assertEquals($expected, $json);
    }
}
