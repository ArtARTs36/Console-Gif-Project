<?php

namespace Core\View;

use Core\FileSystem\Contracts\FileSystem;
use Core\Lang\Language;
use Core\View\Contracts\Viewer;

class RegexViewer implements Viewer
{
    protected $dir;

    protected $files;

    protected $lang;

    public function __construct(RegexViewerDir $dir, FileSystem $files, Language $language)
    {
        $this->dir = $dir;
        $this->files = $files;
        $this->lang = $language;
    }

    public function render(string $template, array $attributes = []): string
    {
        $attributes = array_merge($attributes, [
            'lang' => $this->lang->all(),
        ]);

        $template = $this->files->get($this->path($template));

        $template = $this->prepareInclude($template, $attributes);

        $template = $this->preparedArrayableAttributes($template, $attributes);

        //

        $keys = $this->prepareAttributesKeys($attributes);

        return str_replace($keys, array_values($attributes), $template);
    }

    protected function path(string $template): string
    {
        return $this->dir . DIRECTORY_SEPARATOR . $template . '.tpl';
    }

    protected function preparedArrayableAttributes(string $content, array &$attributes): string
    {
        $arrayable = array_filter($attributes, 'is_array');

        $keys = array_keys($arrayable);

        foreach ($keys as $key) {
            unset($attributes[$key]);
        }

        foreach ($arrayable as $key => $values) {
            foreach ($values as $index => $value) {
                $attributes[$key . '_' . $index] = $value;
            }
        }

        return $content;
    }

    protected function prepareAttributesKeys(array $attributes): array
    {
        return array_map(function (string $attribute) {
            return "{{ $attribute }}";
        }, array_keys($attributes));
    }

    protected function prepareInclude(string $content, array $attributes): string
    {
        $matches = [];

        preg_match_all("/{{ include\('(.*)'\) }}/mi", $content, $matches);

        if (count($matches) === 2) {
            foreach ($matches[0] as $index => $code) {
                if (empty($matches[1][$index])) {
                    continue;
                }

                $file = $matches[1][$index];

                $content = str_replace($code, $this->render($file, $attributes), $content);
            }
        }

        return $content;
    }
}
