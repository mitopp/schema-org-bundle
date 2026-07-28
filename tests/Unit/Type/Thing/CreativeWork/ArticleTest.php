<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Tests\Unit\Type\Thing\CreativeWork;

use Mitopp\SchemaOrgBundle\Type\Thing\CreativeWork\Article;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Article::class)]
final class ArticleTest extends TestCase
{
    public function testInitialization(): void
    {
        $article = new Article(
            type: 'Article',
            identifier: 'https://example.com/article',
            name: 'Test Article',
            url: 'https://example.com/article',
            datePublished: '2023-01-01',
            dateModified: '2023-01-02',
            author: 'https://example.com/author',
            publisher: 'https://example.com/publisher',
            image: 'https://example.com/image.jpg',
            description: 'Test Description',
            inLanguage: 'en',
            isPartOf: 'https://example.com/website'
        );

        $data = $article->toArray();

        $this->assertEquals('Article', $data['@type']);
        $this->assertEquals('https://example.com/article', $data['@id']);
        $this->assertEquals('Test Article', $data['name']);
        $this->assertEquals('https://example.com/article', $data['url']);
        $this->assertEquals('2023-01-01', $data['datePublished']);
        $this->assertEquals('2023-01-02', $data['dateModified']);
        $this->assertEquals(['@id' => 'https://example.com/author'], $data['author']);
        $this->assertEquals(['@id' => 'https://example.com/publisher'], $data['publisher']);
        $this->assertEquals(['@id' => 'https://example.com/image.jpg'], $data['image']);
        $this->assertEquals('Test Description', $data['description']);
        $this->assertEquals('en', $data['inLanguage']);
        $this->assertEquals(['@id' => 'https://example.com/website'], $data['isPartOf']);
    }
}
