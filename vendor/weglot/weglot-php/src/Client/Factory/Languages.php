<?php

namespace Weglot\Client\Factory;

use Weglot\Client\Api\LanguageEntry;

/**
 * Class Languages
 * @package Weglot\Client\Factory
 */
class Languages
{
    /**
     * @var array
     */
    protected $language;

    /**
     * Languages constructor.
     * @param array $language
     */
    public function __construct(array $language)
    {
        $this->language = $language;
    }

    /**
     * @param array $language
     * @return $this
     */
    public function setLanguage(array $language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return array
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @return LanguageEntry
     */
    public function handle()
    {
        $language = new LanguageEntry(
            $this->language['code'],
            $this->language['english'],
            $this->language['local']
        );

        return $language;
    }

    /**
     * Only used to replace API endpoint
     * We planned to make this endpoint available soon !
     *
     * @return array
     */
    public static function data()
    {
        return [
            'sq' => [
                'code'  => 'sq',
                'english' => 'Albanian',
                'local' => 'Shqip'
            ],
            'en' => [
                'code'  => 'en',
                'english' => 'English',
                'local' => 'English'
            ],
            'ar' => [
                'code'  => 'ar',
                'english' => 'Arabic',
                'local' => 'العربية‏'
            ],
            'hy' => [
                'code'  => 'hy',
                'english' => 'Armenian',
                'local' => 'հայերեն'
            ],
            'az' => [
                'code'  => 'az',
                'english' => 'Azerbaijani',
                'local' => 'Azərbaycan dili'
            ],
            'af' => [
                'code'  => 'af',
                'english' => 'Afrikaans',
                'local' => 'Afrikaans'
            ],
            'eu' => [
                'code'  => 'eu',
                'english' => 'Basque',
                'local' => 'Euskara'
            ],
            'be' => [
                'code'  => 'be',
                'english' => 'Belarusian',
                'local' => 'Беларуская'
            ],
            'bg' => [
                'code'  => 'bg',
                'english' => 'Bulgarian',
                'local' => 'български'
            ],
            'bs' => [
                'code'  => 'bs',
                'english' => 'Bosnian',
                'local' => 'Bosanski'
            ],
            'cy' => [
                'code'  => 'cy',
                'english' => 'Welsh',
                'local' => 'Cymraeg'
            ],
            'vi' => [
                'code'  => 'vi',
                'english' => 'Vietnamese',
                'local' => 'Tiếng Việt'
            ],
            'hu' => [
                'code'  => 'hu',
                'english' => 'Hungarian',
                'local' => 'Magyar'
            ],
            'ht' => [
                'code'  => 'ht',
                'english' => 'Haitian',
                'local' => 'Kreyòl ayisyen'
            ],
            'gl' => [
                'code'  => 'gl',
                'english' => 'Galician',
                'local' => 'Galego'
            ],
            'nl' => [
                'code'  => 'nl',
                'english' => 'Dutch',
                'local' => 'Nederlands'
            ],
            'el' => [
                'code'  => 'el',
                'english' => 'Greek',
                'local' => 'Ελληνικά'
            ],
            'ka' => [
                'code'  => 'ka',
                'english' => 'Georgian',
                'local' => 'ქართული'
            ],
            'da' => [
                'code'  => 'da',
                'english' => 'Danish',
                'local' => 'Dansk'
            ],
            'he' => [
                'code'  => 'he',
                'english' => 'Hebrew',
                'local' => 'עברית'
            ],
            'id' => [
                'code'  => 'id',
                'english' => 'Indonesian',
                'local' => 'Bahasa Indonesia'
            ],
            'ga' => [
                'code'  => 'ga',
                'english' => 'Irish',
                'local' => 'Gaeilge'
            ],
            'it' => [
                'code'  => 'it',
                'english' => 'Italian',
                'local' => 'Italiano'
            ],
            'is' => [
                'code'  => 'is',
                'english' => 'Icelandic',
                'local' => 'Íslenska'
            ],
            'es' => [
                'code'  => 'es',
                'english' => 'Spanish',
                'local' => 'Español'
            ],
            'kk' => [
                'code'  => 'kk',
                'english' => 'Kazakh',
                'local' => 'Қазақша'
            ],
            'ca' => [
                'code'  => 'ca',
                'english' => 'Catalan',
                'local' => 'Català'
            ],
            'ky' => [
                'code'  => 'ky',
                'english' => 'Kyrgyz',
                'local' => 'кыргызча'
            ],
            'zh' => [
                'code'  => 'zh',
                'english' => 'Simplified Chinese',
                'local' => '中文 (简体)'
            ],
            'tw' => [
                'code'  => 'tw',
                'english' => 'Traditional Chinese',
                'local' => '中文 (繁體)'
            ],
            'ko' => [
                'code'  => 'ko',
                'english' => 'Korean',
                'local' => '한국어'
            ],
            'lv' => [
                'code'  => 'lv',
                'english' => 'Latvian',
                'local' => 'Latviešu'
            ],
            'lt' => [
                'code'  => 'lt',
                'english' => 'Lithuanian',
                'local' => 'Lietuvių'
            ],
            'mg' => [
                'code'  => 'mg',
                'english' => 'Malagasy',
                'local' => 'Malagasy'
            ],
            'ms' => [
                'code'  => 'ms',
                'english' => 'Malay',
                'local' => 'Bahasa Melayu'
            ],
            'mt' => [
                'code'  => 'mt',
                'english' => 'Maltese',
                'local' => 'Malti'
            ],
            'mk' => [
                'code'  => 'mk',
                'english' => 'Macedonian',
                'local' => 'Македонски'
            ],
            'mn' => [
                'code'  => 'mn',
                'english' => 'Mongolian',
                'local' => 'Монгол'
            ],
            'de' => [
                'code'  => 'de',
                'english' => 'German',
                'local' => 'Deutsch'
            ],
            'no' => [
                'code'  => 'no',
                'english' => 'Norwegian',
                'local' => 'Norsk'
            ],
            'fa' => [
                'code'  => 'fa',
                'english' => 'Persian',
                'local' => 'فارسی'
            ],
            'pl' => [
                'code'  => 'pl',
                'english' => 'Polish',
                'local' => 'Polski'
            ],
            'pt' => [
                'code'  => 'pt',
                'english' => 'Portuguese',
                'local' => 'Português'
            ],
            'ro' => [
                'code'  => 'ro',
                'english' => 'Romanian',
                'local' => 'Română'
            ],
            'ru' => [
                'code'  => 'ru',
                'english' => 'Russian',
                'local' => 'Русский'
            ],
            'sr' => [
                'code'  => 'sr',
                'english' => 'Serbian',
                'local' => 'Српски'
            ],
            'sk' => [
                'code'  => 'sk',
                'english' => 'Slovak',
                'local' => 'Slovenčina'
            ],
            'sl' => [
                'code'  => 'sl',
                'english' => 'Slovenian',
                'local' => 'Slovenščina'
            ],
            'sw' => [
                'code'  => 'sw',
                'english' => 'Swahili',
                'local' => 'Kiswahili'
            ],
            'tg' => [
                'code'  => 'tg',
                'english' => 'Tajik',
                'local' => 'Тоҷикӣ'
            ],
            'th' => [
                'code'  => 'th',
                'english' => 'Thai',
                'local' => 'ภาษาไทย'
            ],
            'tl' => [
                'code'  => 'tl',
                'english' => 'Tagalog',
                'local' => 'Tagalog'
            ],
            'tt' => [
                'code'  => 'tt',
                'english' => 'Tatar',
                'local' => 'Tatar'
            ],
            'tr' => [
                'code'  => 'tr',
                'english' => 'Turkish',
                'local' => 'Türkçe'
            ],
            'uz' => [
                'code'  => 'uz',
                'english' => 'Uzbek',
                'local' => 'O\'zbek'
            ],
            'uk' => [
                'code'  => 'uk',
                'english' => 'Ukrainian',
                'local' => 'Українська'
            ],
            'fi' => [
                'code'  => 'fi',
                'english' => 'Finnish',
                'local' => 'Suomi'
            ],
            'fr' => [
                'code'  => 'fr',
                'english' => 'French',
                'local' => 'Français'
            ],
            'hr' => [
                'code'  => 'hr',
                'english' => 'Croatian',
                'local' => 'Hrvatski'
            ],
            'cs' => [
                'code'  => 'cs',
                'english' => 'Czech',
                'local' => 'Čeština'
            ],
            'sv' => [
                'code'  => 'sv',
                'english' => 'Swedish',
                'local' => 'Svenska'
            ],
            'et' => [
                'code'  => 'et',
                'english' => 'Estonian',
                'local' => 'Eesti'
            ],
            'ja' => [
                'code'  => 'ja',
                'english' => 'Japanese',
                'local' => '日本語'
            ],
            'hi' => [
                'code'  => 'hi',
                'english' => 'Hindi',
                'local' => 'हिंदी'
            ],
            'ur' => [
                'code'  => 'ur',
                'english' => 'Urdu',
                'local' => 'اردو'
            ],
            'co' => [
                'code'  => 'co',
                'english' => 'Corsican',
                'local' => 'Corsu'
            ],
            'fj' => [
                'code'  => 'fj',
                'english' => 'Fijian',
                'local' => 'Vosa Vakaviti'
            ],
            'hw' => [
                'code'  => 'hw',
                'english' => 'Hawaiian',
                'local' => '‘Ōlelo Hawai‘i'
            ],
            'ig' => [
                'code'  => 'ig',
                'english' => 'Igbo',
                'local' => 'Igbo'
            ],
            'ny' => [
                'code'  => 'ny',
                'english' => 'Chichewa',
                'local' => 'chiCheŵa'
            ],
            'ps' => [
                'code'  => 'ps',
                'english' => 'Pashto',
                'local' => 'پښت'
            ],
            'sd' => [
                'code'  => 'sd',
                'english' => 'Sindhi',
                'local' => 'سنڌي، سندھی, सिन्धी'
            ],
            'sn' => [
                'code'  => 'sn',
                'english' => 'Shona',
                'local' => 'chiShona'
            ],
            'to' => [
                'code'  => 'to',
                'english' => 'Tongan',
                'local' => 'faka-Tonga'
            ],
            'yo' => [
                'code'  => 'yo',
                'english' => 'Yoruba',
                'local' => 'Yorùbá'
            ],
            'zu' => [
                'code'  => 'zu',
                'english' => 'Zulu',
                'local' => 'isiZulu'
            ],
            'ty' => [
                'code'  => 'ty',
                'english' => 'Tahitian',
                'local' => 'te reo Tahiti, te reo Māʼohi'
            ],
            'sm' => [
                'code'  => 'sm',
                'english' => 'Samoan',
                'local' => 'gagana fa\'a Samoa'
            ],
            'ku' => [
                'code'  => 'ku',
                'english' => 'Kurdish',
                'local' => 'كوردی'
            ],
            'ha' => [
                'code'  => 'ha',
                'english' => 'Hausa',
                'local' => 'هَوُسَ'
            ],
            'bn' => [
                'code'  => 'bn',
                'english' => 'Bengali',
                'local' => 'বাংলা'
            ],
            'st' => [
                'code'  => 'st',
                'english' => 'Southern Sotho',
                'local' => 'seSotho'
            ],
            'ba' => [
                'code'  => 'ba',
                'english' => 'Bashkir',
                'local' => 'башҡорт теле'
            ],
            'jv' => [
                'code'  => 'jv',
                'english' => 'Javanese',
                'local' => 'Wong Jawa'
            ],
            'kn' => [
                'code'  => 'kn',
                'english' => 'Kannada',
                'local' => 'ಕನ್ನಡ'
            ],
            'la' => [
                'code'  => 'la',
                'english' => 'Latin',
                'local' => 'Latine'
            ],
            'lo' => [
                'code'  => 'lo',
                'english' => 'Lao',
                'local' => 'ພາສາລາວ'
            ],
            'mi' => [
                'code'  => 'mi',
                'english' => 'Māori',
                'local' => 'te reo Māori'
            ],
            'ml' => [
                'code'  => 'ml',
                'english' => 'Malayalam',
                'local' => 'മലയാളം'
            ],
            'mr' => [
                'code'  => 'mr',
                'english' => 'Marathi',
                'local' => 'मराठी'
            ],
            'ne' => [
                'code'  => 'ne',
                'english' => 'Nepali',
                'local' => 'नेपाली'
            ],
            'pa' => [
                'code'  => 'pa',
                'english' => 'Punjabi',
                'local' => 'ਪੰਜਾਬੀ'
            ],
            'so' => [
                'code'  => 'so',
                'english' => 'Somali',
                'local' => 'Soomaaliga'
            ],
            'su' => [
                'code'  => 'su',
                'english' => 'Sundanese',
                'local' => 'Sundanese'
            ],
            'te' => [
                'code'  => 'te',
                'english' => 'Telugu',
                'local' => 'తెలుగు'
            ],
            'yi' => [
                'code'  => 'yi',
                'english' => 'Yiddish',
                'local' => 'ייִדיש'
            ],
            'am' => [
                'code'  => 'am',
                'english' => 'Amharic',
                'local' => 'አማርኛ'
            ],
            'eo' => [
                'code'  => 'eo',
                'english' => 'Esperanto',
                'local' => 'Esperanto'
            ],
            'fy' => [
                'code'  => 'fy',
                'english' => 'Western Frisian',
                'local' => 'frysk'
            ],
            'gd' => [
                'code'  => 'gd',
                'english' => 'Scottish Gaelic',
                'local' => 'Gàidhlig'
            ],
            'gu' => [
                'code'  => 'gu',
                'english' => 'Gujarati',
                'local' => 'ગુજરાતી'
            ],
            'km' => [
                'code'  => 'km',
                'english' => 'Central Khmer',
                'local' => 'ភាសាខ្មែរ'
            ],
            'lb' => [
                'code'  => 'lb',
                'english' => 'Luxembourgish',
                'local' => 'Lëtzebuergesch'
            ],
            'my' => [
                'code'  => 'my',
                'english' => 'Burmese',
                'local' => 'မျန္မာစာ'
            ],
            'si' => [
                'code'  => 'si',
                'english' => 'Sinhalese',
                'local' => 'සිංහල'
            ],
            'ta' => [
                'code'  => 'ta',
                'english' => 'Tamil',
                'local' => 'தமிழ்'
            ],
            'xh' => [
                'code'  => 'xh',
                'english' => 'Xhosa',
                'local' => 'isiXhosa'
            ],
            'fl' => [
                'code'  => 'fl',
                'english' => 'Filipino',
                'local' => 'Pilipino'
            ]
        ];
    }
}
