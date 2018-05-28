<?php

use Weglot\Util\JsonLd;
use Weglot\Client\Api\WordCollection;
use Weglot\Client\Api\WordEntry;

class JsonLdTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var array
     */
    protected $jsonLd = [];

    protected function _before()
    {
        $raw = <<<EOT
{
  "@context": {
    "name": "http://xmlns.com/foaf/0.1/name",
    "homepage": {
      "@id": "http://xmlns.com/foaf/0.1/workplaceHomepage",
      "@type": "@id"
    },
    "Person": "http://xmlns.com/foaf/0.1/Person"
  },
  "@id": "http://me.example.com",
  "@type": "Person",
  "name": "John Smith",
  "homepage": "http://www.example.com/"
}
EOT;
        $this->jsonLd = json_decode($raw, true);
    }


    // tests
    public function testGet()
    {
        $this->assertNull(JsonLd::get($this->jsonLd, 'description'));
        $this->assertEquals('John Smith', JsonLd::get($this->jsonLd, 'name'));
    }

    public function testAdd()
    {
        $words = new WordCollection();
        $words->addOne(new WordEntry('Une voiture bleue'));

        $this->assertEquals(1, $words->count());

        $value = JsonLd::get($this->jsonLd, 'name');
        JsonLd::add($words, $value);

        $this->assertEquals(2, $words->count());
        $this->assertEquals(new WordEntry($value), $words[1]);
    }

    public function testSet()
    {
        $nextJson = 0;
        $words = new WordCollection();
        $words->addOne(new WordEntry('Une voiture bleue'));

        $this->assertEquals(0, $nextJson);
        $this->assertEquals(1, $words->count());

        $data = JsonLd::set($words, $this->jsonLd, 'name', $nextJson);

        $this->assertEquals(1, $nextJson);
        $this->assertEquals($data['name'], $words[0]->getWord());
    }
}
