<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Tests\Unit\Type\Thing\Intangible;

use Mitopp\SchemaOrgBundle\Type\Thing\Intangible\ListItem;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(ListItem::class)]
final class ListItemTest extends TestCase
{
    public function testInitialization(): void
    {
        $listItem = new ListItem(
            position: 1,
            name: 'Books',
            itemUrl: 'https://example.com/books'
        );

        $data = $listItem->toArray();

        $this->assertEquals('ListItem', $data['@type']);
        $this->assertEquals(1, $data['position']);
        $this->assertEquals('Books', $data['name']);
        $this->assertEquals('https://example.com/books', $data['item']);
    }
}
