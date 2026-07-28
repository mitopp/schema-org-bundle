# WebPages

Web pages can be described using `WebPage` or more specific types like `CollectionPage` and `ContactPage`.

## WebPage

```php
use Mitopp\SchemaOrgBundle\Config\SchemaOrgConfigurationInterface;
use Mitopp\SchemaOrgBundle\Type\Thing\CreativeWork\WebPage;

/** @var SchemaOrgConfigurationInterface $configuration */
$page = new WebPage(
    type: 'WebPage',
    identifier: $configuration->createIdentifier('/about#webpage'),
    name: 'About Us',
    url: '/about',
    description: 'Learn more about our company.',
);

$collector->add($page);
```

## CollectionPage

Used for pages that list multiple items, like a blog index or category page.

```php
use Mitopp\SchemaOrgBundle\Type\Thing\CreativeWork\WebPage\CollectionPage;

/** @var SchemaOrgConfigurationInterface $configuration */
$page = new CollectionPage(
    identifier: $configuration->createIdentifier('/blog#collectionpage'),
    name: 'Our Blog',
    url: '/blog',
    description: 'A list of all our blog posts.',
);

$collector->add($page);
```

## ContactPage

Specifically for contact pages.

```php
use Mitopp\SchemaOrgBundle\Type\Thing\CreativeWork\WebPage\ContactPage;

/** @var SchemaOrgConfigurationInterface $configuration */
$page = new ContactPage(
    identifier: $configuration->createIdentifier('/contact#contactpage'),
    name: 'Contact Us',
    url: '/contact',
    description: 'Get in touch with us.',
);

$collector->add($page);
```
