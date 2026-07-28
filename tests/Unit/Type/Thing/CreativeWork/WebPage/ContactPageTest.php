<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Tests\Unit\Type\Thing\CreativeWork\WebPage;

use Mitopp\SchemaOrgBundle\Type\Thing\CreativeWork\WebPage\ContactPage;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(ContactPage::class)]
final class ContactPageTest extends TestCase
{
    public function testInitialization(): void
    {
        $page = new ContactPage(
            identifier: 'https://example.com/contact',
            name: 'Contact Name',
            url: 'https://example.com/contact',
            description: 'Contact Description'
        );

        $data = $page->toArray();

        $this->assertEquals('ContactPage', $data['@type']);
        $this->assertEquals('https://example.com/contact', $data['@id']);
        $this->assertEquals('Contact Name', $data['name']);
        $this->assertEquals('https://example.com/contact', $data['url']);
        $this->assertEquals('Contact Description', $data['description']);
    }
}
