@extends('adminlte::page')

@section('title', 'Edit storage location')

@section('content_header')
    <h1>Edit location {{$location->name}}</h1>
@stop

@section('content')
	@include('includes.messages')
    <div class="row">
			<div class="col-sm-12">
				<div class="box box-danger">
					<div class="box-header with-border">
						<h3 class="box-title">Edit storage location {{$location->name}}</h3>
					</div>
					<div class="box-body">
						{!! Form::open(['action' => ['StorageLocationsController@update', $location->id], 'method' => 'post']) !!}

						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									{{ Form::label('name', 'Storage location name') }}
									{{ Form::text('name', $location->name, ['class' => 'form-control', 'placeholder' => 'Storage location name']) }}
								</div>
							</div>
						</div>

            <div class="row">
              <div class="col-sm-10">
                <div class="form-group">
                  {{ Form::label('street', 'Street name') }}
                  {{ Form::text('street', $location->street, ['class' => 'form-control', 'placeholder' => 'Street name']) }}
                </div>
              </div>
              <div class="col-sm-2">
                <div class="form-group">
                  {{ Form::label('house_number', 'House number') }}
                  {{ Form::text('house_number', $location->house_number, ['class' => 'form-control', 'placeholder' => 'House number']) }}
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  {{ Form::label('postal', 'Postal / Zip code') }}
                  {{ Form::text('postal', $location->postal, ['class' => 'form-control', 'placeholder' => 'Postal / Zip code']) }}
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  {{ Form::label('state_province_county', 'State / Province / County') }}
                  {{ Form::text('state_province_county', $location->state_province_county, ['class' => 'form-control', 'placeholder' => 'State / Province / County']) }}
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  {{ Form::label('country', 'Country') }}
                  {{ Form::text('country', $location->country, ['class' => 'form-control', 'placeholder' => 'Country']) }}
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
