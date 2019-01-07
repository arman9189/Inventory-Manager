@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
  <div class="row">
    <div class="col-sm-3">
      <div class="box box-danger">
        <div class="box-body box-profile">
          <img class="profile-user-img img-responsive img-circle" src="{{asset('img/defaultuser.png')}}" alt="User profile picture">
          <h3 class="profile-username text-center">{{auth()->user()->name}}</h3>
          <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
              <b>Email address</b> <a class="pull-right">{{auth()->user()->email}}</a>
            </li>
            <li class="list-group-item">
              <b>Member since</b> <a class="pull-right">{{auth()->user()->created_at}}</a>
            </li>
            <li class="list-group-item">
              <b>Friends</b> <a class="pull-right">13,287</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-sm-9">
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Incoming orders (recent)</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table class="table no-margin">
              <thead>
              <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Status</th>
                <th>Placed at</th>
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
          <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          <a href="/orders/create" class="btn btn-sm btn-default pull-left">New Order</a>
          <a href="javascript:void(0)" class="btn btn-sm btn-default pull-right">All orders</a>
        </div>
        <!-- /.box-footer -->
      </div>
      <!-- /.box -->
    </div>
    </div>
  </div>
@stop
