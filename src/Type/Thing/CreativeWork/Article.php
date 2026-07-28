<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Type\Thing\CreativeWork;

use Mitopp\SchemaOrgBundle\Type\AbstractType;
use Mitopp\SchemaOrgBundle\Type\Contract\SchemaItemInterface;

/**
 * @see https://schema.org/Article
 */
class Article extends AbstractType
{
    public function __construct(
        string $type,
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
    ) {
        parent::__construct($type, $identifier);

        $this->data['name'] = $name;
        $this->data['url'] = $url;
        $this->data['datePublished'] = $datePublished;

        if (null !== $dateModified) {
            $this->data['dateModified'] = $dateModified;
        }

        if (null !== $author) {
            $this->data['author'] = is_string($author)
                ? ['@id' => $author]
                : $author;
        }

        if (null !== $publisher) {
            $this->data['publisher'] = is_string($publisher)
                ? ['@id' => $publisher]
                : $publisher;
        }

        if (null !== $image) {
            $this->data['image'] = is_string($image)
                ? ['@id' => $image]
                : $image;
        }

        if (null !== $description) {
            $this->data['description'] = $description;
        }

        if (null !== $inLanguage) {
            $this->data['inLanguage'] = $inLanguage;
        }

        if (null !== $isPartOf) {
            $this->data['isPartOf'] = is_string($isPartOf)
                ? ['@id' => $isPartOf]
                : $isPartOf;
        }
    }
}
