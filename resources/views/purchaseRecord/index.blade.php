<link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
<script src="https://kit.fontawesome.com/bc8e231302.js" crossorigin="anonymous"></script>
<style>
  .course-item {
    margin-bottom: 20px;
  }

  .status-buttons {
    display: flex;
    justify-content: center;
  }

  .status-buttons button {
    margin-right: 10px;
  }

</style>

@section('content')
  @extends('layouts.app')
  @include('layouts.sidebar')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper1" style="height: 100px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0" style="">Purchase Records</h1>
          </div><!-- /.col -->
          <div class="col-sm-10">
            <ol class="breadcrumb float-sm-right">

            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="container " style="margin: left 60px;">

      <div class="row">
        <div class="col-md-12">
          <div class="card">
            @if (session('success'))
              <div class="alert alert-success">
                {{ session('success') }}
              </div>
            @endif

            <div class="card-header">Purchase Records</div>
            <div class="card-body">
              <a href="{{ url('/purchaseRecord/create') }}" class="btn btn-success btn-sm" title="Add New Item">

                <i class="fa fa-plus" aria-hidden="true"></i> Add New
              </a>
              <a class="btn btn-success btn-sm" style="background-color: blue"
                href="{{ URL::to('purchaseRecords/export') }}">Export to Excel</a>

              <br />
              <br />
              <div class="table-responsive">
                <table id="ListCourse" class="table">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Purchase Date</th>
                      <th>Item ID</th>
                      <th>Item Name</th>
                      <th>Quantity</th>
                      <th>Sold Price (RM)</th>
                      <th>Total Price (RM)</th>
                      <th>Customer ID</th>
                      <th>Customer Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    @foreach ($purchaseRecord as $item)
                      <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->purchase_date }}</td>
                        <td>{{ $item->item_id }}</td>
                        <td>{{ $item->inventory->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->sold_price }}</td>
                        <td>{{ number_format($item->sold_price * $item->quantity, 2)}}</td>
                        <td>{{ $item->customer_id }}</td>
                        <td>{{ $item->customer->name }}</td>
                        <td>
                          <div class="action-buttons d-flex">
                            <a href="{{ url('purchaseRecords/pdfDownload/' . $item->id) }}" title="Download invoice" class="mr-2">
                              <button class="btn btn-warning btn-sm" style="" >
                                <i class="bi bi-download" aria-hidden="true" style="color: black"></i>Down
                              </button>
                            </a>
                            <a href="{{ url('purchaseRecords/pdfStream/' . $item->id) }}" title="View invoice" class="mr-2">
                              <button class="btn btn-dark btn-sm">
                                <i class="bi bi-box-arrow-up-right" aria-hidden="true"></i>Inv
                              </button>
                            </a>
                            <a href="{{ url('/purchaseRecord/' . $item->id) }}" title="View Purchase Record" class="mr-2">
                              <button class="btn btn-info btn-sm">
                                <i class="fa fa-eye" aria-hidden="true"></i> View
                              </button>
                            </a>
                            <a href="{{ url('/purchaseRecord/' . $item->id . '/edit') }}" title="Edit Purchase Record" class="mr-2">
                              <button class="btn btn-primary btn-sm">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                Edit
                              </button>
                            </a>
                            <form method="POST" action="{{ url('/purchaseRecord' . '/' . $item->id) }}" accept-charset="UTF-8"
                              style="display:inline">
                              {{ method_field('DELETE') }}
                              {{ csrf_field() }}
                              <button type="submit" class="btn btn-danger btn-sm" title="Delete Customer"
                                onclick="return confirm('Confirm delete?')">
                                <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                              </button>
                            </form>
                          </div>
                        </td>
                      </tr>
                    @endforeach



                  </tbody>

                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  {{-- <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script> --}}
  <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

  <script>
    $(document).ready(function() {
      $('#ListCourse').DataTable();
    });

  </script>
@endsection
