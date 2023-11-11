@extends('admin.master.layout')
@section('title', 'Create Push Notification')
@section('content')
<style>
   .small-text {
      font-size: 12px;
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
                     <h4 class="card-title">Send Push Notification</h4>
                  </div>
                  <div class="d-flex justify-content-end">
                     <a href="{{ url('admin/notification') }}" class="btn btn-sm btn-primary">All Push Notification</a>
                 </div>
               </div>
               <div class="card-body">
                  <div class="new-user-info">
                     <form enctype="multipart/form-data" action="{{ url('admin/notification-send') }}" method="post" class="save">
                         @csrf
                           <div class="form-group col-md-12">
                              <label class="form-label">Title</label>
                              <input type="text" name="title" class="form-control" placeholder="Enter Title"  value="">
                           </div>
                           <div class="form-group col-md-12">
                              <label class="form-label">Description</label>
                              <textarea name="description" class="form-control" placeholder="Enter Description"></textarea>
                           </div>
                           <div class="form-group col-md-12">
                              <label class="form-label">Image</label>
                              <input type="file" name="image" class="form-control">
                           </div>
                           {{-- <div class="form-group col-md-12">
                              <label class="form-label">Type</label>
                               <select name="type" class="form-control">
                                  <option value="">Choose Type</option>
                                  <option value="user">User</option>
                                  <option value="driver">Driver</option>
                               </select>
                           </div> --}}
                           <button type="submit" class="btn btn-primary">Add</button>
                     </form>
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
