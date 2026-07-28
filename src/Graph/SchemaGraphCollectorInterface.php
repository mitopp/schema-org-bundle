<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Graph;

use Mitopp\SchemaOrgBundle\Type\Contract\SchemaItemInterface;

interface SchemaGraphCollectorInterface
{
    public function add(SchemaItemInterface $item): self;

    /**
     * @return array<SchemaItemInterface>
     */
    public function getItems(): array;
}
