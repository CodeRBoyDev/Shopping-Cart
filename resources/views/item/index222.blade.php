@extends('layouts.master')
@section('content')


@include('layouts.flash-messages')
<div class="container">
    <a href="{{route('item.create')}}" class="btn btn-primary a-btn-slide-text">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        <span><strong>ADD</strong></span>            
    </a>

    <div class="col-xs-6">
       <form method="post" enctype="multipart/form-data" action="{{ url('/import') }}">
          {{ csrf_field() }}
        <input type="file" id="uploadName" name="item_upload" required>
        <button type="submit" class="btn btn-info btn-primary " >Import Excel File</button>
         
         </form>
         {{ link_to_route('item.export', 'Export to Excel')}}
       </div>
    </div>
    
    @if ($message = Session::get('success'))
 <div class="alert alert-success alert-block">
 <button type="button" class="close" data-dismiss="alert">×</button> 
         <strong>{{ $message }}</strong>
 </div>
@endif
    @if ($message = Session::get('error'))
<div class="alert alert-danger alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
</div>
@endif
<div class="table-responsive">
<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th>Item ID</th>
        <th>Item Description</th>
        <th>Item Cost Price</th>
        <th>Item Sell Price</th>
        <th>Image</th>
        <th colspan="2">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($item as $items)
      <tr>
      <td>{{$items->item_id}}</td>
        <td>{{$items->description}}</td>
        <td>{{$items->cost_price}}</td>
        <td>{{$items->sell_price}}</td>
        <td><img src="{{ $items->img_path}}" class="brand-image img-square elevation-3" width="60" ></td>

         <td><a href="{{action('ItemController@edit', $items->item_id)}}" class="btn btn-warning">Edit</a></td>
         <td>
          <form action=" {{action('ItemController@destroy', $items->item_id)}}" method="post">
           {{ csrf_field() }}
            <input name="_method" type="hidden" value="DELETE">
            <button class="btn btn-danger" type="submit">Delete</button>
        </form>
        </td>
        @endforeach
        
      </tr>
     <!-- {{--  @foreach($albums as $album)
      <tr>
      <td>{{$album->id}}</td>
    <td>
      <img src="{{asset($album->img_path)}}" width="100px" height="100px"></td>
          <td><a href="{{route('album.show',$album->id)}}">{{$album->name}}</a></td>
          <td>{{$album->artist_name}}</td>
        <td align="center"><a href="{{route('album.edit',$album->id)}}"><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size:24px" ></a></i></td>
         <td align="center"><a href="{{route('album.destroy',$album->id)}}"  ><i class="fa fa-trash-o" style="font-size:24px; color:red" ></a></i></td>
          
      @endforeach --}}
  </tr> -->
    </tbody>
  </table>
</div>
</div>
@endsection
