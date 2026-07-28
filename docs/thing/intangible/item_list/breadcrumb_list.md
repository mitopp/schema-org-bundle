# BreadcrumbList

The `BreadcrumbList` type represents a chain of linked web pages, typically terminating with the current page.

## Usage

```php
use Mitopp\SchemaOrgBundle\Config\SchemaOrgConfigurationInterface;
use Mitopp\SchemaOrgBundle\Type\Thing\Intangible\ItemList\BreadcrumbList;
use Mitopp\SchemaOrgBundle\Type\Thing\Intangible\ListItem;

/** @var SchemaOrgConfigurationInterface $configuration */
$breadcrumbList = new BreadcrumbList(
    itemListElement: [
        new ListItem(1, 'Home', 'https://example.com/'),
        new ListItem(2, 'Books', 'https://example.com/books'),
        new ListItem(3, 'Authors', 'https://example.com/books/authors'),
    ],
    identifier: $configuration->createIdentifier('/books/authors#breadcrumb')
);

$collector->add($breadcrumbList);
```
