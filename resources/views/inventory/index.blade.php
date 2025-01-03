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
            <h1 class="m-0" style="">Inventory</h1>
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

            <div class="card-header">Inventory</div>
            <div class="card-body">
              <a href="{{ url('/inventory/create') }}" class="btn btn-success btn-sm" title="Add New Item">

                <i class="fa fa-plus" aria-hidden="true"></i> Add New
              </a>
              <a class="btn btn-success btn-sm" style="background-color: blue"
                href="{{ URL::to('inventories/export') }}">Export to Excel</a>

              <br />
              <br />
              <div class="table-responsive">
                <table id="ListCourse" class="table">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Image</th>
                      <th>Name</th>
                      <th>Quantity</th>
                      <th>Age Category</th>
                      <th>Price (RM)</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    @foreach ($inventory as $item)
                      <tr>
                        <td>{{ $item->id }}</td>
                        <td><img src="{{ asset('img/' . $item->photo) }}" style="max-width: 80px; max-height: 80px; border-radius: 5px;" /></td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->age_category }}</td>
                        <td>{{ $item->price }}</td>
                        <td>
                          <div class="action-buttons d-flex">

                            <a href="{{ url('/inventory/' . $item->id) }}" title="View Inventory" class="mr-2">
                              <button class="btn btn-info btn-sm">
                                <i class="fa fa-eye" aria-hidden="true"></i> View
                              </button>
                            </a>
                            <a href="{{ url('/inventory/' . $item->id . '/edit') }}" title="Edit Inventory" class="mr-2">
                              <button class="btn btn-primary btn-sm">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                Edit
                              </button>
                            </a>
                            <form method="POST" action="{{ url('/inventory' . '/' . $item->id) }}" accept-charset="UTF-8"
                              style="display:inline">
                              {{ method_field('DELETE') }}
                              {{ csrf_field() }}
                              <button type="submit" class="btn btn-danger btn-sm" title="Delete Customer"
                                onclick="return confirmDelete()">
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
  <script>
    function confirmDelete() {
      var confirmation = prompt("If you delete the item, all the relevant data inside purchase record and supply record will also be deleted. Please ensure that you have export all the data before deleting.\nType 'confirm' to delete:", "");
      if (confirmation.toLowerCase() === "confirm") {
        // Perform the delete operation
        // (e.g., submit a form, make an AJAX request)
        return true; // Allow the default action (e.g., form submission)
      } else {
        return false; // Prevent the default action (e.g., form submission)
      }
    }
    function confirmUpdate() {
      var confirmation = prompt("If you delete the item, all the relevant data inside purchase record and supply record will also be deleted. Please ensure that you have export all the data before deleting.\nType 'confirm' to delete:", "");
      if (confirmation.toLowerCase() === "confirm") {
        // Perform the delete operation
        // (e.g., submit a form, make an AJAX request)
        return true; // Allow the default action (e.g., form submission)
      } else {
        return false; // Prevent the default action (e.g., form submission)
      }
    }
  </script>
@endsection
