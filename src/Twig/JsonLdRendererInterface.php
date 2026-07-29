<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Twig;

interface JsonLdRendererInterface
{
    public function render(?string $nonce = null): string;
}
