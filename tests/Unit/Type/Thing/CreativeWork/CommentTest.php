<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Tests\Unit\Type\Thing\CreativeWork;

use Mitopp\SchemaOrgBundle\Type\Thing\CreativeWork\Comment;
use Mitopp\SchemaOrgBundle\Type\Thing\Person;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Comment::class)]
final class CommentTest extends TestCase
{
    public function testInitializationWithAuthorObject(): void
    {
        $author = new Person('https://example.com/p1', 'Author', 'https://example.com/a');
        $comment = new Comment(
            author: $author,
            datePublished: '2024-01-01',
            text: 'Nice recipe!'
        );

        $data = $comment->toArray();

        $this->assertEquals('Comment', $data['@type']);
        $this->assertEquals(['@id' => 'https://example.com/p1'], $data['author']);
        $this->assertEquals('2024-01-01', $data['datePublished']);
        $this->assertEquals('Nice recipe!', $data['text']);
    }

    public function testInitializationWithAuthorId(): void
    {
        $comment = new Comment(
            author: 'https://example.com/p1',
            datePublished: '2024-01-01',
            text: 'Nice recipe!'
        );

        $data = $comment->toArray();

        $this->assertEquals(['@id' => 'https://example.com/p1'], $data['author']);
    }
}
