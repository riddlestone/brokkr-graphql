<?php

namespace Riddlestone\Brokkr\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Laminas\ServiceManager\AbstractPluginManager;

/**
 * @method Type get(string $name, ?array $options = null)
 */
class GraphQLTypeManager extends AbstractPluginManager
{
    protected $instanceOf = Type::class;
}
