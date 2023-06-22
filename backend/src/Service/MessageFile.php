<?php

namespace App\Service;

class MessageFile
{
    private const FILE_PATH = 'messages.txt';

    public function store(string $message): void
    {
        if (!file_exists(self::FILE_PATH)) {
            touch(self::FILE_PATH);
        }

        if (!is_writable(self::FILE_PATH)) {
            throw new \RuntimeException(sprintf('The file %s is not writable.', self::FILE_PATH));
        }

        $file = @fopen(self::FILE_PATH, 'ab');

        if (!$file) {
            throw new \RuntimeException(sprintf('The file %s could not be opened.', self::FILE_PATH));
        }

        $writeResult = @fwrite($file, $message . PHP_EOL);

        if ($writeResult === false) {
            throw new \RuntimeException(sprintf('The file %s could not be written to.', self::FILE_PATH));
        }

        @fclose($file);
    }
}
