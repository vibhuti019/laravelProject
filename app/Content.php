<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Content extends Eloquent
{
  protected $collection = 'contents';

  protected $fillable = ['text','pageType'];
}
