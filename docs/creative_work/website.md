# WebSite

The `WebSite` type is often used to describe the entire site and provide site-wide search information.

## Usage

```php
use Mitopp\SchemaOrgBundle\Config\SchemaOrgConfigurationInterface;
use Mitopp\SchemaOrgBundle\Type\Thing\CreativeWork\WebSite;

/** @var SchemaOrgConfigurationInterface $configuration */
$website = new WebSite(
    identifier: $configuration->createIdentifier('#website'),
    url: $configuration->getBaseUrl(),
    name: 'My Awesome Site',
);

$website->setProperty('potentialAction', new \Mitopp\SchemaOrgBundle\Type\Thing\Action\SearchAction(
    urlTemplate: $configuration->getBaseUrl() . '/search?q={search_term_string}'
));

$collector->add($website);
```

For more details on search actions, see the [SearchAction documentation](../thing/action/search_action.md).
