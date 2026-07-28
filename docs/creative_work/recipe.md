# Recipe

The `Recipe` type is used for cooking instructions.

## Usage

```php
use Mitopp\SchemaOrgBundle\Config\SchemaOrgConfigurationInterface;
use Mitopp\SchemaOrgBundle\Type\Thing\CreativeWork\HowTo\Recipe;

/** @var SchemaOrgConfigurationInterface $configuration */
use Mitopp\SchemaOrgBundle\Type\Thing\Intangible\Rating\AggregateRating;
use Mitopp\SchemaOrgBundle\Type\Thing\CreativeWork\Review;
use Mitopp\SchemaOrgBundle\Type\Thing\CreativeWork\Comment;
use Mitopp\SchemaOrgBundle\Type\Thing\Person;

$recipe = new Recipe(
    identifier: $configuration->createIdentifier('/recipes/pancakes#recipe'),
    name: 'Fluffy Pancakes',
    url: '/recipes/pancakes',
    datePublished: '2024-03-20',
    recipeIngredient: ['1 cup flour', '1 egg', '1 cup milk'],
    recipeInstructions: ['Mix ingredients', 'Cook on a griddle'],
    image: $configuration->createIdentifier('/images/pancakes.jpg'),
    description: 'The best pancakes you will ever taste.',
    prepTime: 'PT10M',
    cookTime: 'PT15M',
    aggregateRating: new AggregateRating(ratingValue: 4.8, reviewCount: 120),
    reviews: [
        new Review(
            datePublished: '2024-07-27',
            reviewBody: 'Amazing recipe!',
            ratingValue: 5,
            author: new Person($configuration->createIdentifier('/#jane'), 'Jane Doe')
        )
    ],
    comments: [
        new Comment(
            author: new Person($configuration->createIdentifier('/#john'), 'John Smith'),
            datePublished: '2024-07-26',
            text: 'Can I use almond milk?'
        )
    ]
);

$collector->add($recipe);
```
