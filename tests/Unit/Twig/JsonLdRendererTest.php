<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Tests\Unit\Twig;

use Mitopp\SchemaOrgBundle\Graph\SchemaOrgGraphCollectorInterface;
use Mitopp\SchemaOrgBundle\Twig\JsonLdRenderer;
use Mitopp\SchemaOrgBundle\Type\Contract\SchemaItemInterface;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(JsonLdRenderer::class)]
final class JsonLdRendererTest extends TestCase
{
    public function testRenderEmptyGraph(): void
    {
        $graph = $this->createMock(SchemaOrgGraphCollectorInterface::class);
        $graph->method('getItems')->willReturn([]);

        $renderer = new JsonLdRenderer($graph);
        $this->assertEquals('', $renderer->render());
    }

    public function testRenderWithItems(): void
    {
        $item = $this->createMock(SchemaItemInterface::class);
        $item->method('toArray')->willReturn(['@type' => 'Thing', 'name' => 'Test']);

        $graph = $this->createMock(SchemaOrgGraphCollectorInterface::class);
        $graph->method('getItems')->willReturn([$item]);

        $renderer = new JsonLdRenderer($graph, false);
        $output = $renderer->render();

        $this->assertStringContainsString('<script type="application/ld+json">', $output);
        $this->assertStringContainsString('"@context":"https://schema.org"', $output);
        $this->assertStringContainsString('"@graph":[{"@type":"Thing","name":"Test"}]', $output);
    }

    public function testRenderWithPrettyPrint(): void
    {
        $item = $this->createMock(SchemaItemInterface::class);
        $item->method('toArray')->willReturn(['@type' => 'Thing']);

        $graph = $this->createMock(SchemaOrgGraphCollectorInterface::class);
        $graph->method('getItems')->willReturn([$item]);

        $renderer = new JsonLdRenderer($graph, true);
        $output = $renderer->render();

        $this->assertStringContainsString('    "@context": "https://schema.org"', $output);
    }
}
