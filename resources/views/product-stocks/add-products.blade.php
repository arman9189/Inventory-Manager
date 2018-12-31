@extends('adminlte::page')

@section('title', 'Add stock')

@section('content_header')
    <h1>Add stock</h1>
@stop

@section('content')
	@include('includes.messages')
    <div class="row">
			<div class="col-sm-5">
				<div class="box box-danger">
					<div class="box-header with-border">
						<h3 class="box-title">Add stock</h3>
					</div>
					<div class="box-body">
						{!! Form::open(['action' => 'ProductStocksController@addStock', 'method' => 'post']) !!}

            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  {{Form::label('product_id', 'Product')}}
                  {{Form::select('product_id', $products->pluck('name', 'id'), null, ['id' => 'select2', 'class' => 'form-control select2', 'placeholder' => 'Product'])}}
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  {{Form::label('storage_location_id', 'Storage location')}}
                  {{Form::select('storage_location_id', $locations->pluck('name', 'id'), null, ['id' => 'select2', 'class' => 'form-control select2', 'placeholder' => 'Storage location'])}}
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  {{Form::label('quantity', 'Quantity')}}
                  {{Form::number('quantity', '', ['class' => 'form-control', 'placeholder' => 'Quantity'])}}
                </div>
              </div>
            </div>

						{{ Form::submit('Add stock', ['class' => 'pull-right btn btn-default']) }}

						{!! Form::close() !!}
					</div>
				</div>
			</div>
    </div>
@stop

@section('js')
  <script src="{{asset('js/render_select2.js')}}" charset="utf-8"></script>
@endsection
