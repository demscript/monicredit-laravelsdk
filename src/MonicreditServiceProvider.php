<?php

namespace Demscript\Monicredit;

use Illuminate\Support\ServiceProvider;

class MonicreditServiceProvider extends ServiceProvider
{
    public $path;

    protected $defer = false;

    public function __construct($app)
    {
        $this->path = dirname(__DIR__) . '/config/monicredit.php';

        parent::__construct($app);
    }

    public function register()
    {
        $this->mergeConfigFrom($this->path, 'monicredit');

        $this->app->bind('lazerpay', function () {
            return new Monicredit;
        });
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                $this->path => config_path('monicredit.php'),
            ], 'monicredit');
        }
    }

    public function provides(): array
    {
        return ['monicredit'];
    }
}
