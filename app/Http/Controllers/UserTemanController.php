<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teman;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class UserTemanController extends Controller
{
    // public function __construct(){
    //    // OTORISASI GATE

    //   $this->middleware(function($request, $next){

    //     if(Gate::allows('manage-bookings')) return $next($request);

    //     abort(403, 'Anda tidak memiliki cukup hak akses');
    //   }, ['except' => ['unavailableTime', 'store', 'bookings']]);
    // }
    public function index(Request $request){
        $keyword = $request->get('keyword') ? $request->get('keyword') : '';
      $bookings = \App\Booking::with('user')
                    ->with('teman')
                    ->whereHas('user', function($query) use ($keyword) {
                        $query->where('name', 'LIKE', "%$keyword%");
                      })->orderBy('created_at', 'DESC')
                    ->paginate(10);

      return view('userteman.index', ['bookings' => $bookings]);
    }

    public function login(Request $request)
    {
      $this->validate($request, [
          'username' => 'required',
      ]);

      $teman = Teman::where('username', '=', $request->username)->where('roles', '["USERTEMAN"]')->first();
      $status = "error";
      $message = "";
      $data = null;
      $code = 302;

      if($teman){
        if(Hash::check($request->username, $teman->username)){
          $status = 'success';
          $message = 'Login sukses';
          $teman->token = $request->token;
          $teman->save();
          // tampilkan data user menggunakan method toArray
          $data = $teman->toArray();
          $code = 200;
        }else{
          $message = "Login gagal, username salah";
        }
      }else {
        $message = "Login gagal, user " . $request->username . " tidak ditemukan";
      }

      return response()->json([
          'status' => $status,
          'message' => $message,
          'data' => $data
      ], $code);
    }

    public function edit($id)
    {
      $booking = \App\Booking::findOrFail($id);

      return view('userteman.edit', ['booking' => $booking]);
    }

    public function update(Request $request, $id)
    {
      $booking = \App\Booking::with('user')->findOrFail($id);

      $booking->status = $request->get('status');
      $token = $booking->user->token;

      $char="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
      $random = substr(str_shuffle($char), 0, 4);

      $title = "Pesanan Dibatalkan";
      $body = "Pesanan kamu telah dibatalkan";

      if($request->get('status') == 'ACCEPT'){
        $booking->code = date('ymd', strtotime($booking->date)) . $random;

        $title = "Pesanan Diterima";
        $body = "Hore! Pesanan kamu telah diterima";
      }

      $this->sendNotification($token, $title, $body);

      // $nama = "Wildan Fuady";
      // $email = "wildanfuady@gmail.com";
      // $kirim = Mail::to($email)->send(new SendMail($nama));

      // if($kirim){
      //   echo "Email telah dikirim";
      // }

      $booking->save();

      return redirect()->route('userteman.edit', [$booking->id])->with('status', 'Booking status succesfully updated');
    }

    public function bookings(Request $request)
    {
      $bookings = \App\Booking::with('teman')->where('user_id', $request->id)->orderBy('created_at', 'DESC')->get();

      // $bookings->field->name

      $data = $bookings->toArray();

      return response()->json([
          'data' => $data
      ]);
    }
    public function sendNotification($token, $title, $body)
    {
      $optionBuilder = new OptionsBuilder();
      $optionBuilder->setTimeToLive(60*20);

      $notificationBuilder = new PayloadNotificationBuilder($title);
      $notificationBuilder->setBody($body)
                  ->setSound('default');

      $dataBuilder = new PayloadDataBuilder();
      $dataBuilder->addData(['a_data' => 'my_data']);

      $option = $optionBuilder->build();
      $notification = $notificationBuilder->build();
      $data = $dataBuilder->build();

      $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);

      $downstreamResponse->numberSuccess();
      $downstreamResponse->numberFailure();
      $downstreamResponse->numberModification();
    }
}
