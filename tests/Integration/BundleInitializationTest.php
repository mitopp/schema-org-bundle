<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle\Tests\Integration;

use Mitopp\SchemaOrgBundle\Graph\SchemaOrgGraphCollectorInterface;
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
        self::assertTrue($container->has(SchemaOrgGraphCollectorInterface::class));
        self::assertInstanceOf(SchemaOrgGraphCollectorInterface::class, $container->get(SchemaOrgGraphCollectorInterface::class));
    }

    public function testRendererHasPrettyPrintEnabledInDebugByDefault(): void
    {
        $kernel = self::bootKernel(['debug' => true]);
        $container = $kernel->getContainer();

        /** @var JsonLdRenderer $renderer */
        $renderer = $container->get(JsonLdRenderer::class);

        $reflection = new \ReflectionClass($renderer);
        $property = $reflection->getProperty('prettyPrint');

        $this->assertTrue($property->getValue($renderer), 'Pretty print should be enabled by default in debug mode');
    }

    public function testRendererHasPrettyPrintDisabledInNonDebugByDefault(): void
    {
        $kernel = self::bootKernel(['debug' => false]);
        $container = $kernel->getContainer();

        /** @var JsonLdRenderer $renderer */
        $renderer = $container->get(JsonLdRenderer::class);

        $reflection = new \ReflectionClass($renderer);
        $property = $reflection->getProperty('prettyPrint');

        $this->assertFalse($property->getValue($renderer), 'Pretty print should be disabled by default in non-debug mode');
    }

    public function testRendererCanDisablePrettyPrintViaConfig(): void
    {
        $kernel = self::bootKernel(['debug' => true, 'config' => function (TestKernel $kernel): void {
            $kernel->addTestConfig(__DIR__ . '/../Common/config.php');
        }]);
        $container = $kernel->getContainer();

        /** @var JsonLdRenderer $renderer */
        $renderer = $container->get(JsonLdRenderer::class);

        $reflection = new \ReflectionClass($renderer);
        $property = $reflection->getProperty('prettyPrint');

        $this->assertFalse($property->getValue($renderer), 'Pretty print should be disabled via config');
    }

    public function testRendererCanEnablePrettyPrintViaConfigInNonDebug(): void
    {
        $kernel = self::bootKernel(['debug' => false, 'config' => function (TestKernel $kernel): void {
            $kernel->addTestConfig(__DIR__ . '/../Common/config_pretty_print_true.php');
        }]);
        $container = $kernel->getContainer();

        /** @var JsonLdRenderer $renderer */
        $renderer = $container->get(JsonLdRenderer::class);

        $reflection = new \ReflectionClass($renderer);
        $property = $reflection->getProperty('prettyPrint');

        $this->assertTrue($property->getValue($renderer), 'Pretty print should be enabled via config even in non-debug mode');
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
