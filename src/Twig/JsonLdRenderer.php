<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Twig;

use Mitopp\SchemaOrgBundle\Graph\SchemaGraphCollectorInterface;
use Mitopp\SchemaOrgBundle\Type\Contract\SchemaItemInterface;

final readonly class JsonLdRenderer implements JsonLdRendererInterface
{
    public function __construct(
        private SchemaGraphCollectorInterface $graph,
        private bool $prettyPrint = true,
    ) {
    }

    public function render(): string
    {
        $items = $this->graph->getItems();

        // If the collector is empty, we also don't output an unnecessary <script> tag.
        if ([] === $items) {
            return '';
        }

        $nodes = array_map(
            static fn (SchemaItemInterface $item): array => $item->toArray(),
            $items,
        );

        $payload = [
            '@context' => 'https://schema.org',
            '@graph' => array_values($nodes),
        ];

        $options = JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR;
        if ($this->prettyPrint) {
            $options |= JSON_PRETTY_PRINT;
        }

        try {
            $json = json_encode(
                $payload,
                $options
            );

            return sprintf("<script type=\"application/ld+json\">\n%s\n</script>", $json);
        } catch (\Throwable $throwable) {
            throw new \RuntimeException(
                message: 'Failed to encode JSON-LD payload',
                code: $throwable->getCode(),
                previous: $throwable,
            );
        }
    }
}
