<?php

namespace App\Http\Controllers;

use App\AppUser;
use App\Match;
use App\Contents;
use Illuminate\Http\Request;
use DB;

class ManOfTheMatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list_matches()
    {   
        $projections = ['_id','match_id','title','squads'];
        $matches = DB::collection('matches')
            ->where('mom',0)
            ->where('status', '2')
            ->get($projections);
        // dd($matches);
        return view('mom.mom',compact('matches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function add_mom(Request $request)
    {
        // dd($request->all());
        $projections = ['_id','playerInfo'];
        $players = DB::collection('players')
            ->where('pid',$request->pid)
            // ->where('mid',$mid)
            ->first($projections);
        $player_name = $players['playerInfo']['player']['title'];
        DB::collection('matches')->where('match_id',$request->mid)
            ->update(['mom'=>$request->pid], ['upsert' => true]);

        DB::collection('match_scores')->where('matchId',$request->mid)
            ->update(['mom'=>$player_name], ['upsert' => true]);

        // dd($request->all());exit;
        return redirect('/list_matches')->with('success','ManOfTheMatch has been Added');

    }

    public function add_aboutus(Request $request)
    {
        $projections = ['_id','text','pageType'];
        $content = DB::collection('contents')
            ->where('pageType','about')
            // ->where('mid',$mid)
            ->first($projections);
            // dd($content);
        return view('contents.contents',compact('content'));
    }

    public function howtoplay(Request $request)
    {
        $projections = ['_id','text','pageType'];
        $content = DB::collection('contents')
            ->where('pageType','howtoplay')
            // ->where('mid',$mid)
            ->first($projections);
            // dd($content);
        return view('contents.contents',compact('content'));
    }

    public function helpdesk(Request $request)
    {
        $projections = ['_id','text','pageType'];
        $content = DB::collection('contents')
            ->where('pageType','helpdesk')
            // ->where('mid',$mid)
            ->first($projections);
            // dd($content);
        return view('contents.contents',compact('content'));
    }

    public function legality(Request $request)
    {
        $projections = ['_id','text','pageType'];
        $content = DB::collection('contents')
            ->where('pageType','legality')
            // ->where('mid',$mid)
            ->first($projections);
            // dd($content);
        return view('contents.contents',compact('content'));
    }

    public function referralSystem(Request $request)
    {
        $projections = ['_id','text','pageType'];
        $content = DB::collection('contents')
            ->where('pageType','referralSystem')
            // ->where('mid',$mid)
            ->first($projections);
            // dd($content);
        return view('contents.contents',compact('content'));
    }

    public function pointSystem(Request $request)
    {
        $projections = ['_id','text','pageType'];
        $content = DB::collection('contents')
            ->where('pageType','pointSystem')
            // ->where('mid',$mid)
            ->first($projections);
            // dd($content);
        return view('contents.contents',compact('content'));
    }

    public function terms(Request $request)
    {
        $projections = ['_id','text','pageType'];
        $content = DB::collection('contents')
            ->where('pageType','terms')
            // ->where('mid',$mid)
            ->first($projections);
            // dd($content);
        return view('contents.contents',compact('content'));
    }

    public function pointSystemNew(Request $request)
    {
        return view('contents.pointSystem');
    }

    public function add_content(Request $request)
    {
        // return $request->all();
        DB::collection('contents')
            ->where('pageType',$request->pageType)
            ->update(['text'=>$request->text], ['upsert' => true]);

        if($request->pageType == 'about')
        {
            return redirect('/add_aboutus')->with('success','Updated');

        }
        else if($request->pageType == 'howtoplay')
        {
            return redirect('/howtoplay')->with('success','Updated');

        }
        else if($request->pageType == 'helpdesk')
        {
            return redirect('/helpdesk')->with('success','Updated');
            
        }
        else if($request->pageType == 'legality')
        {
            return redirect('/legality')->with('success','Updated');
            
        }
        else if($request->pageType == 'referralSystem')
        {
            return redirect('/referralSystem')->with('success','Updated');
            
        }
        else if($request->pageType == 'pointSystem')
        {
            return redirect('/pointSystem')->with('success','Updated');
        }
        else if($request->pageType == 'terms')
        {
            return redirect('/terms')->with('success','Updated');
        }

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
