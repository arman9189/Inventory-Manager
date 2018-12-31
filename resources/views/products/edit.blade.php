@extends('adminlte::page')

@section('title', 'Edit product {{$product->name}}')

@section('content_header')
    <h1>Edit product {{$product->name}}</h1>
@stop

@section('content')
	@include('includes.messages')
    <div class="row">
			<div class="col-sm-12">
				<div class="box box-danger">
					<div class="box-header with-border">
						<h3 class="box-title">Edit product {{$product->name}}</h3>
					</div>
					<div class="box-body">
						{!! Form::open(['action' => ['ProductsController@update', $product->id], 'method' => 'post']) !!}

						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									{{ Form::label('name', 'Product name') }}
									{{ Form::text('name', $product->name, ['class' => 'form-control', 'placeholder' => 'Product name']) }}
								</div>
							</div>
						</div>

            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  {{Form::label('description', 'Product description')}}
                  {{Form::textarea('description', $product->description, ['id' => 'ck-textarea', 'class' => 'form-control', 'style' => 'resize: vertical', 'placeholder' => 'Product description'])}}
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  {{Form::label('product_category_id', 'Product category')}}
                  {{Form::select('product_category_id', $categories->pluck('name', 'id'), $product->product_category_id, ['id' => 'select2', 'class' => 'form-control select2', 'placeholder' => 'Product category'])}}
                  <p>Is the category you're looking for not in this list? Create it <a target="_blank" href="/product-categories/create">here</a>.</p>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  {{Form::label('supplier_id', 'Supplier')}}
                  {{Form::select('supplier_id', $suppliers->pluck('name', 'id'), $product->supplier_id, ['id' => 'select2', 'class' => 'form-control select2', 'placeholder' => 'Supplier'])}}
                  <p>Is the supplier you're looking for not in this list? Add them <a target="_blank" href="/suppliers/create">here</a>.</p>
                </div>
              </div>
            </div>

            <div class="row">
    					<div class="col-sm-6">
    						<div class="form-group">
    							{{Form::label('sales_price', 'Sales price')}}
    				      {{Form::number('sales_price', $product->sales_price, ['step' => '0.01', 'class' => 'form-control', 'placeholder' => 'Sales price'])}}
    						</div>
    					</div>
              <div class="col-sm-6">
                <div class="form-group">
                  {{Form::label('buy_price', 'Buy-in price')}}
                  {{Form::number('buy_price', $product->buy_price, ['step' => '0.01', 'class' => 'form-control', 'placeholder' => 'Buy-in price'])}}
                </div>
              </div>
    				</div>

            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  {{Form::label('instock', 'In stock')}}
                  {{Form::select('instock', [0 => 'No', 1 => 'Yes'], $product->instock, ['id' => 'select2', 'class' => 'form-control select2', 'placeholder' => 'In stock'])}}
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  {{Form::label('discontinued', 'Discontinued')}}
                  {{Form::select('discontinued', [0 => 'No', 1 => 'Yes'], $product->discontinued, ['id' => 'select2', 'class' => 'form-control select2', 'placeholder' => 'Discontinued'])}}
                </div>
              </div>
            </div>

            {{ Form::hidden('_method', 'PUT') }}
						{{ Form::submit('Save changes', ['class' => 'pull-right btn btn-default']) }}

						{!! Form::close() !!}
					</div>
				</div>
			</div>
    </div>
@stop

@section('js')
  <script src="{{asset('js/render_select2.js')}}" charset="utf-8"></script>
  <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
  <script src="{{asset('js/render_ckeditor.js')}}" charset="utf-8"></script>
@endsection
