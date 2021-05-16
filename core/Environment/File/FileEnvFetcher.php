<?php

namespace Core\Environment\File;

use ArtARTs36\EnvEditor\Editor;
use Core\Environment\Contracts\EnvFetcher;
use Core\Environment\Contracts\Environment;
use Core\Environment\NullEnvironment;

class FileEnvFetcher implements EnvFetcher
{
    public function fetch(string $path): Environment
    {
        if (! file_exists($path)) {
            return new NullEnvironment();
        }

        return new FileEnvironmentAdapter(Editor::load($path));
    }
}
