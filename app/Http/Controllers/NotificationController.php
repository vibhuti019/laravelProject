<?php
namespace App\Http\Controllers;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
use App\AppUser;
use App\Notification;
use App\DefaultContest;
use App\DynamicPrize;
use App\DynamicPrizeBreakup;
use Illuminate\Http\Request;
use DB;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list_notifications()
    {   
        // echo "hi";exit;
        $limit = 20;
        $projections = ['_id','title','image','description','created_at'];
        $notifications = DB::collection('notifications')
        ->where('type','!=','teamAnnounced')
        ->orderBy('created_at', 'desc')
        ->paginate($limit, $projections);
        return view('notifications.list',compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function send_notifications(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
       
        if(isset($request->image))
        {
            $imageName = time().'.'.$request->image->extension();  
       
            $request->image->move(public_path('images'), $imageName);

        }
        else
        {
            $imageName = "";
        }


        // exit;

        $notificationCreate = Notification::create(
        [
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageName
            // 'created_at' => date('Y-m-d H:i:s'),
        ]
        );


        // phpinfo();exit;
        // $projections = ['_id','title','description','created_at'];
        $fcmTokens = array();
        $users = DB::collection('users')->select('fcmToken','email')
       /* ->where('email','meetdhruve9550@gmail.com')
        ->orWhere('email','abshah37@gmail.com')
        ->orWhere('email','hardiksurmahr@gmail.com')*/
        // ->where_or('email','meetdhruve9550@gmail.com')
        ->get();
        // dd($users);
        // exit;
        foreach ($users as $key => $value) {
            if(isset($value['fcmToken']) && $value['fcmToken'] != "")
            {
                array_push($fcmTokens,$value['fcmToken']);
            }
        }
        
        $users_chunk = array_chunk($fcmTokens,1000);

        foreach ($users_chunk as $key1 => $registration_ids) {
            // $registration_ids = array("ftIdYojhVZc:APA91bEKFxYVSYcE1XFpHNyoLUpZJVz6pJYM8q0BkqAMMiP-8ueRQrj-ndegTPo09UZRmyZrBBCo7YJgrSQazdqfgIBMK2UmRchY2vQp7ANasbvexZ-oQOSEYZVph43iZVKhNFTObq4N","ftIdYojhVZc:APA91bEKFxYVSYcE1XFpHNyoLUpZJVz6pJYM8q0BkqAMMiP-8ueRQrj-ndegTPo09UZRmyZrBBCo7YJgrSQazdqfgIBMK2UmRchY2vQp7ANasbvexZ-oQOSEYZVph43iZVKhNFTObq4N");
            if(isset($request->image))
            {
                $notification = array(
                    'title' =>$request->title , 
                    'text' => $request->description, 
                    'sound' => 'default', 
                    'badge' => '1',
                    'image' => 'http://admin.rockingbravo.com/images/'.$imageName
                );

            }
            else
            {
                $notification = array(
                    'title' =>$request->title , 
                    'text' => $request->description, 
                    'sound' => 'default', 
                    'badge' => '1',
                    'image' => ''
                );                
            }
            $arrayToSend = array(
                'registration_ids' => $registration_ids, 
                // 'notification' => $notification,
                'data' => $notification,
                'priority'=>'high'
            );
            

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
        return redirect('/list_notifications')->with('success','Notifications Sent Successfully');

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
