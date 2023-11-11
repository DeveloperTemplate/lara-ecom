@extends('admin.master.layout')
@section('title', 'Push Notification')
@section('content')
<style>
    .input-group-text, .search-keyword{
        padding: 0.3rem 0.5rem !important;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper pt-5">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
          <div class="col-12">
          
                <div class="card">
                  <div class="card-header">
                    <div class="header-title">
                       <h4 class="card-title">All Push Notification</h4>
                    </div>
                    <div class="d-flex justify-content-end">
                      <a href="{{ url('admin/notification-create') }}" class="btn btn-sm btn-primary">Send Push Notification</a>
                   </div>
                 </div>
                   <div class="card-body px-0">
                       <div class="table-responsive px-3">
                          <table id="user-list-table" class="table table-striped table-bordered" role="grid">
                            <thead>
                                <tr class="ligth">
                                    <th>Title</th>
                                    <th>description</th>
                                    <th>Image</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($notification) > 0)
                                @foreach ($notification as $item)
                                <tr>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>
                                     @if ($item->img)
                                     <img src="{{ url($item->data['img']) }}" alt="img" width="60">
                                     @endif
                                     </td>
                                     <td>{{ date('d-M-Y h:i A', strtotime($item->created_at)) }}</td>
                                     <td>
                                      <a class="btn btn-sm btn-icon btn-success" title="View" href="{{ url('admin/push-notification/?id='.$item->id.'&type='.request()->type.'&pushHistory=Yes') }}">
                                        <span class="btn-inner">
                                          <svg width="19" viewBox="0 0 24 24" class="text-white" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M22.4541 11.3918C22.7819 11.7385 22.7819 12.2615 22.4541 12.6082C21.0124 14.1335 16.8768 18 12 18C7.12317 18 2.98759 14.1335 1.54586 12.6082C1.21811 12.2615 1.21811 11.7385 1.54586 11.3918C2.98759 9.86647 7.12317 6 12 6C16.8768 6 21.0124 9.86647 22.4541 11.3918Z" fill="#130F26"></path>                                
                                            <circle cx="12" cy="12" r="5" fill="#fff"></circle>                                
                                            <circle cx="12" cy="12" r="3" fill="#130F26"></circle>                                
                                            <mask mask-type="alpha" maskUnits="userSpaceOnUse" x="9" y="9" width="6" height="6">                                
                                            <circle cx="12" cy="12" r="3" fill="#130F26"></circle>                                
                                            </mask>                                
                                            <circle opacity="0.89" cx="13.5" cy="10.5" r="1.5" fill="white" fill-opacity="0.6"></circle>                                
                                          </svg>                                                              
                                        </span>
                                     </a>  
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
                  {{-- @if (count($notification) > 0)
                  <div class="d-flex justify-content-between px-4">
                       <div>
                          Showing 1 to  {{ $notification->count() }} of {{ $notification->total() }} entries
                       </div>
                       <div>
                          {{ $notification->appends(['keyword' => request()->keyword, 'type' => request()->type])->links() }}
                       </div>
                  </div>
                  @endif --}}

                  

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

@endsection
