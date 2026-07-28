# Schema.org Bundle for Symfony

[![CI Status](https://github.com/mitopp/schema-org-bundle/actions/workflows/ci.yml/badge.svg)](https://github.com/mitopp/schema-org-bundle/actions/workflows/ci.yml)

> [!WARNING]
> This Bundle is experimental and subject to change in a future release.

This Symfony bundle allows for easy generation and management of Schema.org data in the form of a JSON-LD graph. It provides a central collector service to gather structured data across different parts of your application (controllers, listeners, services) and output it collectively.

## Features

- Central collector for Schema.org objects.
- Twig extension for easy rendering of the JSON-LD graph.
- Support for nested objects and references via `@id`.
- Configurable output (e.g., Pretty Print).

## Installation

Install the bundle via Composer:

```bash
composer require mitopp/schema-org-bundle
```

The bundle should be automatically activated by Symfony Flex. If not, add it manually to your `config/bundles.php`:

```php
return [
    // ...
    Mitopp\SchemaOrgBundle\MitoppSchemaOrgBundle::class => ['all' => true],
];
```

## Configuration

You can customize the bundle's behavior in a configuration file (e.g., `config/packages/mitopp_schema_org.yaml`):

```yaml
mitopp_schema_org:
    # Enables or disables formatted JSON output (default: true)
    pretty_print: true
    # Optional: Default locale for objects (default: 'de')
    default_locale: 'en'
    # Optional: Prefix for generated identifiers (default: null, falls back to base URL)
    id_prefix: 'https://example.com'
```

## Usage

### In the Controller

You can inject the `SchemaGraphCollectorInterface` directly into your controller to add data:

```php
namespace App\Controller;

use Mitopp\SchemaOrgBundle\Config\SchemaOrgConfigurationInterface;
use Mitopp\SchemaOrgBundle\Graph\SchemaGraphCollectorInterface;
use Mitopp\SchemaOrgBundle\Type\Thing\Organization;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(SchemaGraphCollectorInterface $collector, SchemaOrgConfigurationInterface $configuration): Response
    {
        $org = new Organization(
            identifier: $configuration->createIdentifier('#org'),
            name: 'My Company',
            url: $configuration->getBaseUrl(),
            logo: $configuration->createIdentifier('/logo.png'),
        );

        $collector->add($org);

        return $this->render('home/index.html.twig');
    }
}
```

### Via Event Listener

It is often useful to add global data (such as organization or website search) centrally via a listener:

```php
namespace App\EventListener;

use Mitopp\SchemaOrgBundle\Config\SchemaOrgConfigurationInterface;
use Mitopp\SchemaOrgBundle\Graph\SchemaGraphCollectorInterface;
use Mitopp\SchemaOrgBundle\Type\Thing\CreativeWork\WebSite;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

#[AsEventListener(event: KernelEvents::REQUEST, method: 'onKernelRequest')]
final class SchemaOrgListener
{
    public function __construct(
        private readonly SchemaGraphCollectorInterface $collector,
        private readonly SchemaOrgConfigurationInterface $configuration,
    ) {
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        if (!$event->isMainRequest()) {
            return;
        }

        $website = new WebSite(
            identifier: $this->configuration->createIdentifier('#website'),
            url: $this->configuration->getBaseUrl(),
            name: 'Example Website',
        );
        
        $this->collector->add($website);
    }
}
```

### Output in Twig

To output the collected data in your HTML header, use the provided Twig function in your base template (e.g., `base.html.twig`):

```twig
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>{% block title %}Welcome!{% endblock %}</title>
        
        {# Renders the entire Schema.org graph as a JSON-LD script tag #}
        {{ render_schema_org() }}
        
        {% block stylesheets %}{% endblock %}
    </head>
    <body>
        {% block body %}{% endblock %}
    </body>
</html>
```

## Supported Types

The bundle currently includes several common Schema.org types. For detailed examples and usage instructions, please refer to our [documentation](docs/index.md).

- `Organization`
- `Person`
- `WebSite`
- `WebPage` (including `CollectionPage` and `ContactPage`)
- `Article` & `BlogPosting`
- `Recipe` (including `AggregateRating`, `Review`, `Comment`)
- `HowToStep`
- `ImageObject`
- `AggregateRating`
- `Review`
- `Comment`

## Creating Custom Types

The bundle already offers some common types. However, you can create your own types at any time by inheriting from `AbstractType`:

```php
namespace App\Schema\Type;

use Mitopp\SchemaOrgBundle\Type\AbstractType;

class MyCustomType extends AbstractType
{
    public function __construct(string $identifier)
    {
        parent::__construct('MyCustomType', $identifier);
    }
    
    public function setCustomProperty(string $value): self
    {
        $this->data['customProperty'] = $value;
        return $this;
    }
}
```

## License

This bundle is licensed under the MIT License.
