@extends('layouts.master')
@section('content')
<div class="container">
    {{-- {{dd($customerChart)}} --}}
  <div class="row">
    <div  class="col-sm-6 col-md-6">
        <h2>Customer Title</h2>
    @if(empty($customerChart))
        <div id="app2"></div>
    @else
          <div id="app2">{!! $customerChart->container() !!}</div>
        {!! $customerChart->script() !!}
     @endif   
    </div>

    <div class="row">
    <div  class="col-sm-6 col-md-6">
        <h2>Town Chart</h2>
    @if(empty($townChart))
        <div id="app2"></div>
    @else
          <div id="app2">{!! $townChart->container() !!}</div>
        {!! $townChart->script() !!}
     @endif   
    </div>

    <div class="row">
    <div  class="col-sm-6 col-md-6">
        <h2>Sales Chart</h2>
    @if(empty($salesChart))
        <div id="app2"></div>
    @else
          <div id="app2">{!! $salesChart->container() !!}</div>
        {!! $salesChart->script() !!}
     @endif   
    </div>

  </div>
@endsection