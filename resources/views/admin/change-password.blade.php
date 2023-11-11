@extends('admin.master.layout')

@section('title', 'Admin Change Password')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
           {{-- <h1 class="m-0">Dashboard</h1> --}}
         </div><!-- /.col -->
         <div class="col-sm-6">
         
         </div><!-- /.col -->
       </div><!-- /.row -->
     </div><!-- /.container-fluid -->
   </div>
   <!-- /.content-header -->
   <!-- Main content -->
   <section class="content">
     <div class="container-fluid">
      <div class="row">
        <div class="col-12">
           <div class="card">
              <div class="card-header">
                 <div class="header-title">
                    <h2 class="card-title">Change Password</h2>
                 </div>
              </div>
              <div class="card-body">
                 <div class="new-user-info">
                    <form enctype="multipart/form-data" action="{{ url('admin/password-update') }}" method="post" class="save">
                        @csrf
                         <div class="row">
                          <div class="form-group col-md-4">
                            <label class="form-label">Old Password</label>
                            <input type="password" name="old_password" class="form-control" placeholder="Enter Old Password">
                         </div>
                         <div class="form-group col-md-4">
                            <label class="form-label">New Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Enter New Password">
                         </div>
                         <div class="form-group col-md-4">
                            <label class="form-label">Confirm New Password</label>
                             <input type="password" name="password_confirmation" class="form-control" placeholder="Enter Confirm New Password">
                         </div>
                         </div>
                          <div class="text-center">
                            <button type="submit" class="btn btn-primary">Update</button>
                          </div>
                    </form>
                 </div>
              </div>
           </div>
        </div>
        <!-- /.col -->
      </div>
     </div><!-- /.container-fluid -->
   </section>
   <!-- /.content -->
 </div>
@endsection
@section('script')

@endsection
