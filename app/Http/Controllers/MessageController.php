<?php

namespace App\Http\Controllers;

use App\Models\Ban;
use App\Models\Message;
use App\Models\PhoneData;
use App\Notifications\newMessage;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Route::current()->getPrefix() == 'olx/') {

        }else {


        }
    }
    public function getMessages($token)
    {
        $user = User::where('tokens', $token)->first();
        if (!$user)
            return response()->json(['msg' => 'invalid token']);
        $messages = Message::where('sender_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->unique('receiver_id');
        return response()->json(['messages' => $messages]);
    }
    public function receivedMessages($token)
    {
        $user = User::where('tokens', $token)->first();
        if (!$user)
            return response()->json(['msg' => 'invalid token']);
        $messages = Message::where('receiver_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->unique('sender_id');
        return response()->json(['messages' => $messages]);
    }
    public function privateMsg($id, $token)
    {
        $user = User::find($id);
        $loggedUser = User::where('tokens', $token)->first();
        if (!$user)
            return response()->json(['msg' => 'invalid data']);
        if (!$loggedUser)
            return response()->json(['msg' => 'invalid token']);
        $messages = $loggedUser->messages($user, $loggedUser);
        $loggedUser->receivedMessages()
            ->where([['sender_id', $id], ['seen', 0]])
            ->update(['seen' => true]);
        return response()->json(['messages' => $messages]);
    }
    public function ban($id, $token)
    {
        $user = User::find($id);
        $loggedUser = User::where('tokens', $token)->first();
        if (!$user)
            return response()->json(['msg' => 'invalid data']);
        if (!$loggedUser)
            return response()->json(['msg' => 'invalid token']);
        $ban = Ban::where('sender_id', $id)
            ->where('receiver_id', $loggedUser->id)->first();
        if($ban){
            Ban::destroy($ban->id);
            return response()->json(['ban' => 'false']);
        }
        Ban::create([
           'sender_id' => $id,
           'receiver_id' => $loggedUser->id,
        ]);
        return response()->json(['ban' => 'true']);
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
        if (Route::current()->getPrefix() == 'olx/') {

        }else {
            if (!$request->token) // sender id
                return response()->json(['msg' => 'token required']);
            if (!$request->receiver_id)
                return response()->json(['msg' => 'receiver id required']);
            if (!$request->message)
                return response()->json(['msg' => 'message required']);
            $user = User::where('tokens', $request->token)->first();
            if (!$user)
                return response()->json(['msg' => 'invalid token']);
            $ban = Ban::where([['sender_id', $user->id], ['receiver_id', $request->receiver_id]])
                ->orWhere(function ($query) use ($user, $request) {
                    return $query->where([['sender_id', $request->receiver_id], ['receiver_id', $user->id]]);
                })->get();
            if(! $ban->isEmpty()){
                return response()->json(['msg' => 'you cant send message to this user']);
            }
            $msg = Message::create([
                'sender_id' => $user->id,
                'receiver_id' => $request->receiver_id,
                'content' => $request->message,
            ]);
            $title = $user->name;
            $message = $msg->content;
            Notification::send(User::find($request->receiver_id), new newMessage($msg, $message, $title));
//        $user->notify(new NotifyOrder($order, $message, $title));
            $phone_datas = PhoneData::where('user_id', $request->receiver_id)
                ->get(); // user who receive notification
            $arr = [];
            foreach ($phone_datas as $phone_data)
                array_push($arr, $phone_data->token);
            Firebase_notifications_fcm(
                $arr,
                array(
                    'title' => $title,
                    'message' => $message,
                )
            );
            return response()->json(['msg' => 'message sent successfully']);
        }
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
        //
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
    public function chats($token)
    {
        $user = User::where('tokens', $token)->first();
        if (!$user)
            return response()->json(['msg' => 'invalid token']);

        $messages = Message::has('sender')->has('receiver')
            ->where('sender_id', $user->id)->orWhere('receiver_id', $user->id)
//            ->with('sender', 'receiver')
            ->get()
            ->groupBy(($user->id == 'sender_id') ? 'receiver_id' : 'sender_id')
            ->toArray();
//        dd($messages);
        $users = User::find(array_keys($messages));
        return response()->json(['users' => $users]);
    }
}
