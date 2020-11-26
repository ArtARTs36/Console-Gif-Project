<?php

namespace App\Http\Requests;

class SubmitRequest
{
    public function getStrings(): array
    {
        $values = post()->get('strings', null);

        if (empty($values)) {
            $values[] = 'Hello, World! Hello, World! Hello, World!';
        }

        return $values;
    }

    public function getWidthAndHeight(): array
    {
        $default = 450;

        $prepare = function ($value) use ($default) {
            $intValue = (int) $value;

            return $intValue === 0 ? $default : $intValue;
        };

        return [
            $prepare(post()->get('width', 450)),
            $prepare(post()->get('height', 450)),
        ];
    }

    public function getUser(): string
    {
        $user = post()->get('user');

        if (empty($user)) {
            return '';
        }

        return trim($user) . ' ';
    }
}
