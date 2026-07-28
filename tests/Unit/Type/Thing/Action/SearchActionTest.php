<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Tests\Unit\Type\Thing\Action;

use Mitopp\SchemaOrgBundle\Type\Thing\Action\SearchAction;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(SearchAction::class)]
final class SearchActionTest extends TestCase
{
    public function testInitialization(): void
    {
        $searchAction = new SearchAction(
            urlTemplate: 'https://example.com/search?q={search_term_string}',
            queryInput: 'required name=search_term_string',
            identifier: 'https://example.com/#search'
        );

        $data = $searchAction->toArray();

        $this->assertEquals('SearchAction', $data['@type']);
        $this->assertEquals('https://example.com/#search', $data['@id']);
        $this->assertEquals([
            '@type' => 'EntryPoint',
            'urlTemplate' => 'https://example.com/search?q={search_term_string}',
        ], $data['target']);
        $this->assertEquals('required name=search_term_string', $data['query-input']);
    }

    public function testInitializationWithDefaultQueryInput(): void
    {
        $searchAction = new SearchAction(
            urlTemplate: 'https://example.com/search?q={search_term_string}'
        );

        $data = $searchAction->toArray();

        $this->assertEquals('SearchAction', $data['@type']);
        $this->assertEquals([
            '@type' => 'EntryPoint',
            'urlTemplate' => 'https://example.com/search?q={search_term_string}',
        ], $data['target']);
        $this->assertEquals('required name=search_term_string', $data['query-input']);
    }
}
