<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Type\Thing;

use Mitopp\SchemaOrgBundle\Type\AbstractType;

/**
 * @see https://schema.org/Person
 */
final class Person extends AbstractType
{
    public function __construct(
        string $identifier,
        string $name,
        ?string $url = null,
    ) {
        parent::__construct('Person', $identifier);

        $this->data['name'] = $name;

        if (null !== $url) {
            $this->data['url'] = $url;
        }
    }
}
