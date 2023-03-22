<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Item;
use App\Models\Cart;
use App\Models\Stock;
use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;
use Session;
use DB;
use Auth;

class ProductController extends Controller
{
    public function getIndex()
    {
        // $products = Product::all();
        $products = Stock::with('item')->get();

        return view('shop.index',compact('products'));
    }

    public static function getAddToCart(Request $request, $id)
    {
        $item = Item::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($item, $item->item_id);
        
        $request->session()->put('cart',$cart);
        return redirect('/');
    }

    public function getCart() { 
        if (!Session::has('cart')) {
        return view('shop.shopping-cart');
        }
        
        $oldCart = Session::get('cart'); 
        $cart = new Cart($oldCart);
        return view('shop.shopping-cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
}

    public function getAddByOne($id) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null; 
        $cart = new Cart($oldCart); 
        $cart->addByOne($id);
        
        if (count($cart->items) > 0) {
            Session::put('cart', $cart); 
        } else {
            Session::forget('cart'); 
        }
        // return redirect('shopping-cart');
        return redirect()->route('product.shoppingCart');
    }

    public function getReduceByOne($id) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null; 
        $cart = new Cart($oldCart); 
        $cart->reduceByOne($id);
        
        if (count($cart->items) > 0) {
            Session::put('cart', $cart); 
        } else {
            Session::forget('cart'); 
        }
        // return redirect('user/shopping-cart');
        return redirect()->route('product.shoppingCart');
    }

    public function getRemoveItem($id) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null; 
        $cart = new Cart($oldCart); 
        $cart->removeItem($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart); 
        } else {
            Session::forget('cart');
        }    
        
        // return redirect('user/shopping-cart');
        return redirect()->route('product.shoppingCart');
}

    public function addToCart(Request $request){
        
        return "hello";

    }



    public function postCheckout(Request $request){

        if (!Session::has('cart')) {
            // return redirect()->route('product.shoppingCart');
            return redirect()->route('product.shoppingCart');
        }
        $oldCart = Session::get('cart');
        // dd(Session::get('cart'));
        $cart = new Cart($oldCart);
       // dd($cart);
            // try {
            // DB::beginTransaction();
            // dd($order);
            $order = new Order;
            // dd($order);

            $customer =  Customer::where('user_id',Auth::id())->first();
            // dd($customer->user_id);
            // dd($cart->items);
            // dd($customer);

            $customer->orders()->save($order);
           // dd($customer);
            foreach($cart->items as $items){
                // dump($items);
                $id = $items['item']['item_id'];
                //dd($items['qty']);

                $order->items()->attach($id,['quantity'=>$items['qty']]);
           
                //dd($items['qty']);
                // dd($id);
                $stock = Stock::find($id);
                //dd($stock);
                $stock->quantity = $stock->quantity - $items['qty'];
                //dd($stock->quantity);
                $stock->save();
            }
            // $order->save();
        // }
        // catch (\Exception $e) {
        //   // dd($e);
        //    DB::rollback();
        //     return redirect()->route('checkout')->with('error', $e->getMessage());
        // }
        // DB::commit();
        Session::forget('cart');
        //session_destroy();
        //return redirect()->back();
        return redirect()->route('product.index')->with('success','Successfully Purchased Your Products!!!');
    }
}