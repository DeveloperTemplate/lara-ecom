@extends('admin.master.layout')
@section('title', 'All User')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
          <div class="col-12 mt-5">
             <div>
                <div class="card">
                    <div class="card-header">
                        <div class="header-title">
                           <h4 class="card-title">All User</h4>
                        </div>
                        <div class="d-flex justify-content-end">

                       </div>
                     </div>
                   <div class="card-body px-0">
                       <div class="table-responsive px-3">
                           <table id="example1" class="table table-striped table-bordered" role="grid">
                               <thead>
                                   <tr class="ligth">
                                       <th>Name</th>
                                       <th>Mobile</th>
                                       <th>Role</th>
                                   </tr>
                               </thead>
                               <tbody>
                                   @if (count($user) > 0)
                                   @foreach ($user as $item)
                                   <tr>
                                       <td>{{ $item->name }}</td>
                                       <td>{{ $item->mobile }}</td>
                                       <td>{{ $item->roles->pluck('name')[0] }}</td>
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
@endsection
