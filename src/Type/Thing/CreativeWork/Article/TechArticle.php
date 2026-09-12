<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Type\Thing\CreativeWork\Article;

use Mitopp\SchemaOrgBundle\Type\Contract\SchemaItemInterface;
use Mitopp\SchemaOrgBundle\Type\Thing\CreativeWork\Article;

final class TechArticle extends Article
{
    public function __construct(
        string $identifier,
        string $name,
        string $url,
        string $datePublished,
        ?string $dateModified = null,
        SchemaItemInterface|string|null $author = null,
        SchemaItemInterface|string|null $publisher = null,
        SchemaItemInterface|string|null $image = null,
        ?string $description = null,
        ?string $inLanguage = null,
        SchemaItemInterface|string|null $isPartOf = null,
        ?string $dependencies = null,
    ) {
        parent::__construct(
            type: 'TechArticle',
            identifier: $identifier,
            name: $name,
            url: $url,
            datePublished: $datePublished,
            dateModified: $dateModified,
            author: $author,
            publisher: $publisher,
            image: $image,
            description: $description,
            inLanguage: $inLanguage,
            isPartOf: $isPartOf,
        );

        if (null !== $dependencies) {
            $this->data['dependencies'] = $dependencies;
        }
    }
}
