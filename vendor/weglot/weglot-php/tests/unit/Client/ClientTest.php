<?php

use Weglot\Client\Client;
use Weglot\Client\HttpClient\CurlClient;

class ClientTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var \Weglot\Client\Client
     */
    protected $client;

    /**
     * Init client
     */
    protected function _before()
    {
        $this->client = new Client(getenv('WG_API_KEY'));
    }

    // tests
    public function testOptions()
    {
        $options = $this->client->getOptions();

        $this->assertEquals('https://api.weglot.com', $options['host']);
    }

    public function testConnector()
    {
        $httpClient = $this->client->getHttpClient();

        $this->assertTrue($httpClient instanceof CurlClient);

        $curlVersion = curl_version();
        $userAgentInfo = [
            'curl' =>  'cURL\\' .$curlVersion['version'],
            'ssl' => $curlVersion['ssl_version'],
            'weglot' => 'Weglot\\' .Client::VERSION
        ];
        $this->assertEquals($userAgentInfo, $httpClient->getUserAgentInfo());
    }

    public function testProfile()
    {
        $wgApiKeys = [
            'wg_aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa' => 1,
            'wg_bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb' => 2
        ];
        foreach ($wgApiKeys as $wgApiKey => $version) {
            $client = new Client($wgApiKey);
            $profile = $client->getProfile();

            $this->assertEquals($version, $profile->getApiVersion());
            $this->assertEquals($version === 2, $profile->getIgnoredNodes());
        }
    }

    public function testMakeRequest()
    {
        $response = $this->client->makeRequest('GET', '/status', []);
        $this->assertEquals([], $response);
    }

    public function testMakeRequestAsResponse()
    {
        list($rawBody, $httpStatusCode, $httpHeader) = $this->client->makeRequest('GET', '/status', [], false);
        $this->assertTrue($httpStatusCode === 200);
    }
}
