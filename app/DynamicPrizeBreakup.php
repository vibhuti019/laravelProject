<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class DynamicPrizeBreakup extends Eloquent
{
  protected $collection = 'dynamic_prize_breakups_collection';

  protected $fillable = ['defaultContestId','totalUsers','prizeBreakup'];
}
