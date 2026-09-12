<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Type\Thing\Intangible;

use Mitopp\SchemaOrgBundle\Type\AbstractType;
use Mitopp\SchemaOrgBundle\Type\Contract\SchemaItemInterface;

/**
 * @see https://schema.org/ItemList
 */
class ItemList extends AbstractType
{
    /**
     * @param array<ListItem|SchemaItemInterface|string>|null $itemListElement
     */
    public function __construct(
        ?array $itemListElement = null,
        ?string $identifier = null,
        ?string $name = null,
        ?string $description = null,
        ?string $itemListOrder = null,
        ?int $numberOfItems = null,
        ?string $url = null,
        string $type = 'ItemList',
    ) {
        parent::__construct($type, $identifier);

        if (null !== $itemListElement) {
            $this->data['itemListElement'] = $itemListElement;
        }

        if (null !== $name) {
            $this->data['name'] = $name;
        }

        if (null !== $description) {
            $this->data['description'] = $description;
        }

        if (null !== $itemListOrder) {
            $this->data['itemListOrder'] = $itemListOrder;
        }

        if (null !== $numberOfItems) {
            $this->data['numberOfItems'] = $numberOfItems;
        }

        if (null !== $url) {
            $this->data['url'] = $url;
        }
    }
}
