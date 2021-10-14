<?php

namespace Riddlestone\Brokkr\GraphQL;

use GraphQL\Type\Schema;
use Psr\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class GraphQLServerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): GraphQLServer
    {
        return new GraphQLServer([
            'schema' => $container->get(Schema::class),
        ]);
    }
}
