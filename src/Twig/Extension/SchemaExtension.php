<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Twig\Extension;

use Mitopp\SchemaOrgBundle\Twig\JsonLdRendererInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class SchemaExtension extends AbstractExtension
{
    public function __construct(
        private readonly JsonLdRendererInterface $jsonLdRenderer,
    ) {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction(
                name: 'render_schema_org',
                callable: [
                    $this->jsonLdRenderer,
                    'render',
                ],
                options: [
                    'is_safe' => ['html'],
                ]
            ),
        ];
    }
}
