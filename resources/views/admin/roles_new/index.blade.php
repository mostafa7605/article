@extends('admin.layouts.app')
	@section('content')
@if(session('status'))
<p id="alert-wishlist"class="alert alert-success"> {{ session('status') }}</p>
@endif

<div class="table-responsive-xl">
  <table class="table table-index table-roles">
    <thead class="spacer">

		<th style="width:14%">Num.</th>
		<th class="cell-name" style="width:93%">Role Name</th>

		<th  >
            <a href="{!! route('add_roles')  !!}" style="color: #cccccc;">
			<div class="addUser-btn">
			<span>add role</span> <img src="{{asset('rwrite/assets/images/admin/homepage/Group 419.svg')}}" alt="">
			</div>
            </a>
		</th>
	</thead>

	<tbody>
        <?php
        $index=1;

       ?>
       @foreach ($roles as $role )
       <tr>
        <td>{{ ($roles ->currentpage()-1) * $roles ->perpage() + $loop->index + 1  }}.</td>
        <td class="cell-name">{{ $role->name }}</td>
        <td class="cell-action">
			<span class="border-left" style="margin-right: 10px;"></span>
                <a href="{!! url('/admin/role/edit', ['id' => $role->id]) !!}">
				<div class="edit">
					<span>Edit</span>
					<img src="{{asset('rwrite/assets/images/admin/homepage/edit.svg')}}" alt="">
				</div>
			    </a>

                <button type="button" class="pop" data-toggle="modal"
                          data-target="#delete_{{ $role->id }}">
                          <div class="delete">
                              <span>Delete</span>
                              <img src="{{ asset('rwrite/assets/images/admin/homepage/trash-bin.svg') }}" alt="">
                          </div>
                      </button>

			</td>
        </tr>
        <?php
        $index+=1;

       ?>
       <div class="modal fade" id="delete_{{ $role->id }}" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <p class="text-center">Are you sure you want to delete “{{ $role->name }}”
                        Role?</p>
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="{!! url('/admin/roles/delete', ['id' => $role->id]) !!}" class="btn btn-danger">Delete</a>
                </div>
            </div>
        </div>
    </div>
       @endforeach


	</tbody>
  </table>
</div>
<div class="page-number">
    <div>
        {!! $roles->links() !!}
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
