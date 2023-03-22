<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function show($id){
        $customer = \App\Models\Customer::find($id);
       return view('customer.show',compact('customer'));
   }
}
