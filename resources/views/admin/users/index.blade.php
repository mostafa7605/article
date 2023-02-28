@extends('layouts.app')
	@section('content')
@if(session('status'))
<p id="alert-wishlist"class="alert alert-success"> {{ session('status') }}</p>
@endif



<div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header"><h3 style="color:#a97e01"> Users</h3></div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered">
                            <thead>
                            <tr>

                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Edit</th>
                                


                                


                            </tr>
                            </thead>
                            <tbody>


                            @foreach($users as $user)
                                <tr>
                                <td>{{$user->id }} </td>
                    
                              <td>{{$user->first_name}}</td>
                              <td>{{$user->last_name}}</td>
                              <td>{{$user->email}}</td>

                                <td>
                                @if(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $v)
                                <label class="badge badge-success">{{ $v }}</label>
                                @endforeach
                                @endif
                                </td>
                              <td> <a class="show" title="show" data-toggle="tooltip" href="{{ url('admin/users/edit', ['id' => $user->id]) }}"> Edit User</a></td>


                                </tr>
                            @endforeach


                            </tbody>
                            <tfoot>
                            <tr>

                            <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Edit</th>
                               
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- End Row-->

  <!--Start Dashboard Content-->


@endsection
@section('scripts')

@endsection
