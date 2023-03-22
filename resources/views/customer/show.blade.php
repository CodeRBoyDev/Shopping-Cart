@extends('layouts.master')
@section('title')
  customer
@endsection
@section('content')
   <div class="container">
    <table class="table table-striped">
    <thead>
      <tr>
        <th>customer ID</th>
        <th>last name</th>
        <th>first name</th>
      </tr>
    </thead>
    <tbody>
        <tr>
        <td>{{$customer->customer_id}}</td>
        <td>{{$customer->lname}}</td>
        
        <td>{{$customer->fname}}</td>
</tbody>        
@endsection