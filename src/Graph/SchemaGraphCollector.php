<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Graph;

use Mitopp\SchemaOrgBundle\Type\Contract\SchemaItemInterface;

final class SchemaGraphCollector implements SchemaGraphCollectorInterface
{
    /**
     * @var array<SchemaItemInterface>
     */
    private array $items = [];

    public function add(SchemaItemInterface $item): SchemaGraphCollectorInterface
    {
        $this->items[] = $item;

        return $this;
    }

    public function getItems(): array
    {
        return $this->items;
    }
}
