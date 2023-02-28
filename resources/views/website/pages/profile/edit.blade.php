@extends('website.layouts.app')
@section('content')
    <section class="edit-profile">
        <div class="m-auto" style="width: 95%;">
            <form id="update_profile_form" method="POST" enctype="multipart/form-data" action="{{ url('/updateprofile') }}">
                @csrf
                <div class="content-edit-profile ">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="profile-pic-wrapper" data-aos="fade-right">
                                <div class="pic-holder position-relative">
                                    <!-- uploaded pic shown here -->
                                    @if (is_null(auth()->user()->image) || auth()->user()->image == '')
                                        <img id="profilePic" class="pic"
                                            src="{{ asset('assets/img/person-img.png ') }}" />
                                        <img class="position-absolute bottom-0 start-50 translate-middle-x mb-4"
                                            src="{{ asset('assets/img/camera.png ') }}" width="40px" />
                                    @else
                                        <img id="profilePic" class="pic" src="{{ asset(auth()->user()->image) }}" />
                                    @endif
                                    <label for="newProfilePhoto" class="upload-file-block">
                                        <div class="text-center">
                                            <div class="text-uppercase">
                                                change image
                                            </div>
                                        </div>
                                    </label>
                                    <input class="uploadProfileInput" type="file" name="image" id="newProfilePhoto"
                                        accept="image/*" style="visibility: hidden;" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="secound-content2" style="margin-bottom: 60px;">
                                <h2>Edit Profile</h2>
                                <p>Update your photo and personal details</p>
                            </div>
                            <div class="form-edit-profile mt-3">

                                <div class="mb-4 pb-4 row border-bottom">
                                    <label class="col-md-3 col-form-label">Username</label>
                                    <div class="col-md-9">
                                        <input readonly type="text" class="form-control" value="{{ $user->username }}"
                                            style="background-color: #fff">
                                    </div>
                                </div>
                                <div class="mb-4 pb-4 row border-bottom">
                                    <label class="col-md-3 col-form-label">Email</label>
                                    <div class="col-md-9">
                                        <input readonly type="email" class="form-control" value="{{ $user->email }}"
                                            style="background-color: #fff">
                                    </div>
                                </div>
                                <div class="mb-4 pb-4 row">
                                    <label class="col-md-3 col-form-label">Your bio</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="bio" placeholder="Add a short bio …" style="height: 130px">{{ $user->bio }}</textarea>
                                    </div>
                                </div>
                                <button type="submit" class="submit">Save</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
            <div class="change-pass">
                <ul class="mb-4">
                    <li>
                        <span>Password</span>
                    </li>
                    <li style="float: right">
                        <a href="{{ url('/change-password') }}">Change</a>
                    </li>
                </ul>
                <p>You can set or change your Password <br> by clicking here</p>
            </div>

        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $(document).on("change", ".uploadProfileInput", function() {
            var triggerInput = this;
            var currentImg = $(this).closest(".pic-holder").find(".pic").attr("src");
            var holder = $(this).closest(".pic-holder");
            var wrapper = $(this).closest(".profile-pic-wrapper");
            $(wrapper).find('[role="alert"]').remove();
            triggerInput.blur();
            var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader) {
                return;
            }
            if (/^image/.test(files[0].type)) {
                // only image file
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[0]); // read the local file

                reader.onloadend = function() {
                    $(holder).addClass("uploadInProgress");
                    $(holder).find(".pic").attr("src", this.result);
                    $(holder).append(
                        '<div class="upload-loader"> <div class="spinner-border text-primary" role="status"></div> </div>'
                    );

                    // Dummy timeout; call API or AJAX below
                    setTimeout(() => {
                        $(holder).removeClass("uploadInProgress");
                        $(holder).find(".upload-loader").remove();
                        // If upload successful
                        if (Math.random() < 0.9) {
                            // 

                        } else {
                            $(holder).find(".pic").attr("src", currentImg);
                            $(wrapper).append(
                                '<div class="snackbar show" role="alert"><i class="fa fa-times-circle text-danger"></i> There is an error while uploading! Please try again later.</div>'
                            );
                            setTimeout(() => {
                                $(wrapper).find('[role="alert"]').remove();
                            }, 3000);

                        }
                    }, 1500);
                };
            } else {
                $(wrapper).append(
                    '<div class="alert alert-danger d-inline-block p-2 small" role="alert">Please choose the valid image.</div>'
                );
                setTimeout(() => {
                    $(wrapper).find('role="alert"').remove();
                }, 3000);
            }
        });
    </script>
@endpush
