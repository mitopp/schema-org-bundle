<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Tests\Unit\Type\Thing\CreativeWork\WebPage;

use Mitopp\SchemaOrgBundle\Type\Thing\CreativeWork\WebPage\CollectionPage;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(CollectionPage::class)]
final class CollectionPageTest extends TestCase
{
    public function testInitialization(): void
    {
        $page = new CollectionPage(
            identifier: 'https://example.com/collection',
            name: 'Collection Name',
            url: 'https://example.com/collection',
            description: 'Collection Description'
        );

        $data = $page->toArray();

        $this->assertEquals('CollectionPage', $data['@type']);
        $this->assertEquals('https://example.com/collection', $data['@id']);
        $this->assertEquals('Collection Name', $data['name']);
        $this->assertEquals('https://example.com/collection', $data['url']);
        $this->assertEquals('Collection Description', $data['description']);
    }
}
