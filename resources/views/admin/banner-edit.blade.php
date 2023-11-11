@extends('admin.master.layout')
@section('title', 'Edit Banner')
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
                     <h4 class="card-title">Banner Edit</h4>
                  </div>
                  <div class="d-flex justify-content-end">
                     <a href="{{ route('banner.index') }}" class="btn btn-sm btn-primary">All Banner</a>
                 </div>
               </div>
               <div class="card-body">
                  <div class="new-user-info">
                     <form enctype="multipart/form-data" action="{{ route('banner.update', $banner->id) }}" method="post" class="save">
                         @csrf
                         @method('PUT')

                         <div class="row">
                           <div class="form-group col-md-4">
                              <label class="form-label">Category</label> 
                              <select name="category" class="form-control category">
                                 <option value="{{ $banner->category_id }}">{{ $banner->category->name }}</option>
                                 @foreach ( App\Models\Category::whereNot('id', $banner->category_id)->get() as $item)
                                 <option value="{{ $item->id }}">{{ $item->name }}</option>
                                 @endforeach
                              </select>
                           </div>
                           <div class="form-group col-md-4">
                              <div class="edit-subcategory">
                                 <label class="form-label">Sub Category</label>
                                 <select name="oldsubcategory" class="form-control subcategory">
                                     @if ($banner->sub_category_id)
                                     <option value="{{ $banner->sub_category_id }}" selected>{{ $banner->subcategory->name }}</option>
                                     @foreach ( App\Models\SubCategory::where('category_id', $banner->category_id)->whereNot('id', $banner->sub_category_id)->get() as $item)
                                     <option value="{{ $item->id }}">{{ $item->name }}</option>
                                     @endforeach
                                     @else
                                     <option value="">Choose Sub Category</option>
                                     @endif
                                    
                                 </select>
                              </div>
                              <div class="d-none dynamic-sub-category">
                                 @include('admin.data.sub-category-data')
                              </div>
                           </div>
                           <div class="form-group col-md-4">
                              <div class="edit-childcategory">
                                 <label class="form-label">Child Category</label>
                                 <select name="old_child_category" class="form-control">
                                    @if ($banner->child_category_id)
                                       <option value="{{ $banner->child_category_id }}" selected>{{ $banner->childCategory->name }}</option>
                                       @foreach ( App\Models\ChildCategory::where('category_id', $banner->category_id)->where('sub_category_id', $banner->sub_category_id)->whereNot('id', $banner->child_category_id)->whereNot('id', $banner->child_category_id)->get() as $item)
                                       <option value="{{ $item->id }}">{{ $item->name }}</option>
                                       @endforeach
                                    @else
                                    <option value="">Choose Child Category</option>
                                    @endif
                                    
                                 </select>
                              </div>
                              <div class="d-none dynamic-child-category">
                                 @include('admin.data.child-category-data')
                              </div>
                           </div>
                         </div>

                         <div class="row">
                           <div class="form-group col-md-12">
                              <label class="form-label">Name</label>
                               <textarea name="name" class="form-control p-name" placeholder="Enter Name" spellcheck="true">{{ $banner->name }}</textarea>
                           </div>
                         
                         </div>

                         <div class="form-group col-md-12">
                           <label class="form-label">Image</label>
                           <input type="file" name="image" class="form-control">
                        </div>
                        @if($banner->img)
                        <div class="mt-3">
                           <input type="hidden" name="old_image" value="{{ $banner->img }}">
                           <img src="{{ $banner->img }}" alt="logo" width="70">
                        </div>
                        @endif

                        

                           
                            <div class="form-group col-md-12">
                              <label class="form-label">Description</label>
                              <textarea name="description" class="form-control" id="editor" placeholder="Enter Description" spellcheck="true">{{ $banner->desc }}</textarea>
                           </div>


                           


                           <div class="row">
                              <div class="form-group col-md-12">
                                 <label class="form-label">Status</label>
                                 <select name="status" class="form-control">
                                    @if ($banner->status == 'Active')
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                    @else
                                    <option value="Inactive">Inactive</option>
                                    <option value="Active">Active</option>
                                    @endif
                                  </select>
                              </div>
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
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
   $(function(){


      $(document).on( "click", ".add-item", function( event ) {
         $("#ItemsWrapper").append('<div class="row"><div class="form-group col-lg-11 col-sm-11 col-11 col-md-11"><input type="hidden" name="old_img[]"><input type="file" name="image[]" class="form-control"></div><a href="#" class="removeclass d-table"><i class="fas fa-trash-alt"></i></a></div>');
      });

      $("body").on("click",".removeclass", function(e){
            e.preventDefault();
            $(this).parent('div').remove();  
            return false;
      });

      //////// Create slug

      function createSlug(text) {
         return text
            .toLowerCase()           // Convert the text to lowercase
            .replace(/\s+/g, '-')    // Replace spaces with hyphens
            .replace(/[^\w-]+/g, '') // Remove non-word characters except hyphens
            .replace(/--+/g, '-')    // Replace multiple hyphens with a single hyphen
            .replace(/^-+/, '')      // Remove leading hyphens
            .replace(/-+$/, '');     // Remove trailing hyphens
      }

      $('.p-name').keyup(function(e){
         $('.p-slug').val(createSlug($(this).val()));
          ////// Meta Title
         var name = $(this).val();
         var cleanedString = name.replace(/\s+/g, ' ');
         $('.p-name').val(cleanedString);
         $('.name-count').text( cleanedString.length );
         $('.p-m-title').val(cleanedString);
            /////////// Meta Title Count
            var title = $('.p-m-title').val();
            $('.t-count').text( title.length );
      });

      /////////// Meta Title Count
      $('.p-m-title').keyup(function(e){
         var title = $(this).val();
         var cleanedString = title.replace(/\s+/g, ' ');
         $('.p-m-title').val(cleanedString);
        $('.t-count').text(cleanedString.length);
      });

      /////////// Meta Desc Count
      $('.p-m-des').keyup(function(){
         var des = $(this).val();
         var cleanedString = des.replace(/\s+/g, ' ');
         $('.p-m-des').val(cleanedString);
        $('.d-count').text(cleanedString.length);
      });

      
      
      $('.category').change(function(){
         $.ajax({
            type: 'POST',
            url: '{{  route("sub-category-search") }}',
            data: { id: $(this).val() },
            success:function(data){
               $('.edit-subcategory').html('');
               $('.dynamic-sub-category').show();
               $('.dynamic-sub-category').removeClass('d-none');
               $('.sub-category-load').html(data);
             }
         }); 
      });

      $(document).on('change', '.subcategory', function (e) {
         $.ajax({
            type: 'POST',
            url: '{{  route("child-category-search") }}',
            data: { sub_id: $(this).val(), cat_id: $('.category').val() },
            success:function(data){
               $('.edit-childcategory').html('');
               $('.dynamic-child-category').show();
               $('.dynamic-child-category').removeClass('d-none');
               $('.child-category-load').html(data);
             }
         });
      });

      

   });

   </script>

<script>
   //Define an adapter to upload the files
   class MyUploadAdapter {
      constructor(loader) {
         // The file loader instance to use during the upload. It sounds scary but do not
         // worry — the loader will be passed into the adapter later on in this guide.
         this.loader = loader;

         // URL where to send files.
         this.url = '{{ route("image-upload") }}';

         //
      }
      // Starts the upload process.
      upload() {
         return this.loader.file.then(
            (file) =>
               new Promise((resolve, reject) => {
                  this._initRequest();
                  this._initListeners(resolve, reject, file);
                  this._sendRequest(file);
               })
         );
      }
      // Aborts the upload process.
      abort() {
         if (this.xhr) {
            this.xhr.abort();
         }
      }
      // Initializes the XMLHttpRequest object using the URL passed to the constructor.
      _initRequest() {
         const xhr = (this.xhr = new XMLHttpRequest());
         // Note that your request may look different. It is up to you and your editor
         // integration to choose the right communication channel. This example uses
         // a POST request with JSON as a data structure but your configuration
         // could be different.
         // xhr.open('POST', this.url, true);
         xhr.open("POST", this.url, true);
         xhr.setRequestHeader("x-csrf-token", "{{ csrf_token() }}");
         xhr.responseType = "json";
      }
      // Initializes XMLHttpRequest listeners.
      _initListeners(resolve, reject, file) {
         const xhr = this.xhr;
         const loader = this.loader;
         const genericErrorText = `Couldn't upload file: ${file.name}.`;
         xhr.addEventListener("error", () => reject(genericErrorText));
         xhr.addEventListener("abort", () => reject());
         xhr.addEventListener("load", () => {
            const response = xhr.response;
            // This example assumes the XHR server's "response" object will come with
            // an "error" which has its own "message" that can be passed to reject()
            // in the upload promise.
            //
            // Your integration may handle upload errors in a different way so make sure
            // it is done properly. The reject() function must be called when the upload fails.
            if (!response || response.error) {
               return reject(response && response.error ? response.error.message : genericErrorText);
            }
            // If the upload is successful, resolve the upload promise with an object containing
            // at least the "default" URL, pointing to the image on the server.
            // This URL will be used to display the image in the content. Learn more in the
            // UploadAdapter#upload documentation.
            resolve({
               default: response.url,
            });
         });
         // Upload progress when it is supported. The file loader has the #uploadTotal and #uploaded
         // properties which are used e.g. to display the upload progress bar in the editor
         // user interface.
         if (xhr.upload) {
            xhr.upload.addEventListener("progress", (evt) => {
               if (evt.lengthComputable) {
                  loader.uploadTotal = evt.total;
                  loader.uploaded = evt.loaded;
               }
            });
         }
      }
      // Prepares the data and sends the request.
      _sendRequest(file) {
         // Prepare the form data.
         const data = new FormData();
         data.append("upload", file);
         // Important note: This is the right place to implement security mechanisms
         // like authentication and CSRF protection. For instance, you can use
         // XMLHttpRequest.setRequestHeader() to set the request headers containing
         // the CSRF token generated earlier by your application.
         // Send the request.
         this.xhr.send(data);
      }
      // ...
   }

   function SimpleUploadAdapterPlugin(editor) {
      editor.plugins.get("FileRepository").createUploadAdapter = (loader) => {
         // Configure the URL to the upload script in your back-end here!
         return new MyUploadAdapter(loader);
      };
   }

   //Initialize the ckeditor
   ClassicEditor.create(document.querySelector("#editor"), {
      extraPlugins: [SimpleUploadAdapterPlugin],
   }).catch((error) => {
      console.error(error);
   });

</script>



@endsection