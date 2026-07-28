<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Tests\Unit\Type\Thing\CreativeWork;

use Mitopp\SchemaOrgBundle\Type\Thing\CreativeWork\HowToStep;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(HowToStep::class)]
final class HowToStepTest extends TestCase
{
    public function testInitialization(): void
    {
        $step = new HowToStep(
            text: 'Boil water',
            name: 'Step 1',
            url: 'https://example.com/step1',
            image: 'https://example.com/step1.jpg'
        );

        $data = $step->toArray();

        $this->assertEquals('HowToStep', $data['@type']);
        $this->assertEquals('Boil water', $data['text']);
        $this->assertEquals('Step 1', $data['name']);
        $this->assertEquals('https://example.com/step1', $data['url']);
        $this->assertEquals(['@id' => 'https://example.com/step1.jpg'], $data['image']);
    }

    public function testInitializationWithIdentifier(): void
    {
        $step = new HowToStep(
            text: 'Mix ingredients',
        );

        $data = $step->toArray();

        $this->assertEquals('HowToStep', $data['@type']);
        $this->assertEquals('Mix ingredients', $data['text']);
    }

    public function testInitializationWithoutOptionalFields(): void
    {
        $step = new HowToStep(text: 'Wait');
        $data = $step->toArray();

        $this->assertEquals('HowToStep', $data['@type']);
        $this->assertEquals('Wait', $data['text']);
        $this->assertArrayNotHasKey('name', $data);
    }
}
