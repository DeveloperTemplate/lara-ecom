@extends('admin.master.layout')

@endphp
@section('title', 'Orde Details')
@section('content')

<style>
/*Invoice*/
.invoice .top-left {
    font-size:65px;
	color:#3ba0ff;
}

.invoice .top-right {
	text-align:right;
	padding-right:20px;
}

.invoice .table-row {
	margin-left:-15px;
	margin-right:-15px;
	margin-top:25px;
}

.invoice .payment-info {
	font-weight:500;
}

.invoice .table-row .table>thead {
	border-top:1px solid #ddd;
}

.invoice .table-row .table>thead>tr>th {
	border-bottom:none;
}

.invoice .table>tbody>tr>td {
	padding:8px 20px;
}

.invoice .invoice-total {
	margin-right:-10px;
	font-size:16px;
}

.invoice .last-row {
	border-bottom:1px solid #ddd;
}

.invoice-ribbon {
	width:85px;
	height:88px;
	overflow:hidden;
	position:absolute;
	top:-1px;
	right:14px;
}

.ribbon-inner {
	text-align:center;
	-webkit-transform:rotate(45deg);
	-moz-transform:rotate(45deg);
	-ms-transform:rotate(45deg);
	-o-transform:rotate(45deg);
	position:relative;
	padding:7px 0;
	left:-5px;
	top:11px;
	width:120px;
	background-color:#66c591;
	font-size:15px;
	color:#fff;
}

.ribbon-inner:before,.ribbon-inner:after {
	content:"";
	position:absolute;
}

.ribbon-inner:before {
	left:0;
}

.ribbon-inner:after {
	right:0;
}

@media(max-width:575px) {
	.invoice .top-left,.invoice .top-right,.invoice .payment-details {
		text-align:center;
	}

	.invoice .from,.invoice .to,.invoice .payment-details {
		float:none;
		width:100%;
		text-align:center;
		margin-bottom:25px;
	}

	.invoice p.lead,.invoice .from p.lead,.invoice .to p.lead,.invoice .payment-details p.lead {
		font-size:22px;
	}

	.invoice .btn {
		margin-top:10px;
	}
}

@media print {
	.invoice {
		width:900px;
		height:800px;
	}
}

</style>

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
        <!-- Main row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                          <h4 class="card-title">Order Details</h4>
                    </div>
                </div>
                <div class="card-body">
                      <div class="col-sm-12">
                          <div class="card panel-default invoice" id="invoice">
                          <div class="card-body">
                            <div class="row d-flex justify-content-between">
                            <div class="col-md-6">
                              <span style="font-size: 20px">Order Status - {{ $order->status }}</span>
                            </div>
                            <div class="col-md-6 text-right">
                              <span style="font-size: 20px">Order ID - {{ $order->order_details_id_generate }}</span>
                            </div>
                          </div>
                          <hr>
                          <div class="row d-flex justify-content-between">
                    
                            <div class="col-xs-4 from">
                              <p class="lead marginbottom m-0"><b>User details</b></p>
                              <p class="m-0">{{ $order->order->user->name }}</p>
                              <p class="m-0">Phone - {{ $order->order->user->mobile }}</p>
                            </div>
                    
                              <div class="col-xs-4 text-right payment-details">
                                <p class="lead marginbottom payment-info m-0">Payment details</p>
                                <p class="m-0">Mode: {{ $order->order->booking_type }}</p>
                                <p class="m-0">Date: {{ date('d M Y', strtotime($order->created_at)) }}</p>
                              </div>
                    
                          </div>
                    
                          <div class="row table-row">
                            <table class="table table-striped">
                                <thead>
                                  <tr>
                                    <th style="width:30%">Name</th>
                                    <th style="width:30%">List Price</th>
                                    <th class="text-right" style="width:10%">Total</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ $order->list_price }}</td>
                                    <td class="text-right">{{ $order->total_amount }}</td>
                                  </tr>
                                 </tbody>
                              </table>
                    
                          </div>
                    
                          <div class="row d-flex justify-content-between">
                          <div class="col-xs-6 margintop">
                            <a href="{{ route('order.index') }}" class="btn btn-sm btn-success">Back</a>
                          </div>
                          <div class="col-xs-6 text-right invoice-total mr-2">
                              <p class="m-0">Subtotal : {{ $order->list_price }}</p>
                              <p class="m-0">Total : {{ $order->total_amount }} </p>
                          </div>
                          </div>
                    
                          </div>
                        </div>
                      </div>
                </div>


            </div>
          </div>


          @if (App\Models\OrderDetail::whereNot('id',  $order->id)->where('order_id',  $order->order_id)->count() > 0)
          <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                          <h4 class="card-title">Other Order Details</h4>
                    </div>
                </div>
                <div class="card-body">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th style="width:30%">Name</th>
                        <th style="width:30%">List Price</th>
                        <th class="text-right" style="width:10%">Total</th>
                      </tr>
                    </thead>
                    <tbody>
                       @foreach ( App\Models\OrderDetail::whereNot('id',  $order->id)->where('order_id',  $order->order_id)->get() as $item)
                       <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->list_price }}</td>
                        <td class="text-right">{{ $item->total_amount }}</td>
                      </tr> 
                       @endforeach
                     </tbody>
                  </table>
                </div>
                
            </div>
          </div>
          @endif


          <!-- /.col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>



@endsection

