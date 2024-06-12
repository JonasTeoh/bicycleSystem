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

        <div class="card-header">User Edit Page
          <span class="float-right">
            <a class="btn btn-primary" href="{{ url('/user') }}">Back</a>
          </span>
        </div>
        <div class="card-body">
          <h5 class="card-title"><b>Current Data</b></h5>
          <br>
          <hr>
          <p class="card-text">Name: {{ $user->name }}</p>
          <p class="card-text">Email: {{ $user->email }}</p>
          <p class="card-text">Role: {{ $user->getRoleNames()->first() }}</p>
          <hr>

          <form method="POST" action="{{ url('/user/' . $user->id) }}">
            @csrf

            <input type="hidden" name="id" value="{{ $user->id }}">
            <label>Name</label><br>
            <input type="text" required name="name" id="name" class="form-control" value="{{ $user->name }}">
            <input type="hidden" required name="email" id="email" class="form-control" value="{{ $user->email }}"><br>
            @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror

            <label>Role</label><br>
            <select class="form-control" required name="role" value="{{ $user->getRoleNames() }}">
              @if (!@empty($user->getRoleNames()))
                <option value="">Select Option</option>
                @foreach ($roles as $role)
                  <option value="{{ $role->name }}" @if ($user->getRoleNames()->first() == $role->name) selected @endif>
                    {{ $role->name }}</option>
                @endforeach
              @endif

            </select><br>
            {{-- <label>Password</label><br>
            <input id="password" type="password" placeholder="Password"
              class="form-control @error('password') is-invalid @enderror" name="password" required><br>
            @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror

            <label>Password Confirmation</label><br>
            <input style="font-family:verdana;" id="password-confirm" type="password" placeholder="Password Confirmation"
              class="form-control" name="password_confirmation" required autocomplete="new-password"><br> --}}

            <input type="submit" value="Save" class="btn btn-success"></br>
            @method('PUT')
          </form>

          {{-- {!! Form::model($customer, ['route' => ['customer.update', $customer->id], 'method' => 'PATCH']) !!}
          <div class="form-group">
            <strong>Name</strong>
            {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
          </div>
          <div class="form-group">
            <strong>Contact Number</strong>
            {!! Form::text('contact_number', null, ['placeholder' => 'Contact Number', 'class' => 'form-control']) !!}
          </div>


          <button type="submit" class="btn btn-primary">Submit</button>

          {!! Form::close() !!} --}}
        </div>
      </div>
    </div>
  @stop
