<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Type\Thing\CreativeWork\HowTo;

use Mitopp\SchemaOrgBundle\Type\Contract\SchemaItemInterface;
use Mitopp\SchemaOrgBundle\Type\Thing\CreativeWork\Article;
use Mitopp\SchemaOrgBundle\Type\Thing\CreativeWork\Comment;
use Mitopp\SchemaOrgBundle\Type\Thing\CreativeWork\HowToStep;
use Mitopp\SchemaOrgBundle\Type\Thing\CreativeWork\Review;

/**
 * @see https://schema.org/Recipe
 */
final class Recipe extends Article
{
    /**
     * @param array<string> $recipeIngredient
     * @param array<int, string>|array<HowToStep> $recipeInstructions
     * @param array<Review> $reviews
     * @param array<Comment> $comments
     */
    public function __construct(
        string $identifier,
        string $name,
        string $url,
        string $datePublished,
        array $recipeIngredient,
        array $recipeInstructions,
        SchemaItemInterface|string $image,
        ?string $dateModified = null,
        SchemaItemInterface|string|null $author = null,
        SchemaItemInterface|string|null $publisher = null,
        ?string $description = null,
        ?string $inLanguage = null,
        SchemaItemInterface|string|null $isPartOf = null,
        ?string $prepTime = null,
        ?string $cookTime = null,
        ?string $totalTime = null,
        ?string $recipeYield = null,
        ?string $recipeCategory = null,
        ?string $recipeCuisine = null,
        SchemaItemInterface|string|null $aggregateRating = null,
        array $reviews = [],
        array $comments = [],
    ) {
        parent::__construct(
            type: 'Recipe',
            identifier: $identifier,
            name: $name,
            url: $url,
            datePublished: $datePublished,
            dateModified: $dateModified,
            author: $author,
            publisher: $publisher,
            image: $image,
            description: $description,
            inLanguage: $inLanguage,
            isPartOf: $isPartOf
        );

        $this->data['recipeIngredient'] = $recipeIngredient;
        $this->data['recipeInstructions'] = $recipeInstructions;

        if (null !== $prepTime) {
            $this->data['prepTime'] = $prepTime; // Format nach ISO 8601 (z.B. PT20M)
        }

        if (null !== $cookTime) {
            $this->data['cookTime'] = $cookTime; // Format nach ISO 8601 (z.B. PT1H)
        }

        if (null !== $totalTime) {
            $this->data['totalTime'] = $totalTime; // Format nach ISO 8601 (z.B. PT1H20M)
        }

        if (null !== $recipeYield) {
            $this->data['recipeYield'] = $recipeYield; // z.B. "4 Portionen"
        }

        if (null !== $recipeCategory) {
            $this->data['recipeCategory'] = $recipeCategory; // z.B. "Hauptspeise"
        }

        if (null !== $recipeCuisine) {
            $this->data['recipeCuisine'] = $recipeCuisine; // z.B. "Deutsch"
        }

        if (null !== $aggregateRating) {
            $this->data['aggregateRating'] = is_string($aggregateRating)
                ? ['@id' => $aggregateRating]
                : $aggregateRating;
        }

        if ([] !== $reviews) {
            $this->data['review'] = $reviews;
        }

        if ([] !== $comments) {
            $this->data['comment'] = $comments;
        }
    }
}
