<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Type\Thing\Intangible\ItemList;

use Mitopp\SchemaOrgBundle\Type\Thing\Intangible\ItemList;
use Mitopp\SchemaOrgBundle\Type\Thing\Intangible\ListItem;

/**
 * @see https://schema.org/BreadcrumbList
 */
final class BreadcrumbList extends ItemList
{
    /**
     * @param array<ListItem> $itemListElement
     */
    public function __construct(
        array $itemListElement,
        ?string $identifier = null,
    ) {
        parent::__construct(
            itemListElement: $itemListElement,
            identifier: $identifier,
            type: 'BreadcrumbList',
        );
    }
}
