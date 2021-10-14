<?php

namespace Riddlestone\Brokkr\GraphQL\Test;

use GraphQL\Type\Schema;
use Laminas\Diactoros\ServerRequest;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Riddlestone\Brokkr\GraphQL\GraphQLServer;

class GraphQLServerTest extends TestCase
{
    private GraphQLServer $server;

    protected function setUp(): void
    {
        $this->server = new GraphQLServer([
            'schema' => new Schema([]),
        ]);
    }

    /**
     * @covers \Riddlestone\Brokkr\GraphQL\GraphQLServer::handle()
     */
    public function testHandle(): void
    {
        $response = $this->server->handle(new ServerRequest());
        $this->assertInstanceOf(ResponseInterface::class, $response);
    }
}
