<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Config;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

final readonly class SchemaOrgConfiguration implements SchemaOrgConfigurationInterface
{
    private ?string $idPrefix;

    private string $locale;

    public function __construct(
        private ParameterBagInterface $parameters,
        private RequestStack $requestStack,
    ) {
        /** @phpstan-ignore-next-line */
        $this->idPrefix = $this->parameters->get('mitopp_schema_org.id_prefix') ?? null;
        /** @phpstan-ignore-next-line */
        $this->locale = $this->parameters->get('mitopp_schema_org.default_locale') ?? 'en';
    }

    public function getBaseUrl(): string
    {
        $request = $this->requestStack->getMainRequest();

        return $request instanceof Request ? $request->getSchemeAndHttpHost() : '';
    }

    public function getIdPrefix(): string
    {
        return (null !== $this->idPrefix) ? $this->idPrefix : $this->getBaseUrl();
    }

    public function getLocale(): string
    {
        return $this->locale;
    }

    public function createIdentifier(string $path): string
    {
        return rtrim($this->getIdPrefix(), '/') . '/' . ltrim($path, '/');
    }
}
