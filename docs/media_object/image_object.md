# ImageObject

The `ImageObject` type is used to describe an image file, often used as a property of other types like `Article` or `Recipe`.

## Usage

```php
use Mitopp\SchemaOrgBundle\Config\SchemaOrgConfigurationInterface;
use Mitopp\SchemaOrgBundle\Type\Thing\CreativeWork\MediaObject\ImageObject;

/** @var SchemaOrgConfigurationInterface $configuration */
$image = new ImageObject(
    identifier: $configuration->createIdentifier('/images/pancakes.jpg'),
    url: $configuration->createIdentifier('/images/pancakes.jpg'),
);
$image->setProperty('width', 800)
    ->setProperty('height', 600)
    ->setProperty('caption', 'A delicious plate of fluffy pancakes.');

$collector->add($image);
```

### Usage as a property

Many types accept an `ImageObject` or a simple string URL for their `image` property.

```php
use Mitopp\SchemaOrgBundle\Type\Thing\CreativeWork\Article;

$article = new Article(
    type: 'Article',
    identifier: 'https://example.com/blog/my-post#article',
    name: 'The Future of PHP',
    url: 'https://example.com/blog/my-post',
    datePublished: '2024-03-20',
    image: $image, // Passing the ImageObject instance
);
```
