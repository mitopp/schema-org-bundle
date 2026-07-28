# HowToStep

`HowToStep` is used within `HowTo` or `Recipe` to describe a single step in a process.

## Usage

```php
use Mitopp\SchemaOrgBundle\Type\Thing\CreativeWork\HowToStep;

$step = new HowToStep(
    text: 'Boil 1 liter of water in a large pot.',
    name: 'Boil water',
    url: 'https://example.com/how-to#step-1',
    image: 'https://example.com/images/boiling-water.jpg'
);

$collector->add($step);
```
