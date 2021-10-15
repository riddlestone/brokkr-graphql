<?php

namespace Riddlestone\Brokkr\GraphQL\Test\Types;

use Interop\Container\Exception\ContainerException;
use Psr\Container\ContainerInterface;
use Riddlestone\Brokkr\GraphQL\Types\GraphQLTypeManager;
use Riddlestone\Brokkr\GraphQL\Types\GraphQLTypeManagerFactory;
use PHPUnit\Framework\TestCase;

class GraphQLTypeManagerFactoryTest extends TestCase
{
    /**
     * @covers \Riddlestone\Brokkr\GraphQL\Types\GraphQLTypeManagerFactory::__invoke
     * @throws ContainerException
     */
    public function test__invokeWithServiceListener()
    {
        $factory = new GraphQLTypeManagerFactory();

        $container = $this->createMock(ContainerInterface::class);
        $container->method('has')->willReturnMap([
            ['ServiceListener', true],
        ]);

        $container->expects($this->never())->method('get');

        $typeManager = $factory($container, GraphQLTypeManager::class, []);

        $this->assertInstanceOf(GraphQLTypeManager::class, $typeManager);
    }

    /**
     * @covers \Riddlestone\Brokkr\GraphQL\Types\GraphQLTypeManagerFactory::__invoke
     * @throws ContainerException
     */
    public function test__invokeWithoutConfig()
    {
        $factory = new GraphQLTypeManagerFactory();

        $container = $this->createMock(ContainerInterface::class);
        $container->method('has')->willReturnMap([
            ['ServiceListener', false],
            ['config', false],
        ]);

        $container->expects($this->never())->method('get');

        $typeManager = $factory($container, GraphQLTypeManager::class, []);

        $this->assertInstanceOf(GraphQLTypeManager::class, $typeManager);
    }

    /**
     * @covers \Riddlestone\Brokkr\GraphQL\Types\GraphQLTypeManagerFactory::__invoke
     * @throws ContainerException
     */
    public function test__invokeWithEmptyConfig()
    {
        $factory = new GraphQLTypeManagerFactory();

        $container = $this->createMock(ContainerInterface::class);
        $container->method('has')->willReturnMap([
            ['ServiceListener', false],
            ['config', true],
        ]);
        $container->method('get')->willReturnMap([
            ['config'], [],
        ]);

        $typeManager = $factory($container, GraphQLTypeManager::class, []);

        $this->assertInstanceOf(GraphQLTypeManager::class, $typeManager);
    }

    /**
     * @covers \Riddlestone\Brokkr\GraphQL\Types\GraphQLTypeManagerFactory::__invoke
     * @throws ContainerException
     */
    public function test__invokeWithConfig()
    {
        $factory = new GraphQLTypeManagerFactory();

        $container = $this->createMock(ContainerInterface::class);
        $container->method('has')->willReturnMap([
            ['ServiceListener', false],
            ['config', true],
        ]);
        $container->method('get')->willReturnMap([
            ['config', ['graphql_types' => []]],
        ]);

        $typeManager = $factory($container, GraphQLTypeManager::class, []);

        $this->assertInstanceOf(GraphQLTypeManager::class, $typeManager);
    }
}
