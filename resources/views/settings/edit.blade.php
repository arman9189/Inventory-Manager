@extends('adminlte::page')

@section('title', 'Settings')

@section('content_header')
    <h1>Settings</h1>
@stop

@section('content')
	@include('includes.messages')
    <div class="row">
			<div class="col-sm-12">
				<div class="box box-danger">
					<div class="box-header with-border">
						<h3 class="box-title">Settings</h3>
					</div>
					<div class="box-body">
						{{ Form::open(['action' => ['SettingsController@update'], 'method' => 'post']) }}
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										{{ Form::label('name', 'Username') }}
										{{ Form::text('name', auth()->user()->name, ['class' => 'form-control']) }}
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										{{ Form::label('email', 'Email address') }}
										{{ Form::text('email', auth()->user()->email, ['class' => 'form-control']) }}
									</div>
								</div>
							</div>

              {{ Form::hidden('userid', auth()->user()->id) }}

              {{ Form::submit('Save changes', ['class' => 'btn btn-default pull-right']) }}

						{{ Form::close() }}
					</div>
				</div>
			</div>
@stop

@section('js')
	<script src="{{asset('js/render_datatables.js')}}" charset="utf-8"></script>
@endsection
