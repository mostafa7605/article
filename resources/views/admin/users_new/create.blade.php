@extends('admin.layouts.app')
@section('content')
    @if (session('status'))
        <p id="alert-wishlist"class="alert alert-success">
            {{ session('status') }}</p>
    @endif

    <div class="create-user-content">
        <div class="row">
            <div class="col-6">
                <form method="POST" action="{{ url('admin/new_user/add_new') }}"
                    aria-label="{{ __('admin/new_user/add_new') }}" enctype="multipart/form-data">
                    @csrf
                    <table class="table ">
                        <tbody>
                            <tr>
                                <td></td>
                                <td>
                                    @if ($errors->has('roles'))
                                        <p class="text-error more-info-err" style="color: red;">
                                            {{ $errors->first('roles') }}</p>
                                    @endif
                                </td>
                                <td style="float:right">
                                    <select name="roles" id="roles" class="cell-select m-0">
                                        <option value="">please select role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach


                                    </select>

                                </td>
                            </tr>
                            <tr>
                                <td>First Name</td>

                                <td colspan="2"><input class="form-control" type="text"
                                        name="first_name"value="{{ old('first_name') }}" placeholder="Enter First Name">
                                    @if ($errors->has('first_name'))
                                        <p class="text-error more-info-err" style="color: red;">
                                            {{ $errors->first('first_name') }}</p>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Last Name</td>

                                <td colspan="2"><input class="form-control" type="text"
                                        name="last_name"value="{{ old('last_name') }}" placeholder="Enter Last Name">
                                    @if ($errors->has('last_name'))
                                        <p class="text-error more-info-err" style="color: red;">
                                            {{ $errors->first('last_name') }}</p>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Username</td>

                                <td colspan="2"><input class="form-control" type="text"
                                        name="username"value="{{ old('username') }}" placeholder="Enter Username">
                                    @if ($errors->has('username'))
                                        <p class="text-error more-info-err" style="color: red;">
                                            {{ $errors->first('username') }}</p>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <td>Phone Number</td>

                                <td colspan="2"><input class="form-control" type="text"
                                        name="phone"value="{{ old('phone') }}" placeholder="Enter Phone Number">
                                    @if ($errors->has('phone'))
                                        <p class="text-error more-info-err" style="color: red;">
                                            {{ $errors->first('phone') }}</p>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Email</td>

                                <td colspan="2"><input class="form-control"
                                        type="text"name="email"value="{{ old('email') }}" placeholder="Enter Email">
                                    @if ($errors->has('email'))
                                        <p class="text-error more-info-err" style="color: red;">
                                            {{ $errors->first('email') }}</p>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Password</td>

                                <td colspan="2"><input class="form-control" type="password" name="password" placeholder="Enter Password">
                                    @if ($errors->has('password'))
                                        <p class="text-error more-info-err" style="color: red;">
                                            {{ $errors->first('password') }}</p>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Confirm Password</td>

                                <td colspan="2"><input class="form-control" type="password"name="confirm_password" placeholder="Confirm Password">
                                    @if ($errors->has('confirm_password'))
                                        <p class="text-error more-info-err" style="color: red;">
                                            {{ $errors->first('confirm_password') }}</p>
                                    @endif
                                </td>
                            </tr>

                        </tbody>


                    </table>
                    <div class="row">
                        <input type="submit" value="Submit" class="create-user-submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
