<?php

namespace Riddlestone\Brokkr\GraphQL\Test;

use PHPUnit\Framework\TestCase;
use Riddlestone\Brokkr\GraphQL\Module;

class ModuleTest extends TestCase
{
    private Module $module;

    protected function setUp(): void
    {
        $this->module = new Module();
    }

    /**
     * @covers \Riddlestone\Brokkr\GraphQL\Module::getConfig()
     */
    public function testConfig(): void
    {
        $config = $this->module->getConfig();
        $this->assertIsArray($config);
        $this->assertArrayHasKey('router', $config);
        $this->assertIsArray($config['router']);
        $this->assertArrayHasKey('service_manager', $config);
        $this->assertIsArray($config['service_manager']);
    }
}
