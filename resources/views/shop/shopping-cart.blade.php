@extends('layouts.master')
@section('title')
    Laravel Shopping Cart
@endsection
@section('content')
    @if(Session::has('cart'))
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <ul class="list-group">
                    @php
                        $totalPrice = 0;
                    @endphp
                    @foreach($products as $product)
                 
                            <li class="list-group-item">
                                <span class="badge">{{ $product['qty'] }}</span>
                                <strong>{{ $product['item']['description'] }}</strong>
                                @php
                                    $totalPriceItem = $product['item']['sell_price'] * $product['qty'];
                                @endphp
                                <span class="label label-success">{{  $totalPriceItem  }}</span>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-xs dropdown-toogle" data-toggle="dropdown">Action <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ route('product.reduceByOne',['id'=>$product['item']['item_id']]) }}">Reduce By 1</a></li>
                                        <li><a href="{{ route('product.remove',['id'=>$product['item']['item_id']]) }}">Reduce All</a></li>
                                    </ul>
                                </div>
                            </li>
                             @php
                $totalPrice = $totalPrice + $totalPriceItem;
                @endphp
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
               
                <strong>Total: {{ $totalPrice }}</strong>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <a href="{{ route('checkout') }}" type="button" class="btn btn-success">Checkout</a>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <h2>No Items in Cart!</h2>
            </div>
        </div>
    @endif
@endsection