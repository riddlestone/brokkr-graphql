<?php

return [
    'modules' => [
        Laminas\Router\Module::class,
        Laminas\Mvc\Middleware\Module::class,
        Riddlestone\Brokkr\GraphQL\Module::class,
    ],
    'module_listener_options' => [
        'use_laminas_loader' => false,
        'config_glob_paths' => [
            realpath(__DIR__) . '/autoload/{{,*.}global,{,*.}local}.php',
        ],
        'config_cache_enabled' => false,
        'config_cache_key' => 'application.config.cache',
        'module_map_cache_enabled' => false,
        'module_map_cache_key' => 'application.module.cache',
        'cache_dir' => 'data/cache/',
    ],
];
