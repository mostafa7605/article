@extends('admin.layouts.app')
	@section('content')
@if(session('status'))
<p id="alert-wishlist"class="alert alert-success"> {{ session('status') }}</p>
@endif

<div class="table-responsive-xl">
    <table class="table table-index  tab-pane fade show active"  id="nav-book">
        @if(count($Articles)!=0)
        <thead class="spacer">

            <th>Num.</th>
            <th class="cell-name">Name</th>
            <th class="cell-name">Type</th>
            <th class="cell-name">Email</th>
            <th  class="cell-email">Price</th>
            <th class=" cell-date">Status</th>
            <th  >

            </th>
        </thead>
        @endif
        <tbody >
            <?php
              $article_counter=1;

              ?>
              @foreach ($Articles as $Article)
              <tr>
                <td>{{ $article_counter }}.</td>
                <td>{{ $Article->title }}</td>
                <td>{{ $Article->category->name }}</td>
                <td>{{ $Article->user->email }}</td>
                <td>{{ $Article->cost }} USD</td>
                <td class=" cell-date"><div>
                    @if ($Article->approved==1)
                      <span>Approved</span>
                    @else
                    <span>Unapproved</span>
                    @endif
                </div></td>

                <td class="cell-action">
                    <span class="border-left" style="margin-right: 10px;"></span>

                        <select name="" id=""onchange="getval(this,{{ $Article->id }});" class="cell-select">
                            <option value="0"@if($Article->approved==0) selected @endif>Unapproved</option>
                            <option value="1"@if($Article->approved==1) selected @endif>Approved</option>
                        </select>
                        <button type="button" class="pop" data-toggle="modal"
                          data-target="#delete_{{ $Article->id }}">
                          <div class="delete">
                              <span>Delete</span>
                              <img src="{{ asset('rwrite/assets/images/admin/homepage/trash-bin.svg') }}" alt="">
                          </div>
                      </button>
                    </td>
              </tr>
              <?php
              $article_counter+=1;

              ?>
              <div class="modal fade" id="delete_{{ $Article->id }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <p class="text-center">Are you sure you want to delete “{{ $Article->title }}”
                                article?</p>
                        </div>
                        <div class="modal-footer border-0 justify-content-center">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <a href="{!! url('/admin/media/delete', ['id' => $Article->id]) !!}" class="btn btn-danger">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
              @endforeach


        </tbody>

    </table>
</div>

@endsection
@section('scripts')
<script>
    function getval(sel,id)
        {  let value_selected=sel.value;
           $.ajax({
                 type: 'GET',
                 url: "/admin/changeapprove/"+id+'/'+value_selected,
                 success: function (data) {
                   console.log(value_selected);
                   location.reload();

                      }
       // data: $("#examId").val()
            })
        }
</script>
@endsection
