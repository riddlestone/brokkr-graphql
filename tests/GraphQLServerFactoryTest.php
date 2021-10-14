<?php

namespace Riddlestone\Brokkr\GraphQL\Test;

use GraphQL\Type\Schema;
use Interop\Container\Exception\ContainerException;
use Laminas\ServiceManager\ServiceManager;
use Riddlestone\Brokkr\GraphQL\GraphQLServer;
use Riddlestone\Brokkr\GraphQL\GraphQLServerFactory;
use PHPUnit\Framework\TestCase;

class GraphQLServerFactoryTest extends TestCase
{
    /**
     * @throws ContainerException
     */
    public function test__invoke()
    {
        $serviceManager = $this->createMock(ServiceManager::class);

        $schema = $this->createMock(Schema::class);
        $serviceManager->method('get')->willReturnMap([
            [Schema::class, $schema],
        ]);

        $factory = new GraphQLServerFactory();

        $this->assertInstanceOf(GraphQLServer::class, $factory($serviceManager, GraphQLServer::class, []));
    }
}
