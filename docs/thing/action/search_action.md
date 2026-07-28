# SearchAction

The `SearchAction` type is used to describe a search action, typically as part of a `WebSite` to enable Sitelinks Searchbox.

## Usage

```php
use Mitopp\SchemaOrgBundle\Type\Thing\Action\SearchAction;
use Mitopp\SchemaOrgBundle\Type\Thing\CreativeWork\WebSite;

$searchAction = new SearchAction(
    urlTemplate: 'https://example.com/search?q={search_term_string}',
    queryInput: 'required name=search_term_string' // optional, default value
);

$website = new WebSite(
    identifier: 'https://example.com/#website',
    url: 'https://example.com/',
    name: 'My Awesome Site'
);

$website->setProperty('potentialAction', $searchAction);

$collector->add($website);
```

## Reference
See [https://schema.org/SearchAction](https://schema.org/SearchAction) for more information.
