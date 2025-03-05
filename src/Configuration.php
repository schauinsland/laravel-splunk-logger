<?php

return [
    'splunk' => [
        'driver' => 'custom',
        'via' => \Schauinsland\SplunkLogger\SplunkLogger::class,
		'SPLUNK_URL' => env('SPLUNK_URL'),
		'SPLUNK_TOKEN' => env('SPLUNK_TOKEN'),
		'SPLUNK_INDEX' => env('SPLUNK_INDEX'),
		'SPLUNK_SOURCE' => env('SPLUNK_SOURCE', 'schauinsland/laravel-splunk-logger'),
		'SPLUNK_SSL_VERIFY' => env('SPLUNK_SSL_VERIFY', true),
    ]
];
