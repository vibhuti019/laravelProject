<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Match extends Eloquent
{
  protected $collection = 'matches';

  protected $fillable = ['manOfTheMatch'];
}
