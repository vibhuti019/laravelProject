<?php
namespace App\Http\Controllers;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
use App\AppUser;
use App\DefaultContest;
use App\DynamicPrize;
use App\DynamicPrizeBreakup;
use Illuminate\Http\Request;
use MongoDB\BSON\Decimal128;
use DB;

class WithdrawalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list_withdrawal_request()
    {   
        $limit = 10;
        $projections = ['_id','userId','amount','type'];
        $withdrawals = DB::collection('transaction_histories')->where('type',3)->where('transactionId','')->where('status','!=','rejected')->paginate($limit, $projections);;
        return view('withdrawal.list',compact('withdrawals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function approve_transaction(Request $request)
    {
        $request->validate([
            '_id' => 'required',
            'transaction_id' => 'required',
        ]);
       
        
        DB::collection('transaction_histories')->where('_id',$request->_id)
            ->update(['transactionId'=>$request->transaction_id,'status'=>'approved'], ['upsert' => true]);

       
        return redirect('/list_withdrawal_request')->with('success','Withdrawal request approved');

    }

    public function reject_transaction(Request $request)
    {
        $request->validate([
            '_id' => 'required',
            'user_id' => 'required',
            'reason' => 'required',
        ]);
        

        $user = DB::collection('users')->select('winning')->where('_id',$request->user_id)->first();
        $transaction = DB::collection('transaction_histories')->where('_id',$request->_id)->first();

        // dd((string) new Decimal128($transaction['amount']));
        $withdrawalAmount = (string) new Decimal128($transaction['amount']);
        // echo "<br>";
        $userWinning = (string) new Decimal128($user['winning']);
        // echo "<br>";
        // dd($withdrawalAmount+$userWinning);
        // echo "<br>";
        $amount = $withdrawalAmount+$userWinning;
        
        DB::collection('users')->where('_id',$request->user_id)
            ->update(['winning'=>$amount], ['upsert' => true]);
        DB::collection('transaction_histories')->where('_id',$request->_id)
            ->update(['status'=>'rejected','reason'=>$request->reason], ['upsert' => true]);

       
        return redirect('/list_withdrawal_request')->with('error','Withdrawal request rejected');

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
