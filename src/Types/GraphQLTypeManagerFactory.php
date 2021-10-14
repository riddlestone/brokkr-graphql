<?php

namespace Riddlestone\Brokkr\GraphQL\Types;

use Laminas\ServiceManager\Config;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class GraphQLTypeManagerFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     *
     * @return GraphQLTypeManager
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): GraphQLTypeManager
    {
        $pluginManager = new GraphQLTypeManager($container, $options ?: []);

        // If this is in a laminas-mvc application, the ServiceListener will inject
        // merged configuration during bootstrap.
        if ($container->has('ServiceListener')) {
            return $pluginManager;
        }

        // If we do not have a config service, nothing more to do
        if (! $container->has('config')) {
            return $pluginManager;
        }

        $config = $container->get('config');

        // If we do not have graphql_types configuration, nothing more to do
        if (! isset($config['graphql_types']) || ! is_array($config['graphql_types'])) {
            return $pluginManager;
        }

        // Wire service configuration for forms and elements
        (new Config($config['graphql_types']))->configureServiceManager($pluginManager);

        return $pluginManager;
    }
}
