@extends('admin.master.layout')
@section('title', 'All Order')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper pt-5">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
          <div class="col-12">
             <div>
                <div class="card">
                    <div class="card-header">
                        <div class="header-title">
                           <h4 class="card-title">All Order</h4>
                        </div>
                        <div class="d-flex justify-content-end">
                       </div>
                     </div>
                   <div class="card-body px-0">
                       <div class="table-responsive px-3">
                           <table id="example1" class="table table-striped table-bordered" role="grid">
                               <thead>
                                   <tr class="ligth">
                                       <th>Order Id</th>
                                       <th>Name</th>
                                       <th>Price</th>
                                       <th>Status</th>
                                       <th>Action</th>
                                   </tr>
                               </thead>
                               <tbody>
                                   @if (count($order) > 0)
                                   @foreach ($order as $item)
                                   <tr>
                                       <td>{{  $item->order_details_id_generate }}</td>
                                       <td>{{  $item->name }}</td>
                                       <td>{{  $item->total_amount }}</td>
                                       <td>{{ $item->status }}</td>
                                       <td>
                                           <div class="flex align-items-center list-user-action">
                                              <a href="{{ route('order.show', $item->id) }}" class="btn btn-sm btn-icon btn-info mb-3">
                                                <svg width="20" viewBox="0 0 24 24" class="text-white" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                  <path d="M22.4541 11.3918C22.7819 11.7385 22.7819 12.2615 22.4541 12.6082C21.0124 14.1335 16.8768 18 12 18C7.12317 18 2.98759 14.1335 1.54586 12.6082C1.21811 12.2615 1.21811 11.7385 1.54586 11.3918C2.98759 9.86647 7.12317 6 12 6C16.8768 6 21.0124 9.86647 22.4541 11.3918Z" fill="#130F26"></path>                                
                                                  <circle cx="12" cy="12" r="5" fill="#fff"></circle>                                
                                                  <circle cx="12" cy="12" r="3" fill="#130F26"></circle>                                
                                                  <mask mask-type="alpha" maskUnits="userSpaceOnUse" x="9" y="9" width="6" height="6">                                
                                                  <circle cx="12" cy="12" r="3" fill="#130F26"></circle>                                
                                                  </mask>                                
                                                  <circle opacity="0.89" cx="13.5" cy="10.5" r="1.5" fill="white" fill-opacity="0.6"></circle>                                
                                                  </svg>
                                              </a>
                                              <a href="#" data-id="{{ $item->id }}" class="btn btn-sm btn-icon btn-warning mb-3 status-order">
                                                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                  <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                  <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                  <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                               </svg>
                                              </a>
                                           </div>
                                           
                                        </td>
                                   </tr> 
                                   @endforeach
                                   @else
                                   <tr>
                                       <td colspan="7" class="text-center text-danger">No Record Found</td>
                                    </tr> 
                                   @endif
                               </tbody>
                           </table>
                       </div>
                   </div>
               </div>
             </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<!-- Modal -->
<div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form enctype="multipart/form-data" action="{{ route('order-status-update') }}" method="post" class="save">
        @csrf
        <input type="hidden" name="id" class="order-id">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Order Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         
         @include('admin.data.order-status-data')
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    </form>
    </div>
  </div>
</div>
@endsection
@section('script')
<script>
   $(function(){


      // $('.category').change(function(){
      //    $.ajax({
      //       type: 'POST',
      //       url: '{{  route("sub-category-search") }}',
      //       data: { id: $(this).val() },
      //       success:function(data){
      //          $('.edit-subcategory').html('');
      //          $('.dynamic-sub-category').show();
      //          $('.dynamic-sub-category').removeClass('d-none');
      //          $('.sub-category-load').html(data);
      //        }
      //    }); 
      // });

      $(document).on('click', '.status-order', function (e) {
          e.preventDefault();
          $('#orderModal').modal('show');
          $('.order-id').val($(this).data('id'));

            $.ajax({
            type: 'POST',
            url: '{{  route("order-get-status") }}',
            data: { id: $(this).data('id') },
            success:function(data){
               $('.order-status-load').html(data);
             }
         }); 

      });

      

   });

</script>

@endsection