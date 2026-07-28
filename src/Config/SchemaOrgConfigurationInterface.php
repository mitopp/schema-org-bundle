<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Config;

interface SchemaOrgConfigurationInterface
{
    public function getBaseUrl(): string;

    public function getIdPrefix(): string;

    public function getLocale(): string;

    public function createIdentifier(string $path): string;
}
