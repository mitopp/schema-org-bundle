<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Type\Contract;

interface SchemaItemInterface
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(): array;

    public function getIdentifier(): string;
}
