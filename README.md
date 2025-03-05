# Laravel Splunk Logger

<!-- TOC -->
* [Laravel Splunk Logger](#laravel-splunk-logger)
  * [About](#about)
  * [Features](#features)
  * [Installation](#installation)
  * [Requirements](#requirements)
  * [Setup](#setup)
    * [Library Configuration](#library-configuration)
    * [Splunk Configuration](#splunk-configuration)
    * [Example .env](#example-env)
  * [Usage](#usage)
  * [Output Example](#output-example)
  * [Bug report or Feature request](#bug-report-or-feature-request)
  * [Want to Contribute?](#want-to-contribute)
  * [Code of Conduct](#code-of-conduct)
<!-- TOC -->

---

## About

A simple Splunk Logger package for Laravel that integrates seamlessly with Splunk's HTTP Event Collector (HEC). This package provides robust logging capabilities, enabling developers to capture and analyze application events in real-time with Splunk.

## Features

- **Native Logger Compatibility**:
Effortlessly use `Illuminate\Support\Facades\Log::class` to send logs directly to Splunk, keeping your existing logging syntax intact.

- **Automatic Integration with Laravel Logging System**:
The library automatically merges with Laravel's `config/logging.php`, eliminating the need for manual configuration. Simply add the necessary credentials in the `.env` file to get started.

- **Captures All Laravel Errors in Debug Mode**:
Automatically logs all Laravel exceptions and errors to Splunk when the application is in debug mode, providing comprehensive error insights during development.

## Installation

```bash
composer require schauinsland/laravel-splunk-logger
```

## Requirements

- **Laravel** >= 11
- **Splunk HEC**: Enabled instance

## Setup

Configure the following settings in your `.env` file:

### Library Configuration
- **LOG_CHANNEL**: Set to `splunk` or `stack` if you want multiple log drivers
- **LOG_STACK**: Comma-separated list of drivers (e.g., `single,splunk` for multiple log drivers)
- **LOG_LEVEL**: Defines the minimum severity level for logging. All errors and messages filtered by this setting will be sent to Splunk.

### Splunk Configuration
- **SPLUNK_URL**: URL of your Splunk HEC instance
- **SPLUNK_TOKEN**: Token for Splunk HEC authentication
- **SPLUNK_INDEX**: Target Splunk index for storing logs (must exist in Splunk)
- **SPLUNK_SOURCE**: Source identifier for the logs
- **SPLUNK_SSL_VERIFY**: Whether to send logs over HTTPS (`true`) or HTTP (`false`)

### Example .env

```dotenv
LOG_CHANNEL=stack
LOG_STACK=single,splunk
LOG_LEVEL=debug

SPLUNK_URL=<protocol>://<host>:<port>/services/collector
SPLUNK_TOKEN=...
SPLUNK_INDEX=index_test
SPLUNK_SOURCE=source_test
SPLUNK_SSL_VERIFY=true
```

## Usage

```php
Log::channel('splunk')->info('Custom Log Info referring explicit splunk');

Log::error(
    'This is a custom Error',
    ['user_id' => 1, 'name' => 'John Doe', 'email' => 'john@doe.com', 'is_admin' => false]
);

try {
    DB::table('non_existent_table')->get();
} catch (\Exception $e) {
    Log::error('Error with Trace', [
        'message' => $e->getMessage(),
        'stack' => $e->getTraceAsString(),
    ]);
}
```

For more custom logging options, refer to the [Laravel Logging Documentation](https://laravel.com/docs/11.x/logging#writing-log-messages).

## Output Example
```json
{
  "message":"This is a custom Error",
  "context": {
    "user_id":1,
    "name":"John Doe",
    "email":"john@doe.com",
    "is_admin":false
  },
  "level":400,
  "level_name":"ERROR",
  "channel":"Laravel",
  "datetime":"2025-03-05T11:35:46.111298+00:00",
  "extra":[]
}
```

## Bug report or Feature request

If you encounter a bug or have a feature request, please [create an issue](https://github.com/schauinsland/laravel-splunk-logger/issues).

## Want to Contribute?

Refer to [CONTRIBUTING.md](./docs/CONTRIBUTING.md).

## Code of Conduct

Before contributing to this repository, please read the [code of conduct](./docs/CODE_OF_CONDUCT.md).
