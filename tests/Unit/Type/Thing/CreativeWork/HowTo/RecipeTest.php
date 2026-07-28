<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Tests\Unit\Type\Thing\CreativeWork\HowTo;

use Mitopp\SchemaOrgBundle\Type\Thing\CreativeWork\Comment;
use Mitopp\SchemaOrgBundle\Type\Thing\CreativeWork\HowTo\Recipe;
use Mitopp\SchemaOrgBundle\Type\Thing\CreativeWork\HowToStep;
use Mitopp\SchemaOrgBundle\Type\Thing\CreativeWork\Review;
use Mitopp\SchemaOrgBundle\Type\Thing\Intangible\Rating\AggregateRating;
use Mitopp\SchemaOrgBundle\Type\Thing\Person;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Recipe::class)]
final class RecipeTest extends TestCase
{
    public function testInitialization(): void
    {
        $step = new HowToStep('Boil water');
        $author = new Person('https://example.com/p1', 'Author', 'https://example.com/a');
        $rating = new AggregateRating(4.5, 10);
        $review = new Review('2024-01-01', 'Great', 5, 'https://example.com/p1');
        $comment = new Comment('https://example.com/p1', '2024-01-01', 'Nice');

        $recipe = new Recipe(
            identifier: 'https://example.com/recipe',
            name: 'Pasta Carbonara',
            url: 'https://example.com/recipe',
            datePublished: '2023-01-01',
            recipeIngredient: ['Pasta', 'Eggs', 'Bacon'],
            recipeInstructions: [$step],
            image: 'dvfdfvdf',
            prepTime: 'PT10M',
            cookTime: 'PT15M',
            totalTime: 'PT25M',
            recipeYield: '2 persons',
            recipeCategory: 'Main course',
            recipeCuisine: 'Italian',
            aggregateRating: $rating,
            reviews: [$review],
            comments: [$comment]
        );

        $data = $recipe->toArray();

        $this->assertEquals('Recipe', $data['@type']);
        $this->assertEquals(['Pasta', 'Eggs', 'Bacon'], $data['recipeIngredient']);
        $this->assertEquals([$step->toArray()], $data['recipeInstructions']);
        $this->assertEquals('PT10M', $data['prepTime']);
        $this->assertEquals('PT15M', $data['cookTime']);
        $this->assertEquals('PT25M', $data['totalTime']);
        $this->assertEquals('2 persons', $data['recipeYield']);
        $this->assertEquals('Main course', $data['recipeCategory']);
        $this->assertEquals('Italian', $data['recipeCuisine']);
        $this->assertEquals($rating->toArray(), $data['aggregateRating']);
        $this->assertEquals([$review->toArray()], $data['review']);
        $this->assertEquals([$comment->toArray()], $data['comment']);
    }

    public function testInitializationWithRatingId(): void
    {
        $recipe = new Recipe(
            identifier: 'https://example.com/recipe',
            name: 'Pasta Carbonara',
            url: 'https://example.com/recipe',
            datePublished: '2023-01-01',
            recipeIngredient: ['Pasta'],
            recipeInstructions: ['Step 1'],
            image: 'img.jpg',
            aggregateRating: 'https://example.com/rating/1'
        );

        $data = $recipe->toArray();
        $this->assertEquals(['@id' => 'https://example.com/rating/1'], $data['aggregateRating']);
    }
}
