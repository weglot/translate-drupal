<?php

namespace Weglot\Util;

/**
 * Class Url
 * @package Weglot\Util
 */
class Url
{
    /**
     * @var string
     */
    protected $url;

    /**
     * @var null|string
     */
    protected $host = null;

    /**
     * @var null|string
     */
    protected $baseUrl = null;

    /**
     * @var null|array
     */
    protected $allUrls = null;

    /**
     * @var
     */
    protected $default;

    /**
     * @var array
     */
    protected $languages = [];

    /**
     * @var string
     */
    protected $pathPrefix = '';

    /**
     * @var array
     */
    protected $excludedUrls = [];

    /**
     * Url constructor.
     * @param string $url           Current visited url
     * @param string $default       Default language represented by ISO 639-1 code
     * @param array $languages      All available languages
     * @param string $pathPrefix    Prefix to access website root path (ie. : `/my/custom/path`, don't forget: starting `/` and no ending `/`)
     */
    public function __construct($url, $default, $languages = [], $pathPrefix = '')
    {
        $this
            ->setUrl(urldecode($url))
            ->setDefault($default)
            ->setLanguages($languages)
            ->setPathPrefix($pathPrefix);
    }

    /**
     * @param string $url
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $default
     * @return $this
     */
    public function setDefault($default)
    {
        $this->default = $default;
        return $this;
    }

    /**
     * @return string
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * @param array $languages
     * @return $this
     */
    public function setLanguages($languages)
    {
        $this->languages = $languages;
        return $this;
    }

    /**
     * @return array
     */
    public function getLanguages()
    {
        return $this->languages;
    }

    /**
     * @param string $pathPrefix
     * @return $this
     */
    public function setPathPrefix($pathPrefix)
    {
        $this->pathPrefix = $pathPrefix;
        return $this;
    }

    /**
     * @return string
     */
    public function getPathPrefix()
    {
        return $this->pathPrefix;
    }

    /**
     * @param array $excludedUrls
     * @return $this
     */
    public function setExcludedUrls($excludedUrls)
    {
        $this->excludedUrls = $excludedUrls;
        return $this;
    }

    /**
     * @return array
     */
    public function getExcludedUrls()
    {
        return $this->excludedUrls;
    }

    /**
     * @return null|string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @return null|string
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * @param string $code  Language represented by ISO 639-1 code
     * @return bool|string
     */
    public function getForLanguage($code)
    {
        $url = false;

        if (in_array($code, $this->getLanguages()) || $code === $this->getDefault()) {
            $all = $this->currentRequestAllUrls();
            $url = $all[$code];
        }

        return $url;
    }

    /**
     * Check if we need to translate given URL
     *
     * @return bool
     */
    public function isTranslable()
    {
        if ($this->getBaseUrl() === null) {
            $this->detectUrlDetails();
        }

        foreach ($this->getExcludedUrls() as $regex) {
            $escapedRegex = $this->escapeForRegex($regex);
            $fullRegex = sprintf('/%s/', $escapedRegex);

            if (preg_match($fullRegex, $this->getBaseUrl()) === 1) {
                return false;
            }
        }

        return true;
    }

    /**
     * Check current locale, based on URI segments from the given URL
     *
     * @return mixed
     */
    public function detectCurrentLanguage()
    {
        // parsing url to get only path & removing prefix if there is one
        $escapedPathPrefix = $this->escapeForRegex($this->getPathPrefix());
        $uriPath = parse_url($this->getUrl(), PHP_URL_PATH);
        $uriPath = preg_replace('/^' . $escapedPathPrefix . '/s', '', $uriPath);
        $uriSegments = explode('/', $uriPath);

        if (isset($uriSegments[1]) && in_array($uriSegments[1], $this->getLanguages())) {
            return $uriSegments[1];
        }
        return $this->getDefault();
    }

    /**
     * Generate possible host & base URL then store it into internal variables
     *
     * @return string   Host + path prefix + base URL
     */
    public function detectUrlDetails()
    {
        $escapedPathPrefix = $this->escapeForRegex($this->getPathPrefix());
        $languages = implode('|', $this->getLanguages());

        $fullUrl = preg_replace('#' . $escapedPathPrefix . '\/?(' . $languages . ')#i', '', $this->getUrl());
        $parsed = parse_url($fullUrl);

        $this->host = $parsed['scheme'] . '://' . $parsed['host'];
        $this->baseUrl = isset($parsed['path']) ? $parsed['path'] : '/';

        if ($this->baseUrl === $this->getPathPrefix() ||
            $this->baseUrl === $this->getPathPrefix() . '/') {
            $this->baseUrl = '/';
        }
        return $this->getHost() . $this->getPathPrefix() . $this->getBaseUrl();
    }

    /**
     * Returns array with all possible URL for current Request
     *
     * @return array
     */
    public function currentRequestAllUrls()
    {
        $urls = $this->allUrls;

        if ($urls === null) {
            if ($this->getBaseUrl() === null) {
                $this->detectUrlDetails();
            }

            $urls = [];
            $urls[$this->getDefault()] = $this->getHost() . $this->getPathPrefix() . $this->getBaseUrl();
            foreach ($this->getLanguages() as $language) {
                $urls[$language] = $this->getHost() . $this->getPathPrefix() . '/' . $language . $this->getBaseUrl();
            }

            $this->allUrls = $urls;
        }

        return $urls;
    }

    /**
     * Render hreflang links for SEO
     *
     * @return string
     */
    public function generateHrefLangsTags()
    {
        $render = '';
        $urls = $this->currentRequestAllUrls();

        foreach ($urls as $language => $url) {
            $render .= '<link rel="alternate" href="' .$url. '" hreflang="' .$language. '"/>'."\n";
        }

        return $render;
    }

    /**
     * @param string $regex
     * @return string
     */
    private function escapeForRegex($regex)
    {
        return str_replace('\\\\/', '\/', str_replace('/', '\/', $regex));
    }
}
