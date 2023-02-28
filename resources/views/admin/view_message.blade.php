@extends('admin.layouts.app')
	@section('content')
@if(session('status'))
<p id="alert-wishlist"class="alert alert-success"> {{ session('status') }}</p>
@endif
<div class="create-user-content">

    <div class="row">
        <div class="col-6">
            <form method="POST" action="{{ url('admin/sendMessage') }}"
            enctype="multipart/form-data">
            @csrf
            <table class="table ">
                <tbody>


                    <tr>
                        <td>Name</td>

                        <td colspan="2"><input class="form-control" type="text" disabled name="name" value="{{$message->name}}">
                            @if($errors->has('first_name'))
                            <p

                            class="text-error more-info-err"
                            style="color: red;"
                          >{{ $errors->first('first_name') }}</p>
                          @endif
                        </td>
                    </tr>


                    <tr>
                        <td>Phone Number</td>

                        <td colspan="2"><input class="form-control" disabled type="text" name="phone" value="{{$message->phone}}">
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

                        <td colspan="2"><input class="form-control" disabled type="text"value="{{$message->email}}">
                            @if($errors->has('email'))
                            <p

                            class="text-error more-info-err"
                            style="color: red;"
                          >{{ $errors->first('email') }}</p>
                          @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Message</td>
                        <td colspan="2">
                             <?php  $mes2 = str_replace(array('\r\n', '\n\r', '\n', '\r'), '<br>',$message->message )?>
                            <textarea class="form-control" disabled style="height: 130px" name="message"placeholder="leave a message :D">{{ $mes2 }}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Reply</td>
                        <td colspan="2">
                            <textarea class="form-control"  style="height: 100px" name="reply"placeholder="leave a message :D"></textarea>
                        </td>
                    </tr>
            </table>
            <input class="form-control" hidden type="text"name="email" value="{{$message->email}}">
            <input class="form-control" hidden type="text"name="name" value="{{$message->name}}">
            <input class="form-control" hidden type="text"name="message" value="{{$message->message}}">
            <div class="row">
                <input type="submit"  value="Send" class="create-user-submit">
            </div>
            </form>
        </div>
    </div>
    </div>

    @endsection
    @section('scripts')

    @endsection
