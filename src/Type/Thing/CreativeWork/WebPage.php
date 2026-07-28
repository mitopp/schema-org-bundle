<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Type\Thing\CreativeWork;

use Mitopp\SchemaOrgBundle\Type\AbstractType;
use Mitopp\SchemaOrgBundle\Type\Contract\SchemaItemInterface;

class WebPage extends AbstractType
{
    public function __construct(
        string $type,
        /**
         * Required by schema.org
         */
        string $identifier,
        string $name,
        string $url,
        /**
         * Recommended by google.com
         */
        ?string $description = null,
        ?string $inLanguage = null,
        SchemaItemInterface|string|null $publisher = null,
        SchemaItemInterface|string|null $isPartOf = null,
        SchemaItemInterface|string|null $breadcrumb = null,
    ) {
        parent::__construct($type, $identifier);

        $this->data['name'] = $name;
        $this->data['url'] = $url;

        if (null !== $description) {
            $this->data['description'] = $description;
        }

        if (null !== $inLanguage) {
            $this->data['inLanguage'] = $inLanguage;
        }

        if (null !== $publisher) {
            $this->data['publisher'] = is_string($publisher)
                ? ['@id' => $publisher]
                : $publisher;
        }

        if (null !== $isPartOf) {
            $this->data['isPartOf'] = is_string($isPartOf)
                ? ['@id' => $isPartOf]
                : $isPartOf;
        }

        if (null !== $breadcrumb) {
            $this->data['breadcrumb'] = is_string($breadcrumb)
                ? ['@id' => $breadcrumb]
                : $breadcrumb;
        }
    }
}
