<link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
<script src="https://kit.fontawesome.com/bc8e231302.js" crossorigin="anonymous"></script>
@section('content')
  @extends('layouts.app')

  <!-- Main Sidebar Container -->
  @include('layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="height: 100px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Purchase Record ID #{{ $purchaseRecord->id }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-10">
            <ol class="breadcrumb float-sm-right">

            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="container" style= "margin: left 50;">
      <div class="card">
        <div class="card-header">Purchase Record View Page
          <span class="float-right">
            <a class="btn btn-primary" href="{{ url('/purchaseRecord') }}">Back</a>
          </span>
        </div>
        <div class="card-body">
          <div class="card-body">
            <h5 class="card-text">Purchase Date: {{ $purchaseRecord->purchase_date }}</h5>
            <h5 class="card-text">Item ID: {{ $purchaseRecord->item_id }}</h5>
            <h5 class="card-text">Item Name: {{ $purchaseRecord->inventory->name }}</h5>
            <h5 class="card-text">Quantity: {{ $purchaseRecord->quantity }}</h5>
            <h5 class="card-text">Unit Price (RM): {{ $purchaseRecord->sold_price }}</h5>
            <h5 class="card-text">Total Price (RM): {{ number_format($purchaseRecord->sold_price * $purchaseRecord->quantity, 2) }}</h5>
            <h5 class="card-text">Customer ID: {{ $purchaseRecord->customer_id }}</h5>
            <h5 class="card-text">Customer Name: {{ $purchaseRecord->customer->name }}</h5>
          </div>

          </hr>

        </div>
      </div>


    </div>
  </div>
@stop
