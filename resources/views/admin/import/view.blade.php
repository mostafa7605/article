@extends('admin.layouts.app')
	@section('content')
	@if(session('status'))
<p id="alert-wishlist"class="alert alert-success"> {{ session('status') }}</p>
@endif


	

 
 

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <form id="signupForm"  method="POST" action="{!! url('/admin/import') !!}" enctype="multipart/form-data">
              @csrf
                <h4 class="form-header text-uppercase">
                <i class="fa fa-bars"></i>
                Import Data 
                </h4>

               


                <div class="form-group row">
                  <label for="input-7" class="col-sm-2 col-form-label">Add file</label>
                  <div class="col-sm-4">
                  <input type="file" class="form-control" id="input-7" name="file"  required>
                  </div>
                 
                </div>

               
                
               
                <div class="form-footer">
                    <button class="btn btn-danger"><i class="fa fa-times"></i> CANCEL</button>
                    <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> SAVE</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div><!--End Row-->


      @endsection
      @section('scripts')

    <script>

 

  

   // validate signup form on keyup and submit
    $("#signupForm").validate({
       
       
       
    });



    </script>
    @endsection
	

