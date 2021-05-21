<?php

namespace App\Http\Controllers;
ini_set('memory_limit', '-1');
ini_set('max_execution_time', 600);
set_time_limit(600);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
use App\AppUser;
use App\DefaultContest;
use App\DynamicPrize;
use App\DynamicPrizeBreakup;
use Illuminate\Http\Request;
use DB;

class DefaultContestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list_contest()
    {   
        $limit = 10;
        $projections = ['_id','pricePool','entryFees','totalSpots'];
        $contests = DB::collection('default_contests')->paginate($limit, $projections);;
        return view('contest.contest_list',compact('contests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view_contest($id)
    {
        $contest = DB::collection('contest_list')->where('_id', $id)->first();
        // dd($contest);
        return view('contest.view_contest',compact('contest'));
    }

    public function add_contest()
    {
        return view('contest.add_contest');
    }

    public function save_contest(Request $request)
    {
        // echo "hi";exit;
        $request->validate([
            'title' => 'required|max:255',
            'pricePool' => 'required',
            'entryFees' => 'required',
            'totalWinners' => 'required',
            'totalSpots' => 'required',
            'maxSpotPerUser' => 'required',
            'isMultiSpot' => 'required'
        ]);
        $prizeBreakup = [];
        $dynamicArray = [];
        $prizeBreakupNew = array();
        $dynamicArray3 = [];
        
        /*for($i=0;$i<count($request->rank_start);$i++)
        {
            if($request->rank_start[$i] != null && $request->percentage[$i] != null)
            {
                if($request->rank_end[$i] != null)
                {
                    $rank = $request->rank_start[$i].'-'.$request->rank_end[$i];
                }
                else
                {
                    $rank = $request->rank_start[$i];   
                }
                $prizeBreakup[] = array(
                    'rank' => $rank,
                    'percentage' => $request->percentage[$i].'%',
                    'currency' => 'INR'
                );  
            }

        }*/
        // echo "<pre>";
        // print_r($prizeBreakup);exit;
        $newArray = [];
        for ($j=0; $j < count($request->rank_start) ; $j++) { 
            if($request->rank_end[$j] != null)
            {
                for($k=$request->rank_start[$j];$k<=$request->rank_end[$j];$k++)
                {
                    $newArray[$k] = $request->percentage[$j];
                }
            }
            else
            {
                $newArray[$request->rank_start[$j]] = $request->percentage[$j];   
            }    
        }
        // echo "<pre>";
        // print_r($newArray);exit;
        $newArray2 = [];
        $newArray3 = [];
        $entryFees = $request->entryFees;
        // $l=2;
        $totalSpots = $request->totalSpots;
        for ($t=1000; $t >1 ; $t--) 
        { 
            // echo $t."<br>";
            $totalWinners = floor($t*0.7);
            $pricePool = ($t*$entryFees)*0.7;
            // echo $request->totalWinners;exit;
            if($request->totalWinners > $totalWinners)
            {
                for ($i=0; $i < $totalWinners ; $i++) { 
                    $percentage = 0;
                    for ($j=$i; $j < $request->totalWinners; $j = $j + $totalWinners) { 
                        $percentage = $percentage + $newArray[$j+1];
                    }
                    $newPrice = ($percentage*$pricePool)/100;
                    $newPrice = number_format((float)$newPrice, 2, '.', '');
                    $newArray2[] = array(
                        "rank"=>$i+1,
                        "price"=>$newPrice,
                        "currency"=>"INR"
                    );

                    $newArray3[$i+1] = floatval($newPrice);
                    // print_r($newArray3);
                }

            }else
            {
                // echo $t;
                // echo "<pre>";
                for ($m=0; $m < count($newArray); $m++) {
                    // echo $m;
                    $newPrice = ($pricePool*floatval($newArray[$m+1]))/100;
                    $newPrice = number_format((float)$newPrice, 2, '.', '');
                    $newArray2[] = array(
                        "rank"=>$m+1,
                        "price"=>$newPrice,
                        "currency"=>"INR"
                    );
                    $newArray3[$m+1] = $newPrice;
                    
                    /*if($request->rank_end[$m] != null)
                    {
                        for($k=($request->rank_start[$m]);$k<=$request->totalWinners;$k++)
                        {
                            // $newArray2[] = (integer)$newArray[$m+1];
                            $newArray2[] = array(
                                "rank"=>$m+1,
                                "price"=>(integer)$newArray[$m+1],
                                "currency"=>"INR"
                            );
                        }
                    }
                    else
                    {
                        $newArray2[] = array(
                            "rank"=>$m+1,
                            "price"=>(integer)$newArray[$m+1],
                            "currency"=>"INR"
                        );
                        // $newArray2[] =(integer)$newArray[$m+1]; 

                    }*/
                }
            }
            // echo "<pre>";
            /*array_push($dynamicArray,
                array
                (
                    "totalSpots"=>(integer)$t,
                    "priceBreakup"=>$newArray2
                )
            );*/
            array_push($prizeBreakupNew,
                array(
                    "priceBreakup"=>$newArray3,
                    "totalSpots"=>(integer)$t
                )
            );
            

            $newArray3 = [];
            $newArray2 = [];
            // dd($prizeBreakupNew);
            // exit;
        }            
             
        /*// return $newArray;
        $prizeBreakup = [];
        $totalSpots = $request->totalSpots;
        for ($i=0; $i < $totalSpots ; $i++) {
            if(array_key_exists($i, $newArray) == true)
            {
                $prizeBreakup[] = $newArray[$i];
            }
        }*/
        

        
        // print_r($dynamicArray[0]['priceBreakup']);exit;

        // exit;
        // dd($prizeBreakupNew);exit;
        $contest = DefaultContest::where('entryFees', "12")->count();
        if($contest == 0){
            $contestCreate = DefaultContest::create(
                [
                    'title' => $request->title,
                    'pricePool' => $request->pricePool,
                    'entryFees' => $request->entryFees,
                    'totalWinners' => $request->totalWinners,
                    'totalSpots' => $request->totalSpots,
                    'maxSpotPerUser' => $request->maxSpotPerUser,
                    'isMultiSpot' => $request->isMultiSpot,
                    // 'prizeBreakup' => $dynamicArray[0]['priceBreakup'],
                    // 'dynamicPrice' => $dynamicArray
                ]
            );

        }

        // print_r($contestCreate['_id']);exit;
/*
        foreach($dynamicArray as $dynamicArray2){
            $contestCreate1 = DynamicPrize::create(
                [
                    "defaultContestId" => "5e3c57639769c34c211a0cc2",
                    "totalUsers"=>$dynamicArray2['totalSpots'],
                    "winners"=>$dynamicArray2['priceBreakup'],
                ]
            );
        }
*/
        foreach($prizeBreakupNew as $dynamicArray3){
            $first_array = $dynamicArray3['priceBreakup'];
         // print_r($dynamicArray3);

            // $first_array = ['1'=>'a','2'=>'a','3'=>'a','4'=>'b','5'=>'b'];

            $flip = array();
            foreach($first_array as $key => $val) {
              $flip[strval($val)][] = $key;
            }

            $second_array = [];
            // echo "<pre>";
            foreach($flip as $key1 => $value1) {
                if(count($value1) == 1)
                {

                    $newKey = strval(end($value1));
                }
                else
                {
                    $newKey = array_shift($value1).' - '.end($value1);

                }

                // $second_array[$newKey] = $key1;
                $second_array[] = array(
                    'rank' => $newKey,
                    'price' => $key1,
                    'currency' => "INR"
                ); 
            }
            // print_r($second_array);
            $contest1 = DynamicPrizeBreakup::where('totalUsers', $dynamicArray3['totalSpots'])->where('defaultContestId','5e444647dbb4b273d94b6df2')->count();
            if($contest1 == 0){
                $contestCreate1 = DynamicPrizeBreakup::create(
                    [
                        "defaultContestId" => "5e444647dbb4b273d94b6df2",
                        "totalUsers"=>$dynamicArray3['totalSpots'],
                        "prizeBreakup"=>$second_array,
                    ]
                );
            }
            // echo "<pre>";
            // print_r($test);
        }

        // dd($contestCreate);exit;
        // return redirect('/list_contest')->with('success','Contest has been created');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AppUser  $appUser
     * @return \Illuminate\Http\Response
     */
    public function show(AppUser $appUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AppUser  $appUser
     * @return \Illuminate\Http\Response
     */
    public function edit(AppUser $appUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AppUser  $appUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AppUser $appUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AppUser  $appUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(AppUser $appUser)
    {
        //
    }
}
