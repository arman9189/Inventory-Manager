@extends('adminlte::page')

@section('title', 'Product categories')

@section('content_header')
    <h1>Product categories</h1>
@stop

@section('content')
	@include('includes.messages')
    <div class="row">
			<div class="col-sm-12">
				<div class="box box-danger">
					<div class="box-header with-border">
						<h3 class="box-title">Product categories</h3>
					</div>
					<div class="box-body">
						<table class="table" id="datatable">
							<thead>
								<tr>
									<th>#</th>
									<th>Category name</th>
									<th></th>
								</tr>
							</thead>
							<tbody>

								@foreach ($categories as $category)
									<tr>
										<td>{{$category->id}}</td>
										<td><a href="/product-categories/{{$category->id}}">{{$category->name}}</a></td>
										<td><a href="/product-categories/{{$category->id}}/edit" class="btn btn-default">Edit</a></td>
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
