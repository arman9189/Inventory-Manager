@extends('adminlte::page')

@section('title', 'Orders')

@section('content_header')
    <h1>Orders</h1>
@stop

@section('content')
	@include('includes.messages')
    <div class="row">
			<div class="col-sm-12">
				<div class="box box-danger">
					<div class="box-header with-border">
						<h3 class="box-title">Orders</h3>
					</div>
					<div class="box-body">
						<table class="table" id="datatable">
							<thead>
								<tr>
									<th>#</th>
									<th>Customer name</th>
									<th>Status</th>
									<th>Created at</th>
                  <th></th>
								</tr>
							</thead>
							<tbody>

								@foreach ($orders as $order)

	                @php
	                  if(in_array($order->status, ['Quote', 'Quote sent'])) {
	                    $label = 'warning';
	                  } elseif(in_array($order->status, ['Processing', 'Awaiting payment', 'Ready to ship'])) {
	                    $label = 'info';
	                  } elseif(in_array($order->status, ['Shipped'])) {
	                    $label = 'success';
	                  } elseif(in_array($order->status, ['Cancelled', 'Back order'])) {
	                    $label = 'danger';
	                  } else {$label = '';}
	                @endphp

	                <tr>
	                  <td>{{$order->id}}</td>
	                  <td><a href="{{url('')}}/customers/{{$order->customer->id}}">{{$order->customer->name}}</a></td>
	                  <td><span class="label label-{{$label}}">{{$order->status}}</span></td>
	                  <td>{{$order->created_at}}</td>
                    <td><a href="{{url('')}}/orders/{{$order->id}}" class="btn btn-default">View</a></td>
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
