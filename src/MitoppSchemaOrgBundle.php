<?php

declare(strict_types=1);

namespace Mitopp\SchemaOrgBundle;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

final class MitoppSchemaOrgBundle extends AbstractBundle
{
    protected string $extensionAlias = 'mitopp_schema_org';

    public function configure(DefinitionConfigurator $definition): void
    {
        $rootNode = $definition->rootNode();
        assert($rootNode instanceof ArrayNodeDefinition);

        $rootNode
            ->children()
                ->scalarNode('pretty_print')
                    ->info('Enables pretty printing for the generated JSON-LD output.')
                    ->defaultValue('%kernel.debug%')
                ->end()
                ->scalarNode('id_prefix')
                    ->defaultNull()
                    ->info('Optional prefix for generated identifiers.')
                ->end()
                    ->scalarNode('locale')
                    ->defaultNull()
                    ->info('Optional default locale.')
                ->end()
            ->end()
        ;
    }

    /**
     * @param array<string, mixed> $config
     */
    public function loadExtension(array $config, ContainerConfigurator $configurator, ContainerBuilder $container): void
    {
        /** @var bool|string $prettyPrint */
        $prettyPrint = $config['pretty_print'];

        /** @var ?string $idPrefix */
        $idPrefix = $config['id_prefix'];
        /** @var ?string $defaultLocale */
        $defaultLocale = $config['locale'];

        $container->setParameter('mitopp_schema_org.pretty_print', $prettyPrint);
        $container->setParameter('mitopp_schema_org.id_prefix', $idPrefix);
        $container->setParameter('mitopp_schema_org.default_locale', $defaultLocale);

        $configurator->import('../config/services.php');
    }
}
