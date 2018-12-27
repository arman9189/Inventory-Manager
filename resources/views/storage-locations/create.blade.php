@extends('adminlte::page')

@section('title', 'New storage location')

@section('content_header')
    <h1>New storage location</h1>
@stop

@section('content')
	@include('includes.messages')
    <div class="row">
			<div class="col-sm-12">
				<div class="box box-danger">
					<div class="box-header with-border">
						<h3 class="box-title">New storage location</h3>
					</div>
					<div class="box-body">
						{!! Form::open(['action' => 'StorageLocationsController@store', 'method' => 'post']) !!}

						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									{{ Form::label('name', 'Storage location name') }}
									{{ Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Storage location name']) }}
								</div>
							</div>
						</div>

            <div class="row">
              <div class="col-sm-10">
                <div class="form-group">
                  {{ Form::label('street', 'Street name') }}
                  {{ Form::text('street', '', ['class' => 'form-control', 'placeholder' => 'Street name']) }}
                </div>
              </div>
              <div class="col-sm-2">
                <div class="form-group">
                  {{ Form::label('house_number', 'House number') }}
                  {{ Form::text('house_number', '', ['class' => 'form-control', 'placeholder' => 'House number']) }}
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  {{ Form::label('postal', 'Postal / Zip code') }}
                  {{ Form::text('postal', '', ['class' => 'form-control', 'placeholder' => 'Postal / Zip code']) }}
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  {{ Form::label('state_province_county', 'State / Province / County') }}
                  {{ Form::text('state_province_county', '', ['class' => 'form-control', 'placeholder' => 'State / Province / County']) }}
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  {{ Form::label('country', 'Country') }}
                  {{ Form::text('country', '', ['class' => 'form-control', 'placeholder' => 'Country']) }}
                </div>
              </div>
            </div>

						{{ Form::submit('Create storage location', ['class' => 'pull-right btn btn-default']) }}

						{!! Form::close() !!}
					</div>
				</div>
			</div>
    </div>
@stop
