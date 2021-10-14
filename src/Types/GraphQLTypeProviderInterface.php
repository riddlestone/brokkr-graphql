<?php

namespace Riddlestone\Brokkr\GraphQL\Types;

interface GraphQLTypeProviderInterface
{
    public function getGraphQLTypeConfig(): array;
}
