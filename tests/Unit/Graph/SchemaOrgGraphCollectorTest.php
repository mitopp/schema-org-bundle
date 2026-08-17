<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Tests\Unit\Graph;

use Mitopp\SchemaOrgBundle\Graph\SchemaOrgGraphCollector;
use Mitopp\SchemaOrgBundle\Type\Contract\SchemaItemInterface;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(SchemaOrgGraphCollector::class)]
final class SchemaOrgGraphCollectorTest extends TestCase
{
    public function testAddAndGetItems(): void
    {
        $collector = new SchemaOrgGraphCollector();
        $this->assertEmpty($collector->getItems());

        $item1 = $this->createStub(SchemaItemInterface::class);
        $item2 = $this->createStub(SchemaItemInterface::class);

        $collector->add($item1);
        $collector->add($item2);

        $this->assertCount(2, $collector->getItems());
        $this->assertSame($item1, $collector->getItems()[0]);
        $this->assertSame($item2, $collector->getItems()[1]);
    }
}
