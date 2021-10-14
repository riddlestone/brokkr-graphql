<?php

namespace Riddlestone\Brokkr\GraphQL\Fields;

use Riddlestone\Brokkr\GraphQL\Types\GraphQLTypeManager;

interface NeedsTypeManagerInterface
{
    public function __construct(array $config, GraphQLTypeManager $typeManager);
}
