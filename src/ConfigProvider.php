<?php

namespace Riddlestone\Brokkr\GraphQL;

use GraphQL\Type\Schema;
use Laminas\Mvc\Middleware\PipeSpec;
use Laminas\Router\Http\Placeholder;
use Riddlestone\Brokkr\GraphQL\Fields\AbstractFieldFactory;
use Riddlestone\Brokkr\GraphQL\Fields\GraphQLFieldManager;
use Riddlestone\Brokkr\GraphQL\Fields\GraphQLFieldManagerFactory;
use Riddlestone\Brokkr\GraphQL\Schema\GraphQLSchemaFactory;
use Riddlestone\Brokkr\GraphQL\Types\AbstractScalarTypeFactory;
use Riddlestone\Brokkr\GraphQL\Types\GraphQLTypeManager;
use Riddlestone\Brokkr\GraphQL\Types\GraphQLTypeManagerFactory;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencyConfig(),
            'graphql_fields' => $this->getGraphQLFieldConfig(),
            'graphql_types' => $this->getGraphQLTypeConfig(),
            'router' => $this->getRouteConfig(),
        ];
    }

    public function getDependencyConfig(): array
    {
        return [
            'aliases' => [
                'GraphQLFieldManager' => GraphQLFieldManager::class,
                'GraphQLTypeManager' => GraphQLTypeManager::class,
            ],
            'factories' => [
                GraphQLServer::class => GraphQLServerFactory::class,
                GraphQLFieldManager::class => GraphQLFieldManagerFactory::class,
                GraphQLTypeManager::class => GraphQLTypeManagerFactory::class,
                Schema::class => GraphQLSchemaFactory::class,
            ],
        ];
    }

    public function getGraphQLFieldConfig(): array
    {
        return [
            'abstract_factories' => [
                AbstractFieldFactory::class,
            ],
        ];
    }

    public function getGraphQLTypeConfig(): array
    {
        return [
            'abstract_factories' => [
                AbstractScalarTypeFactory::class,
            ],
        ];
    }

    public function getRouteConfig(): array
    {
        return [
            'routes' => [
                'graphql' => [
                    'type' => Placeholder::class,
                    'options' => [
                        'defaults' => [
                            'controller' => PipeSpec::class,
                            'middleware' => GraphQLServer::class,
                        ]
                    ],
                ],
            ],
        ];
    }
}
