<?php

namespace Schauinsland\SplunkLogger;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
	private string $configPath = '/Configuration.php';

	public function boot(): void
	{
		$this->publishes(
			[__DIR__ . $this->configPath => config_path('laravel-splunk-logger.php')],
		);

		$this->mergeSplunkConfig();
	}

	private function mergeSplunkConfig(): void
	{
		if (config('laravel-splunk-logger')) {
			return;
		}

		$this->mergeConfigFrom(
			__DIR__ . $this->configPath,
			'logging.channels'
		);
	}
}
