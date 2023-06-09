<?php

namespace App\Http\Controllers;
use App\Models\Item;
use App\Models\Customer;
use Spatie\Searchable\Search;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request){
    	$searchResults = (new Search())
		   ->registerModel(Item::class, 'description','cost_price','sell_price')
		   ->registerModel(Customer::class, 'lname','fname','addressline','town')
		   ->search($request->search);
		   // dd($searchResults);
	   // return view('item.search',compact('searchResults'));
		   return view('search',compact('searchResults'));
    }

}
