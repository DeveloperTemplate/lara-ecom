@extends('admin.master.layout')
@section('title', 'Create Category')
@section('content')
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
                     <h4 class="card-title">Category Create</h4>
                  </div>
                  <div class="d-flex justify-content-end">
                     <a href="{{ route('category.index') }}" class="btn btn-sm btn-primary">All Category</a>
                 </div>
               </div>
               <div class="card-body">
                  <div class="new-user-info">
                     <form enctype="multipart/form-data" action="{{ route('category.store') }}" method="post" class="save">
                         @csrf
                           <div class="form-group col-md-12">
                              <label class="form-label">Name</label>
                              <input type="text" name="name" class="form-control" placeholder="Enter Category"  value="">
                           </div>
                           <div class="form-group col-md-12">
                              <label class="form-label">Image</label>
                              <input type="file" name="image" class="form-control">
                           </div>
                           <div class="form-group col-md-12">
                              <label class="form-label">Status</label>
                               <select name="status" class="form-control">
                                  <option value="">Choose Status</option>
                                  <option value="Active">Active</option>
                                  <option value="Inactive">Inactive</option>
                               </select>
                           </div>
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
