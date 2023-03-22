@extends('layouts.master')
@section('content')


<table class="table table-bordered" id="users-table">

       <form method="post" enctype="multipart/form-data" action="{{ url('/import') }}">
          {{ csrf_field() }}
        <input type="file" id="uploadName" name="item_upload" required>
        <button type="submit" class="btn btn-info btn-primary " >Import Excel File</button>
         
         </form>
         {{ link_to_route('item.export', 'Export to Excel')}}
       </div>
       
       <table class="table table-striped" id="item-table">
     
    <thead>
      <tr>
        <th>Item ID</th>
        <th>Name</th>
        <th>Selling Price</th>
        <th>Cost Price</th>
       
      </tr>
    </thead>
   
  </table>

@section('scripts')
  <script >
    $(document).ready(function() {
      $('#item-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('item.getItem') !!}',
            columns: [
              { data: 'item_id', name: 'item_id' },
              { data: 'description', name: 'description' },
              { data: 'cost_price', name: 'cost_price' },
 { data: 'sell_price', name: 'sell_price' }
             ]
        });
  });

  </script>
  @endsection

@endsection