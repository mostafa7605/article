@extends('layouts.app')
	@section('content')
	@if(session('status'))
						<p id="alert-wishlist"class="alert alert-success"> {{ session('status') }}</p>
						@endif
   



      

                        </div>


     </div>

    

          
     

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Articles {{count($articles)}} item</div>
            <div class="card-body">
              <div class="table-responsive">
              <table id="example" class="table table-bordered" >
                <thead>
                    <tr>
                        <th>Num.</th>
                        <th>Name</th>
                        <th>User Email</th>
                        <th>Actions</th>
                
                     
                      
                    
                      
                    </tr>
                </thead>
                <tbody>
                   @foreach($articles as $article)
                <tr>
                        <td>{{$article->id}}</td>
                        <td>{{$article->title}}</td>
                        @if(isset($article->user))
                        <td>{{$article->user->email}}</td>
                        @else
                        <td>{{$article->author}}</td>

                        @endif
                        <td> 
                        @can('article-edit')
                        @if($article->approved==0)
                        <a type="button"  href="{{ url('/admin/articles/approved', ['id' =>  $article->id,'approved'=>1]) }}" class="btn  waves-effect waves-light m-1" style="background:green;color:white ">Approved</a>
                        @else
                        <a type="button"  href="{{ url('/admin/articles/approved', ['id' => $article->id,'approved'=>0]) }}" class="btn  waves-effect waves-light m-1" style="background:green;color:white ">UnApproved</a>

                        @endif
                        @endcan
                        @can('article-delete')
                        <a type="button"  onclick="return confirm_alert(this);" href="{{ url('/admin/articles/delete', ['id' => $article->id]) }}" class="btn  waves-effect waves-light m-1" style="background:red;color:white ">Delete</a>
                        @endcan
                        @can('article-hide')
                        @if($article->show==1)
                        <a type="button"   href="{{ url('/admin/articles/show', ['id' => $article->id,'show'=>0]) }}" class="btn  waves-effect waves-light m-1" style="background:red;color:white ">Hide</a>
                        @else
                        <a type="button"  href="{{ url('/admin/articles/show', ['id' => $article->id,'show'=>1]) }}" class="btn  waves-effect waves-light m-1" style="background:red;color:white ">Show</a>
                        @endif
                       @endcan
                
                        <a type="button"  href="{{ url('/admin/articles/view', ['id' => $article->id]) }}" class="btn  waves-effect waves-light m-1" style="background:blue;color:white ">View</a>
                      </td>
                    
                 
                  
                        

                        
                    </tr>
                    @endforeach
                 
                  
                  
                  
                  
                   
                </tbody>
                <tfoot>
                <tr>
                         <th>Num.</th>
                        <th>Name</th>
                        <th>User Email</th>
                     
                     
                      
                    
                      
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
    return confirm("Are you sure you want to delete this article");
}
  setTimeout(function() {
$('#alert-wishlist').fadeOut('fast');
}, 2000);
</script>
<script>
            var table = $('#example').DataTable ( {
"bFilter": false,
lengthChange: false,
"searching": true,
buttons: [ 'copy', 'excel', 'pdf', 'print', 'colvis' ]
} );
    

</script>
@endsection
