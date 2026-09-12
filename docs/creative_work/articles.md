# Article, BlogPosting and TechArticle

These types are used for news articles, blog posts, technical documentation, and similar content.

## Article

```php
use Mitopp\SchemaOrgBundle\Config\SchemaOrgConfigurationInterface;
use Mitopp\SchemaOrgBundle\Type\Thing\CreativeWork\Article;
use Mitopp\SchemaOrgBundle\Type\Thing\Person;

/** @var SchemaOrgConfigurationInterface $configuration */
$article = new Article(
    type: 'Article',
    identifier: $configuration->createIdentifier('/blog/my-post#article'),
    name: 'The Future of PHP',
    url: '/blog/my-post',
    datePublished: '2024-03-20',
    dateModified: '2024-03-21',
    author: new Person($configuration->createIdentifier('/#author'), 'John Doe'),
    image: $configuration->createIdentifier('/images/php-future.jpg'),
);
$article->setProperty('articleBody', 'Long content here...');

$collector->add($article);
```

## BlogPosting

`BlogPosting` is a more specific type of `Article`.

```php
use Mitopp\SchemaOrgBundle\Type\Thing\CreativeWork\Article\SocialMediaPosting\BlogPosting;

/** @var SchemaOrgConfigurationInterface $configuration */
$post = new BlogPosting(
    identifier: $configuration->createIdentifier('/blog/my-post#post'),
    name: 'My First Blog Post',
    url: '/blog/my-post',
    datePublished: '2024-01-01',
);
$post->setProperty('wordCount', 500);

$collector->add($post);
```

## TechArticle

`TechArticle` is a specific type of `Article` for technical documentation, tutorials, or API references. It supports an optional `dependencies` property.

```php
use Mitopp\SchemaOrgBundle\Config\SchemaOrgConfigurationInterface;
use Mitopp\SchemaOrgBundle\Type\Thing\CreativeWork\Article\TechArticle;

/** @var SchemaOrgConfigurationInterface $configuration */
$techArticle = new TechArticle(
    identifier: $configuration->createIdentifier('/docs/installation#article'),
    name: 'Installation Guide',
    url: '/docs/installation',
    datePublished: '2024-01-01',
    dependencies: 'PHP >= 8.2, Composer',
);

$collector->add($techArticle);
```
