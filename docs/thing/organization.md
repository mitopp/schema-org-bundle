# Organization

The `Organization` type represents a company, school, club, etc.

## Usage

```php
use Mitopp\SchemaOrgBundle\Config\SchemaOrgConfigurationInterface;
use Mitopp\SchemaOrgBundle\Type\Thing\Organization;

/** @var SchemaOrgConfigurationInterface $configuration */
$org = new Organization(
    identifier: $configuration->createIdentifier('#org'),
    name: 'Acme Corp',
    url: $configuration->getBaseUrl(),
    logo: $configuration->createIdentifier('/logo.png'),
);
$org->setProperty('email', 'info@example.com');

$collector->add($org);
```
