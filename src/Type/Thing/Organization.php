<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Type\Thing;

use Mitopp\SchemaOrgBundle\Type\AbstractType;
use Mitopp\SchemaOrgBundle\Type\Contract\SchemaItemInterface;

/**
 * @see https://schema.org/Organization
 */
final class Organization extends AbstractType
{
    public function __construct(
        /**
         * Required by schema.org
         */
        string $identifier,
        string $name,
        /**
         * Recommended by google.com
         */
        ?string $url = null,
        SchemaItemInterface|string|null $logo = null,
    ) {
        parent::__construct('Organization', $identifier);

        $this->data['name'] = $name;

        if (null !== $url) {
            $this->data['url'] = $url;
        }

        if (null !== $logo) {
            $this->data['logo'] = is_string($logo)
                ? ['@id' => $logo]
                : $logo;
        }
    }
}
