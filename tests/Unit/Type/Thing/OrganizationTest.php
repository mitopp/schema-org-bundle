<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Tests\Unit\Type\Thing;

use Mitopp\SchemaOrgBundle\Type\Thing\Organization;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Organization::class)]
final class OrganizationTest extends TestCase
{
    public function testInitialization(): void
    {
        $org = new Organization(
            identifier: 'https://example.com/org',
            name: 'Example Org',
            url: 'https://example.com',
            logo: 'https://example.com/logo.png'
        );

        $data = $org->toArray();

        $this->assertEquals('Organization', $data['@type']);
        $this->assertEquals('https://example.com/org', $data['@id']);
        $this->assertEquals('Example Org', $data['name']);
        $this->assertEquals('https://example.com', $data['url']);
        $this->assertEquals(['@id' => 'https://example.com/logo.png'], $data['logo']);
    }
}
