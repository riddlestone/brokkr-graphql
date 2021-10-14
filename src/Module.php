<?php

namespace Riddlestone\Brokkr\GraphQL;

use Laminas\ModuleManager\Listener\ServiceListener;
use Laminas\ModuleManager\ModuleManager;
use Riddlestone\Brokkr\GraphQL\Fields\GraphQLFieldProviderInterface;
use Riddlestone\Brokkr\GraphQL\Types\GraphQLTypeProviderInterface;

class Module
{
    public function getConfig(): array
    {
        $provider = new ConfigProvider();
        return [
            'graphql_fields' => $provider->getGraphQLFieldConfig(),
            'graphql_types' => $provider->getGraphQLTypeConfig(),
            'router' => $provider->getRouteConfig(),
            'service_manager' => $provider->getDependencyConfig(),
        ];
    }

    /**
     * Register a specification for the GraphQLTypeManager with the ServiceListener.
     */
    public function init(ModuleManager $moduleManager): void
    {
        $event = $moduleManager->getEvent();
        $container = $event->getParam('ServiceManager');
        /** @var ServiceListener $serviceListener */
        $serviceListener = $container->get('ServiceListener');

        $serviceListener->addServiceManager(
            'GraphQLFieldManager',
            'graphql_fields',
            GraphQLFieldProviderInterface::class,
            'getGraphQLFieldConfig'
        );

        $serviceListener->addServiceManager(
            'GraphQLTypeManager',
            'graphql_types',
            GraphQLTypeProviderInterface::class,
            'getGraphQLTypeConfig'
        );
    }
}
