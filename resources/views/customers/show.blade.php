@extends('adminlte::page')

@section('title', 'Customer')

@section('content_header')
    <h1>Customer {{$customer->name}}</h1>
@stop

@section('content')
	@include('includes.messages')
    <div class="row">
			<div class="col-sm-5">
				<div class="box box-danger">
					<div class="box-header with-border">
						<h3 class="box-title">Customer {{$customer->name}}</h3>
					</div>
					<div class="box-body">
						<dl class="dl-vertical">
							<dt>Customer name</dt>
							<dd>{{$customer->name}}</dd>
							<br>
							<dt>Phone</dt>
							<dd>{{$customer->phone}}</dd>
							<br>
							<dt>Email address</dt>
							<dd>{{$customer->email}}</dd>
							<br>
							<dt>Address</dt>
							<dd>{{$customer->street}} {{$customer->house_number}}</dd>
							<br>
							<dt>Postal / zipcode</dt>
							<dd>{{$customer->postal}}</dd>
							<br>
							<dt>State / Province / County</dt>
							<dd>{{$customer->state_province_county}}</dd>
							<br>
							<dt>Country</dt>
							<dd>{{$customer->country}}</dd>
							<br>
							<dt>Created at</dt>
							<dd>{{$customer->created_at}}</dd>
						</dl>
					</div>
				</div>
			</div>
    </div>
@stop

@section('js')
  <script src="{{asset('js/render_select2.js')}}" charset="utf-8"></script>
@endsection
