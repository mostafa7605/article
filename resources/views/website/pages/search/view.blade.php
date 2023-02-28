@extends('website.layouts.app')
<style>
    .icon_search {
        display: none !important;
    }
</style>
@section('content')
    <div id="myOverlay2" class="overlay h-auto mt-4" style="display: block;position: inherit;">
        <div class="overlay-content">
            <form id="form_12" method="post" action="{{ route('search') }}" enctype="multipart/form-data">
                @csrf
                <div class="d-flex">
                    <div class="position-relative search-bar">
                        <input type="text" id="search2" placeholder="Search.." name="search">
                        <img onclick="submit_search();" class="search-icon" src="{{ asset('assets/img/search1.svg ') }}" />
                        <span class="closebtn" onclick="removeValue2()">×</span>
                    </div>
                    <select class="form-select" id="type_search" name="search_type" aria-label="Default select example"
                        required>
                        <option value="1" selected>R-Content</option>
                        <option value="2">R-Writers</option>
                    </select>
                </div>

                <div style="text-align: left; padding-left: 10px;">
                    <p id="error_message2" class="text-error more-info-err" style="color: red;"></p>

                </div>
                <button type="button" style="visibility: hidden"><i class="fa fa-search"></i></button>
            </form>
        </div>
    </div>

    {!! $view !!}


    <script>
        function search_type(id, type) {
            document.getElementById('dropdownMenu2').innerHTML = type;
            document.getElementById('type_search').value = id;
        }

        function copylink(id, type) {
            let url = 'https://newrwrite.msol.dev/article/view/';
            var tempInput = document.createElement("input");

            tempInput.style = "position: absolute; left: -1000px; top: -1000px";
            tempInput.value = url + id;
            document.body.appendChild(tempInput);
            tempInput.select();

            try {
                var successful = document.execCommand('copy');

                document.getElementById(type + '_span_' + id).style.display = 'inline-block';
                setTimeout(function() {
                    $('#' + type + '_span_' + id).fadeOut('fast');
                }, 1000);
                var msg = successful ? 'successful' : 'unsuccessful';
                console.log('Copying text command was ' + msg);
                document.body.removeChild(tempInput);
            } catch (err) {
                console.log('Oops, unable to copy');
            }
        }


        function bookmark_all(article_id, purchase_type) {
            let element = document.getElementById('image_bookmark' + article_id);
            if (purchase_type == 'dark') {
                if (element.className == "marked") {
                    element.className = "not_marked";
                    element.src = "{{ asset('assets/img/bookmark.svg ') }}"
                    document.getElementById('paid_image_bookmark' + article_id).className = "not_marked";
                    document.getElementById('paid_image_bookmark' + article_id).src =
                        "{{ asset('assets/img/bookmark.svg ') }}"
                } else {
                    element.className = "marked";
                    element.src = "{{ asset('assets/img/bookmark_fill.svg ') }}"
                    document.getElementById('paid_image_bookmark' + article_id).className = "marked";
                    document.getElementById('paid_image_bookmark' + article_id).src =
                        "{{ asset('assets/img/bookmark_fill.svg ') }}"
                }
            } else if (purchase_type == 'light') {
                if (element.className == "marked") {
                    element.className = "not_marked";
                    element.src = "{{ asset('assets/img/bookmark_white.svg ') }}"
                    document.getElementById('free_image_bookmark' + article_id).className = "not_marked";
                    document.getElementById('free_image_bookmark' + article_id).src =
                        "{{ asset('assets/img/bookmark_white.svg ') }}"
                } else {
                    element.className = "marked";
                    element.src = "{{ asset('assets/img/bookmark_white_fill.svg ') }}"
                    document.getElementById('free_image_bookmark' + article_id).className = "marked";
                    document.getElementById('free_image_bookmark' + article_id).src =
                        "{{ asset('assets/img/bookmark_white_fill.svg ') }}"
                }
            }

            $.ajax({
                type: 'GET',
                url: '/bookmark/' + article_id,
                success: function(data) {

                }
            });
        }

        function bookmark2_free(article_id) {
            let element = document.getElementById('free_image_bookmark' + article_id);

            if (element.className == "marked") {
                element.className = "not_marked";
                element.src = "{{ asset('assets/img/bookmark_white.svg ') }}"

                document.getElementById('image_bookmark' + article_id).src =
                    "{{ asset('assets/img/bookmark_white.svg ') }}";
                document.getElementById('image_bookmark' + article_id).className = "not_marked";
            } else {
                element.className = "marked";
                element.src = "{{ asset('assets/img/bookmark_white_fill.svg ') }}"
                document.getElementById('image_bookmark' + article_id).className = "marked";
                document.getElementById('image_bookmark' + article_id).src =
                    "{{ asset('assets/img/bookmark_white_fill.svg ') }}"
            }


            $.ajax({
                type: 'GET',
                url: '/bookmark/' + article_id,
                success: function(data) {

                }
            });
        }


        function bookmark2_paid(article_id) {
            let element = document.getElementById('paid_image_bookmark' + article_id);

            if (element.className == "marked") {
                element.className = "not_marked";
                element.src = "{{ asset('assets/img/bookmark.svg ') }}"
                document.getElementById('image_bookmark' + article_id).className = "not_marked";
                document.getElementById('image_bookmark' + article_id).src = "{{ asset('assets/img/bookmark.svg ') }}"
            } else {
                element.className = "marked";
                element.src = "{{ asset('assets/img/bookmark_fill.svg ') }}"
                document.getElementById('image_bookmark' + article_id).className = "marked";
                document.getElementById('image_bookmark' + article_id).src = "{{ asset('assets/img/bookmark_fill.svg ') }}"
            }


            $.ajax({
                type: 'GET',
                url: '/bookmark/' + article_id,
                success: function(data) {

                }
            });
        }
    </script>
@endsection
