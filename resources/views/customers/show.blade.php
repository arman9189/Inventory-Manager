@extends('adminlte::page')

@section('title', 'Customer')

@section('content_header')
    <h1>Customer {{$customer->name}}</h1>
@stop

@section('content')
	@include('includes.messages')
    <div class="row">
			<div class="col-sm-3">
				<div class="box box-danger">
					<div class="box-header with-border">
						<h3 class="box-title">Customer {{$customer->name}}</h3>
					</div>
					<div class="box-body">
						<dl class="dl-vertical">
							<dt>Customer name</dt>
							<dd>{{$customer->name}}</dd>
							<dt>Phone</dt>
							<dd>{{$customer->phone}}</dd>
							<dt>Email address</dt>
							<dd>{{$customer->email}}</dd>
							<dt>Address</dt>
							<dd>{{$customer->street}} {{$customer->house_number}}</dd>
							<dt>Postal / zipcode</dt>
							<dd>{{$customer->postal}}</dd>
							<dt>State / Province / County</dt>
							<dd>{{$customer->state_province_county}}</dd>
							<dt>Country</dt>
							<dd>{{$customer->country}}</dd>
							<dt>Created at</dt>
							<dd>{{$customer->created_at}}</dd>
						</dl>
					</div>
				</div>
			</div>
      <div class="col-sm-9">
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
                    } elseif(in_array($order->status, ['Cancelled', 'Backorder'])) {
                      $label = 'danger';
                    }
                  @endphp

                  <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->customer->name}}</td>
                    <td><span class="label label-{{$label}}">{{$order->status}}</span></td>
                    <td>{{$order->created_at}}</td>
                  </tr>
                @endforeach

              </tbody>
            </table>
          </div>
        </div>
      </div>
      </div>
    </div>
@stop

@section('js')
  <script src="{{asset('js/render_select2.js')}}" charset="utf-8"></script>
@endsection
