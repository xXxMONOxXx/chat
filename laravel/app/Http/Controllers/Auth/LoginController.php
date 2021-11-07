<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MessageController;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use App\User;

class LoginController extends Controller
{

    public function index(){
        $messages = Message::all();
        $brothers=0;
        $sisters=0;
        foreach ($messages as $message){
            if($message->message=='Sis!'){
                $sisters++;
            }
            else{
                $brothers++;
            }
        }
        $chat_stat = ['bro'=>$brothers, 'sis'=>$sisters];
        return view('login')->with('chat_stat', $chat_stat);
    }

    public function post(Request $request){
        $request->validate([
           'email' => 'required|email',
           'password'=>'required'
        ]);
        $credentials = $request->only(['email', 'password']);
        if(Auth::attempt($credentials)){
            return redirect()->intended('/chat');
        }
        else {
            return redirect()->back()
                ->withErrors(['password'=>'Incorrect email/password combination']);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function github(){
        return Socialite::driver('github')->redirect();
    }

    public function githubRedirect(){
        $user = Socialite::driver('github')->user();
        $user = User::firstOrCreate([
            'email' =>$user->email
        ], [
            'name' =>$user->name,
                'password' => Hash::make(Str::random(24))
            ]

        );
        Auth::login($user, true);
        return redirect('/chat');
    }

    public function facebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function facebookRedirect(){
        $user = Socialite::driver('facebook')->user();

        $user = User::firstOrCreate([
            'email' =>$user->email
        ], [
                'name' =>$user->name,
                'password' => Hash::make(Str::random(24))
            ]

        );
        return redirect('/chat');
    }
}
