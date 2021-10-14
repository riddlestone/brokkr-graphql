<?php

namespace Riddlestone\Brokkr\GraphQL\Fields;

interface GraphQLFieldProviderInterface
{
    public function getGraphQLFieldConfig(): array;
}
