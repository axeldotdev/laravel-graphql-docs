<?php

namespace Axeldotdev\GraphqlDocs;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class GraphqlDocsApplicationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->authorization();
    }

    /**
     * Configure the GraphQL Docs authorization services.
     *
     * @return void
     */
    protected function authorization(): void
    {
        $this->gate();

        GraphqlDocs::auth(function ($request) {
            return app()->environment('local') ||
                   Gate::check('viewGraphqlDocs', [$request->user()]);
        });
    }

    /**
     * Register the GraphQL Docs gate.
     *
     * This gate determines who can access GraphQL Docs in non-local environments.
     *
     * @return void
     */
    protected function gate(): void
    {
        Gate::define('viewGraphqlDocs', function ($user) {
            return false;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {

    }
}
