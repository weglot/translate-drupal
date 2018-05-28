<?php

use Weglot\Util\Url;

class UrlTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testSimpleUrlDefaultEnWithEsUrl()
    {
        $profile = [
            'url' => 'https://weglot.com/es/pricing',
            'default' => 'en',
            'languages' => ['fr', 'de', 'es'],
            'prefix' => '',
            'exclude' => [],
            'results' => [
                'getHost' => 'https://weglot.com',
                'getPathPrefix' => '',
                'getBaseUrl' => '/pricing',
                'isTranslable' => true,
                'detectCurrentLanguage' => 'es',
                'detectBaseUrl' => 'https://weglot.com/pricing',
                'currentRequestAllUrls' => [
                    'en' => 'https://weglot.com/pricing',
                    'fr' => 'https://weglot.com/fr/pricing',
                    'de' => 'https://weglot.com/de/pricing',
                    'es' => 'https://weglot.com/es/pricing'
                ]
            ]
        ];

        $url = $this->_urlInstance($profile);
        $this->_checkResults($url, $profile);
    }

    public function testSimpleUrlDefaultFrWithEnUrl()
    {
        $profile = [
            'url' => 'https://www.ratp.fr/en/horaires',
            'default' => 'fr',
            'languages' => ['en'],
            'prefix' => '',
            'exclude' => [],
            'results' => [
                'getHost' => 'https://www.ratp.fr',
                'getPathPrefix' => '',
                'detectBaseUrl' => 'https://www.ratp.fr/horaires',
                'getBaseUrl' => '/horaires',
                'isTranslable' => true,
                'detectCurrentLanguage' => 'en',
                'currentRequestAllUrls' => [
                    'fr' => 'https://www.ratp.fr/horaires',
                    'en' => 'https://www.ratp.fr/en/horaires',
                ]
            ]
        ];

        $url = $this->_urlInstance($profile);
        $this->_checkResults($url, $profile);
    }

    public function testSimpleUrlDefaultFrWithFrUrl()
    {
        $profile = [
            'url' => 'https://www.ratp.fr/horaires',
            'default' => 'fr',
            'languages' => ['en'],
            'prefix' => '',
            'exclude' => [],
            'results' => [
                'getHost' => 'https://www.ratp.fr',
                'getPathPrefix' => '',
                'detectBaseUrl' => 'https://www.ratp.fr/horaires',
                'getBaseUrl' => '/horaires',
                'isTranslable' => true,
                'detectCurrentLanguage' => 'fr',
                'currentRequestAllUrls' => [
                    'fr' => 'https://www.ratp.fr/horaires',
                    'en' => 'https://www.ratp.fr/en/horaires',
                ]
            ]
        ];

        $url = $this->_urlInstance($profile);
        $this->_checkResults($url, $profile);
    }

    public function testUrlDefaultEnWithEsUrlAndPrefix()
    {
        $profile = [
            'url' => 'https://weglot.com/web/es/pricing',
            'default' => 'en',
            'languages' => ['fr', 'de', 'es'],
            'prefix' => '/web',
            'exclude' => [],
            'results' => [
                'getHost' => 'https://weglot.com',
                'getPathPrefix' => '/web',
                'getBaseUrl' => '/pricing',
                'isTranslable' => true,
                'detectCurrentLanguage' => 'es',
                'detectBaseUrl' => 'https://weglot.com/web/pricing',
                'currentRequestAllUrls' => [
                    'en' => 'https://weglot.com/web/pricing',
                    'fr' => 'https://weglot.com/web/fr/pricing',
                    'de' => 'https://weglot.com/web/de/pricing',
                    'es' => 'https://weglot.com/web/es/pricing'
                ]
            ]
        ];

        $url = $this->_urlInstance($profile);
        $this->_checkResults($url, $profile);
    }

    public function testUrlDefaultEnWithEsUrlAndTrailingSlashAndPrefix()
    {
        $profile = [
            'url' => 'http://weglotmultiv2.local/othersite/',
            'default' => 'en',
            'languages' => ['fr', 'de', 'es'],
            'prefix' => '/othersite',
            'exclude' => [],
            'results' => [
                'getHost' => 'http://weglotmultiv2.local',
                'getPathPrefix' => '/othersite',
                'getBaseUrl' => '/',
                'isTranslable' => true,
                'detectCurrentLanguage' => 'en',
                'detectBaseUrl' => 'http://weglotmultiv2.local/othersite/',
                'currentRequestAllUrls' => [
                    'en' => 'http://weglotmultiv2.local/othersite/',
                    'fr' => 'http://weglotmultiv2.local/othersite/fr/',
                    'de' => 'http://weglotmultiv2.local/othersite/de/',
                    'es' => 'http://weglotmultiv2.local/othersite/es/'
                ]
            ]
        ];

        $url = $this->_urlInstance($profile);
        $this->_checkResults($url, $profile);
    }

    public function testUrlDefaultEnWithEnUrlAndPrefixAsUrl()
    {
        $profile = [
            'url' => 'https://weglot.com/web',
            'default' => 'en',
            'languages' => ['fr', 'de', 'es'],
            'prefix' => '/web',
            'exclude' => [],
            'results' => [
                'getHost' => 'https://weglot.com',
                'getPathPrefix' => '/web',
                'getBaseUrl' => '/',
                'isTranslable' => true,
                'detectCurrentLanguage' => 'en',
                'detectBaseUrl' => 'https://weglot.com/web/',
                'currentRequestAllUrls' => [
                    'en' => 'https://weglot.com/web/',
                    'fr' => 'https://weglot.com/web/fr/',
                    'de' => 'https://weglot.com/web/de/',
                    'es' => 'https://weglot.com/web/es/'
                ]
            ]
        ];

        $url = $this->_urlInstance($profile);
        $this->_checkResults($url, $profile);
    }

    public function testUrlDefaultEnWithFrAndExclude()
    {
        $profile = [
            'url' => 'https://weglot.com/fr/pricing',
            'default' => 'en',
            'languages' => ['fr', 'kr'],
            'prefix' => '',
            'exclude' => [
                '\/admin\/.*'
            ],
            'results' => [
                'getHost' => 'https://weglot.com',
                'getPathPrefix' => '',
                'getBaseUrl' => '/pricing',
                'isTranslable' => true,
                'detectCurrentLanguage' => 'fr',
                'detectBaseUrl' => 'https://weglot.com/pricing',
                'currentRequestAllUrls' => [
                    'en' => 'https://weglot.com/pricing',
                    'fr' => 'https://weglot.com/fr/pricing',
                    'kr' => 'https://weglot.com/kr/pricing'
                ]
            ]
        ];

        $url = $this->_urlInstance($profile);
        $this->_checkResults($url, $profile);

        $profile['url'] = 'https://weglot.com/fr/admin/dashboard';
        $profile['results']['getBaseUrl'] = '/admin/dashboard';
        $profile['results']['isTranslable'] = false;
        $profile['results']['detectBaseUrl'] = 'https://weglot.com/admin/dashboard';
        $profile['results']['currentRequestAllUrls'] = [
            'en' => 'https://weglot.com/admin/dashboard',
            'fr' => 'https://weglot.com/fr/admin/dashboard',
            'kr' => 'https://weglot.com/kr/admin/dashboard'
        ];

        $url = $this->_urlInstance($profile);
        $this->_checkResults($url, $profile);
    }

    public function testUrlDefaultEnWithKrAndInverseExclude()
    {
        $profile = [
            'url' => 'https://weglot.com/kr/pricing',
            'default' => 'en',
            'languages' => ['fr', 'kr'],
            'prefix' => '',
            'exclude' => [
                '^(?!/rgpd-wordpress/?|/optimiser-wordpress/?).*$'
            ],
            'results' => [
                'getHost' => 'https://weglot.com',
                'getPathPrefix' => '',
                'getBaseUrl' => '/pricing',
                'isTranslable' => false,
                'detectCurrentLanguage' => 'kr',
                'detectBaseUrl' => 'https://weglot.com/pricing',
                'currentRequestAllUrls' => [
                    'en' => 'https://weglot.com/pricing',
                    'fr' => 'https://weglot.com/fr/pricing',
                    'kr' => 'https://weglot.com/kr/pricing'
                ]
            ]
        ];

        $url = $this->_urlInstance($profile);
        $this->_checkResults($url, $profile);

        $profile['url'] = 'https://weglot.com/kr/rgpd-wordpress';
        $profile['results']['getBaseUrl'] = '/rgpd-wordpress';
        $profile['results']['isTranslable'] = true;
        $profile['results']['detectBaseUrl'] = 'https://weglot.com/rgpd-wordpress';
        $profile['results']['currentRequestAllUrls'] = [
            'en' => 'https://weglot.com/rgpd-wordpress',
            'fr' => 'https://weglot.com/fr/rgpd-wordpress',
            'kr' => 'https://weglot.com/kr/rgpd-wordpress'
        ];

        $url = $this->_urlInstance($profile);
        $this->_checkResults($url, $profile);
    }

    public function testUrlDefaultEnWithFrAndPrefixAndExclude()
    {
        $profile = [
            'url' => 'https://weglot.com/landing/fr/how-to-manage-your-translations',
            'default' => 'en',
            'languages' => ['fr', 'kr'],
            'prefix' => '/landing',
            'exclude' => [
                '\/admin\/.*'
            ],
            'results' => [
                'getHost' => 'https://weglot.com',
                'getPathPrefix' => '/landing',
                'getBaseUrl' => '/how-to-manage-your-translations',
                'isTranslable' => true,
                'detectCurrentLanguage' => 'fr',
                'detectBaseUrl' => 'https://weglot.com/landing/how-to-manage-your-translations',
                'currentRequestAllUrls' => [
                    'en' => 'https://weglot.com/landing/how-to-manage-your-translations',
                    'fr' => 'https://weglot.com/landing/fr/how-to-manage-your-translations',
                    'kr' => 'https://weglot.com/landing/kr/how-to-manage-your-translations'
                ]
            ]
        ];

        $url = $this->_urlInstance($profile);
        $this->_checkResults($url, $profile);

        $profile['url'] = 'https://weglot.com/landing/fr/admin/how-to-manage-your-translations';
        $profile['results']['getBaseUrl'] = '/admin/how-to-manage-your-translations';
        $profile['results']['isTranslable'] = false;
        $profile['results']['detectBaseUrl'] = 'https://weglot.com/landing/admin/how-to-manage-your-translations';
        $profile['results']['currentRequestAllUrls'] = [
            'en' => 'https://weglot.com/landing/admin/how-to-manage-your-translations',
            'fr' => 'https://weglot.com/landing/fr/admin/how-to-manage-your-translations',
            'kr' => 'https://weglot.com/landing/kr/admin/how-to-manage-your-translations'
        ];

        $url = $this->_urlInstance($profile);
        $this->_checkResults($url, $profile);
    }

    /**
     * @param array $profile
     * @return Url
     */
    protected function _urlInstance(array $profile)
    {
        return (new Url(
            $profile['url'],
            $profile['default'],
            $profile['languages'],
            $profile['prefix']
        ))
            ->setExcludedUrls($profile['exclude']);
    }

    /**
     * @param array $currentRequestAllUrls
     * @return string
     */
    protected function _generateHrefLangs(array $currentRequestAllUrls)
    {
        $render = '';
        foreach ($currentRequestAllUrls as $language => $url) {
            $render .= '<link rel="alternate" href="' .$url. '" hreflang="' .$language. '"/>'."\n";
        }
        return $render;
    }

    /**
     * @param Url $url
     * @param array $profile
     * @return void
     */
    protected function _checkResults(Url $url, array $profile)
    {
        // cloned $url, to be sure to have a `null` $baseUrl
        $cloned = clone $url;
        $this->assertEquals($profile['results']['currentRequestAllUrls'], $cloned->currentRequestAllUrls());

        // cloned $url, to be sure to have a `null` $baseUrl
        $cloned = clone $url;
        $this->assertEquals($profile['results']['isTranslable'], $cloned->isTranslable());

        $this->assertNull($url->getHost());
        $this->assertNull($url->getBaseUrl());

        $this->assertEquals($profile['results']['detectBaseUrl'], $url->detectUrlDetails());

        $this->assertEquals($profile['results']['getHost'], $url->getHost());
        $this->assertEquals($profile['results']['getPathPrefix'], $url->getPathPrefix());
        $this->assertEquals($profile['results']['getBaseUrl'], $url->getBaseUrl());

        $this->assertEquals($profile['results']['isTranslable'], $url->isTranslable());

        $this->assertEquals($profile['results']['detectCurrentLanguage'], $url->detectCurrentLanguage());

        $this->assertEquals($profile['results']['currentRequestAllUrls'], $url->currentRequestAllUrls());
        $this->assertEquals($this->_generateHrefLangs($profile['results']['currentRequestAllUrls']), $url->generateHrefLangsTags());

        foreach ($profile['results']['currentRequestAllUrls'] as $lang => $expected) {
            $this->assertEquals($expected, $url->getForLanguage($lang));
        }
    }
}
