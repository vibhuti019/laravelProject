<?php

namespace App\Http\Controllers;

use App\AppUser;
use App\Notification;
use Illuminate\Http\Request;
use DB;

class ContestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function upcoming_match()
    {   
        $limit = 30;
        $projections = ['_id','short_title','date_start','match_id'];
        $matches = DB::collection('matches')->where('status','1')->paginate($limit, $projections);;
        return view('contest.upcoming_matches',compact('matches'));
    }

    public function match_list()
    {   
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://www.rockingbravo.com/api/v1/contests/fetchUpcomingMatchesNew1",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $data1 = json_decode($response);
        $matches = $data1->data;

        return view('contest.match_list',compact('matches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function contest_list($id)
    {
        $limit = 30;
        $contests = DB::collection('contests')->where('filledSpots','>',0)->where('matchId', $id)->paginate();
        // $bank = DB::collection('user_banks')->where('userId',$id)->first();
        // dd($bank);
        return view('contest.upcoming_contest',compact('contests'));
    }

    public function contest_users($id)
    {
        $limit = 30;
        $contest_users = DB::collection('contest_users')->where('contestId',$id)->paginate();
        // $bank = DB::collection('user_banks')->where('userId',$id)->first();
        // dd($bank);
        return view('contest.contest_users',compact('contest_users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function match_announce()
    {
        $matches = DB::collection('matches')
        ->select('match_id','teamAnnounced','competition','short_title')
        ->where('status','1')
        ->where('teamAnnounced',1)
        // ->limit(1)
        ->get();
        foreach ($matches as $key_matches => $value_matches) {
            $notificationSent = DB::collection('notifications')
            ->where('matchId',$value_matches['match_id'])
            // ->limit(1)
            ->count();

            if($notificationSent == 0)
            {
                $title = "🏏 ".$value_matches['competition']['title'];
                $description = $value_matches['short_title'].": Team Announced. Create/Edit your team and Win Big💰";
                
                
                $notificationCreate = Notification::create(
                [
                    'title' => $title,
                    'description' => $description,
                    'type' => "teamAnnounced",
                    'matchId' => $value_matches['match_id']
                    // 'created_at' => date('Y-m-d H:i:s'),
                ]
                );


                // phpinfo();exit;
                // $projections = ['_id','title','description','created_at'];
                $fcmTokens = array();
                $users = DB::collection('users')->select('fcmToken','email')
                // ->where('email','hardiksurmahr@gmail.com')
                ->get();
                
                foreach ($users as $key => $value) {
                    if(isset($value['fcmToken']) && $value['fcmToken'] != "")
                    {
                        array_push($fcmTokens,$value['fcmToken']);
                    }
                }
                
                $users_chunk = array_chunk($fcmTokens,1000);

                foreach ($users_chunk as $key1 => $registration_ids) {
                    // $registration_ids = array("ftIdYojhVZc:APA91bEKFxYVSYcE1XFpHNyoLUpZJVz6pJYM8q0BkqAMMiP-8ueRQrj-ndegTPo09UZRmyZrBBCo7YJgrSQazdqfgIBMK2UmRchY2vQp7ANasbvexZ-oQOSEYZVph43iZVKhNFTObq4N","ftIdYojhVZc:APA91bEKFxYVSYcE1XFpHNyoLUpZJVz6pJYM8q0BkqAMMiP-8ueRQrj-ndegTPo09UZRmyZrBBCo7YJgrSQazdqfgIBMK2UmRchY2vQp7ANasbvexZ-oQOSEYZVph43iZVKhNFTObq4N");
                    
                    $notification = array(
                        'title' =>$title , 
                        'text' => $description, 
                        'sound' => 'default', 
                        'badge' => '1',
                        'image' => ''
                    );                
                    
                    $arrayToSend = array(
                        'registration_ids' => $registration_ids, 
                        // 'notification' => $notification,
                        'data' => $notification,
                        'priority'=>'high'
                    );
                    
                    // dd($arrayToSend);exit;
                    $headers = array(
                        'Authorization: key= AAAAvB0qCXs:APA91bEGi98zF0JdyI4rlk6dp5iBWQpDsim-WWWq6eJnGBgMGcYvoPCAPHB0aweO0bxL5hR3klfjBmdMonC1-C7PjrLUQjkafJJ_RIxUGXqxOsS9KyOb-B1J3dvZpxf9s4SziGLo5YRX' ,
                        'Content-Type: application/json'
                    );
                     
                    $ch = curl_init();
                    curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
                    curl_setopt( $ch,CURLOPT_POST, true );
                    curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
                    curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
                    curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
                    curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $arrayToSend ) );
                    $result = curl_exec($ch );
                    curl_close( $ch );
                    // echo $result . "\n\n";
                }
            }
        }     

    }    
}
