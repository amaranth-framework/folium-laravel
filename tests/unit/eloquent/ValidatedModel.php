<?php

namespace Itmcdev\Folium\Tests\Crud\Eloquent;

use Illuminate\Database\Eloquent\Model as Eloquent;

class ValidatedModel extends Eloquent
{

    static function rules($id = null) {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8'
        ];
        return $rules;
    }

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