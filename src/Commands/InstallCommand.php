<?php

namespace Axeldotdev\GraphqlDocs\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class InstallCommand extends Command
{
    public $signature = 'graphql-docs:install';

    public $description = 'Install the package in one command.';

    public function handle(): int
    {
        // $this->comment('Publishing GraphQL Docs Service Provider...');
        // $this->callSilent('vendor:publish', ['--tag' => 'graphql-docs-provider']);

        // $this->comment('Publishing GraphQL Docs Assets...');
        // $this->callSilent('vendor:publish', ['--tag' => 'graphql-docs-assets']);

        $this->comment('Publishing GraphQL Docs Configuration...');
        $this->callSilent('vendor:publish', ['--tag' => 'graphql-docs-config']);

        $this->comment('Publishing Laravel Markdown Configuration...');
        $this->callSilent('vendor:publish', [
            '--provider' => 'Spatie\LaravelMarkdown\LaravelMarkdownBladeComponentServiceProvider',
            '--tag' => 'markdown-config',
        ]);

        if (! Str::contains(file_get_contents(base_path('routes/web.php')), 'Route::graphqlDocs()')) {
            (new Filesystem())->append(base_path('routes/web.php'), $this->graphqlDocsRouteDefinition());
        }

        $this->registerGraphqlDocsServiceProvider();

        return Command::SUCCESS;
    }

    /**
     * Get the route definition(s) that should be installed for GraphQL Docs.
     *
     * @return string
     */
    protected function graphqlDocsRouteDefinition(): string
    {
        return <<<'EOF'
Route::graphqlDocs();
EOF;
    }

    protected function registerGraphqlDocsServiceProvider(): void
    {
        $namespace = Str::replaceLast('\\', '', $this->laravel->getNamespace());

        $app_config = file_get_contents(config_path('app.php'));

        if (Str::contains($app_config, $namespace . '\\Providers\\GraphqlDocsServiceProvider::class')) {
            return;
        }

        $line_ending_count = [
            "\r\n" => substr_count($app_config, "\r\n"),
            "\r" => substr_count($app_config, "\r"),
            "\n" => substr_count($app_config, "\n"),
        ];

        $eol = array_keys($line_ending_count, max($line_ending_count))[0];

        file_put_contents(config_path('app.php'), str_replace(
            "{$namespace}\\Providers\RouteServiceProvider::class," . $eol,
            "{$namespace}\\Providers\RouteServiceProvider::class," . $eol . "        {$namespace}\Providers\GraphqlDocsServiceProvider::class," . $eol,
            $app_config
        ));

        file_put_contents(app_path('Providers/GraphqlDocsServiceProvider.php'), str_replace(
            "namespace App\Providers;",
            "namespace {$namespace}\Providers;",
            file_get_contents(app_path('Providers/GraphqlDocsServiceProvider.php'))
        ));
    }
}
