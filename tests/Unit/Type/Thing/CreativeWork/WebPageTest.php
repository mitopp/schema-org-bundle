<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Tests\Unit\Type\Thing\CreativeWork;

use Mitopp\SchemaOrgBundle\Type\Thing\CreativeWork\WebPage;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(WebPage::class)]
final class WebPageTest extends TestCase
{
    public function testInitialization(): void
    {
        $page = new WebPage(
            type: 'WebPage',
            identifier: 'https://example.com/page',
            name: 'Example Page',
            url: 'https://example.com/page',
            description: 'Description',
            inLanguage: 'en',
            publisher: 'https://example.com/org',
            isPartOf: 'https://example.com/website',
            breadcrumb: 'https://example.com/breadcrumb'
        );

        $data = $page->toArray();

        $this->assertEquals('WebPage', $data['@type']);
        $this->assertEquals('https://example.com/page', $data['@id']);
        $this->assertEquals('Example Page', $data['name']);
        $this->assertEquals('https://example.com/page', $data['url']);
        $this->assertEquals('Description', $data['description']);
        $this->assertEquals('en', $data['inLanguage']);
        $this->assertEquals(['@id' => 'https://example.com/org'], $data['publisher']);
        $this->assertEquals(['@id' => 'https://example.com/website'], $data['isPartOf']);
        $this->assertEquals(['@id' => 'https://example.com/breadcrumb'], $data['breadcrumb']);
    }
}
