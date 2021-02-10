<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class DatingController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $temans = \App\Dating::with('user')->with('teman')->orderBy('created_at', 'DESC')->where('user_id', '!=', $request->id)->get();

        return response()->json([
            'data' => $temans
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $new_date = new \App\Dating;

      $new_date->date = $request->get('date');
      $new_date->user_id = $request->get('user_id');
      $new_date->teman_id = $request->get('teman_id');
      $new_date->teamReq = $request->get('teamReq');
      $new_date->teamAcc = $request->get('teamAcc');

      $new_date->save();

      return response()->json([
          'status' => 'success'
      ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dating = \App\Dating::with('user')->findOrFail($id);

        $dating->teamAcc = $request->get('teamAcc');
        $dating->status = 'ACCEPT';

        $token = $dating->user->token;

        $title = "Request Teman Jalan Diterima";
        $body = "Hore! Kamu sudah dapat teman jalan :) ";

        $this->sendNotification($token, $title, $body);

        $dating->save();

        return response()->json([
            'data' => $dating
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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

    public function myDating(Request $request)
    {
        $temans = \App\Dating::with('user')->with('teman')->orderBy('created_at', 'DESC')->where('user_id', '=', $request->id)->get();

        return response()->json([
            'data' => $temans
        ]);
    }
}
