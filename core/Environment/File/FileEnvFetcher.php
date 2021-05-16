<?php

namespace Core\Environment\File;

use ArtARTs36\EnvEditor\Editor;
use Core\Environment\Contracts\EnvFetcher;
use Core\Environment\Contracts\Environment;
use Core\Environment\NullEnvironment;
use Core\FileSystem\Contracts\FileSystem;

final class FileEnvFetcher implements EnvFetcher
{
    private $fileSystem;

    public function __construct(FileSystem $fileSystem)
    {
        $this->fileSystem = $fileSystem;
    }

    public function fetch(string $path): Environment
    {
        if (! $this->fileSystem->exists($path)) {
            return new NullEnvironment();
        }

        return new FileEnvironmentAdapter(Editor::load($path));
    }
}
