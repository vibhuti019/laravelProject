<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class DefaultContest extends Eloquent
{
  protected $collection = 'default_contests_collection';

  protected $fillable = ['title','pricePool','entryFees','totalWinners','totalSpots','maxSpotPerUser','isMultiSpot','prizeBreakup','dynamicPrice'];
}
