<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class DynamicPrize extends Eloquent
{
  protected $collection = 'dynamic_prizes_collection';

  protected $fillable = ['defaultContestId','winners','totalUsers'];
}
