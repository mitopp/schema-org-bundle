<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Type\Thing\Intangible;

use Mitopp\SchemaOrgBundle\Type\AbstractType;

/**
 * @see https://schema.org/ListItem
 */
final class ListItem extends AbstractType
{
    public function __construct(
        int $position,
        string $name,
        string $itemUrl,
        ?string $identifier = null,
    ) {
        parent::__construct('ListItem', $identifier);

        $this->data['position'] = $position;
        $this->data['name'] = $name;
        $this->data['item'] = $itemUrl;
    }
}
