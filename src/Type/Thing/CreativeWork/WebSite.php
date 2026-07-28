<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Type\Thing\CreativeWork;

use Mitopp\SchemaOrgBundle\Type\AbstractType;
use Mitopp\SchemaOrgBundle\Type\Contract\SchemaItemInterface;

/**
 * @see https://schema.org/WebSite
 */
final class WebSite extends AbstractType
{
    public function __construct(
        /**
         * Required by schema.org
         */
        string $identifier,
        string $url,
        /**
         * Recommended by google.com
         */
        ?string $name = null,
        ?string $description = null,
        ?string $inLanguage = null,
        SchemaItemInterface|string|null $publisher = null,
        SchemaItemInterface|string|null $potentialAction = null,
    ) {
        parent::__construct('WebSite', $identifier);

        $this->data['url'] = $url;

        if (null !== $name) {
            $this->data['name'] = $name;
        }

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

        if (null !== $potentialAction) {
            $this->data['potentialAction'] = is_string($potentialAction)
                ? ['@id' => $potentialAction]
                : $potentialAction;
        }
    }
}
