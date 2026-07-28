# Person

The `Person` type represents an individual.

## Usage

```php
use Mitopp\SchemaOrgBundle\Config\SchemaOrgConfigurationInterface;
use Mitopp\SchemaOrgBundle\Type\Thing\Person;

/** @var SchemaOrgConfigurationInterface $configuration */
$person = new Person(
    identifier: $configuration->createIdentifier('/authors/jane-doe#person'),
    name: 'Jane Doe',
    url: $configuration->createIdentifier('/jane-doe'),
);
$person->setProperty('givenName', 'Jane')
    ->setProperty('familyName', 'Doe')
    ->setProperty('jobTitle', 'Food Blogger')
    ->setProperty('sameAs', [
        'https://twitter.com/janedoe',
        'https://github.com/janedoe'
    ]);

$collector->add($person);
```
