<?php

namespace Itmcdev\Folium\Tests\Eloquent\Model;

require_once __DIR__ . '/Simple.php';
use Illuminate\Database\Eloquent\Model as Eloquent;
use Itmcdev\Folium\Tests\Eloquent\Model\Simple;

class Validated extends Simple
{
    /**
     * Obtain set of validation rules.
     *
     * @param array $keys Validate only a set of keys. Usable for update methods.
     * @return array
     */
    static function rules($keys = []) {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8'
        ];
        return $rules;
    }
 }