@extends('admin.layouts.app')
@section('content')
    @if (session('status'))
        <p id="alert-wishlist" class="alert alert-success"> {{ session('status') }}</p>
    @endif

    <div class="create-user-content">

        <div class="row">
            <div class="col-6">
                <form method="POST" action="{{ url('admin/saveinfo') }}" enctype="multipart/form-data">
                    @csrf
                    <table class="table ">
                        <tbody>
                            <tr>
                                <td>First Name</td>

                                <td colspan="2"><input class="form-control" type="text" name="first_name"
                                        value="{{ old('first_name', $user->first_name) }}">
                                    @if ($errors->has('first_name'))
                                        <p class="text-error more-info-err" style="color: red;">
                                            {{ $errors->first('first_name') }}</p>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Last Name</td>

                                <td colspan="2"><input class="form-control" type="text" name="last_name"
                                        value="{{ old('last_name', $user->last_name) }}">
                                    @if ($errors->has('last_name'))
                                        <p class="text-error more-info-err" style="color: red;">
                                            {{ $errors->first('last_name') }}</p>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Username</td>

                                <td colspan="2"><input class="form-control" type="text" name="username"
                                        value="{{ old('username', $user->username) }}">
                                    @if ($errors->has('username'))
                                        <p class="text-error more-info-err" style="color: red;">
                                            {{ $errors->first('username') }}</p>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <td>Phone Number</td>

                                <td colspan="2"><input class="form-control" type="text" name="phone"
                                        value="{{ old('phone', $user->phone) }}">
                                    @if ($errors->has('phone'))
                                        <p class="text-error more-info-err" style="color: red;">
                                            {{ $errors->first('phone') }}</p>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Email</td>

                                <td colspan="2"><input class="form-control" type="text" name="email"
                                        value="{{ old('email', $user->email) }}">
                                    @if ($errors->has('email'))
                                        <p class="text-error more-info-err" style="color: red;">
                                            {{ $errors->first('email') }}</p>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Image</td>

                                <td colspan="2"><input class="form-control" type="file" name="image"
                                        value="{{ old('image') }}"
                                        oninput="slider_image.src=window.URL.createObjectURL(this.files[0])">

                                    @if ($errors->has('image'))
                                        <p class="text-error more-info-err" style="color: red;">
                                            {{ $errors->first('image') }}</p>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td></td>

                                <td>
                                    <img id="slider_image" style="border-radius: 10px;" height="120px" width="200px"
                                        src="{{ asset($user->image) }}" alt="">
                                </td>
                            </tr>


                        </tbody>


                    </table>

                    <div class="row">
                        <input type="submit" value="Save" class="create-user-submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
