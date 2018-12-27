@extends('adminlte::page')

@section('title', 'Edit product category {{$category->name}}')

@section('content_header')
    <h1>Edit product category {{$category->name}}</h1>
@stop

@section('content')
	@include('includes.messages')
    <div class="row">
			<div class="col-sm-12">
				<div class="box box-danger">
					<div class="box-header with-border">
						<h3 class="box-title">Edit product category {{$category->name}}</h3>
					</div>
					<div class="box-body">
						{!! Form::open(['action' => ['ProductCategoriesController@update', $category->id], 'method' => 'post']) !!}

						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									{{ Form::label('name', 'Product category name') }}
									{{ Form::text('name', $category->name, ['class' => 'form-control', 'placeholder' => 'Product category name']) }}
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
