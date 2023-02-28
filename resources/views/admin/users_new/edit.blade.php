@extends('admin.layouts.app')
	@section('content')
@if(session('status'))
<p id="alert-wishlist"class="alert alert-success"> {{ session('status') }}</p>
@endif

<div class="create-user-content">

<div class="row">
    <div class="col-6">
        <form method="POST" action="{{ url('admin/user/update', ['id' => $user->id]) }}"
        enctype="multipart/form-data">
        @csrf
        <table class="table ">
            <tbody>
                <tr>
                    <td></td>
                    <td>
                        @if($errors->has('roles'))
                        <p

                        class="text-error more-info-err"
                        style="color: red;"
                      >{{ $errors->first('roles') }}</p>
                      @endif
                    </td>
                    <td style="float:right">
                    <select name="roles" id="roles" class="cell-select m-0">
                          @if($userRole)
                            @foreach ($roles as $role)
                            <option value="{{ $role->id }}"@if($role->id==$userRole->id) selected @endif>{{ $role->name }}</option>
                            @endforeach
                         @else
                         <option value="">Please Select Role</option>
                         @foreach ($roles as $role)
                         <option value="{{ $role->id }}">{{ $role->name }}</option>
                         @endforeach
                         @endif
                    </select>
                    </td>
                </tr>
                <tr>
                    <td>First Name</td>

                    <td colspan="2"><input class="form-control" type="text" name="first_name" value="{{old('first_name',$user->first_name)}}">
                        @if($errors->has('first_name'))
                        <p

                        class="text-error more-info-err"
                        style="color: red;"
                      >{{ $errors->first('first_name') }}</p>
                      @endif
                    </td>
                </tr>
                <tr>
                    <td>Last Name</td>

                    <td colspan="2"><input class="form-control" type="text" name="last_name" value="{{old('last_name',$user->last_name)}}">
                        @if($errors->has('last_name'))
                        <p

                        class="text-error more-info-err"
                        style="color: red;"
                      >{{ $errors->first('last_name') }}</p>
                      @endif
                    </td>
                </tr>
                <tr>
                    <td>Username</td>

                    <td colspan="2"><input class="form-control" type="text" name="username" value="{{old('username',$user->username)}}">
                        @if($errors->has('username'))
                        <p

                        class="text-error more-info-err"
                        style="color: red;"
                      >{{ $errors->first('username') }}</p>
                      @endif
                    </td>
                </tr>

                <tr>
                    <td>Phone Number</td>

                    <td colspan="2"><input class="form-control" type="text" name="phone" value="{{old('phone',$user->phone)}}">
                        @if($errors->has('phone'))
                        <p

                        class="text-error more-info-err"
                        style="color: red;"
                      >{{ $errors->first('phone') }}</p>
                      @endif
                    </td>
                </tr>
                <tr>
                    <td>Email</td>

                    <td colspan="2"><input class="form-control" type="text"name="email" value="{{old('email',$user->email)}}">
                        @if($errors->has('email'))
                        <p

                        class="text-error more-info-err"
                        style="color: red;"
                      >{{ $errors->first('email') }}</p>
                      @endif
                    </td>
                </tr>


            </tbody>


        </table>

        <div class="row">
            <input type="submit"  value="Submit" class="create-user-submit">
        </div>
        </form>
    </div>
</div>
</div>

@endsection
@section('scripts')

@endsection
