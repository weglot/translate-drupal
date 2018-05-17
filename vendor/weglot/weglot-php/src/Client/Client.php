<?php

namespace Weglot\Client;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Http\Message\ResponseInterface;
use Weglot\Client\Api\Exception\ApiError;
use Weglot\Client\Caching\Cache;
use Weglot\Client\Caching\CacheInterface;

/**
 * Class Client
 * @package Weglot\Client
 */
class Client
{
    /**
     * Library version
     *
     * @var string
     */
    const VERSION = '0.2';

    /**
     * Weglot API Key
     *
     * @var string
     */
    protected $apiKey;

    /**
     * Options for client
     *
     * @var array
     */
    protected $options;

    /**
     * Http connector
     *
     * @var GuzzleClient
     */
    protected $connector;

    /**
     * @var Profile
     */
    protected $profile;

    /**
     * @var CacheInterface
     */
    protected $cache;

    /**
     * Client constructor.
     * @param string    $apiKey     your Weglot API key
     * @param array     $options    an array of options, currently only "host" is implemented
     */
    public function __construct($apiKey, $options = [])
    {
        $this->apiKey = $apiKey;
        $this->profile = new Profile($apiKey);

        $this
            ->setOptions($options)
            ->setCache();
    }

    /**
     * Creating Guzzle HTTP connector based on $options
     */
    protected function setupConnector()
    {
        $this->connector = new GuzzleClient([
            'base_uri' => $this->options['host'],
            'headers' => [
                'Content-Type' => 'application/json',
                'User-Agent' => $this->options['user-agent']
            ],
            'query' => [
                'api_key' => $this->apiKey
            ]
        ]);
    }

    /**
     * @return string
     */
    protected function makeUserAgent()
    {
        $curlVersion = curl_version();

        $userAgentArray = [
            'curl' =>  'cURL\\' .$curlVersion['version'],
            'ssl' => $curlVersion['ssl_version'],
            'weglot' => 'Weglot\\' .self::VERSION
        ];

        return implode(' / ', $userAgentArray);
    }

    /**
     * Default options values
     *
     * @return array
     */
    public function defaultOptions()
    {
        return [
            'host'  => 'https://api.weglot.com',
            'user-agent' => $this->makeUserAgent()
        ];
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param array $options
     * @return $this
     */
    public function setOptions($options)
    {
        // merging default options with user options
        $this->options = array_merge($this->defaultOptions(), $options);

        // then loading / reloading http connector
        $this->setupConnector();

        return $this;
    }

    /**
     * @return GuzzleClient
     */
    public function getConnector()
    {
        return $this->connector;
    }

    /**
     * @return Profile
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * @param null|CacheInterface $cache
     * @return $this
     */
    public function setCache($cache = null)
    {
        if ($cache === null || !($cache instanceof CacheInterface)) {
            $cache = new Cache();
        }

        $this->cache = $cache;

        return $this;
    }

    /**
     * @return CacheInterface
     */
    public function getCache()
    {
        return $this->cache;
    }

    /**
     * @param null|CacheItemPoolInterface $cacheItemPool
     * @return $this
     */
    public function setCacheItemPool($cacheItemPool)
    {
        $this->getCache()->setItemPool($cacheItemPool);

        return $this;
    }

    /**
     * Make the API call and return the response.
     *
     * @param string $method    Method to use for given endpoint
     * @param string $endpoint  Endpoint to hit on API
     * @param array $body       Body content of the request as array
     * @param bool $asArray     To know if we return an array or ResponseInterface
     * @return array|ResponseInterface
     * @throws ApiError
     */
    public function makeRequest($method, $endpoint, $body = [], $asArray = true)
    {
        try {
            $response = $this->connector->request($method, $endpoint, [
                'json' => $body
            ]);
            $array = json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            throw new ApiError($e->getMessage(), $body);
        }

        if ($asArray) {
            return $array;
        }
        return $response;
    }
}
