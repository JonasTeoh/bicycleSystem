<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

@section('content')
  @extends('layouts.app')
  @include('layouts.sidebar')
  <div class="d-flex align-items-center justify-content-center content-wrapper1">
    <div class="row" style="width: 100%; justify-content: center;">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Profile
            <span class="float-right">
              <a class="btn btn-primary" href="{{ url('/home') }}">Back</a>
            </span>
          </div>

          <div class="card-body" style="justify-content: center; display: flex; align-items: center; flex-direction:column">
            @if (session('success'))
              <div class="alert alert-success">
                {{ session('success') }}
              </div>
            @endif
            <div class="image" style="padding-left:0;">
              <img src="{{ asset('img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image"
                style="display: block;
              margin-left: auto;
              margin-right: auto;
              width: 50%;">
            </div>

            <div
              style="display: flex; justify-content: center; align-items: center; padding-top:10px; flex-direction:column; width: 30%">

              <p class="card-text">Name: {{ $user->name }}</p>
              <p class="card-text">Email: {{ $user->email }}</p>
              <p class="card-text">Role: {{ $user->getRoleNames()->first() }}</p>
              <form method="POST" action="{{ url('/profile/' . $user->id) }}">
                @csrf
                <input type="hidden" name="id" value="{{ $user->id }}">
                <label>Name</label><br>
                <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}">
                <input type="hidden" name="email" id="email" class="form-control" value="{{ $user->email }}"><br>
                @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
                <label>Password</label><br>
                <input id="password" type="password" placeholder="Password"
                  class="form-control @error('password') is-invalid @enderror" name="password" required><br>
                @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
                <label>Password Confirmation</label><br>
                <input style="font-family:verdana;" id="password-confirm" type="password"
                  placeholder="Password Confirmation" class="form-control" name="password_confirmation" required
                  autocomplete="new-password"><br>

                <input type="submit" value="Save" class="btn btn-success"></br>
                @method('PUT')
              </form>

              <hr>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
