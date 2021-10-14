<?php

namespace Riddlestone\Brokkr\GraphQL\Test\Classes;

use GraphQL\Type\Definition\FieldDefinition;
use Riddlestone\Brokkr\GraphQL\Types\GraphQLTypeManager;
use Riddlestone\Brokkr\GraphQL\Fields\NeedsTypeManagerInterface;

class HelloField extends FieldDefinition implements NeedsTypeManagerInterface
{
    public function __construct(array $config, GraphQLTypeManager $typeManager)
    {
        parent::__construct(array_merge(
            [
                'name' => 'hello',
                'type' => fn () => $typeManager->get('string'),
                'resolve' => fn () => $this->resolve(),
            ],
            $config
        ));
    }

    protected function resolve(): string
    {
        return 'Hello World!';
    }
}
