<?php

use Axeldotdev\GraphqlDocs\Strategies\ModelStrategy;

return [
    /**
     * GraphQL Docs can be enabled or disabled.
     *
     * It is usefull if you don't want to activated it
     * on a certain environment for example.
     */
    'enabled' => env('GRAPHQL_DOCS_ENABLED', true),

    /**
     * The title in the meta attributes and
     * on the home page can be changed.
     *
     * When you are in a child page, a suffix will be added
     * depending on the selected strategy.
     */
    'name' => env('APP_NAME') . ' - GraphQL Docs',

    /**
     * The GraphQL Docs path can be changed to fit your need.
     *
     * By default, no one has access to the documentation.
     * But you can changed that behaviour within
     * the published service provider.
     */
    'path' => env('GRAPHQL_DOCS_PATH', 'docs/graphql'),

    /**
     * GraphQL Docs can be display in many ways with theme.
     * The default theme is beautiful and simple.
     *
     * Go to the package documentation to see
     * all the supported theme.
     *
     * If none of the themes orks for you, don't hesitate to
     * publish the package views and override it.
     * Or even better, send a PR and we'll see if your theme
     * can be implemented.
     */
    'theme' => [
        /**
         * The theme name is important, without it,
         * you will see nothing at all.
         *
         * It allow GraphQL Docs to find the right view files.
         */
        'name' => 'default',

        /**
         * GraphQL Docs also supports dark mode.
         */
        'dark_mode' => [
            /**
             * It can be disabled if you don't have a need for it.
             */
            'enabled' => true,

            /**
             * And you can also specify that it is the default behaviour.
             *
             * By default, the dark mode is displayed if the user
             * operating system is in dark mode, but you can changed that.
             */
            'default_on' => false,
        ],
    ],

    /**
     * To display your API Schema informations,
     * GraphQL Docs use strategies.
     *
     * It means that it follow some rules to parse and
     * display content of the schema.
     */
    'strategy' => [
        /**
         * By default, the modal strategy is used.
         * It will display types, inputs, mutations and
         * queries by models
         *
         * Go to the package documentation to see
         * all the supported strategies.
         */
        'name' => ModelStrategy::class,

        /**
         * GraphQL Docs let you choose what GraphQL types
         * you want to display in your documentation.
         */
        'types' => [
            'types' => true,
            'inputs' => true,
            'mutations' => true,
            'queries' => true,
        ],
    ],
];
