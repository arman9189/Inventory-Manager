@extends('adminlte::page')

@section('title', 'Edit supplier {{$supplier->name}}')

@section('content_header')
    <h1>Edit supplier {{$supplier->name}}</h1>
@stop

@section('content')
	@include('includes.messages')
    <div class="row">
			<div class="col-sm-12">
				<div class="box box-danger">
					<div class="box-header with-border">
						<h3 class="box-title">Edit supplier {{$supplier->name}}</h3>
					</div>
					<div class="box-body">
						{!! Form::open(['action' => ['SuppliersController@update', $supplier->id], 'method' => 'post']) !!}

						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									{{ Form::label('name', 'Supplier name') }}
									{{ Form::text('name', $supplier->name, ['class' => 'form-control', 'placeholder' => 'Supplier name']) }}
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									{{ Form::label('website', 'Supplier website') }}
									{{ Form::text('website', $supplier->website, ['class' => 'form-control', 'placeholder' => 'Supplier website']) }}
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
