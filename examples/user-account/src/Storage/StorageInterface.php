<?php

namespace UserAccount\Storage;

interface StorageInterface
{
    public function set(string $state);

    public function get(): ? string;

    public function reset();
}
