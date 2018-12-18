<?php

namespace Itmcdev\Folium\Illuminate\Tests\Model;

use Itmcdev\Folium\Illuminate\Tests\Model\Simple;

class Validated extends Simple
{
    /**
     * Obtain set of validation rules.
     *
     * @param array $keys Validate only a set of keys. Usable for update methods.
     * @return array
     */
    public static function rules($keys = [])
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8'
        ];
        return $rules;
    }
}
