<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Type\Thing\Intangible\ItemList;

use Mitopp\SchemaOrgBundle\Type\AbstractType;
use Mitopp\SchemaOrgBundle\Type\Thing\Intangible\ListItem;

/**
 * @see https://schema.org/BreadcrumbList
 */
final class BreadcrumbList extends AbstractType
{
    /**
     * @param array<ListItem> $itemListElement
     */
    public function __construct(
        array $itemListElement,
        ?string $identifier = null,
    ) {
        parent::__construct('BreadcrumbList', $identifier);

        $this->data['itemListElement'] = $itemListElement;
    }
}
