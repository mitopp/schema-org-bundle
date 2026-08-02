<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Tests\Unit\Type\Thing;

use Mitopp\SchemaOrgBundle\Type\Thing\Person;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Person::class)]
final class PersonTest extends TestCase
{
    public function testInitialization(): void
    {
        $person = new Person(
            name: 'John Doe',
            identifier: 'https://example.com/person/john',
            url: 'https://example.com/john'
        );

        $data = $person->toArray();

        $this->assertEquals('Person', $data['@type']);
        $this->assertEquals('https://example.com/person/john', $data['@id']);
        $this->assertEquals('John Doe', $data['name']);
        $this->assertEquals('https://example.com/john', $data['url']);
    }
}
