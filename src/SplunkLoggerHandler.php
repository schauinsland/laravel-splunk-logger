<?php

namespace Schauinsland\SplunkLogger;

use Illuminate\Support\Facades\Http;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\LogRecord;

class SplunkLoggerHandler extends AbstractProcessingHandler
{
    public function write(LogRecord $record): void
    {
        $payload = [
            'event' => json_encode($record->toArray()),
            'source' => env('SPLUNK_SOURCE'),
            'index' => env('SPLUNK_INDEX'),
        ];

        Http::withHeaders([
            'Authorization' => 'Splunk ' . env('SPLUNK_TOKEN'),
        ])
            ->withOptions([
                'verify' => env('SPLUNK_VERIFY', false),
            ])->post(env('SPLUNK_URL'), $payload);
    }
}
