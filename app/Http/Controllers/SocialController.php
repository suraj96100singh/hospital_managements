<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
    
class SocialController extends Controller
{
    public function googleRedirect(){
        return Socialite::driver('google')->redirect();
    }
    public function googleCallback(Request $request){
        $users=Socialite::driver('google')->user();
        // dd($users);
        $this->registerOrLoginGoogleUser($users);
        return redirect('/home');
    }
    protected function registerOrLoginGoogleUser($users){
        
            $user=User::where('google_id',$users->id)->first();
            if(!$user){
                $user=new User();
                $user->name=$users->name;
                $user->email =$users->email ;
                $user->password=encrypt('password');
                $user->google_id=$users->id;
                $user->save();
            }
           Auth::login($user);

           
    }
}
