<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Tests\Unit\Type\Thing\CreativeWork\MediaObject;

use Mitopp\SchemaOrgBundle\Type\Thing\CreativeWork\MediaObject\ImageObject;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(ImageObject::class)]
final class ImageObjectTest extends TestCase
{
    public function testInitialization(): void
    {
        $image = new ImageObject(
            identifier: 'https://example.com/image.jpg',
            url: 'https://example.com/image.jpg'
        );

        $data = $image->toArray();

        $this->assertEquals('ImageObject', $data['@type']);
        $this->assertEquals('https://example.com/image.jpg', $data['@id']);
        $this->assertEquals('https://example.com/image.jpg', $data['url']);
    }
}
