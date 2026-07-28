# ListItem

The `ListItem` type represents an item in a list. It is commonly used within `BreadcrumbList`.

## Usage

```php
use Mitopp\SchemaOrgBundle\Type\Thing\Intangible\ListItem;

$listItem = new ListItem(
    position: 1,
    name: 'Books',
    itemUrl: 'https://example.com/books'
);

$collector->add($listItem);
```
