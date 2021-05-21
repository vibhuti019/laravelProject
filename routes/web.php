<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/pointSystemNew', 'ManOfTheMatchController@pointSystemNew')->name('pointSystemNew');

Route::group(['middleware' => ['auth']], function () {
  Route::get('/', 'HomeController@index')->name('home');
  Route::get('/new_users', 'AppUserController@new_users')->name('new_users');
  Route::get('/new_users_ajax', 'AppUserController@new_users_ajax')->name('new_users_ajax');
  Route::get('/rejected_users', 'AppUserController@rejected_users')->name('rejected_users');
  Route::get('/rejected_users_ajax', 'AppUserController@rejected_users_ajax')->name('rejected_users_ajax');
  Route::get('/export', 'AppUserController@export')->name('export');
  Route::get('/user_referral', 'AppUserController@user_referral')->name('user_referral');
  Route::get('/user_referral_list_ajax', 'AppUserController@user_referral_list_ajax')->name('user_referral_list_ajax');
  Route::get('/transaction_histories', 'AppUserController@transaction_histories')->name('transaction_histories');
  Route::get('/unverified_bank_details', 'AppUserController@unverified_bank_details')->name('unverified_bank_details');
  Route::get('/unverified_bank_details_ajax', 'AppUserController@unverified_bank_details_ajax')->name('unverified_bank_details_ajax');
  Route::get('/rejected_bank_details', 'AppUserController@rejected_bank_details')->name('rejected_bank_details');
  Route::get('/rejected_bank_details_ajax', 'AppUserController@rejected_bank_details_ajax')->name('rejected_bank_details_ajax');
  Route::get('/user_referral_ajax', 'AppUserController@user_referral_ajax')->name('user_referral_ajax');
  Route::get('/unverified_users', 'AppUserController@unverified_users')->name('unverified_users');
  Route::get('/unverified_users_ajax', 'AppUserController@unverified_users_ajax')->name('unverified_users_ajax');
  Route::get('/view_user/{id}', 'AppUserController@view_user')->name('view_user');
  Route::get('/list_contest', 'DefaultContestController@list_contest')->name('list_contest');
  Route::get('/add_contest', 'DefaultContestController@add_contest')->name('add_contest');
  Route::post('/add_contest', 'DefaultContestController@save_contest')->name('add_contest');
  Route::get('/list_matches', 'ManOfTheMatchController@list_matches')->name('list_matches');
  Route::get('/manOfTheMatch/{pid}/{mid}', 'ManOfTheMatchController@add_mom')->name('manOfTheMatch');
  Route::post('/manOfTheMatch', 'ManOfTheMatchController@add_mom')->name('manOfTheMatch');
  Route::get('/view_contest/{id}', 'DefaultContestController@view_contest')->name('view_contest');
  Route::post('/change_document_status', 'AppUserController@change_document_status')->name('change_document_status');
  Route::post('/change_pancard_status', 'AppUserController@change_pancard_status')->name('change_pancard_status');
  Route::post('/change_bank_status', 'AppUserController@change_bank_status')->name('change_bank_status');
  Route::get('/list_withdrawal_request', 'WithdrawalController@list_withdrawal_request')->name('list_withdrawal_request');
  Route::post('/approve_transaction', 'WithdrawalController@approve_transaction')->name('approve_transaction');
  Route::post('/reject_transaction', 'WithdrawalController@reject_transaction')->name('reject_transaction');
  Route::get('/list_notifications', 'NotificationController@list_notifications')->name('list_notifications');
  Route::post('/send_notifications', 'NotificationController@send_notifications')->name('send_notifications');
  Route::post('/add_balance', 'AppUserController@add_balance')->name('add_balance');
  Route::post('/add_deposit', 'AppUserController@add_deposit')->name('add_deposit');
  Route::get('/upcoming_match', 'ContestController@upcoming_match')->name('upcoming_match');
  Route::get('/match_list', 'ContestController@match_list')->name('match_list');
  Route::get('/contest_list/{match_id}', 'ContestController@contest_list')->name('contest_list');
  Route::get('/contest_users/{contest_id}', 'ContestController@contest_users')->name('contest_users');
  Route::post('/add_pancard', 'AppUserController@add_pancard')->name('add_pancard');
});
  Route::get('/howtoplay', 'ManOfTheMatchController@howtoplay')->name('howtoplay');
  Route::get('/add_aboutus', 'ManOfTheMatchController@add_aboutus')->name('add_aboutus');
  Route::get('/helpdesk', 'ManOfTheMatchController@helpdesk')->name('helpdesk');
  Route::get('/legality', 'ManOfTheMatchController@legality')->name('legality');
  Route::get('/referralSystem', 'ManOfTheMatchController@referralSystem')->name('referralSystem');
  Route::get('/pointSystem', 'ManOfTheMatchController@pointSystem')->name('pointSystem');
  Route::get('/terms', 'ManOfTheMatchController@terms')->name('terms');
  Route::post('/add_content', 'ManOfTheMatchController@add_content')->name('add_content');
  Route::get('/match_announce', 'ContestController@match_announce')->name('match_announce');
