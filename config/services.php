<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Mitopp\SchemaOrgBundle\Graph\SchemaGraphCollector;
use Mitopp\SchemaOrgBundle\Graph\SchemaGraphCollectorInterface;
use Mitopp\SchemaOrgBundle\Twig\JsonLdRenderer;

return static function (ContainerConfigurator $container): void {
    $services = $container->services()
        ->defaults()
        ->autowire()
        ->autoconfigure()
        ->public()
    ;

    $services->load('Mitopp\\SchemaOrgBundle\\', '../src')
        ->exclude('../src/{Type,MitoppSchemaOrgBundle.php}')
    ;

    $services->set(JsonLdRenderer::class)
        ->arg('$prettyPrint', param('mitopp_schema_org.pretty_print'))
    ;

    $services->alias(SchemaGraphCollectorInterface::class, SchemaGraphCollector::class);
};
