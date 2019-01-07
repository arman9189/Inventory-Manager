@extends('adminlte::page')

@section('title', 'New order')

@section('content_header')
    <h1>New order</h1>
@stop

@section('content')
	@include('includes.messages')
    <div class="row">
			<div class="col-sm-12">
				<div class="box box-danger">
					<div class="box-header with-border">
						<h3 class="box-title">New order</h3>
					</div>
					<div class="box-body">

						{!! Form::open(['action' => 'OrdersController@store', 'method' => 'post']) !!}

						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									{{Form::label('customer_id', 'Customer')}}
									{{Form::select('customer_id', $customers->pluck('name', 'id'), null, ['id' => 'select2', 'class' => 'form-control select2', 'placeholder' => 'Customer'])}}
									<p>Is the customer you're looking for not in this list? Add them <a target="_blank" href="/customers/create">here</a>.</p>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									{{Form::label('status', 'Status')}}
									{{Form::select('status', $statuses, null, ['id' => 'select2', 'class' => 'form-control select2', 'placeholder' => 'Status'])}}
								</div>
							</div>
						</div>

            <div id="fieldlist">

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    {{Form::label('product_id[]', 'Product')}}
                    {{Form::select('product_id[]', $products->pluck('name', 'id'), null, ['id' => 'select2', 'class' => 'form-control select2', 'placeholder' => 'Product'])}}
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    {{Form::label('quantity[]', 'Quantity')}}
                    {{Form::number('quantity[]', '', ['class' => 'form-control', 'placeholder' => 'Quantity'])}}
                  </div>
                </div>
              </div>

            </div>

						<div class="form-group">
							<a id="more" class="btn btn-block btn-default">+</a>
						</div>

						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									{{Form::label('notes', 'Notes (optional)')}}
									{{Form::textarea('notes', '', ['id' => 'ck-textarea', 'class' => 'form-control ck-textarea', 'style' => 'resize: vertical', 'placeholder' => 'Notes'])}}
								</div>
							</div>
						</div>

            {{Form::submit('Create order', ['class' => 'btn btn-default pull-right'])}}

						{!! Form::close() !!}

					</div>
				</div>
			</div>
    </div>
@stop

@section('js')
	<script src="{{asset('/js/render_select2.js')}}" charset="utf-8"></script>
	<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
	<script src="{{asset('/js/render_ckeditor.js')}}" charset="utf-8"></script>
  <script>
    var products = {!! json_encode($products->toArray(), JSON_HEX_TAG) !!};
  </script>
  <script src="{{asset('/js/order_dynamic_inputs.js')}}" charset="utf-8"></script>
@endsection
