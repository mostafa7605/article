@extends('layouts.app')
@section('content')
    @if (session('status'))
        <p id="alert-wishlist"class="alert alert-success"> {{ session('status') }}</p>
    @endif







    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form id="signupForm" method="POST" action="{!! url('/admin/create_image_slider') !!}" enctype="multipart/form-data">
                        @csrf
                        <h4 class="form-header text-uppercase">
                            <i class="fa fa-bars"></i>
                            Add Image Slider
                        </h4>



                        <div class="form-group row">
                            <label for="input-19" class="col-sm-2 col-form-label">Order</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="input-19" name="order" required>
                            </div>
                        </div>






                        <div class="form-group row">
                            <label for="input-7" class="col-sm-2 col-form-label">Image Slider</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" id="input-7" name="image" required>
                            </div>

                        </div>




                        <div class="form-footer">
                            <button class="btn btn-danger"><i class="fa fa-times"></i> CANCEL</button>
                            <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i>
                                SAVE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--End Row-->
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.js"></script>

    <script>
        $.validator.addMethod('filesize', function(value, element, param) {
            return this.optional(element) || (element.files[0].size / 1024 <= param * 1024)
        }, 'File size must be less than {0}');
        // validate signup form on keyup and submit
        $("#signupForm").validate({
            rules: {
                image: {
                    required: true,
                    extension: "webp"
                }


            },
            messages: {
                image: {
                    required: "Please upload file.",
                    extension: "Please upload file in these format only webp."
                }
            }

        });
    </script>
@endsection
