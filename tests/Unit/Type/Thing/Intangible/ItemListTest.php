<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Tests\Unit\Type\Thing\Intangible;

use Mitopp\SchemaOrgBundle\Type\Thing\Intangible\ItemList;
use Mitopp\SchemaOrgBundle\Type\Thing\Intangible\ListItem;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(ItemList::class)]
final class ItemListTest extends TestCase
{
    public function testInitialization(): void
    {
        $listItem1 = new ListItem(1, 'Item 1', 'https://example.com/item1');
        $listItem2 = new ListItem(2, 'Item 2', 'https://example.com/item2');

        $itemList = new ItemList(
            itemListElement: [$listItem1, $listItem2],
            identifier: 'https://example.com/#itemlist',
            name: 'Top Items',
            description: 'A list of top items',
            itemListOrder: 'https://schema.org/ItemListOrderAscending',
            numberOfItems: 2,
            url: 'https://example.com/items',
        );

        $data = $itemList->toArray();

        $this->assertEquals('ItemList', $data['@type']);
        $this->assertEquals('https://example.com/#itemlist', $data['@id']);
        $this->assertEquals('Top Items', $data['name']);
        $this->assertEquals('A list of top items', $data['description']);
        $this->assertEquals('https://schema.org/ItemListOrderAscending', $data['itemListOrder']);
        $this->assertEquals(2, $data['numberOfItems']);
        $this->assertEquals('https://example.com/items', $data['url']);
        $this->assertCount(2, $data['itemListElement']);
        $this->assertEquals('ListItem', $data['itemListElement'][0]['@type']);
        $this->assertEquals('Item 1', $data['itemListElement'][0]['name']);
        $this->assertEquals('ListItem', $data['itemListElement'][1]['@type']);
        $this->assertEquals('Item 2', $data['itemListElement'][1]['name']);
    }

    public function testInitializationWithDefaults(): void
    {
        $itemList = new ItemList();

        $data = $itemList->toArray();

        $this->assertEquals('ItemList', $data['@type']);
        $this->assertArrayNotHasKey('@id', $data);
        $this->assertArrayNotHasKey('itemListElement', $data);
        $this->assertArrayNotHasKey('name', $data);
        $this->assertArrayNotHasKey('description', $data);
        $this->assertArrayNotHasKey('itemListOrder', $data);
        $this->assertArrayNotHasKey('numberOfItems', $data);
        $this->assertArrayNotHasKey('url', $data);
    }

    public function testInitializationWithCustomType(): void
    {
        $itemList = new ItemList(type: 'CustomList');

        $data = $itemList->toArray();

        $this->assertEquals('CustomList', $data['@type']);
    }
}
