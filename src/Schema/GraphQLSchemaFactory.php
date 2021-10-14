<?php

namespace Riddlestone\Brokkr\GraphQL\Schema;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Schema;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;
use Riddlestone\Brokkr\GraphQL\Fields\GraphQLFieldManager;

class GraphQLSchemaFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): Schema
    {
        /** @var GraphQLFieldManager $fieldManager */
        $fieldManager = $container->get(GraphQLFieldManager::class);
        $queryType = new ObjectType([
            'name' => 'Query',
            'fields' => $fieldManager->getQueryFields(),
        ]);

        return new Schema([
            'query' => $queryType,
        ]);
    }
}
