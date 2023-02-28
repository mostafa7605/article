@extends('layouts.app')
@section('content')
    @if (session('status'))
        <p id="alert-wishlist" class="alert alert-success"> {{ session('status') }}</p>
    @endif






    </div>
    @can('image-slider-create')
        <a type="button" href="{!! url('/admin/add_image_slider') !!}" class="btn btn-primary waves-effect waves-light m-1">Add New Image
            Slider</a>
    @endcan

    </div>






    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header"><i class="fa fa-table"></i> Images Slider {{ count($imageSliders) }} item
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Num.</th>
                                    <th>Name</th>
                                    <th>Order</th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($imageSliders as $image)
                                    <tr>
                                        <td>{{ $image->id }}</td>
                                        <td> <img src="{!! asset($image->image) !!}" height="100"></td>
                                        <td>{{ $image->order }}</td>
                                        @can('image-slider-edit')
                                            <td> <a type="button"
                                                    href="{{ url('/admin/image_slider/edit', ['id' => $image->id]) }}"
                                                    class="btn  waves-effect waves-light m-1"
                                                    style="background:green;color:white ">Edit</a>
                                            @endcan
                                            @can('image-slider-delete')
                                                <a type="button" onclick="return confirm_alert(this);"
                                                    href="{{ url('/admin/image_slider/delete', ['id' => $image->id]) }}"
                                                    class="btn  waves-effect waves-light m-1"
                                                    style="background:red;color:white ">Delete</a>
                                            </td>
                                        @endcan
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Num.</th>
                                    <th>Name</th>
                                    <th>Order</th>
                                    <th> Delete</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- End Row-->
@endsection
@section('scripts')
    <script>
        function confirm_alert(node) {
            return confirm("Are you sure you want to delete this product");
        }
        setTimeout(function() {
            $('#alert-wishlist').fadeOut('fast');
        }, 2000);
    </script>
    <script>
        var table = $('#example').DataTable({
            "bFilter": false,
            lengthChange: false,
            "searching": true,
            buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
        });
    </script>
    <script type="text/javascript">
        setTimeout(function() {
            $('#alert-wishlist').fadeOut('fast');
        }, 2000);
    </script>
@endsection
