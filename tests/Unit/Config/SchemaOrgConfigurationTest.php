<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Tests\Unit\Config;

use Mitopp\SchemaOrgBundle\Config\SchemaOrgConfiguration;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

#[CoversClass(SchemaOrgConfiguration::class)]
final class SchemaOrgConfigurationTest extends TestCase
{
    public function testGetBaseUrlFromRequest(): void
    {
        $request = Request::create('https://example.com/foo');
        $requestStack = new RequestStack();
        $requestStack->push($request);

        $parameterBag = new ParameterBag([
            'mitopp_schema_org.id_prefix' => null,
            'mitopp_schema_org.default_locale' => 'de',
        ]);

        $config = new SchemaOrgConfiguration($parameterBag, $requestStack);

        $this->assertEquals('https://example.com', $config->getBaseUrl());
    }

    public function testGetBaseUrlEmptyWithoutRequest(): void
    {
        $requestStack = new RequestStack();
        $parameterBag = new ParameterBag([
            'mitopp_schema_org.id_prefix' => null,
            'mitopp_schema_org.default_locale' => 'de',
        ]);

        $config = new SchemaOrgConfiguration($parameterBag, $requestStack);

        $this->assertEquals('', $config->getBaseUrl());
    }

    public function testGetIdPrefixFromParameter(): void
    {
        $requestStack = new RequestStack();
        $parameterBag = new ParameterBag([
            'mitopp_schema_org.id_prefix' => 'https://custom.com',
            'mitopp_schema_org.default_locale' => 'de',
        ]);

        $config = new SchemaOrgConfiguration($parameterBag, $requestStack);

        $this->assertEquals('https://custom.com', $config->getIdPrefix());
    }

    public function testGetIdPrefixFallsBackToBaseUrl(): void
    {
        $request = Request::create('https://example.com');
        $requestStack = new RequestStack();
        $requestStack->push($request);

        $parameterBag = new ParameterBag([
            'mitopp_schema_org.id_prefix' => null,
            'mitopp_schema_org.default_locale' => 'de',
        ]);

        $config = new SchemaOrgConfiguration($parameterBag, $requestStack);

        $this->assertEquals('https://example.com', $config->getIdPrefix());
    }

    public function testGetLocale(): void
    {
        $requestStack = new RequestStack();
        $parameterBag = new ParameterBag([
            'mitopp_schema_org.id_prefix' => null,
            'mitopp_schema_org.default_locale' => 'fr',
        ]);

        $config = new SchemaOrgConfiguration($parameterBag, $requestStack);

        $this->assertEquals('fr', $config->getLocale());
    }

    public function testCreateIdentifier(): void
    {
        $requestStack = new RequestStack();
        $parameterBag = new ParameterBag([
            'mitopp_schema_org.id_prefix' => 'https://example.com/',
            'mitopp_schema_org.default_locale' => 'en',
        ]);

        $config = new SchemaOrgConfiguration($parameterBag, $requestStack);

        $this->assertEquals('https://example.com/recipe/1', $config->createIdentifier('/recipe/1'));
        $this->assertEquals('https://example.com/recipe/1', $config->createIdentifier('recipe/1'));
    }
}
