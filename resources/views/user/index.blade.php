{{-- <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
<script src="https://kit.fontawesome.com/bc8e231302.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> --}}
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
  <div class="content-wrapper" style="height: 100px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0" style="">User Info</h1>
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
            @if (session()->has('errors'))
              <div class="alert alert-danger">
                @foreach (session()->get('errors')->all() as $error)
                  {{ $error }}
                @endforeach
              </div>
            @endif

            <div class="card-header">User Info</div>
            <div class="card-body">
              <a href="{{ url('/user/create') }}" class="btn btn-success btn-sm" title="Add New User">

                <i class="fa fa-plus" aria-hidden="true"></i> Add New
              </a>
              {{-- <a class="btn btn-success btn-sm" style="background-color: blue"
                href="{{ URL::to('/customer/export') }}">Export to Excel</a> --}}

              <br />
              <br />
              <div class="table-responsive">
                <table id="ListCourse" class="table">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Role</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>

                    @foreach ($users as $item)
                      <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>
                          @if (!empty($item->getRoleNames()))
                            @foreach ($item->getRoleNames() as $val)
                              <label class="badge badge-dark">{{ $val }}</label>
                            @endforeach
                          @endif
                        </td>
                        <td>
                          <div class="action-buttons d-flex">

                            <a href="{{ url('/user/' . $item->id) }}" title="View User" class="mr-2">
                              <button class="btn btn-info btn-sm">
                                <i class="fa fa-eye" aria-hidden="true"></i> View
                              </button>
                            </a>
                            @if ($item->id != 1)
                              <a href="{{ url('/user/' . $item->id . '/edit') }}" title="Edit User" class="mr-2">
                                <button class="btn btn-primary btn-sm">
                                  <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                  Edit
                                </button>
                              </a>
                              <form method="POST" action="{{ url('/user' . '/' . $item->id) }}" accept-charset="UTF-8"
                                style="display:inline">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger btn-sm" title="Delete User"
                                  onclick="return confirm('Confirm delete?')">
                                  <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                </button>
                            @endif

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
