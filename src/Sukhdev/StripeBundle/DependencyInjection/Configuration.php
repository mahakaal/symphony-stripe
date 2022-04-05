<?php

namespace App\Sukhdev\StripeBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('sukhdev_stripe');

        $treeBuilder->getRootNode()
            ->children()
                ->arrayNode('stripe')
                    ->children()
                        ->scalarNode('api_key')->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}