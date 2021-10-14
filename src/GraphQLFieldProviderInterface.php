<?php

namespace Riddlestone\Brokkr\GraphQL;

interface GraphQLFieldProviderInterface
{
    public function getGraphQLFieldConfig(): array;
}
