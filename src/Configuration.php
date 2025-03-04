<?php

return [
    'splunk' => [
        'driver' => 'custom',
        'via' => \Schauinsland\SplunkLogger\SplunkLogger::class,
    ]
];
