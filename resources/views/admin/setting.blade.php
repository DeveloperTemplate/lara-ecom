@extends('admin.master.layout')
@section('title', 'All Setting')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
          <div class="col-12">
            <nav class="navbar navbar-expand-lg navbar-dark bg-info rounded-1 mt-5">
                <div class="container-fluid">
                    <div class="navbar-collapse" id="navbar-1">
                        <ul class="navbar-nav mb-2 mb-lg-0">
                            <li class="nav-item">
                               <a class="nav-link active" href="{{ route('setting.index') }}">All Setting</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
             <div>
                <div class="card">
                   <div class="card-body">
                           <div class="row">
                              <div class="col-lg-3">
                                 <div class="card border">
                                    <div class="card-body">
                                          <div class="text-center">
                                             <span><b>GST(%)</b></span>
                                          </div>
                                       <div class="mt-4">
                                         <form enctype="multipart/form-data" action="{{ route('setting.update', setting('gst')->id ) }}" method="post" class="save">
                                             @csrf
                                             @method('PUT')
                                             <input type="text"   name="value" class="form-control" value="{{ setting('gst')->value ?? null }}">
                                             <input type="hidden" name="type" value="gst">
                                             <button class="btn btn-sm btn-primary mt-2">Save</button>
                                         </form>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-3">
                                 <div class="card border">
                                    <div class="card-body">
                                          <div class="text-center">
                                             <span><b>Minimum order amount(₹)</b></span>
                                          </div>
                                       <div class="mt-4">
                                         <form enctype="multipart/form-data" action="{{ route('setting.update', setting('minimun_order_value')->id ) }}" method="post" class="save">
                                             @csrf
                                             @method('PUT')
                                             <input type="text"   name="value" class="form-control" value="{{ setting('minimun_order_value')->value ?? null }}">
                                             <input type="hidden" name="type" value="minimun_order_value">
                                             <button class="btn btn-sm btn-primary mt-2">Save</button>
                                         </form>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-3">
                                 <div class="card border">
                                    <div class="card-body">
                                          <div class="text-center">
                                             <span><b>Delivery Fee(₹)</b></span>
                                          </div>
                                       <div class="mt-4">
                                         <form enctype="multipart/form-data" action="{{ route('setting.update', setting('delivery_fee')->id ) }}" method="post" class="save">
                                             @csrf
                                             @method('PUT')
                                             <input type="text"   name="value" class="form-control" value="{{ setting('delivery_fee')->value ?? null }}">
                                             <input type="hidden" name="type" value="delivery_fee">
                                             <button class="btn btn-sm btn-primary mt-2">Save</button>
                                         </form>
                                       </div>
                                    </div>
                                 </div>
                              </div>
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
