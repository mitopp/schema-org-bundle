# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Remove 

- Remove `composer.lock` from the code base.

## 0.3.0 - 2026-08-02

### Changed

- Make `identifier` optional in `Person` and update tests accordingly.

## 0.2.0 - 2026-07-29

### Added

- Added optional `nonce` attribute support to `JsonLdRenderer` and `render_schema_org` Twig function for Content Security Policy (CSP) compliance.

### Changed

- [BC] Renamed `SchemaGraphCollectorInterface` to `SchemaOrgGraphCollectorInterface`
- [BC] Renamed `SchemaGraphCollector` to `SchemaOrgGraphCollector`
- [BC] Renamed `SchemaExtension` to `SchemaOrgExtension`.

## 0.1.0 - 2026-07-28

### Added
- Added unit tests and documentation for `ListItem` and `BreadcrumbList`.
- Added unit test for `SearchAction`.
- Added documentation for `SearchAction`.
- Added unit tests for `AggregateRating`, `Comment`, and `Review` types.
- Added unit tests for `SchemaOrgConfiguration`.
- Extended `RecipeTest` to cover `aggregateRating`, `reviews`, and `comments`.
- Updated `README.md` and `docs/` with examples and information about new types and configuration options.
- Added comprehensive example documentation in English for all supported Schema.org types in the `docs/` folder.
- Extended CI matrix to test `lowest` dependencies for all supported Symfony versions (6.4, 7.4, 8.0, 8.1).
- Translated README.md to English and added a list of supported Schema.org types.
- Comprehensive README.md with examples for Controller, Listener, and Twig usage.
- Integration tests for bundle configuration and service registration.
- Explicit default values in bundle configuration to avoid warnings when config is missing.
- Added GitHub Dependabot configuration.
- Add GitHub actions.
- Initialize bundle.
- Added comprehensive unit tests for all Schema.org types, `SchemaOrgGraphCollector`, and `JsonLdRenderer`.

### Changed
- Corrected documentation and README.md examples to match actual class implementations (constructor initialization instead of non-existent fluent methods).
- Updated README.md and documentation examples to use `SchemaOrgConfigurationInterface` for identifier and URL generation.
- Refactored `WebPage`, `CollectionPage` and `ContactPage` to use the same extension pattern as `Article` and `BlogPosting`.
- Updated `HowToStep` to correctly pass the identifier to the parent constructor, fixing a PHPStan error.
- Updated `composer.json` to officially support Symfony 8.0 and 8.1.
- Made builder service public in the test container for easier testing.
- Updated `TestKernel` to allow extension in tests.

### Fixed
- Fixed `SchemaOrgConfigurationTest` to be compatible with newer `symfony/http-foundation` versions where `RequestStack` cannot be initialized with an array in the constructor anymore.
- Corrected `HowToStepTest` to match the expected JSON-LD structure for images and added tests for the identifier.
- Correct configuration for PHP-CS-Fixer.
- Fixed PHPStan false positives in `MitoppSchemaOrgBundle` when running with older Symfony versions (lowest dependencies).
- Fixed typos in README.
