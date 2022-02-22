<?php

namespace Riddlestone\Brokkr\GraphQL\Fields;

use GraphQL\Type\Definition\FieldDefinition;
use Laminas\ServiceManager\Factory\AbstractFactoryInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Riddlestone\Brokkr\GraphQL\Types\GraphQLTypeManager;

class AbstractFieldFactory implements AbstractFactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @return bool
     */
    public function canCreate(ContainerInterface $container, $requestedName): bool
    {
        return is_a($requestedName, FieldDefinition::class, true)
            && is_a($requestedName, NeedsTypeManagerInterface::class, true);
    }

    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return FieldDefinition
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): FieldDefinition
    {
        assert(class_exists($requestedName, true));
        $fieldDefinition = new $requestedName($options ?? [], $container->get(GraphQLTypeManager::class));
        assert($fieldDefinition instanceof FieldDefinition);
        return $fieldDefinition;
    }
}
