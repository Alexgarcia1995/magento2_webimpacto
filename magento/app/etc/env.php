<?php
return [
    'backend' => [
        'frontName' => 'suadmin'
    ],
    'cache' => [
        'graphql' => [
            'id_salt' => '5AwCdV8eOtHt7vXUagsIijBlgDkhzdJp'
        ],
        'frontend' => [
            'default' => [
                'id_prefix' => 'f73_'
            ],
            'page_cache' => [
                'id_prefix' => 'f73_'
            ]
        ],
        'allow_parallel_generation' => false
    ],
    'remote_storage' => [
        'driver' => 'file'
    ],
    'queue' => [
        'consumers_wait_for_messages' => 1
    ],
    'crypt' => [
        'key' => '05f8654d245daa638ee28bdb97d1929f'
    ],
    'db' => [
        'table_prefix' => '',
        'connection' => [
            'default' => [
                'host' => '172.17.0.1',
                'dbname' => 'magento2',
                'username' => 'magento2',
                'password' => 'magento2',
                'model' => 'mysql4',
                'engine' => 'innodb',
                'initStatements' => 'SET NAMES utf8;',
                'active' => '1',
                'driver_options' => [
                    1014 => false
                ]
            ]
        ]
    ],
    'resource' => [
        'default_setup' => [
            'connection' => 'default'
        ]
    ],
    'x-frame-options' => 'SAMEORIGIN',
    'MAGE_MODE' => 'developer',
    'session' => [
        'save' => 'files'
    ],
    'lock' => [
        'provider' => 'db'
    ],
    'directories' => [
        'document_root_is_pub' => true
    ],
    'cache_types' => [
        'config' => 1,
        'layout' => 1,
        'block_html' => 1,
        'collections' => 1,
        'reflection' => 1,
        'db_ddl' => 1,
        'compiled_config' => 1,
        'eav' => 1,
        'customer_notification' => 1,
        'config_integration' => 1,
        'config_integration_api' => 1,
        'full_page' => 1,
        'config_webservice' => 1,
        'translate' => 1
    ],
    'downloadable_domains' => [
        'local.magento.com'
    ],
    'install' => [
        'date' => 'Wed, 28 Jun 2023 00:13:11 +0000'
    ],
    'system' => [
        'default' => [
            'catalog' => [
                'search' => [
                    'elasticsearch7_server_hostname' => '172.17.0.1',
                    'elasticsearch7_server_port' => '9200',
                    'elasticsearch7_index_prefix' => 'magento2',
                    'elasticsearch7_enable_auth' => '0',
                    'elasticsearch7_server_timeout' => '15'
                ]
            ]
        ]
    ]
];
