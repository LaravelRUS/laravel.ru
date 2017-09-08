<?php
/**
 * This file is part of Railt Laravel Adapter package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

use Railt\Adapters\Laravel\Controllers\GraphQLController;

return [
    /**
     *
     */
    'prefix'    => 'railt.',

    /**
     * Default endpoint
     */
    'default'   => 'default',

    /**
     *
     */
    'endpoints' => [
        /**
         * Configuration for application
         */
        'default' => [
            /**
             *
             */
            'enabled'    => true,

            /**
             * Root GraphQL schema file path
             */
            'schema'     => resource_path('graphql/schema.graphqls'),

            /**
             * Autoload schema paths
             *
             *  PSR-0 Autoloading:
             *      'path/to/directory/User.gql' for User type.
             * <code>
             *  'path/to/directory'
             * </code>
             *
             *  Custom loader:
             * <code>
             *  function (string $type): ?string {
             *      return ... // File path if found or null otherwise
             *  }
             * </code>
             */
            'autoload'   => [
                resource_path('graphql'),
                resource_path('graphql/models'),
                resource_path('graphql/common'),
            ],

            /**
             * Router file path
             */
            'router'     => base_path('routes/graphql.php'),

            /**
             *
             */
            'uri'        => '/api',

            /**
             *
             */
            'uses'       => GraphQLController::class . '@index',

            /**
             *
             */
            'middleware' => ['api'],

            /**
             *
             */
            'methods' => ['GET', 'POST', 'PUT', 'PATCH']
        ],
    ],

    /**
     *
     */
    'graphiql' => [
        [
            /**
             *
             */
            'enabled'  => env('APP_DEBUG', false),

            /**
             *
             */
            'endpoint' => 'default',

            /**
             *
             */
            'uri' => '/api/ui',

            /**
             *
             */
            'uses' => GraphQLController::class . '@graphiql',

            /**
             *
             */
            'middleware' => ['web'],
        ],
    ],
];
