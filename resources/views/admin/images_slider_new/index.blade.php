@extends('admin.layouts.app')
@section('content')
    @if (session('status'))
        <p id="alert-wishlist" class="alert alert-success"> {{ session('status') }}</p>
    @endif

    <div class="table-responsive-xl">
        <table class="table table-index table-roles">
            <thead class="spacer">
                <th style="width:14%">Num.</th>
                <th class="cell-name" style="width:93%">Image</th>
                <th>
                    <a href="{!! route('add_image_sliders') !!}" style="color: #cccccc;">
                        <div class="addUser-btn">
                            <span>Add Image</span> <img
                                src="{{ asset('rwrite/assets/images/admin/homepage/Group 419.svg') }}" alt="">
                        </div>
                    </a>
                </th>
            </thead>
            <tbody>
                <?php $index = 1; ?>
                @foreach ($imageSliders as $imageSlider)
                    <tr>
                        <td>{{ ($imageSliders ->currentpage()-1) * $imageSliders ->perpage() + $loop->index + 1  }}.</td>
                        <td class="cell-name"><img src="{!! asset($imageSlider->image) !!}" style="border-radius: 20px;"
                                width="200" height="auto"></td>
                        <td class="cell-action">
                            <span class="border-left" style="margin-right: 10px;"></span>
                            <a href="{!! url('/admin/image_slider/edit', ['id' => $imageSlider->id]) !!}">
                                <div class="edit">
                                    <span>Edit</span>
                                    <img src="{{ asset('rwrite/assets/images/admin/homepage/edit.svg') }}" alt="">
                                </div>
                            </a>
                            <button type="button" class="pop" data-toggle="modal"
                                data-target="#delete_{{ $imageSlider->id }}">
                                <div class="delete">
                                    <span>Delete</span>
                                    <img src="{{ asset('rwrite/assets/images/admin/homepage/trash-bin.svg') }}" alt="">
                                </div>
                            </button>
                        </td>
                    </tr>
                    <?php $index += 1; ?>
                    <!-- Modal delete-->
                    <div class="modal fade" id="delete_{{ $imageSlider->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <p class="text-center">Are you sure you want to delete image number
                                        “{{ $imageSlider->order }}”
                                        ?</p>
                                </div>
                                <div class="modal-footer border-0 justify-content-center">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <a href="{!! url('/admin/image_sliders/delete', ['id' => $imageSlider->id]) !!}" class="btn btn-danger">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- pagination -->
    <div class="page-number">
        <div>
            {!! $imageSliders->links() !!}
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        setTimeout(function() {
            $('#alert-wishlist').fadeOut('fast');
        }, 2000);
    </script>
@endsection
