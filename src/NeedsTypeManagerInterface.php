<?php

namespace Riddlestone\Brokkr\GraphQL;

interface NeedsTypeManagerInterface
{
    public function __construct(array $config, GraphQLTypeManager $typeManager);
}
