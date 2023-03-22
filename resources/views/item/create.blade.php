@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h1>ADD NEW ITEM</h1>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            {!!Form::open(['route'=>['item.store','files'=>true],'enctype'=>'multipart/form-data'])!!}
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="description">Item Description: </label>
                    <input type="text" name="description" id="description" class="form-control">
                </div>

                <div class="form-group">
                    <label for="sell_price">Price: </label>
                    <input type="text" name="sell_price" id="sell_price" class="form-control">
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