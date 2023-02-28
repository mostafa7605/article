@extends('admin.layouts.app')
	@section('content')
@if(session('status'))
<p id="alert-wishlist"class="alert alert-success"> {{ session('status') }}</p>
@endif

<div class="table-responsive-xl">
  <table class="table table-index">
    <thead class="spacer">

		<th>Num.</th>
        <th class="cell-name">Name</th>


		<th  class="cell-email">Email</th>
        <th  class="cell-email">Phone Number</th>
		<th class=" cell-date">Date Added</th>
        <th  class="cell-email">Message</th>
        <th></th>

	</thead>

	<tbody>
        <?php
        $index=1;

       ?>
        @foreach ($messages as $message )
        <tr>

            <td>{{ $index }}.</td>
            <td>{{ $message->name }}</td>
            <td>{{ $message->email }}</td>
            <td>{{ $message->phone }}</td>
            <td class=" cell-date"><div><span>{{ date('Y-m-d',strtotime($message->created_at)) }}</td>
                @php
                 $message_content = strlen($message->message) > 35 ? substr($message->message,0,35)."..." : $message->message
                @endphp
            <td @if($message->seen==0) style="font-weight: 1000;" @endif>{{ $message_content }}</td>
            <td class="cell-action">

                    <a href="{!! url('/admin/view_message', ['id' => $message->id]) !!}">
                    <div class="edit">
                        <span>View</span>
                        <img src="{{asset('rwrite/assets/images/admin/homepage/edit.svg')}}" alt="">
                    </div>
                    </a>
                    <a href="{!! url('/admin/message/delete', ['id' => $message->id]) !!}">
                    <div class="delete">
                        <span>Delete</span>
                        <img src="{{asset('rwrite/assets/images/admin/homepage/trash-bin.svg')}}" alt="">
                    </div>
                    </a>
            </td>
        </tr>
        <?php
        $index+=1;

       ?>
        @endforeach

	</tbody>
  </table>
</div>

@endsection
@section('scripts')
<script type="text/javascript">
	setTimeout(function() {
$('#alert-wishlist').fadeOut('fast');
}, 2000);
</script>

@endsection
