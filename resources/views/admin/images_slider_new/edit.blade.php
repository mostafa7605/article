@extends('admin.layouts.app')
@section('content')
    @if (session('status'))
        <p id="alert-wishlist"class="alert alert-success"> {{ session('status') }}</p>
    @endif

    <div class="create-user-content">
        <div class="row">
            <div class="col-6">
                <form method="POST" action="{{ url('admin/image_slider/update', ['id' => $image_slider->id]) }}"
                    enctype="multipart/form-data">
                    @csrf
                    <table class="table ">
                        <tbody>

                            <tr>
                                <td>Order</td>

                                <td colspan="2"><input class="form-control" type="number"
                                        name="order"value="{{ old('order', $image_slider->order) }}">
                                    @if ($errors->has('order'))
                                        <p class="text-error more-info-err" style="color: red;">
                                            {{ $errors->first('order') }}</p>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Image</td>

                                <td colspan="2"><input class="form-control" type="file"
                                        name="image"value="{{ old('image') }}"oninput="slider_image.src=window.URL.createObjectURL(this.files[0])">

                                    @if ($errors->has('image'))
                                        <p class="text-error more-info-err" style="color: red;">
                                            {{ $errors->first('image') }}</p>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td></td>

                                <td>
                                    <img id="slider_image" style="border-radius: 10px;"height="120px" width="200px"
                                        src="{{ asset($image_slider->image) }}" alt="">
                                </td>
                            </tr>
                            <tr>
                                <td>Link</td>

                                <td colspan="2"><input class="form-control" type="text"
                                        name="deeb_link"value="{{ old('deeb_link', $image_slider->deeb_link) }}">
                                    @if ($errors->has('deeb_link'))
                                        <p class="text-error more-info-err" style="color: red;">
                                            {{ $errors->first('deeb_link') }}</p>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Title</td>

                                <td colspan="2">
                                    <input class="form-control" type="text"
                                        name="title"value="{{ old('title', $image_slider->title) }}">
                                    @if ($errors->has('title'))
                                        <p class="text-error more-info-err" style="color: red;">
                                            {{ $errors->first('title') }}</p>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Descreption</td>

                                <td colspan="2">
                                    <input class="form-control" type="text"
                                        name="description"value="{{ old('description', $image_slider->description) }}">
                                    @if ($errors->has('description'))
                                        <p class="text-error more-info-err" style="color: red;">
                                            {{ $errors->first('description') }}</p>
                                    @endif
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
