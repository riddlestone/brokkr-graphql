<?php

return [
    'graphql_fields' => [
        'query_fields' => [
            Riddlestone\Brokkr\GraphQL\Test\Classes\HelloField::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'errors/404',
        'exception_template' => 'errors/500',
        'template_path_stack' => [
            __DIR__ . '/../../views',
        ],
    ],
];
