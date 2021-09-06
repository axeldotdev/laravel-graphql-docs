# This is my package laravel-graphql-docs

[![Latest Version on Packagist](https://img.shields.io/packagist/v/axeldotdev/laravel-graphql-docs.svg?style=flat-square)](https://packagist.org/packages/axeldotdev/laravel-graphql-docs)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/axeldotdev/laravel-graphql-docs/run-tests?label=tests)](https://github.com/axeldotdev/laravel-graphql-docs/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/axeldotdev/laravel-graphql-docs/Check%20&%20fix%20styling?label=code%20style)](https://github.com/axeldotdev/laravel-graphql-docs/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/axeldotdev/laravel-graphql-docs.svg?style=flat-square)](https://packagist.org/packages/axeldotdev/laravel-graphql-docs)

GraphQL Docs is a package that help you create a beautiful documentation for you API.

## Installation

You can install the package via composer:

```bash
composer require axeldotdev/laravel-graphql-docs
```

You can install and publish the needed files with:

```bash
php artisan graphql-docs:install
```

You can also generate files that will help you write human readable content for you documentation:

```bash
php artisan graphql-docs:generate-types-views
```

This is the contents of the published config file:

```php
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
     *
     * By default, the modal strategy is used.
     * It will display types, inputs, mutations and
     * queries by models
     *
     * Go to the package documentation to see
     * all the supported strategies.
     */
    'strategy' => ModelStrategy::class,
];
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Axel Charpentier](https://github.com/axeldotdev)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
