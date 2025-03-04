<?php

namespace Schauinsland\SplunkLogger;

use Monolog\Logger;

class SplunkLogger
{
    public function __invoke(array $config): Logger
    {
        return new Logger(
            env('APP_NAME'),
            [
                new SplunkLoggerHandler(),
            ]
        );
    }
}
