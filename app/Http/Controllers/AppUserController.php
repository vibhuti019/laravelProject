<?php

namespace App\Http\Controllers;

use App\AppUser;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Carbon\Carbon;
use Response;
use MongoDB\BSON\Decimal128;
use MongoDB\BSON\UTCDateTime;

class AppUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function new_users()
    {   
        return view('users.new_users');
    }

    public function new_users_ajax()
    {
        $limit = 30;
            
        $data = DB::collection('users')
        ->select('_id','email','fullName','loginVia')
        ->where('pancardStatus',"pending")
        ->where('documentStatus',"pending")
        ->get();
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                       $btn = '<a href="/view_user/'.$row["_id"].'" class="btn btn-primary btn-xs">View</a>';
 
                        return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function rejected_users()
    {   
        return view('users.reject_users');
    }

    public function rejected_users_ajax()
    {
        $limit = 30;
            
        $data = DB::collection('users')
        ->select('_id','email','fullName','loginVia')
        ->where('pancardStatus',"reject")
        ->where('documentStatus',"reject")
        ->get();
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                       $btn = '<a href="/view_user/'.$row["_id"].'" class="btn btn-primary btn-xs">View</a>';
 
                        return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function unverified_bank_details()
    {   
        return view('users.unverified_bank');
    }

    public function unverified_bank_details_ajax()
    {
        $limit = 30;
            
        $data = DB::collection('user_banks')->where('status',"inprogress")->get();

        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                       $btn = '<a href="/view_user/'.$row["userId"].'" class="btn btn-primary btn-xs">View</a>';
 
                        return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }

     public function rejected_bank_details()
    {   
        return view('users.rejected_bank');
    }

    public function rejected_bank_details_ajax()
    {
        $limit = 30;
            
        $data = DB::collection('user_banks')->where('status',"reject")->get();

        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                       $btn = '<a href="/view_user/'.$row["userId"].'" class="btn btn-primary btn-xs">View</a>';
 
                        return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function user_referral()
    {   
        return view('users.user_referral');
    }

    public function user_referral_ajax()
    {
        $limit = 30;
        $i = 0;
        $data = DB::collection('users')->select('_id','email','fullName','phone','referralCode','level')->get();
        $data = $data->map(function ($object) {
            $data1 = DB::collection('users')->select('_id','email','fullName','phone','referralCode','level')->where('referBy',$object['referralCode'])->count();
            // Add the new property
            $object['level'] = $data1;

            // Return the new object
            return $object;

        });
        /*foreach ($data as $value) {

            $data1 = DB::collection('users')->select('_id','email','fullName','phone','referralCode','level')->where('referBy',$value['referralCode'])->count();
            // print_r($data1);
            $data[$i]['level'] = $data1;
            $i++;
        }*/
        // echo "<pre>";
        // print_r($data);exit;
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                       $btn = '<a href="/view_user/'.$row["_id"].'" class="btn btn-primary btn-xs">View</a>';
 
                        return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function user_referral_list_ajax(Request $request)
    {
        $limit = 30;
        $i = 0;
        $data = DB::collection('users')->select('_id','email','fullName','phone','referralCode')->where('referBy',$request->referralCode)->get();
        
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                       $btn = '<a href="/view_user/'.$row["_id"].'" class="btn btn-primary btn-xs">View</a>';
 
                        return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function unverified_users()
    {   
        return view('users.unverified_users');
    }

    public function unverified_users_ajax()
    {
        $limit = 30;
            
        $data = DB::collection('users')->select('_id','email','fullName','loginVia')
        ->where('pancardStatus',"inprogress")
        ->orWhere('documentStatus',"inprogress")
        ->get();
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                       $btn = '<a href="/view_user/'.$row["_id"].'" class="btn btn-primary btn-xs">View</a>';
 
                        return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view_user($id)
    {
        $user = DB::collection('users')->where('_id', $id)->first();
        $bank = DB::collection('user_banks')->where('userId',$id)->first();
        // dd($bank);
        $transaction_histories = DB::collection('transaction_histories')->where('userId',$id)->get();
        return view('users.view_user',compact('user','bank','transaction_histories'));
    }


    public function transaction_histories(Request $request)
    {
        $limit = 30;
            
        $data = DB::collection('transaction_histories')->where('userId',$request->userId)->get();
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('transactionId', function($row){
                        if($row['type'] == 2)
                        {
                            return $row['transactionId'];
                        }
                        else
                        {
                            return "N/A";
                        }
                       
                })
                ->addColumn('createdDate', function($row){
                    $date = strval($row['created'])/1000;
                    return Carbon::createFromTimestamp($date)->toDateTimeString();
                    // return $row['created'];
                })
                ->addColumn('action', function($row){

                       $btn = '<a href="/view_user/'.$row["_id"].'" class="btn btn-primary btn-xs">View</a>';
 
                        return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function change_document_status(Request $request)
    {
        $user = DB::collection('users')->where('_id',$request->userId)->first();
        if($request->documentStatus == 'reject')
        {
            $data = [
                'documentStatus' => $request->documentStatus,
                'pancardRejectReason' => $request->documentRejectReason,
                'status' => 'reject'
            ];
        }
        else
        {
            if($user['pancardStatus'] == 'approve'){
                $data = [
                    'documentStatus' => $request->documentStatus,
                    'pancardRejectReason' => ""
                ];   
            }
            else
            {
                $data = [
                    'documentStatus' => $request->documentStatus,
                    'pancardRejectReason' => ""
                ];    
            }
        }
        DB::collection('users')->where('_id',$request->userId)
            ->update($data, ['upsert' => true]);
        $user1 = DB::collection('users')->where('_id',$request->userId)->first();
        if($user1['documentStatus'] == 'approve' && $user1['pancardStatus'] == 'approve')
        {

            DB::collection('users')->where('_id',$request->userId)
            ->update(['status'=>'approve'], ['upsert' => true]);
        }
        return redirect('/view_user/'.$request->userId)->with('success','documentStatus has been Changed');
    }

    public function change_pancard_status(Request $request)
    {
        $user = DB::collection('users')->where('_id',$request->userId)->first();
        if($request->pancardStatus == 'reject')
        {
            $data = [
                'pancardStatus' => $request->pancardStatus,
                'pancardRejectReason' => $request->pancardRejectReason,
                'status' => 'reject'
            ];
        }
        else
        {

            if($user['documentStatus'] == 'approve'){
                $data = [
                    'pancardStatus' => $request->pancardStatus,
                    'pancardRejectReason' => ""
                ];   
            }
            else
            {
                $data = [
                    'pancardStatus' => $request->pancardStatus,
                    'pancardRejectReason' => ""
                ];    
            }   
        }
        DB::collection('users')->where('_id',$request->userId)
            ->update($data, ['upsert' => true]);
        $user1 = DB::collection('users')->where('_id',$request->userId)->first();
        if($user1['documentStatus'] == 'approve' && $user1['pancardStatus']== 'approve')
        {

            DB::collection('users')->where('_id',$request->userId)
            ->update(['status'=>'approve'], ['upsert' => true]);
        }
        return redirect('/view_user/'.$request->userId)->with('success','pancardStatus has been Changed');
    }


    public function change_bank_status(Request $request)
    {
        // dd($request->all());exit;
        $data = [
            'status' => $request->bankStatus
        ];
        
        DB::collection('user_banks')->where('userId',$request->userId)
            ->update($data, ['upsert' => true]);
        return redirect('/view_user/'.$request->userId)->with('success','bankStatus has been Changed');
    }

    public function add_balance(Request $request)
    {
        $user = DB::collection('users')->select('deposited')->where('_id',$request->user_id)->first();
        $amount = $user['deposited'] + $request->balance;
        $data = [
            'deposited' => $amount 
        ];
        DB::collection('users')->where('_id',$request->user_id)
            ->update($data, ['upsert' => true]);
        
        $balanceCreate = DB::collection('balance_history')->insert
        (
            [
                'userId' => $request->user_id,
                'balance' => $request->balance,
                'oldBalance' => $user['deposited'],
                'newBalance' => $amount
            ]
        );
        return redirect('/view_user/'.$request->user_id)->with('success','Balance has been Changed');
    }

    public function add_deposit(Request $request)
    {
        $user = DB::collection('users')->select('deposited','created')->where('_id',$request->user_id)->first();
        // return $request->user_id;
        // $amount = $user['deposited'] + $request->balance;
        
        $amount = (string) new Decimal128($user['deposited'])+$request->balance;
        // $withdrawalAmount = (string) new Decimal128($amount);
        $data = [
            'deposited' => $amount 
        ];
        
        // return $data;
        // $currDate = Carbon::now()->toiso8601String();
        $currDate = new UTCDateTime();
        // dd($currDate);exit;
        // return $currDate = date('c');
        // exit;
        $balanceCheck = DB::collection('transaction_histories')->where('transactionId',$request->transactionId)->count();
        if($balanceCheck == 0)
        {
            DB::collection('users')->where('_id',$request->user_id)
                ->update($data, ['upsert' => true]);
            // return $request->all();
            $balanceCreate = DB::collection('transaction_histories')->insert
            (
                [
                    'userId' => $request->user_id,
                    'amount' => $request->balance,
                    'transactionType' => "Deposited Cash",
                    'transactionId' => $request->transactionId,
                    'type' => 2,
                    'created' => $currDate,
                    'modified' => $currDate,
                ]
            );

            return redirect('/view_user/'.$request->user_id)->with('success','Deposit has been added');
        }
        else
        {
            return redirect('/view_user/'.$request->user_id)->with('success','Already exist');   
        }
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

    public function export()
    {
        return false;
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=file.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $users = DB::collection('users')->select('email','fullName','phone')->get();
        $columns = array('Mobile', 'Email', 'Name');

        $callback = function() use ($users, $columns)
        {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach($users as $user) {
                // print_r($user);exit;
                fputcsv($file, array($user['phone'],$user['email'],$user['fullName']));
            }
            fclose($file);
        };
        // print_r($callback);
       return Response::stream($callback, 200, $headers)->send();
       exit;
    }

    public function add_pancard(Request $request)
    {
        $request->validate([
            'pancardNumber' => 'required',
            'pancardImage' => 'required',
        ]);

        $userId = $request->user_id;
        $pancardNumber = $request->pancardNumber;
        $localFileTemp = $_FILES['pancardImage']['tmp_name'];
        $localFileName = $_FILES['pancardImage']['name'];
        $localFileType = $_FILES['pancardImage']['type'];

        // $pancardImageFile = '@'.$localFileTemp.'; type='.$localFileType.'; filename='.$localFileName;
        $pancardImageFile = '@'.$_FILES['pancardImage']['name'];
        if(isset($request->pancardImage))
        {
            $imageName = time().'.'.$request->pancardImage->extension();  
       
            $request->pancardImage->move(public_path('images'), $imageName);

        }

        $imagePath = url("images")."/".$imageName;
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://www.rockingbravo.com/api/v1/account/uploadPancardNew",
          CURLOPT_POST => true,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_POSTFIELDS => array('pancardImage'=> $pancardImageFile,'pancardNumber' => $pancardNumber,'userId' => $userId),
          CURLOPT_HTTPHEADER => array(
            "Content-Type: multipart/form-data"
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }
}
