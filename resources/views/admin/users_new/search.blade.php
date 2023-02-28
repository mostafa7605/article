@extends('admin.layouts.app')
	@section('content')
@if(session('status'))
<p id="alert-wishlist"class="alert alert-success"> {{ session('status') }}</p>
@endif

<div class="table-responsive-xl">
  <table class="table table-index">
    <thead class="spacer">

		<th>Num.</th>
        <th class="cell-name">First Name</th>
		<th class="cell-name">Last Name</th>

		<th  class="cell-email">Email</th>
		<th class=" cell-date">Date Added</th>
		<th  >
            <a href="{!! url('/admin/users/add') !!}" style="color: #cccccc;">
			<div class="addUser-btn">
			<span>add user</span> <img src="{{asset('rwrite/assets/images/admin/homepage/Group 419.svg')}}" alt="">
			</div>
            </a>
		</th>
	</thead>

	<tbody>
        <?php
        $index=1;

       ?>
        @foreach ($users as $user )
        <tr>

            <td>{{ $index }}.</td>
            <td>{{ $user->first_name }}</td>
            <td>{{ $user->last_name }}</td>
            <td>{{ $user->email }}</td>
            <td class=" cell-date"><div><span>{{ date('Y-m-d',strtotime($user->created_at)) }}</td>
            <td class="cell-action">
                <span class="border-left" style="margin-right: 10px;"></span>

                    <select name="roles"onchange="openRoleModal(this,{{ $user->id }});"  id="role_select_{{ $user->id }}"data-id="{{ $user->id }}" class="cell-select roleselection">
                        @foreach ($roles as $role)
                        @if(isset($user->roles))
                        @if(isset($user->roles[0]))
                        <option value="{{ $role->id }}"@if($role->id==$user->roles[0]->id ) selected @endif>{{ $role->name }}</option>
                        @else
                        <option value="{{ $role->id }}">{{ $role->name }}</option>

                        @endif
                        @else
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endif
                        
                        @endforeach

                    </select>

                    <a href="{!! url('/admin/user/edit', ['id' => $user->id]) !!}">
                    <div class="edit">
                        <span>Edit</span>
                        <img src="{{asset('rwrite/assets/images/admin/homepage/edit.svg')}}" alt="">
                    </div>
                    </a>
                    <button type="button" class="pop" data-toggle="modal"
                                data-target="#delete_{{ $user->id }}">
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
        <div class="modal fade" id="delete_{{ $user->id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <p class="text-center">Are you sure you want to delete “{{ $user->first_name }}”
                            User?</p>
                    </div>
                    <div class="modal-footer border-0 justify-content-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a href="{!! url('/admin/users/delete', ['id' => $user->id]) !!}" class="btn btn-danger">Delete</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

	</tbody>
  </table>
</div>
<div class="modal fade" id="exampleModa2" tabindex="-1" aria-labelledby="exampleModalLabe2" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <input type="hidden" name="id" value="" id="id">
                <input type="hidden" name="role_id" value="" id="role_id">

                <p class="text-center">Are you sure you want to change role <span id="user_name"></span></p>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <button type="button" onClick="refreshPage()" class="btn btn-secondary"
                    data-dismiss="modal">Close</button>
                <button onclick="getval()" class="btn btn-danger">Change</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    function getval() {
        let value_selected = document.getElementById("role_id").value;
        let id = document.getElementById("id").value
        $.ajax({
            type: 'GET',
            url: "/admin/changerole/" + id + '/' + value_selected,
            success: function(data) {
                $('#exampleModa2').modal('hide');
                window.location.reload();
            }
            // data: $("#examId").val()
        })
    }


    function openRoleModal(sel, id) {
        document.getElementById("id").value = id
        let name = 'role_select_' + id
        let role_id = document.getElementById(name).value;
        document.getElementById("role_id").value = role_id
        $('#exampleModa2').modal('show');
    }

    function refreshPage() {
        $('#exampleModa2').modal('hide');
    }
</script>
<script>
   /*const gridAddToCartbuttons = document.querySelectorAll(
                ".roleselection"
            );
     gridAddToCartbuttons.forEach((select) => {
       const id = select.dataset.id;
       select.on('change',function() {
    var optionSelected = $(this).find("option:selected");
    var examid = optionSelected.val();
    alert(examid);
       });
    });
    function getval(sel,id)
{  let value_selected=sel.value;
    $.ajax({
        type: 'GET',
        url: "/admin/changerole/"+id+'/'+value_selected,
        success: function (data) {
            console.log(value_selected);
                }
        // data: $("#examId").val()
      })
}*/
</script>
@endsection
