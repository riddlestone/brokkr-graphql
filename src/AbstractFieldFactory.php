<?php

namespace Riddlestone\Brokkr\GraphQL;

use GraphQL\Type\Definition\FieldDefinition;
use Laminas\ServiceManager\Factory\AbstractFactoryInterface;
use Psr\Container\ContainerInterface;

class AbstractFieldFactory implements AbstractFactoryInterface
{

    public function canCreate(ContainerInterface $container, $requestedName): bool
    {
        return is_a($requestedName, FieldDefinition::class, true)
            && is_a($requestedName, NeedsTypeManagerInterface::class, true);
    }

    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): FieldDefinition
    {
        return new $requestedName($options ?? [], $container->get(GraphQLTypeManager::class));
    }
}
