<?php

namespace UserAccount\Storage;

class FileStorage implements StorageInterface
{
    const FILENAME = __DIR__ . '/../../state-storage.txt';

    public function set(string $state)
    {
        file_put_contents(static::FILENAME, $state);
    }

    public function get(): ?string
    {
        if (!file_exists(static::FILENAME)) {
            return null;
        }

        return file_get_contents(static::FILENAME);
    }

    public function reset()
    {
        unlink(static::FILENAME);
    }
}
