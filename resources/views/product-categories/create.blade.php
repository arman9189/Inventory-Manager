@extends('adminlte::page')

@section('title', 'New product category')

@section('content_header')
    <h1>New product category</h1>
@stop

@section('content')
	@include('includes.messages')
    <div class="row">
			<div class="col-sm-12">
				<div class="box box-danger">
					<div class="box-header with-border">
						<h3 class="box-title">New product category</h3>
					</div>
					<div class="box-body">
						{!! Form::open(['action' => 'ProductCategoriesController@store', 'method' => 'post']) !!}

						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									{{ Form::label('name', 'Product category name') }}
									{{ Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Product category name']) }}
								</div>
							</div>
						</div>

						{{ Form::submit('Create product category', ['class' => 'pull-right btn btn-default']) }}

						{!! Form::close() !!}
					</div>
				</div>
			</div>
    </div>
@stop
