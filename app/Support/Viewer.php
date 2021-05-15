<?php

namespace App\Support;

class Viewer
{
    public function render(string $template, array $attributes = []): string
    {
        $template = file_get_contents(view_path($template));

        $template = static::prepareInclude($template, $attributes);

        if ($attributes) {
            $template = static::preparedArrayableAttributes($template, $attributes);
        }

        //

        $keys = static::prepareAttributesKeys($attributes);

        return str_replace($keys, array_values($attributes), $template);
    }

    protected static function preparedArrayableAttributes(string $content, array &$attributes): string
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

    protected static function prepareAttributesKeys(array $attributes): array
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
