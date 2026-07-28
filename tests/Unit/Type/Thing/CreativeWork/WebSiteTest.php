<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Tests\Unit\Type\Thing\CreativeWork;

use Mitopp\SchemaOrgBundle\Type\Thing\CreativeWork\WebSite;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(WebSite::class)]
final class WebSiteTest extends TestCase
{
    public function testInitialization(): void
    {
        $site = new WebSite(
            identifier: 'https://example.com/#website',
            url: 'https://example.com/',
            name: 'Example Website',
            description: 'A great website',
            inLanguage: 'en',
            publisher: 'https://example.com/#org',
            potentialAction: 'https://example.com/search'
        );

        $data = $site->toArray();

        $this->assertEquals('WebSite', $data['@type']);
        $this->assertEquals('https://example.com/#website', $data['@id']);
        $this->assertEquals('https://example.com/', $data['url']);
        $this->assertEquals('Example Website', $data['name']);
        $this->assertEquals('A great website', $data['description']);
        $this->assertEquals('en', $data['inLanguage']);
        $this->assertEquals(['@id' => 'https://example.com/#org'], $data['publisher']);
        $this->assertEquals(['@id' => 'https://example.com/search'], $data['potentialAction']);
    }
}
