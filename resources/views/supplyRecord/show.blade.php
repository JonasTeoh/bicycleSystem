<link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
<script src="https://kit.fontawesome.com/bc8e231302.js" crossorigin="anonymous"></script>
@section('content')
  @extends('layouts.app')

  <!-- Main Sidebar Container -->
  @include('layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper1" style="height: 100px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Supply Record ID #{{ $supplyRecord->id }}</h1>
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
        <div class="card-header">Supply Record View Page
          <span class="float-right">
            <a class="btn btn-primary" href="{{ url('/supplyRecord') }}">Back</a>
          </span>
        </div>
        <div class="card-body">
          <div class="card-body">
            <h5 class="card-text">Supplied Date: {{ $supplyRecord->supplied_date }}</h5>
            <h5 class="card-text">Item ID: {{ $supplyRecord->item_id }}</h5>
            <h5 class="card-text">Item Name: {{ $supplyRecord->inventory->name }}</h5>
            <h5 class="card-text">Quantity: {{ $supplyRecord->quantity }}</h5>
            <h5 class="card-text">Supplier Unit Price (RM): {{ $supplyRecord->supplier_price }}</h5>
            <h5 class="card-text">Supplier Total Price (RM): {{ number_format($supplyRecord->supplier_price * $supplyRecord->quantity, 2) }}</h5>
            <h5 class="card-text">Supplier ID: {{ $supplyRecord->supplier_id }}</h5>
            <h5 class="card-text">Supplier Name: {{ $supplyRecord->supplier->name }}</h5>
          </div>

          </hr>

        </div>
      </div>


    </div>
  </div>
@stop
