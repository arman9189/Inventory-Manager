@extends('adminlte::page')

@section('title', 'Customers')

@section('content_header')
    <h1>Customers</h1>
@stop

@section('content')
	@include('includes.messages')
    <div class="row">
			<div class="col-sm-12">
				<div class="box box-danger">
					<div class="box-header with-border">
						<h3 class="box-title">Customers</h3>
					</div>
					<div class="box-body">
						<table class="table" id="datatable">
							<thead>
								<tr>
									<th>#</th>
									<th>Customer name</th>
									<th>Email address</th>
									<th>Phone number</th>
									<th>Country</th>
									<th></th>
								</tr>
							</thead>
							<tbody>

								@foreach ($customers as $customer)
									<tr>
										<td>{{$customer->id}}</td>
										<td><a href="/customers/{{$customer->id}}">{{$customer->name}}</a></td>
										<td>{{$customer->email}}</td>
										<td>{{$customer->phone}}</td>
										<td>{{$customer->country}}</td>
										<td><a href="/customers/{{$customer->id}}/edit" class="btn btn-default">Edit</a></td>
									</tr>
								@endforeach

							</tbody>
						</table>
					</div>
				</div>
			</div>
    </div>
@stop

@section('js')
	<script src="{{asset('js/render_datatables.js')}}" charset="utf-8"></script>
@endsection
