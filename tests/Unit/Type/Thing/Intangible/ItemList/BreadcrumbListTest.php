<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Tests\Unit\Type\Thing\Intangible\ItemList;

use Mitopp\SchemaOrgBundle\Type\Thing\Intangible\ItemList\BreadcrumbList;
use Mitopp\SchemaOrgBundle\Type\Thing\Intangible\ListItem;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(BreadcrumbList::class)]
final class BreadcrumbListTest extends TestCase
{
    public function testInitialization(): void
    {
        $listItem1 = new ListItem(1, 'Home', 'https://example.com/');
        $listItem2 = new ListItem(2, 'Books', 'https://example.com/books');

        $breadcrumbList = new BreadcrumbList(
            itemListElement: [$listItem1, $listItem2],
            identifier: 'https://example.com/#breadcrumb'
        );

        $data = $breadcrumbList->toArray();

        $this->assertEquals('BreadcrumbList', $data['@type']);
        $this->assertEquals('https://example.com/#breadcrumb', $data['@id']);
        $this->assertCount(2, $data['itemListElement']);
        $this->assertEquals('ListItem', $data['itemListElement'][0]['@type']);
        $this->assertEquals('Home', $data['itemListElement'][0]['name']);
        $this->assertEquals('ListItem', $data['itemListElement'][1]['@type']);
        $this->assertEquals('Books', $data['itemListElement'][1]['name']);
    }
}
