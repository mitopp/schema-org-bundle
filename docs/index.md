# Schema.org Types Documentation

This section provides examples and documentation for the Schema.org types supported by this bundle.

## Available Types

### Creative Works
- [Article, BlogPosting & TechArticle](creative_work/articles.md)
- [Recipe](creative_work/recipe.md)
- [WebPage, CollectionPage, ContactPage & ProfilePage](creative_work/webpages.md)
- [WebSite](creative_work/website.md)
- [HowToStep](creative_work/how_to_step.md)
- [Reviews, Ratings & Comments](creative_work/reviews.md)

### People and Organizations
- [Person](thing/person.md)
- [Organization](thing/organization.md)

### Actions
- [SearchAction](thing/action/search_action.md)

### Intangibles
- [ListItem](thing/intangible/list_item.md)
- [ItemList](thing/intangible/item_list.md)
- [BreadcrumbList](thing/intangible/item_list/breadcrumb_list.md)

### Media Objects
- [ImageObject](media_object/image_object.md)

## Basic Usage

All types follow a similar pattern:
1. Instantiate the object with required parameters (and an `@id` identifier).
2. Set additional properties using `setProperty()`.
3. Add the object to the `SchemaOrgGraphCollector`.

```php
use Mitopp\SchemaOrgBundle\Config\SchemaOrgConfigurationInterface;
use Mitopp\SchemaOrgBundle\Type\Thing\Person;

/** @var SchemaOrgConfigurationInterface $configuration */
$person = new Person(
    identifier: $configuration->createIdentifier('#me'),
    name: 'John Doe',
);
$person->setProperty('jobTitle', 'Software Engineer');

$collector->add($person);
```
