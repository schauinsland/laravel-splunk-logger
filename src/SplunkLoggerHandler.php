<?php

namespace Schauinsland\SplunkLogger;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\LogRecord;

class SplunkLoggerHandler extends AbstractProcessingHandler
{
    public function write(LogRecord $record): void
    {
		$splunkConfiguration = 	Config::get('logging.channels.splunk');

        $payload = [
            'event' => json_encode($record->toArray()),
            'source' => $splunkConfiguration['SPLUNK_SOURCE'],
            'index' => $splunkConfiguration['SPLUNK_INDEX'],
        ];

        Http::withHeaders([
            'Authorization' => 'Splunk ' . $splunkConfiguration['SPLUNK_TOKEN'],
        ])
            ->withOptions([
                'verify' => $splunkConfiguration['SPLUNK_VERIFY'],
            ])->post($splunkConfiguration['SPLUNK_URL'], $payload);
    }
}
