<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function postSignin(Request $request){
        $this->validate($request, [
            'email' => 'email| required',
            'password' => 'required| min:4'
        ]);
        if(auth()->attempt(array('email' => $request->email, 'password' => $request->password)))
        {
            if (auth()->user()->role == 'admin') {
                return redirect()->route('dashboard.index');
            } else if (auth()->user()->role == 'encoder'){
             return redirect()->route('item.index');
            } 
            else {
                return redirect()->route('user.profile');
            }
        }
        else{
            return redirect()->route('user.signin')
                ->with('error','Email-Address And Password Are Wrong.');
        }
     }
}
