<?php

namespace KABBOUCHI\LaravelVercel;

use Illuminate\Support\ServiceProvider;

class LaravelVercelServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../stubs/' => base_path(),
            ], 'laravel-vercel-stubs');
        }

        if (env('AWS_LAMBDA_FUNCTION_VERSION')) {
            $view = config('view.compiled');
            foreach ([$view] as $path) {
                if (!is_dir($path)) {
                    mkdir($path, 0755, true);
                }
            }
        }
    }
}
