<?php

namespace Riddlestone\Brokkr\GraphQL;

interface GraphQLTypeProviderInterface
{
    public function getGraphQLTypeConfig(): array;
}
