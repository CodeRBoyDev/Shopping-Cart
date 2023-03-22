<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Session;
use App\Models\User;
use App\Models\Customer;
use App\Models\Order;

class userController extends Controller
{
    public function getSignup()
    {
        return view('user.signup');
    }

    public function postSignup(Request $request)
    {
        $user = new User([
            'name' => $request->input('fname').' '.$request->lname,
           'email' => $request->input('email'),
           'password' => bcrypt($request->input('password'))
       ]);
        $user->save();
        $customer = new Customer;
        $customer->user_id = $user->id;
        $customer->fname = $request->fname;
        $customer->lname = $request->lname;
        $customer->title = $request->title;
        $customer->addressline = $request->addressline;
        $customer->phone = $request->phone;
        $customer->zipcode = $request->zipcode;
        $customer->level = $request->level;
        $customer->creditlimit = $request->creditlimit;
        $customer->save();

        Auth::login($user);

        return redirect()->route('user.profile');
    }

    public function getSignin()
    {
        return view('user.signin');
    }

    public function postSignin(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|required',
            'password' => 'required|min:4'
        ]);

        if (Auth::attempt(['email' => $request->input('email'), 
        'password' => $request->input('password')])) {
            return redirect()->route('user.profile');
        }
        return redirect()->back();
    }

    public function getProfile(){
        $customer = Customer::where('user_id',Auth::id())->first();
        $orders = Order::with('customer','items')->where('customer_id',$customer->customer_id)->get();
    return view('user.profile',compact('orders'));
    }
    
    public function getLogout() {
        Auth::logout();
        return redirect()->route('product.index');
    }
}
