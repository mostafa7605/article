@extends('admin.layouts.app')
	@section('content')
@if(session('status'))
<p id="alert-wishlist"class="alert alert-success"> {{ session('status') }}</p>
@endif
<form method="POST" action="{{ url('admin/role/update', ['id' => $role->id]) }}"
    enctype="multipart/form-data">
    @csrf
<div class="roles-edit">
  <div class="row justify-content-center">
	  <div class="col-10">
		<div class="create-user-content">
			<div class="row">
				<div class="col-6">
					<table class="table m-0">
						<tbody>
							<tr>
								<td>Role Name</td>
								
								<td colspan="2"><input class="form-control"name="role_name"  value="{{$role->name}}" type="text">
                      @if($errors->has('role_name'))
                        <p

                        class="text-error more-info-err"
                        style="color: red;"
                      >{{ $errors->first('role_name') }}</p>
                      @endif
								</td>
							</tr>
						</tbody>
					</table>		
	  			</div>
	  		</div>
	  	</div>
		  <div class="row  justify-content-center">
			<p class="edit-permission">Edit Permissions</p>
		  </div>
		  <div class="row permission-list" >
			<div class="col">
				<h5>User :</h5>
				<ul>
					@foreach($user_permissions as $user_permission)
					<li><span><i class="fa fa-circle" aria-hidden="true"></i>{{ucwords(substr(strrchr($user_permission->name, "-"), 1))}}</span><input type="checkbox" name="permissions[]" class="checbox-table"@if(in_array($user_permission->id, $rolePermissions)) checked @endif value="{{$user_permission->id}}" ></li>
					@endforeach
				</ul>
			</div>
			<div class="col">
				<h5>Role :</h5>
				<ul>
					@foreach($role_permissions as $role_permission)
					<li><span><i class="fa fa-circle" aria-hidden="true"></i>{{ucwords(substr(strrchr($role_permission->name, "-"), 1))}}</span><input type="checkbox" name="permissions[]" class="checbox-table" @if(in_array($role_permission->id, $rolePermissions)) checked @endif value="{{$role_permission->id}}" ></li>
					@endforeach
				</ul>
			</div>
			<div class="col">
				<h5>Image Slider:</h5>
				<ul style="padding-left: 55px">
				@foreach($image_slider_permissions as $image_slider_permission)
					<li><span><i class="fa fa-circle" aria-hidden="true"></i>{{ucwords(substr(strrchr($image_slider_permission->name, "-"), 1))}}</span><input type="checkbox" name="permissions[]" class="checbox-table"  @if(in_array($image_slider_permission->id, $rolePermissions)) checked @endif value="{{$image_slider_permission->id}}" ></li>
					@endforeach
				</ul>
			</div>
			<div class="col">
				<h5>Media :</h5>
				<ul>
				@foreach($media_permissions as $media_permission)
					<li><span><i class="fa fa-circle" aria-hidden="true"></i>{{ucwords(substr(strrchr($media_permission->name, "-"), 1))}}</span><input type="checkbox" name="permissions[]" class="checbox-table" @if(in_array($media_permission->id, $rolePermissions)) checked @endif value="{{$media_permission->id}}" ></li>
					@endforeach
				</ul>
			</div>
			<div class="col">
				<h5>Rss feed :</h5>
				<ul style="padding-left: 45px">
				@foreach($feed_permissions as $feed_permission)
					<li><span><i class="fa fa-circle" aria-hidden="true"></i>{{ucwords(substr(strrchr($feed_permission->name, "-"), 1))}}</span><input type="checkbox" name="permissions[]" class="checbox-table" @if(in_array($feed_permission->id, $rolePermissions)) checked @endif value="{{$feed_permission->id}}" ></li>
					@endforeach
				</ul>
			</div>
		  </div>
		   @if($errors->has('permissions'))
                        <p

                        class="text-error more-info-err"
                        style="color: red;"
                      >{{ $errors->first('permissions') }}</p>
                      @endif
          <div class="row" style="text-align: center">
            <input type="submit" style="float:right;" value="Submit" class="create-user-submit">
        </div>
	  </div>
  </div>
</div>

@endsection
@section('scripts')

@endsection
