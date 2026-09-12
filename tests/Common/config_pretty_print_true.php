<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return static function (ContainerConfigurator $container): void {
    $container->extension('mitopp_schema_org', [
        'pretty_print' => true,
    ]);
};
