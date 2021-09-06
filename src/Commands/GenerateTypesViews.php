<?php

namespace Axeldotdev\GraphqlDocs\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Axeldotdev\GraphqlDocs\GraphqlDocs;

class GenerateTypesViews extends Command
{
    public $signature = 'graphql-docs:generate-types-views';

    public $description = 'Generate view files for your types, it will help you write some human readable content for your documentation.';

    public Filesystem $filesystem;

    public string $path;

    public function __construct(Filesystem $filesystem)
    {
        parent::__construct();

        $this->filesystem = $filesystem;
        $this->path = resource_path('/views/vendor/axeldotdev/graphql-docs');
    }

    public function handle(): int
    {
        $this->generateViews();

        GraphqlDocs::strategy()->models->each(function (string $model) {
            $this->generateViews($model);
        });

        return Command::SUCCESS;
    }

    public function generateViews(?string $model = null): void
    {
        if (! $this->filesystem->exists($this->path)) {
            $this->filesystem->makeDirectory($this->path);
        }

        if ($model === null) {
            $this->generateMainView();

            return;
        }

        $this->generateModelViews($model);
    }

    public function generateMainView(): void
    {
        $this->filesystem->copy(
            $this->stubPath(),
            sprintf('%s/index.blade.php', $this->path)
        );
    }

    public function generateModelViews(string $model): void
    {
        $model_class = $this->modelClass($model);
        $path = $this->path . '/' . $model_class;

        if (! $this->filesystem->exists($this->path . '/' . $model_class)) {
            $this->filesystem->makeDirectory($this->path . '/' . $model_class);
        }

        $types = collect(config('graphql-docs.strategy.types'))
            ->filter()
            ->each(function (bool $status, string $type) use ($model, $path) {
                $this->filesystem->copy(
                    $this->stubPath(),
                    sprintf('%s/before-%s.blade.php', $path, $type)
                );
                $this->filesystem->copy(
                    $this->stubPath(),
                    sprintf('%s/after-%s.blade.php', $path, $type)
                );
            });
    }

    public function modelClass(string $model): string
    {
        $parts = explode('\\', $model);

        return Str::lower(end($parts));
    }

    public function stubPath(): string
    {
        return dirname(dirname(dirname(__DIR__))) . '/stubs/views/content.blade.php';
    }
}
