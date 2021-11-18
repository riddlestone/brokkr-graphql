# Brokkr GraphQL

This module provides an endpoint and plugin managers to assist with development
of a Laminas-based GraphQL solution.

## Endpoint

A placeholder route is provided to the router for the GraphQL endpoint, named
`graphql`. It can be overridden using router config:

```php
# module config
return [
    'router' => [
        'routes' => [
            'graphql' => [
                'type' => 'literal',
                'options' => [
                    'route' => 'api/graphql'
                ],
            ],
        ],
    ],
];
```

## Types

Types can be registered with the `GraphQLTypeManager` through configuration:

```php
# module config
return [
    'graphql_types' => [
        'factories' => [
            'My\\TypeClass' => 'My\\TypeClassFactory',
        ],
    ],
];
```

Alternatively you can deal with the manager directly:

```php
use Laminas\ServiceManager\ServiceManager;
use Riddlestone\Brokkr\GraphQL\Types\GraphQLTypeManager;

/** @var ServiceManager $serviceManager */

/** @var GraphQLTypeManager $typeManager */
$typeManager = $serviceManager->get(GraphQLTypeManager::class);

$typeManager->setFactory('My\\TypeClass', 'My\\TypeClassFactory');
```

## Fields

Fields can be registered with the `GraphQLFieldManager`, through configuration
or directly.

```php
# module config
return [
    'graphql_fields' => [
        'factories' => [
            'My\\FieldClass' => 'My\\FieldClassFactory',
        ],
    ],
];
```

```php
use Laminas\ServiceManager\ServiceManager;
use Riddlestone\Brokkr\GraphQL\Fields\GraphQLFieldManager;

/** @var ServiceManager $serviceManager */

/** @var GraphQLFieldManager $fieldManager */
$fieldManager = $serviceManager->get(GraphQLFieldManager::class);

$fieldManager->setFactory('My\\FieldClass', 'My\\FieldClassFactory');
```

Note that fields do not need to be registered to use them in types, but will
need to be registered for use as root query fields.

In order for fields to be available as a root element in a query, they need to
be registered as query fields with the field manager through configuration.

You can optionally set the field name using the array key. This can be useful
when reusing configurable classes to represent more than one field.

```php
# module config
return [
    'graphql_fields' => [
        'query_fields' => [
            'field_classes' => 'My\\FieldClass',
        ],
    ],
];
```
