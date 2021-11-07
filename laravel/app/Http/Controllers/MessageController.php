<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class MessageController extends Controller
{

    public function getMessages()
    {
        $messages = Message::all();
        $last_sis=null;
        $last_bro=null;
        foreach ($messages as $message){
            if($message->message=='Sis!'){
                $last_sis = $message;
            }
            else{
                $last_bro=$message;
            }
        }
        $chat_stat = ['bro'=>$last_bro, 'sis'=>$last_sis];
        $data = ['messages'=>$messages, 'stat'=>$chat_stat];

        return view('/chat')->with('data', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
           'user_name'=>'required',
            'message'=>'required'
        ]);
        $message = new Message();
        $message->user_name=$request->input('user_name');
        $message->message=$request->input('message');
        $message->save();
        return redirect('/chat');
    }

    public function toChat(){

    }
}
