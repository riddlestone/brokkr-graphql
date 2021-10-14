<?php

namespace Riddlestone\Brokkr\GraphQL\Fields;

use Laminas\ServiceManager\Config;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class GraphQLFieldManagerFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     *
     * @return GraphQLFieldManager
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): GraphQLFieldManager
    {
        $pluginManager = new GraphQLFieldManager($container, $options ?: []);

        // If we do not have a config service, nothing more to do
        if (! $container->has('config')) {
            return $pluginManager;
        }

        $config = $container->get('config');

        $pluginManager->setQueryFields($config['graphql_fields']['query_fields'] ?? []);

        // If this is in a laminas-mvc application, the ServiceListener will inject
        // merged configuration during bootstrap.
        if ($container->has('ServiceListener')) {
            return $pluginManager;
        }

        // If we do not have graphql_fields configuration, nothing more to do
        if (! isset($config['graphql_fields']) || ! is_array($config['graphql_fields'])) {
            return $pluginManager;
        }

        // Wire service configuration for forms and elements
        (new Config($config['graphql_fields']))->configureServiceManager($pluginManager);

        return $pluginManager;
    }
}
