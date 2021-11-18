<?php

namespace Riddlestone\Brokkr\GraphQL\Fields;

use GraphQL\Type\Definition\FieldDefinition;
use Laminas\ServiceManager\AbstractPluginManager;

class GraphQLFieldManager extends AbstractPluginManager
{
    protected $instanceOf = FieldDefinition::class;

    /**
     * Should the services be shared by default?
     *
     * @var bool
     */
    protected $sharedByDefault = true;

    /**
     * @var string[]
     */
    protected array $queryFields = [];

    /**
     * @param string[] $queryFields
     */
    public function setQueryFields(array $queryFields): void
    {
        $this->queryFields = $queryFields;
    }

    /**
     * @return FieldDefinition[]
     */
    public function getQueryFields(): array
    {
        $fields = [];
        foreach ($this->queryFields as $key => $value) {
            $options = is_string($key)
                ? ['name' => $key]
                : [];
            $fields[] = $this->get($value, $options);
        }
        return $fields;
    }
}
