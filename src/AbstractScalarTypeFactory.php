<?php

namespace Riddlestone\Brokkr\GraphQL;

use GraphQL\Type\Definition\ScalarType;
use GraphQL\Type\Definition\Type;
use Laminas\ServiceManager\Factory\AbstractFactoryInterface;
use Psr\Container\ContainerInterface;

class AbstractScalarTypeFactory implements AbstractFactoryInterface
{
    public function canCreate(ContainerInterface $container, $requestedName): bool
    {
        return in_array(strtolower($requestedName), [
            'string',
            'int',
            'boolean',
            'float',
            'id',
        ]);
    }

    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): ScalarType
    {
        return Type::$requestedName();
    }
}
