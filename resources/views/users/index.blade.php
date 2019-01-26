@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
    <h1>Users</h1>
@stop

@section('content')
	@include('includes.messages')
    <div class="row">
			<div class="col-sm-12">
				<div class="box box-danger">
					<div class="box-header with-border">
						<h3 class="box-title">Users</h3>
					</div>
					<div class="box-body">
						<table class="table" id="datatable">
							<thead>
								<tr>
									<th>#</th>
									<th>Name</th>
                  <th>Email address</th>
                  <th>Member since</th>
									<th></th>
                  <th></th>
								</tr>
							</thead>
							<tbody>

								@foreach ($users as $user)
									<tr>
										<td>{{$user->id}}</td>
										<td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->created_at}}</td>
										<td><a href="{{url('')}}/users/{{$user->id}}/edit" class="btn btn-default">Edit</a></td>
                    <td>
                      {!! Form::open(['action' => ['UsersController@destroy', $user->id], 'method' => 'post']) !!}
                        {{Form::hidden('_method', 'DELETE')}}
                        {{Form::submit('Delete', ['class' => 'btn btn-default'])}}
                      {!! Form::close() !!}
                    </td>
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
