<?php
// Define the Logging interface
interface Logging {
    public function log($message);
}

// Concrete implementation of Logging that logs to a file
class FileLogging implements Logging {
    private $filePath;

    public function __construct($filePath) {
        $this->filePath = $filePath;
    }

    public function log($message) {
        file_put_contents($this->filePath, $message . PHP_EOL, FILE_APPEND);
    }
}

// Concrete implementation of Logging that logs to the console
class ConsoleLogging implements Logging {
    public function log($message) {
        echo $message . PHP_EOL;
    }
}

// Example usage
$fileLogging = new FileLogging('app.log');
$fileLogging->log('This is a log message to a file.');

$consoleLogging = new ConsoleLogging();
$consoleLogging->log('This is a log message to the console.');