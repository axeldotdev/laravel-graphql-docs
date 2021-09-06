<?php

namespace Axeldotdev\GraphqlDocs;

use Spatie\LaravelPackageTools\Package;
use Axeldotdev\GraphqlDocs\Commands\InstallCommand;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Axeldotdev\GraphqlDocs\Commands\GenerateTypesViews;

class GraphqlDocsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('graphql-docs')
            ->hasConfigFile()
            ->hasTranslations()
            ->hasViews()
            ->hasCommands(
                InstallCommand::class,
                GenerateTypesViews::class,
            );
    }

    public function packageBooted(): void
    {
        GraphqlDocs::routes();
    }
}
