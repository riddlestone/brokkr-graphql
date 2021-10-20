<?php

namespace Riddlestone\Brokkr\GraphQL\Test\Fields;

use Interop\Container\Exception\ContainerException;
use Psr\Container\ContainerInterface;
use Riddlestone\Brokkr\GraphQL\Fields\GraphQLFieldManager;
use Riddlestone\Brokkr\GraphQL\Fields\GraphQLFieldManagerFactory;
use PHPUnit\Framework\TestCase;

class GraphQLFieldManagerFactoryTest extends TestCase
{
    /**
     * @covers \Riddlestone\Brokkr\GraphQL\Fields\GraphQLFieldManagerFactory::__invoke
     * @throws ContainerException
     */
    public function test__invokeWithoutConfig()
    {
        $factory = new GraphQLFieldManagerFactory();

        $container = $this->createMock(ContainerInterface::class);
        $container->method('has')->willReturnMap([
            ['config', false],
        ]);

        $typeManager = $factory($container, GraphQLFieldManager::class, []);

        $this->assertInstanceOf(GraphQLFieldManager::class, $typeManager);
    }

    /**
     * @covers \Riddlestone\Brokkr\GraphQL\Fields\GraphQLFieldManagerFactory::__invoke
     * @throws ContainerException
     */
    public function test__invokeWithServiceListener()
    {
        $factory = new GraphQLFieldManagerFactory();

        $container = $this->createMock(ContainerInterface::class);
        $container->method('has')->willReturnMap([
            ['config', true],
            ['ServiceListener', true],
        ]);
        $container->method('get')->willReturnMap([
            ['config', []],
        ]);

        $typeManager = $factory($container, GraphQLFieldManager::class, []);

        $this->assertInstanceOf(GraphQLFieldManager::class, $typeManager);
    }

    /**
     * @covers \Riddlestone\Brokkr\GraphQL\Fields\GraphQLFieldManagerFactory::__invoke
     * @throws ContainerException
     */
    public function test__invokeWithEmptyConfig()
    {
        $factory = new GraphQLFieldManagerFactory();

        $container = $this->createMock(ContainerInterface::class);
        $container->method('has')->willReturnMap([
            ['config', true],
            ['ServiceListener', false],
        ]);
        $container->method('get')->willReturnMap([
            ['config', []],
        ]);

        $typeManager = $factory($container, GraphQLFieldManager::class, []);

        $this->assertInstanceOf(GraphQLFieldManager::class, $typeManager);
    }

    /**
     * @covers \Riddlestone\Brokkr\GraphQL\Fields\GraphQLFieldManagerFactory::__invoke
     * @throws ContainerException
     */
    public function test__invokeWithConfig()
    {
        $factory = new GraphQLFieldManagerFactory();

        $container = $this->createMock(ContainerInterface::class);
        $container->method('has')->willReturnMap([
            ['config', true],
            ['ServiceListener', false],
        ]);
        $container->method('get')->willReturnMap([
            ['config', ['graphql_fields' => []]],
        ]);

        $typeManager = $factory($container, GraphQLFieldManager::class, []);

        $this->assertInstanceOf(GraphQLFieldManager::class, $typeManager);
    }
}
