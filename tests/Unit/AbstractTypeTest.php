<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Tests\Unit;

use Mitopp\SchemaOrgBundle\Type\AbstractType;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(AbstractType::class)]
final class AbstractTypeTest extends TestCase
{
    public function testToArrayHandlesIdentifiersCorrectly(): void
    {
        $type = new class ('TestType', '0') extends AbstractType {
        };

        $data = $type->toArray();
        $this->assertEquals('0', $data['@id'], 'ID "0" should be preserved');

        $typeEmpty = new class ('TestType', '') extends AbstractType {
        };
        $dataEmpty = $typeEmpty->toArray();
        $this->assertEquals('', $dataEmpty['@id'], 'Empty ID should be preserved in root');
    }

    public function testToArrayResolvesNestedObjectsByIdentifier(): void
    {
        $child = new class ('ChildType', 'child-id') extends AbstractType {
        };

        $parent = new class ('ParentType', 'parent-id') extends AbstractType {
        };
        $parent->setProperty('child', $child);

        $data = $parent->toArray();
        $this->assertEquals(['@id' => 'child-id'], $data['child'], 'Nested object with ID should be resolved to @id reference');
    }

    public function testToArrayResolvesNestedObjectsWithoutIdentifier(): void
    {
        $child = new class ('ChildType', '') extends AbstractType {
        };
        $child->setProperty('foo', 'bar');

        $parent = new class ('ParentType', 'parent-id') extends AbstractType {
        };
        $parent->setProperty('child', $child);

        $data = $parent->toArray();
        $this->assertEquals([
            '@type' => 'ChildType',
            '@id' => '',
            'foo' => 'bar',
        ], $data['child'], 'Nested object without ID should be fully serialized');
    }
}
