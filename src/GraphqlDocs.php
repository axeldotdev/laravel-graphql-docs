<?php

namespace Axeldotdev\GraphqlDocs;

use Axeldotdev\GraphqlDocs\Strategies\Strategy;
use Closure;
use Illuminate\Support\Facades\Route;

class GraphqlDocs
{
    /**
     * The callback that should be used to authenticate Horizon users.
     *
     * @var \Closure
     */
    public static $authUsing;

    /**
     * Determine if the given request can access the Horizon dashboard.
     *
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    public static function check($request)
    {
        return (static::$authUsing ?: function () {
            return app()->environment('local');
        })($request);
    }

    /**
     * Set the callback that should be used to authenticate Horizon users.
     *
     * @param \Closure $callback
     * @return static
     */
    public static function auth(Closure $callback)
    {
        static::$authUsing = $callback;

        return new static();
    }

    /**
     * Define the route for GraphQL Docs.
     *
     * @return void
     */
    public static function routes()
    {
        Route::macro('graphqlDocs', function (string $url = '') {
            $path = config('graphql-docs.routes.path');

            Route::get("{$url}/{$path}", fn () => 'ok')
                ->name('graphql-docs.index');

            $strategy = config('graphql-docs.strategy');
            $strategy::routes();
        });
    }

    /**
     * Set the chosen strategy.
     *
     * @return \Axeldotdev\GraphqlDocs\Strategies\Strategy
     */
    public static function strategy(): Strategy
    {
        $strategy = config('graphql-docs.strategy.name');

        return new $strategy();
    }
}
