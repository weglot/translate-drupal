<!-- logo -->
<img src="https://cdn.weglot.com/logo/logo-hor.png" height="40" />

# PHP library

<!-- tags -->
[![Latest Stable Version](https://poser.pugx.org/weglot/weglot-php/v/stable)](https://packagist.org/packages/weglot/weglot-php)
[![BuildStatus](https://travis-ci.org/weglot/weglot-php.svg?branch=develop)](https://travis-ci.org/weglot/weglot-php)
[![Code Climate](https://codeclimate.com/github/weglot/weglot-php/badges/gpa.svg)](https://codeclimate.com/github/weglot/weglot-php)
[![License](https://poser.pugx.org/weglot/weglot-php/license)](https://packagist.org/packages/weglot/weglot-php)

## Overview
This library allows you to quickly and easily use the Weglot API via PHP. It handle all communication with Weglot API and gives you a [fully functional Parser](#getting-started) to handle HTML pages easily.

## Requirements
- PHP version 5.5 and later
- Weglot API Key, starting at [free level](https://dashboard.weglot.com/register)

## Installation
You can install the library via [Composer](https://getcomposer.org/). Run the following command:

```bash
composer require weglot/weglot-php
```

To use the library, use Composer's [autoload](https://getcomposer.org/doc/01-basic-usage.md#autoloading):

```php
require_once __DIR__. '/vendor/autoload.php';
```

## Getting Started

Simple usage of `Parser`:

```php
// Url to parse
$url = 'https://foo.bar/baz';

// Config with $_SERVER variables
$config = new ServerConfigProvider();

// Fetching url content
$content = '...';

// Client
$client = new Client(getenv('WG_API_KEY'));
$parser = new Parser($client, $config);

// Run the Parser
$translatedContent = $parser->translate($content, 'en', 'de');
```

For more details, check at [corresponding example](./examples/parsing-web-page/run.php) or at [documentation](https://weglot.github.io/weglot-documentation/#parser).

## Examples

For more usage examples, such as: other endpoints, caching, parsing.

You can take a look at: [examples](./examples) folder. You'll find a short README with details about each example.

## Documentation

You can find a documentation for our libraries at: https://weglot.github.io/weglot-documentation/

## About
`weglot-php` is guided and supported by the Weglot Developer Team.

`weglot-php` is maintained and funded by Weglot SAS. 
The names and logos for `weglot-php` are trademarks of Weglot SAS.

## License
[The MIT License (MIT)](LICENSE.txt)
