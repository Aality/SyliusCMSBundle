<?php

namespace Aality\SyliusCMSBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;


class SyliusCMSExtension extends Extension implements PrependExtensionInterface
{

    public function getAlias(): string
    {
        return 'aality_sylius_cms';
    }
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../../config'));
    }

    public function prepend(ContainerBuilder $container): void
    {
        if (!$container->hasExtension('doctrine_migrations') || !$container->hasExtension('sylius_labs_doctrine_migrations_extra')) {
            return;
        }

        if (
            $container->hasParameter('sylius_core.prepend_doctrine_migrations') &&
            !$container->getParameter('sylius_core.prepend_doctrine_migrations')
        ) {
            return;
        }

        /** @var array<int|string, mixed> $doctrineConfig */
        $doctrineConfig = $container->getExtensionConfig('doctrine_migrations');
        $migrationsPath = (array) \array_pop($doctrineConfig)['migrations_paths'];
        $container->prependExtensionConfig('doctrine_migrations', [
            'migrations_paths' => \array_merge(
                $migrationsPath,
                [
                    'Aality\SyliusCMSBundle\Migrations' => '@SyliusCMSBundle/src/Migrations',
                ],
            ),
        ]);

        $container->prependExtensionConfig('sylius_labs_doctrine_migrations_extra', [
            'migrations' => [
                'Aality\SyliusCMSBundle\Migrations' => ['Sylius\Bundle\CoreBundle\Migrations'],
            ],
        ]);
    }
}
