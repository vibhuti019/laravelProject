<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Notification extends Eloquent
{
  protected $collection = 'notifications';

  protected $fillable = ['title','description','created_at','image','type','matchId'];
}