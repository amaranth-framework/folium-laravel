<?php

namespace Itmcdev\Folium\Tests\Eloquent\Model;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Simple extends Eloquent
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

    // protected $primaryKey = 'id';

   /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
   protected $fillable = [
       'name', 'email', 'password', 'userimage'
   ];
   /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
   protected $hidden = [
       'password', 'remember_token',
   ];
 }