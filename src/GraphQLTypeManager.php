<?php

namespace Riddlestone\Brokkr\GraphQL;

use GraphQL\Type\Definition\Type;
use Laminas\ServiceManager\AbstractPluginManager;

class GraphQLTypeManager extends AbstractPluginManager
{
    protected $instanceOf = Type::class;
}
