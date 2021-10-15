<?php

namespace Riddlestone\Brokkr\GraphQL\Test\Schema;

use GraphQL\Type\Schema;
use Interop\Container\Exception\ContainerException;
use Psr\Container\ContainerInterface;
use Riddlestone\Brokkr\GraphQL\Fields\GraphQLFieldManager;
use Riddlestone\Brokkr\GraphQL\Schema\GraphQLSchemaFactory;
use PHPUnit\Framework\TestCase;

class GraphQLSchemaFactoryTest extends TestCase
{
    /**
     * @covers \Riddlestone\Brokkr\GraphQL\Schema\GraphQLSchemaFactory::__invoke
     * @throws ContainerException
     */
    public function test__invoke()
    {
        $container = $this->createMock(ContainerInterface::class);

        $fieldManager = $this->createMock(GraphQLFieldManager::class);
        $container->method('get')->willReturnMap([
            [GraphQLFieldManager::class, $fieldManager],
        ]);

        $factory = new GraphQLSchemaFactory();
        $this->assertInstanceOf(Schema::class, $schema = $factory($container, Schema::class));
    }
}
