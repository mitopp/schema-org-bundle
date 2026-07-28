# Reviews and Ratings

This section covers `Review`, `AggregateRating`, and `Comment`.

## AggregateRating

Used to represent the average rating of an item.

```php
use Mitopp\SchemaOrgBundle\Type\Thing\Intangible\Rating\AggregateRating;

$rating = new AggregateRating(
    ratingValue: 4.5,
    reviewCount: 10,
    bestRating: 5,  // optional, default 5
    worstRating: 1  // optional, default 1
);
```

## Review

Represents a single review.

```php
use Mitopp\SchemaOrgBundle\Type\Thing\CreativeWork\Review;

$review = new Review(
    datePublished: '2024-01-01',
    reviewBody: 'Excellent product!',
    ratingValue: 5,
    author: 'Jane Doe', // Can be a string (Author name) or a Person object
    identifier: 'https://example.com/review/1' // optional
);
```

## Comment

Represents a comment, for example on a blog post or recipe.

```php
use Mitopp\SchemaOrgBundle\Type\Thing\CreativeWork\Comment;

$comment = new Comment(
    author: 'John Doe', // Can be a string (Author name) or a Person object
    datePublished: '2024-01-01',
    text: 'Very helpful, thanks!'
);
```
