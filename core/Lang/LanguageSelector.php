<?php

namespace Core\Lang;

use Core\FileSystem\Contracts\FileSystem;
use Core\Http\Request;

class LanguageSelector
{
    protected $dir;

    protected $files;

    protected $defaultLocale;

    public function __construct(string $dir, string $defaultLocale, FileSystem $files)
    {
        $this->dir = $dir;
        $this->defaultLocale = $defaultLocale;
        $this->files = $files;
    }

    public function select(Request $request): Language
    {
        $locale = $this->defaultLocale;

        if ($this->has($request->locale())) {
            $locale = $request->locale();
        } elseif ($request->cookie('selected_language') && $this->has($request->cookie('selected_language'))) {
            $locale = $request->cookie('selected_language');
        }

        return new Language($locale, $this->load($locale));
    }

    public function has(string $locale): bool
    {
        return $this->files->exists($this->path($locale));
    }

    protected function load(string $locale): array
    {
        return include $this->path($locale);
    }

    protected function path(string $locale): string
    {
        return $this->dir . DIRECTORY_SEPARATOR . $locale . '.lng.php';
    }
}
