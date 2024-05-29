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
            <h1 class="m-0">Roles Info</h1>
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
        <div class="card-header">Add Role Page
          <span class="float-right">
            <a class="btn btn-primary" href="{{ route('roleAndPermission.index') }}">Back</a>
          </span>
        </div>
        <div class="card-body">

          <form action="{{ url('roleAndPermission') }}" method="post">
            {!! csrf_field() !!}
            <label>Name</label><br>
            <input type="text" required name="name" id="name" class="form-control"><br>
            <label>Permissions</label><br>

            <div class="accordion-body">
              <tr>
                <th><input type="checkbox" id="selectAll" style="margin-bottom: 15px"> Select All</th>
              </tr><br>
              @foreach ($permissions as $permission)
              <tr>
                <td>
                  <label for="permission_{{ $permission->id }}">
                    <input type="checkbox" name="permissions[]" id="permission_{{ $permission->id }}" class="checkmark" value="{{ $permission->name }}">
                    {{ $permission->name }}
                  </label><br>
                </td>
              </tr>
              @endforeach
              <br>
            </div>

            <input type="submit" value="Save" class="btn btn-success"></br>
          </form>


        </div>
      </div>
    </div>
    <script>
      const selectAllCheckbox = document.getElementById('selectAll');
      const permissionCheckboxes = document.querySelectorAll('input[type="checkbox"][name="permissions[]"]');

      selectAllCheckbox.addEventListener('change', (event) => {
        permissionCheckboxes.forEach(checkbox => checkbox.checked = event.target.checked);
      });

      permissionCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
          const allChecked = Array.from(permissionCheckboxes).every(checkbox => checkbox.checked);
          selectAllCheckbox.checked = allChecked;
        });
      });
    </script>
  @stop


