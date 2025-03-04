<?php

namespace Schauinsland\SplunkLogger;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    private string $configPath = '/Configuration.php';

    public function boot(): void
    {
        $this->loadSplunkConfig();
    }

    private function loadSplunkConfig(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . $this->configPath,
            'logging.channels'
        );
    }
}
