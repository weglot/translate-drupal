# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [0.2] - 2018-04-26
### Added
- Util to fetch Site contents through `Site::get`
- cURL & OpenSSL versions inside user-agent for debugging purposes

### Changed
- Parser: excludeBlocks formatter is started only if we have excludeBlocks
- Parser: adding DomCheckerProvider to Parser. Like that people can add their own Checkers
- README: updated getting started to use Parser example, and adding documentation
- Caching: Improving granularity, we use cache on Endpoints to be able to cache words by words and not the full request
- Travis-CI: PHP 5.5 is no more in failures but don't run all caching tests
- CodeClimate: improving maintainability

## [0.1.2] - 2018-04-19
### Fixed
- \#7 : Parser - dynamic tooltip hover a link

## [0.1.1] - 2018-04-18
### Fixed
- ServerConfigProvider behavior changed: we do not load $_SERVER in __construct, it can disturb symfony service loading

## [0.1] - 2018-04-16
### Added
- CodeClimate configuration
- Travis configuration
- Manage API versions (through Profile class)
- Error abstraction
- Unit testing

### Changed
- Refactoring for `Parser`
- Languages endpoint: now giving full list

## [0.1-beta.2] - 2018-04-12
### Added
- examples & descriptions:
  - cached-client-translate
  - parsing-web-page
  - simple-client-languages
  - simple-client-status
  - simple-client-translate
- adding README, LICENCE, CODE_OF_CONDUCT, CONTRIBUTING and github templates

## [0.1-beta.1] - 2018-04-11
### Added
- first Client version
- first endpoints:
  - Translate Endpoint
  - Status Endpoint
  - Languages Endpoint
- client Caching through PSR-6
- importing old Parser with some refactoring
