<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Tests\Unit\Type\Thing\CreativeWork\Article\SocialMediaPosting;

use Mitopp\SchemaOrgBundle\Type\Thing\CreativeWork\Article\SocialMediaPosting\BlogPosting;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(BlogPosting::class)]
final class BlogPostingTest extends TestCase
{
    public function testInitialization(): void
    {
        $posting = new BlogPosting(
            identifier: 'https://example.com/blog/1',
            name: 'Blog Post',
            url: 'https://example.com/blog/1',
            datePublished: '2023-01-01'
        );

        $data = $posting->toArray();

        $this->assertEquals('BlogPosting', $data['@type']);
        $this->assertEquals('https://example.com/blog/1', $data['@id']);
        $this->assertEquals('Blog Post', $data['name']);
    }
}
