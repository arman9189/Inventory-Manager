@extends('adminlte::page')

@section('title', 'Storage locations')

@section('content_header')
    <h1>Storage locations</h1>
@stop

@section('content')
	@include('includes.messages')
    <div class="row">
			<div class="col-sm-12">
				<div class="box box-danger">
					<div class="box-header with-border">
						<h3 class="box-title">Storage locations</h3>
					</div>
					<div class="box-body">
						<table class="table" id="datatable">
							<thead>
								<tr>
									<th>#</th>
									<th>Location name</th>
                  <th>Location address</th>
                  <th>Postal code</th>
                  <th>State / Province / County</th>
                  <th>Country</th>
									<th></th>
								</tr>
							</thead>
							<tbody>

								@foreach ($locations as $location)
									<tr>
										<td>{{$location->id}}</td>
										<td><a href="/storage-locations/{{$location->id}}">{{$location->name}}</a></td>
                    <td>{{$location->street}} {{$location->house_number}}</td>
                    <td>{{$location->postal}}</td>
                    <td>{{$location->state_province_county}}</td>
                    <td>{{$location->country}}</td>
										<td><a href="/storage-locations/{{$location->id}}/edit" class="btn btn-default">Edit</a></td>
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
