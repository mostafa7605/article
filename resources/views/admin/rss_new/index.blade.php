@extends('admin.layouts.app')
	@section('content')
@if(session('status'))
<p id="alert-wishlist"class="alert alert-success"> {{ session('status') }}</p>
@endif

<div class="table-responsive-xl">
  <table class="table table-index table-rss">
    <thead class="spacer">
		<th style="padding-bottom:10px"><input type="checkbox" name="" class="checbox-table" checked></th>
		<th>Num.</th>
		<th class="cell-name">Feed Name</th>
		<th class="cell-name">Status</th>
		<th  class="cell-email">Date Added</th>
		<th class=" cell-date">Fetching Data Time</th>
		<th  >
			<div class="addUser-btn">
				<a style="color:#ccc" href="{{route('rss.create')}}"><span>add new Rss</span> <img src="{{asset('rwrite/assets/images/admin/homepage/Group 419.svg')}}" alt=""></a>
			</div>
		</th>
	</thead>

	<tbody>

		@if(isset($rss_items))

			@foreach( $rss_items as $index=>$item)
			@php
			$time = strtotime($item->timer);
			 $hours=date('H', $time);
			 $mins= date('i', $time);
			@endphp
				<tr id="rss_{{$item->id}}">
					<td><input type="checkbox" name="" class="checbox-table-unchecked" ></td>
					<td>{{$index +1}}.</td>
					<td>{{$item->name}}</td>
					<td id="status_{{$item->id}}">{{$item->publish == 1 ? 'On' : 'Off' }}</td>
					<td class=" cell-date"><div><span>{{date_format($item->created_at ,"Y/m/d h:i:s a")}}</span></div></td>
					<td>Every {{$hours}} hours  {{$mins > 0 ? 'and'.' '.$mins.' minutes' : ''}}</td>
					<td class="cell-action">
						<span class="border-left" ></span>
						<div class="cell-status">
							<label>
								<input name="publish" class="status" id="{{$item->id}}" type="checkbox" {{ $item->publish == 1 ? 'checked' : ''}} >
								<span class="toggle_background">
								<div class="circle-icon">on</div>
								<div class="vertical_line">off</div>

								</span>

							</label>
						</div>

						<div class="edit"  id="edit_{{$item->id}}">
							<a style="color: #fff;  display: flex;  justify-content: space-around;  width: 100%;" href="{{route('rss.edit',$item->id)}}">
								<span>Edit</span>
								<img src="{{asset('rwrite/assets/images/admin/homepage/edit.svg')}}" alt="">
							</a>
						</div>
						<button type="button" class="pop" data-toggle="modal"
                          data-target="#delete_{{ $item->id }}">
                          <div class="delete">
                              <span>Delete</span>
                              <img src="{{ asset('rwrite/assets/images/admin/homepage/trash-bin.svg') }}" alt="">
                          </div>
                      </button>
					</td>
				</tr>
                <div class="modal fade" id="delete_{{ $item->id }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <p class="text-center">Are you sure you want to delete “{{ $item->name }}”
                                    ?</p>
                            </div>
                            <div class="modal-footer border-0 justify-content-center">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <a href="{!! url('/admin/rss/delete', ['id' => $item->id]) !!}" class="btn btn-danger">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
			@endforeach
		@endif
	</tbody>
  </table>
</div>

@endsection
@section('scripts')

	<script>//change publish status
    $('.status').click(function(){
		var id=$(this).attr('id');
        $.ajax({
            url:'/admin/rss/'+id,
            type: 'Get',
            success: function(response){
				if(response.status == 0){
					$('#status_'+id).html('Off');
				}else{
					$('#status_'+id).html('On');

				}
            }
        })
    });


	function destroy(id){
		var id=id;
        $.ajax({
            url:'/admin/rss/delete/'+id,
            type: 'Get',
            success: function(response){
				$('#rss_'+id).remove();
            }
        })
    }
</script>
@endsection
