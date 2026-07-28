<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Tests\Unit\Type\Thing\Intangible\Rating;

use Mitopp\SchemaOrgBundle\Type\Thing\Intangible\Rating\AggregateRating;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(AggregateRating::class)]
final class AggregateRatingTest extends TestCase
{
    public function testInitialization(): void
    {
        $rating = new AggregateRating(
            ratingValue: 4.5,
            reviewCount: 10,
            bestRating: 5,
            worstRating: 1
        );

        $data = $rating->toArray();

        $this->assertEquals('AggregateRating', $data['@type']);
        $this->assertEquals(4.5, $data['ratingValue']);
        $this->assertEquals(10, $data['reviewCount']);
        $this->assertEquals(5, $data['bestRating']);
        $this->assertEquals(1, $data['worstRating']);
    }

    public function testDefaultRatings(): void
    {
        $rating = new AggregateRating(
            ratingValue: 4,
            reviewCount: 5
        );

        $data = $rating->toArray();

        $this->assertEquals(5, $data['bestRating']);
        $this->assertEquals(1, $data['worstRating']);
    }
}
