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
            <h1 class="m-0">User Info</h1>
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
        <div class="card-header">Add User Page
          <span class="float-right">
            <a class="btn btn-primary" href="{{ route('user.index') }}">Back</a>
          </span>
        </div>
        <div class="card-body">

          <form action="{{ url('user') }}" method="post">
            {!! csrf_field() !!}
            <label>Name</label><br>
            <input type="text" required name="name" id="name" class="form-control"><br>

            <label>Email</label><br>
            <input type="email" required name="email" id="email" class="form-control"><br>

            <label>Password</label><br>
            <input id="password" type="password" placeholder="Password"
              class="form-control @error('password') is-invalid @enderror" name="password" required><br>
            @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror

            <label>Password Confirmation</label><br>
            <input style="font-family:verdana;" id="password-confirm" type="password" placeholder="Password Confirmation"
              class="form-control" name="password_confirmation" required autocomplete="new-password"><br>

            <label>Role</label><br>
            <select class="form-control" required name="role">
              <option value="">Select Item</option>
              @foreach ($roles as $roleId => $roleName)
                <option value="{{ $roleId }}">{{ $roleId }} - {{ $roleName }}</option>
              @endforeach
            </select><br>

            <input type="submit" value="Save" class="btn btn-success"></br>
          </form>


        </div>
      </div>
    </div>
  @stop
