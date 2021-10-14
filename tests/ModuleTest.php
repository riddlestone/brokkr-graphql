<?php

namespace Riddlestone\Brokkr\GraphQL\Test;

use Laminas\ModuleManager\Listener\ServiceListener;
use Laminas\ModuleManager\ModuleEvent;
use Laminas\ModuleManager\ModuleManager;
use Laminas\ServiceManager\ServiceManager;
use PHPUnit\Framework\TestCase;
use Riddlestone\Brokkr\GraphQL\Fields\GraphQLFieldProviderInterface;
use Riddlestone\Brokkr\GraphQL\Module;
use Riddlestone\Brokkr\GraphQL\Types\GraphQLTypeProviderInterface;

class ModuleTest extends TestCase
{
    private Module $module;

    protected function setUp(): void
    {
        $this->module = new Module();
    }

    /**
     * @covers \Riddlestone\Brokkr\GraphQL\Module::getConfig
     */
    public function testGetConfig(): void
    {
        $config = $this->module->getConfig();
        $this->assertIsArray($config);
        $this->assertArrayHasKey('router', $config);
        $this->assertIsArray($config['router']);
        $this->assertArrayHasKey('service_manager', $config);
        $this->assertIsArray($config['service_manager']);
    }

    /**
     * @covers \Riddlestone\Brokkr\GraphQL\Module::init
     */
    public function testInit(): void
    {
        $moduleManager = $this->createMock(ModuleManager::class);

        $event = $this->createMock(ModuleEvent::class);
        $moduleManager->method('getEvent')->willReturn($event);

        $serviceManager = $this->createMock(ServiceManager::class);
        $event->method('getParam')->willReturnMap([
            ['ServiceManager', null, $serviceManager],
        ]);

        $serviceListener = $this->createMock(ServiceListener::class);
        $serviceManager->method('get')->willReturnMap([
            ['ServiceListener', $serviceListener],
        ]);

        $serviceListener->expects($this->exactly(2))->method('addServiceManager')->withConsecutive(
            [
                'GraphQLFieldManager',
                'graphql_fields',
                GraphQLFieldProviderInterface::class,
                'getGraphQLFieldConfig'
            ],
            [
                'GraphQLTypeManager',
                'graphql_types',
                GraphQLTypeProviderInterface::class,
                'getGraphQLTypeConfig'
            ]
        );

        $this->module->init($moduleManager);
    }
}
