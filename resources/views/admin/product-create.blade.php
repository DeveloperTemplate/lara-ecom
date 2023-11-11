@extends('admin.master.layout')
@section('title', 'Create Product')
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
                     <h4 class="card-title">Product Create</h4>
                  </div>
                  <div class="d-flex justify-content-end">
                     <a href="{{ route('product.index') }}" class="btn btn-sm btn-primary">All Product</a>
                 </div>
               </div>
               <div class="card-body">
                  <div class="new-user-info">
                     <form enctype="multipart/form-data" action="{{ route('product.store') }}" method="post" class="save">
                         @csrf

                         <div class="row">
                           <div class="form-group col-md-4">
                              <label class="form-label">Category</label> 
                              <select name="category" class="form-control category">
                                 <option value="">Choose Category</option>
                                 @foreach ( App\Models\Category::all() as $item)
                                 <option value="{{ $item->id }}">{{ $item->name }}</option>
                                 @endforeach
                              </select>
                           </div>
                           <div class="form-group col-md-4">
                              @include('admin.data.sub-category-data')
                           </div>
                           <div class="form-group col-md-4">
                              @include('admin.data.child-category-data')
                           </div>
                         </div>

                         <div class="row">
                           <div class="form-group col-md-6">
                              <label class="form-label">Name</label>
                               <textarea name="name" class="form-control p-name" placeholder="Enter Name" spellcheck="true"></textarea>
                               <span>Total Character: <span class="name-count"></span></span> 
                           </div>
                           <div class="form-group col-md-6">
                              <label class="form-label">Slug</label>
                              <textarea name="slug" class="form-control p-slug" placeholder="Enter Slug" spellcheck="true"></textarea>
                           </div>
                         </div>

                         <div class="row">
                           <div class="form-group col-md-6">
                              <label class="form-label">Actual Price</label>
                              <input type="text" name="actual_price" class="form-control" placeholder="Enter Actual Price">
                           </div>
                           <div class="form-group col-md-6">
                              <label class="form-label">Discount Price</label>
                              <input type="text" name="discount_price" class="form-control" placeholder="Enter Discount Price">
                           </div>
                         </div>

                            <div class="row">
                              <div class="form-group col-md-6">
                                 <label class="form-label">Meta Title</label>
                                  <textarea name="meta_title" class="form-control p-m-title" placeholder="Enter Meta Title" spellcheck="true"></textarea>
                                  <span>Total Character: <span class="t-count"></span></span> 
                              </div>
                              <div class="form-group col-md-6">
                                 <label class="form-label">Meta Description</label>
                                 <textarea name="meta_description" class="form-control p-m-des" placeholder="Enter Meta Description" spellcheck="true"></textarea>
                                 <span>Total Character: <span class="d-count"></span></span>
                              </div>
                             
                            </div>

                            <div class="form-group col-md-12">
                              <label class="form-label">Short Description</label>
                              <textarea name="short_description" class="form-control" placeholder="Enter Short Description" spellcheck="true"></textarea>
                           </div>

                            <div class="form-group col-md-12">
                              <label class="form-label">Description</label>
                              <textarea name="description" class="form-control" id="editor" placeholder="Enter Description" spellcheck="true"></textarea>
                           </div>

                            {{-- <div class="row">
                              <div class="form-group col-md-4">
                                 <label class="form-label">Image</label>
                                 <input type="file" name="image" class="form-control">
                              </div>
                            </div> --}}

                            <div class="row">
                              <div class="form-group col-md-12">
                                 <div class="d-flex justify-content-between mb-1">
                                    <label class="form-label">Image</label>
                                    <div class="text-right btn btn-sm btn-primary add-item">Add<i class="pl-1 fas fa-plus"></i></a></div>
                                 </div>
                                <input type="file" name="image[]" class="form-control">
                             </div>
                           </div>
                          
                           {{-- Dynamci Item Name --}}
                           <div id="ItemsWrapper"></div>

                           <div class="row">
                              <div class="form-group col-md-12">
                                 <label class="form-label">Status</label>
                                  <select name="status" class="form-control">
                                     <option value="">Choose Status</option>
                                     <option value="Active">Active</option>
                                     <option value="Inactive">Inactive</option>
                                  </select>
                              </div>
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
@section('script')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
   $(function(){

      $(document).on( "click", ".add-item", function( event ) {
         $("#ItemsWrapper").append('<div class="row"><div class="form-group col-lg-11 col-sm-11 col-11 col-md-11"><input type="file" name="image[]" class="form-control" placeholder="Enter Item Name"></div><a href="#" class="removeclass d-table"><i class="fas fa-trash-alt"></i></a></div>');
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

      
      $('.browser-multiple').select2({
         placeholder: "Choose Browser",
         allowClear: true,
      });

      $('.technology-multiple').select2({
         placeholder: "Choose Technology",
         allowClear: true,
      });

     

     
      $('.category').change(function(){
         $.ajax({
            type: 'POST',
            url: '{{  route("sub-category-search") }}',
            data: { id: $(this).val() },
            success:function(data){
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