@extends('adminlte::page')

@section('title', 'About')

@section('content_header')
    <h1>About</h1>
@stop

@section('content')
	@include('includes.messages')
    <div class="row">
			<div class="col-sm-12">
				<div class="box box-danger">
					<div class="box-header with-border">
						<h3 class="box-title">About Inventory-Manager</h3>
					</div>
					<div class="box-body">
            <p>Inventory-Manager is an open-source stock / inventory management application based on the PHP-framework Laravel.</p>
            <p>Currently, Inventory-Manager supports these features to help manage your inventory:</p>
            <ul>
              <li>Product management</li>
              <li>Stock management</li>
              <li>Storage location management</li>
              <li>Supplier management</li>
            </ul>
            <p>These are some of the key features of Inventory-Manager:</p>
            <ul>
              <li>See which products are stored at what location</li>
              <li>Move products between locations in seconds</li>
              <li>Check stock in and out per location</li>
              <li>View which supplier supplies you what</li>
            </ul>
            <p>Inventory-Manager is being developed by rpm192, you can find the main repository <a target="_blank" href="https://github.com/rpm192/Laravel-Inventory-Manager">here</a>.</p>
            <p>Inventory-Manager is based on the front-end theme <a target="_blank" href="https://adminlte.io/themes/AdminLTE/index2.html">AdminLTE</a>.</p>
					</div>
          <div class="box-footer">
            <p class="text-muted">Current version: 0.8.9</p>
          </div>
				</div>
			</div>
@stop

@section('js')
	<script src="{{asset('js/render_datatables.js')}}" charset="utf-8"></script>
@endsection
