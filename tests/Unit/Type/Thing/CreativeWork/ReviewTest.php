<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Tests\Unit\Type\Thing\CreativeWork;

use Mitopp\SchemaOrgBundle\Type\Thing\CreativeWork\Review;
use Mitopp\SchemaOrgBundle\Type\Thing\Person;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Review::class)]
final class ReviewTest extends TestCase
{
    public function testInitialization(): void
    {
        $author = new Person('https://example.com/p1', 'Author', 'https://example.com/a');
        $review = new Review(
            datePublished: '2024-01-01',
            reviewBody: 'Excellent!',
            ratingValue: 5,
            author: $author,
            identifier: 'https://example.com/review/1'
        );

        $data = $review->toArray();

        $this->assertEquals('Review', $data['@type']);
        $this->assertEquals('https://example.com/review/1', $data['@id']);
        $this->assertEquals('2024-01-01', $data['datePublished']);
        $this->assertEquals('Excellent!', $data['reviewBody']);
        $this->assertEquals(['@id' => 'https://example.com/p1'], $data['author']);
        $this->assertEquals([
            '@type' => 'Rating',
            'ratingValue' => 5,
        ], $data['reviewRating']);
    }

    public function testInitializationWithAuthorId(): void
    {
        $review = new Review(
            datePublished: '2024-01-01',
            reviewBody: 'Excellent!',
            ratingValue: 5,
            author: 'https://example.com/p1'
        );

        $data = $review->toArray();

        $this->assertEquals(['@id' => 'https://example.com/p1'], $data['author']);
    }
}
