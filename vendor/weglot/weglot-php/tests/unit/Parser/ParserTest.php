<?php

use Weglot\Parser\ConfigProvider\ServerConfigProvider;
use Weglot\Parser\ConfigProvider\ManualConfigProvider;
use Weglot\Client\Api\Enum\BotType;
use Weglot\Client\Client;
use Weglot\Parser\Parser;

class ParserTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var array
     */
    protected $config;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var Parser
     */
    protected $parser;

    protected function _before()
    {
        $this->url = 'https://weglot.com/documentation/getting-started';

        // Config with $_SERVER variables
        $_SERVER['SERVER_NAME'] = 'weglot.com';
        $_SERVER['REQUEST_URI'] = '/documentation/getting-started';
        $_SERVER['HTTPS'] = 'on';
        $_SERVER['SERVER_PROTOCOL'] = 'http//';
        $_SERVER['SERVER_PORT'] = 443;
        $_SERVER['HTTP_USER_AGENT'] = 'Google';

        // Config manually
        $this->config = [
            'manual'    => new ManualConfigProvider($this->url, BotType::HUMAN),
            'server'    => new ServerConfigProvider()
        ];

        // Client
        $this->client = new Client(getenv('WG_API_KEY'));
    }

    // tests
    public function testTranslateManual()
    {
        // Parser
        $this->parser = new Parser($this->client, $this->config['manual']);

        // Run the Parser
        $translatedContent = $this->parser->translate(
            $this->_getContent($this->url),
            'en',
            'de'
        );

        $this->assertTrue(\is_string($translatedContent));
    }

    public function testTranslateServer()
    {
        // Parser
        $this->parser = new Parser($this->client, $this->config['server']);

        // Run the Parser
        $translatedContent = $this->parser->translate(
            $this->_getContent($this->url),
            'en',
            'de'
        );
        $this->assertTrue(\is_string($translatedContent));
    }

    private function _getContent($url)
    {
        // Fetching url content
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        $content = curl_exec($ch);
        curl_close($ch);

        return $content;
    }
}
