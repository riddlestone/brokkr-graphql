<?php

namespace Riddlestone\Brokkr\GraphQL\Test;

use Riddlestone\Brokkr\GraphQL\ConfigProvider;
use PHPUnit\Framework\TestCase;

class ConfigProviderTest extends TestCase
{
    /**
     * @covers \Riddlestone\Brokkr\GraphQL\ConfigProvider::__invoke
     */
    public function test__invoke(): void
    {
        $configProvider = new ConfigProvider();
        $this->assertEquals(
            ['dependencies', 'graphql_fields', 'graphql_types', 'router'],
            array_keys($configProvider())
        );
    }

    /**
     * @covers \Riddlestone\Brokkr\GraphQL\ConfigProvider::getDependencyConfig
     */
    public function testGetDependencyConfig(): void
    {
        $configProvider = new ConfigProvider();
        $this->assertEquals(
            ['aliases', 'factories'],
            array_keys($configProvider->getDependencyConfig())
        );
    }

    /**
     * @covers \Riddlestone\Brokkr\GraphQL\ConfigProvider::getGraphQLFieldConfig
     */
    public function testGetGraphQLFieldConfig(): void
    {
        $configProvider = new ConfigProvider();
        $this->assertEquals(
            ['abstract_factories'],
            array_keys($configProvider->getGraphQLFieldConfig())
        );
    }

    /**
     * @covers \Riddlestone\Brokkr\GraphQL\ConfigProvider::getGraphQLTypeConfig
     */
    public function testGetGraphQLTypeConfig(): void
    {
        $configProvider = new ConfigProvider();
        $this->assertEquals(
            ['abstract_factories'],
            array_keys($configProvider->getGraphQLTypeConfig())
        );
    }

    /**
     * @covers \Riddlestone\Brokkr\GraphQL\ConfigProvider::getRouteConfig
     */
    public function testGetRouteConfig(): void
    {
        $configProvider = new ConfigProvider();
        $routeConfig = $configProvider->getRouteConfig();
        $this->assertEquals(
            ['routes'],
            array_keys($routeConfig)
        );
        $this->assertEquals(
            ['graphql'],
            array_keys($routeConfig['routes'])
        );
    }
}
