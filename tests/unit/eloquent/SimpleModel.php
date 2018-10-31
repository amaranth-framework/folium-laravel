<?php

namespace Itmcdev\Folium\Tests\Crud\Eloquent;

use Illuminate\Database\Eloquent\Model as Eloquent;

class SimpleModel extends Eloquent
{
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