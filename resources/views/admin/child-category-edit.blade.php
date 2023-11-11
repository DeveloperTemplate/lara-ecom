@extends('admin.master.layout')
@section('title', 'Edit Child Category')
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
                     <h4 class="card-title">Child Category Edit</h4>
                  </div>
                  <div class="d-flex justify-content-end">
                     <a href="{{ route('child-category.index') }}" class="btn btn-sm btn-primary">All Child Category</a>
                 </div>
               </div>
               <div class="card-body">
                  <div class="new-user-info">
                     <form enctype="multipart/form-data" action="{{ route('child-category.update', $childCategory->id) }}" method="post" class="save">
                         @csrf
                         @method('PUT')
                           <div class="form-group col-md-12">
                              <label class="form-label">Category</label>
                              <select name="category" class="form-control category">
                                 <option value="{{ $childCategory->category_id }}">{{ $childCategory->category->name }}</option>
                                 @foreach ( App\Models\Category::whereNot('id', $childCategory->category_id)->get() as $item)
                                 <option value="{{ $item->id }}">{{ $item->name }}</option>
                                 @endforeach
                              </select>
                           </div>
                           <div class="form-group col-md-12">
                              <div class="old-sub-category-load">
                                 <label class="form-label">Sub Category</label>
                                 <select name="oldsubcategory" class="form-control">
                                     <option value="{{ $childCategory->sub_category_id }}">{{ $childCategory->subcategory->name }}</option>
                                     @foreach ( App\Models\SubCategory::where('category_id', $childCategory->category_id)->whereNot('id', $childCategory->sub_category_id)->get() as $item)
                                     <option value="{{ $item->id }}">{{ $item->name }}</option>
                                     @endforeach
                                 </select>
                              </div>
                              @include('admin.data.sub-category-data')
                           </div>
                           <div class="form-group col-md-12">
                              <label class="form-label">Name</label>
                              <input type="text" name="name" class="form-control" placeholder="Enter Sub Category" value="{{ $childCategory->name }}">
                           </div>
                           <div class="form-group col-md-12">
                              <label class="form-label">Image</label>
                              <input type="file" name="image" class="form-control">
                           </div>
                           @if($childCategory->img)
                           <div class="mt-3">
                              <input type="hidden" name="old_image" value="{{ $childCategory->img }}">
                              <img src="{{ $childCategory->img }}" alt="logo" width="70">
                           </div>
                           @endif
                           <div class="form-group col-md-12">
                              <label class="form-label">Status</label>
                               <select name="status" class="form-control">
                                 @if ($childCategory->status == 'Active')
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
@section('script')
<script>
   $(function(){
      $('.category').change(function(){
           if($(this).val()){
            $.ajax({
            type: 'POST',
            url: '{{  route("sub-category-search") }}',
            data: { id: $(this).val() },
            success:function(data){
               $('.old-sub-category-load').hide();
               $('.sub-category-load').html(data);
             }
            });
           }else{
            $('.old-sub-category-load').show();
            $('.sub-category-load').html('');
           }
      });
   });
</script>
@endsection
