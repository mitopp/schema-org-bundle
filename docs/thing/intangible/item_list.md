# ItemList

The `ItemList` type represents a list of items of any sort (e.g. ordered, unordered, or numbered).

## Basic Usage

```php
use Mitopp\SchemaOrgBundle\Type\Thing\Intangible\ItemList;
use Mitopp\SchemaOrgBundle\Type\Thing\Intangible\ListItem;

$listItem1 = new ListItem(1, 'Item 1', 'https://example.com/item1');
$listItem2 = new ListItem(2, 'Item 2', 'https://example.com/item2');

$itemList = new ItemList(
    itemListElement: [$listItem1, $listItem2],
    identifier: 'https://example.com/#itemlist',
    name: 'Top Items',
    description: 'A list of top items',
    itemListOrder: 'https://schema.org/ItemListOrderAscending',
    numberOfItems: 2,
    url: 'https://example.com/items'
);
```

### JSON-LD Output

```json
{
  "@context": "https://schema.org",
  "@type": "ItemList",
  "@id": "https://example.com/#itemlist",
  "name": "Top Items",
  "description": "A list of top items",
  "itemListOrder": "https://schema.org/ItemListOrderAscending",
  "numberOfItems": 2,
  "url": "https://example.com/items",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "name": "Item 1",
      "item": "https://example.com/item1"
    },
    {
      "@type": "ListItem",
      "position": 2,
      "name": "Item 2",
      "item": "https://example.com/item2"
    }
  ]
}
```
