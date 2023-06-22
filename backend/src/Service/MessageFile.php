<?php

namespace App\Service;

class MessageFile
{
    public function store(string $message): void
    {
        $filePath = 'messages.txt';

        if (!is_writable($filePath)) {
            throw new \RuntimeException(sprintf('The file %s is not writable.', $filePath));
        }

        $file = fopen($filePath, 'ab');
        fwrite($file, $message . PHP_EOL);
        fclose($file);
    }
}