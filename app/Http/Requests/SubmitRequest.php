<?php

namespace App\Http\Requests;

use Core\Http\Request;

class SubmitRequest
{
    protected $parent;

    public function __construct(Request $request)
    {
        $this->parent = $request;
    }

    public function getStrings(): array
    {
        $values = $this->parent->get('strings', null);

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
            $prepare($this->parent->get('width', 450)),
            $prepare($this->parent->get('height', 450)),
        ];
    }

    public function getUser(): string
    {
        $user = $this->parent->get('user');

        if (empty($user)) {
            return '';
        }

        return trim($user) . ' ';
    }
}
