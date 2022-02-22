<?php

namespace Riddlestone\Brokkr\GraphQL;

use GraphQL\Server\StandardServer;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class GraphQLServer extends StandardServer implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $psrResponse = new Response();
        $response = $this->processPsrRequest($request, $psrResponse, $psrResponse->getBody());
        assert($response instanceof ResponseInterface);
        return $response;
    }
}
