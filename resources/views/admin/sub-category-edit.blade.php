@extends('admin.master.layout')
@section('title', 'Edit Sub Category')
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
                     <h4 class="card-title">Sub Category Edit</h4>
                  </div>
                  <div class="d-flex justify-content-end">
                     <a href="{{ route('sub-category.index') }}" class="btn btn-sm btn-primary">All Sub Category</a>
                 </div>
               </div>
               <div class="card-body">
                  <div class="new-user-info">
                     <form enctype="multipart/form-data" action="{{ route('sub-category.update', $subCategory->id) }}" method="post" class="save">
                         @csrf
                         @method('PUT')
                           <div class="form-group col-md-12">
                              <label class="form-label">Category</label>
                              <select name="category" class="form-control">
                                 <option value="{{ $subCategory->category_id }}">{{ $subCategory->category->name }}</option>
                                 @foreach ( App\Models\Category::whereNot('id', $subCategory->category_id)->get() as $item)
                                 <option value="{{ $item->id }}">{{ $item->name }}</option>
                                 @endforeach
                              </select>
                           </div>
                           <div class="form-group col-md-12">
                              <label class="form-label">Name</label>
                              <input type="text" name="name" class="form-control" placeholder="Enter Sub Category" value="{{ $subCategory->name }}">
                           </div>
                           <div class="form-group col-md-12">
                              <label class="form-label">Image</label>
                              <input type="file" name="image" class="form-control">
                           </div>
                           @if($subCategory->img)
                           <div class="mt-3">
                              <input type="hidden" name="old_image" value="{{ $subCategory->img }}">
                              <img src="{{ $subCategory->img }}" alt="logo" width="70">
                           </div>
                           @endif
                           <div class="form-group col-md-12">
                              <label class="form-label">Status</label>
                              <select name="status" class="form-control">
                                 @if ($subCategory->status == 'Active')
                                 <option value="Active">Active</option>
                                 <option value="Inactive">Inactive</option>
                                 @else
                                 <option value="Inactive">Inactive</option>
                                 <option value="Active">Active</option>
                                 @endif
                               </select>
                           </div>
                           <button type="submit" class="btn btn-primary">Update</button>
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
