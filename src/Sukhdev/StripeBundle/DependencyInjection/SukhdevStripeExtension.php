<?php

namespace App\Sukhdev\StripeBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class SukhdevStripeExtension extends Extension
{

    /**
     * @inheritDoc
     * @throws \Exception
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('config.xml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $definition = $container->getDefinition('sukhdev.stripe.configuration');
        $container->setParameter("api_key", $config['stripe']['api_key']);
    }
}