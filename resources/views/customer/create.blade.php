

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
            <h1 class="m-0">Customer Info</h1>
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
        <div class="card-header">Add Customer Page
          <span class="float-right">
            <a class="btn btn-primary" href="{{ route('customer.index') }}">Back</a>
          </span>
        </div>
        <div class="card-body">

          <form action="{{ url('customer') }}" method="post">
            {!! csrf_field() !!}
            <label>Name</label><br>
            <input type="text" required name="name" id="name" class="form-control"><br>

            <label>Contact Number</label><br>
            <input type="text" required name="contact_number" id="contact_number" class="form-control" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"><br>

            <input type="submit" value="Save" class="btn btn-success"></br>
          </form>


        </div>
      </div>
    </div>
  @stop
