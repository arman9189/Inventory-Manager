@extends('adminlte::page')

@section('title', 'Move products')

@section('content_header')
    <h1>Move products</h1>
@stop

@section('content')
	@include('includes.messages')
    {!! Form::open(['action' => 'ProductStocksController@moveStock', 'method' => 'post']) !!}

		<div class="row">
			<div class="col-sm-6">
				<div class="box box-danger">
					<div class="box-header with-border">
						<h3 class="box-title">Source</h3>
					</div>
					<div class="box-body">

						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									{{Form::label('storage_location_id_source', 'Storage location')}}
									{{Form::select('storage_location_id_source', $locations->pluck('name', 'id'), null, ['id' => 'select2', 'class' => 'form-control select2', 'placeholder' => 'Storage location'])}}
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>

			<div class="col-sm-6">
				<div class="box box-danger">
					<div class="box-header with-border">
						<h3 class="box-title">Destination</h3>
					</div>
					<div class="box-body">

						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									{{Form::label('storage_location_id_destination', 'Storage location')}}
									{{Form::select('storage_location_id_destination', $locations->pluck('name', 'id'), null, ['id' => 'select2', 'class' => 'form-control select2', 'placeholder' => 'Storage location'])}}
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
    </div>

		<div class="row">
			<div class="col-sm-12">
				<div class="box box-danger">
					<div class="box-header with-border">
						<h3 class="box-title">Product information</h3>
					</div>
					<div class="box-body">

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
									{{Form::label('quantity', 'Quantity')}}
									{{Form::number('quantity', '', ['class' => 'form-control', 'placeholder' => 'Quantity'])}}
								</div>
							</div>
						</div>

						{{Form::submit('Move products', ['class' => 'btn btn-default pull-right'])}}

					</div>
				</div>
			</div>
		</div>
		{!! Form::close() !!}
@stop

@section('js')
  <script src="{{asset('js/render_select2.js')}}" charset="utf-8"></script>
@endsection
