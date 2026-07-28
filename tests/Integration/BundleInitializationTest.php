<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Tests\Integration;

use Mitopp\SchemaOrgBundle\Graph\SchemaGraphCollectorInterface;
use Mitopp\SchemaOrgBundle\MitoppSchemaOrgBundle;
use Mitopp\SchemaOrgBundle\Twig\JsonLdRenderer;
use Nyholm\BundleTest\TestKernel;
use PHPUnit\Framework\Attributes\CoversClass;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpKernel\KernelInterface;

#[CoversClass(MitoppSchemaOrgBundle::class)]
final class BundleInitializationTest extends KernelTestCase
{
    protected function tearDown(): void
    {
        parent::tearDown();

        self::$class = null; // Kill used Kernel class
    }

    public function testInitBundle(): void
    {
        // Boot the kernel.
        $kernel = self::bootKernel();

        // Get the container
        $container = $kernel->getContainer();

        // Test if your service exists
        self::assertTrue($container->has(SchemaGraphCollectorInterface::class));
        self::assertInstanceOf(SchemaGraphCollectorInterface::class, $container->get(SchemaGraphCollectorInterface::class));
    }

    public function testRendererHasPrettyPrintEnabledByDefault(): void
    {
        $kernel = self::bootKernel();
        $container = $kernel->getContainer();

        /** @var JsonLdRenderer $renderer */
        $renderer = $container->get(JsonLdRenderer::class);

        $reflection = new \ReflectionClass($renderer);
        $property = $reflection->getProperty('prettyPrint');

        $this->assertFalse($property->getValue($renderer), 'Pretty print should be enabled by default');
    }

    public function testRendererCanDisablePrettyPrintViaConfig(): void
    {
        $kernel = self::bootKernel(['config' => function (TestKernel $kernel): void {
            $kernel->addTestConfig(__DIR__ . '/../Common/config.php');
        }]);
        $container = $kernel->getContainer();

        /** @var JsonLdRenderer $renderer */
        $renderer = $container->get(JsonLdRenderer::class);

        $reflection = new \ReflectionClass($renderer);
        $property = $reflection->getProperty('prettyPrint');

        $this->assertFalse($property->getValue($renderer), 'Pretty print should be disabled via config');
    }

    protected static function getKernelClass(): string
    {
        return TestKernel::class;
    }

    protected static function ensureKernelShutdown(): void
    {
        $wasBooted = self::$booted;

        parent::ensureKernelShutdown();

        if ($wasBooted) {
            restore_exception_handler();
        }
    }

    protected static function createKernel(array $options = []): KernelInterface
    {
        /**
         * @var TestKernel $kernel
         */
        $kernel = parent::createKernel($options);
        $kernel->addTestBundle(MitoppSchemaOrgBundle::class);
        $kernel->handleOptions($options);

        return $kernel;
    }
}
