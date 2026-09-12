<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Type\Thing\CreativeWork\WebPage;

use Mitopp\SchemaOrgBundle\Type\Contract\SchemaItemInterface;
use Mitopp\SchemaOrgBundle\Type\Thing\CreativeWork\WebPage;

/**
 * @see https://schema.org/ProfilePage
 */
final class ProfilePage extends WebPage
{
    public function __construct(
        string $identifier,
        string $name,
        string $url,
        ?string $description = null,
        ?string $inLanguage = null,
        SchemaItemInterface|string|null $publisher = null,
        SchemaItemInterface|string|null $isPartOf = null,
        SchemaItemInterface|string|null $breadcrumb = null,
    ) {
        parent::__construct(
            type: 'ProfilePage',
            identifier: $identifier,
            name: $name,
            url: $url,
            description: $description,
            inLanguage: $inLanguage,
            publisher: $publisher,
            isPartOf: $isPartOf,
            breadcrumb: $breadcrumb,
        );
    }
}
