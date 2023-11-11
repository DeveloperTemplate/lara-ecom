@extends('admin.master.layout')

@section('title', 'Admin Panel')

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
       <!-- Small boxes (Stat box) -->
       <div class="row">
         <div class="col-lg-3 col-6">
           <!-- small box -->
           <div class="small-box bg-info">
             <div class="inner">
               <h3>0</h3>
               <p>User</p>
             </div>
             <div class="icon">
               <i class="ion ion-bag"></i>
             </div>
             <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
           </div>
         </div>

                    <!-- ./col -->
       </div>
       <!-- /.row -->
       <!-- Main row -->
       <div class="row">
          {{-- <h2>Safikul Isalm</h2> --}}


       

       </div>
       <!-- /.row (main row) -->
     </div><!-- /.container-fluid -->
   </section>
   <!-- /.content -->
 </div>

@endsection
@section('script')

@endsection
