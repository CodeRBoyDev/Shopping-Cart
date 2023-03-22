@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h1>EDIT</h1>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            {!! Form::model($item,['method'=>'PATCH','route' => ['item.update',$item->item_id]]) !!}
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="description">Item Description: </label>
                    {!! Form::text('description',$item->description,array('autofocus required','size'=>'40','class'=>'form-control')) !!}
                </div>

                <div class="form-group">
                    <label for="sell_price">Price: </label>
                    {!! Form::text('sell_price',$item->sell_price,array('autofocus required','size'=>'40','class'=>'form-control')) !!}
                </div>

                <div class="form-group">
                    <label for="img_path">Image: </label>
                    <input type="file" name="img_path" id="img_path" class="form-control">
                </div>

                
                    <input type="submit" value="Sign Up" class="btn btn-primary">
             </form>
        </div>
    </div>
    {!!Form::close()!!}
@endsection   