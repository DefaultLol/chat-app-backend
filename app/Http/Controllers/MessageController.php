<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Events\Messages;

class MessageController extends Controller
{
    public $sender;
    public $receiver;

    public function index(Request $request)
    {
        $this->sender=$request->sender_id;
        $this->receiver=$request->receiver_id;
        $data=Message::where(function($query){
            $query->where('sender_id','=',$this->sender)->where('receiver_id','=',$this->receiver);
        })->orWhere(function($q){
            $q->where('sender_id','=',$this->receiver)->where('receiver_id','=',$this->sender);
        })->orderBy('created_at','asc')->get();

        return response()->json($data);
    }

    public function save(Request $request)
    {
        $message=Message::create([
            'sender_id'=>$request->sender_id,
            'receiver_id'=>$request->receiver_id,
            'body'=>$request->body
        ]);
        /*$senderName=auth()->user()->firstName.' '.auth()->user()->lastName;*/
        event(new Messages($message->body,$message->receiver_id,$message->sender_id,$message));
        return response()->json($message);
    }
}
