

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
            <h1 class="m-0">Inventory</h1>
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

        <div class="card-header">Inventory Edit Page
          <span class="float-right">
            <a class="btn btn-primary" href="{{ url('/inventory') }}">Back</a>
          </span>
        </div>
        <div class="card-body">
          <h5 class="card-title"><b>Current Data</b></h5>
          <br><hr>
          <p class="card-text">Name: {{ $inventory->name }}</p>
          <p class="card-text">Quantity: {{ $inventory->quantity }}</p>
          <p class="card-text">Age Category: {{ $inventory->age_category }}</p>
          <p class="card-text">Price: RM{{ $inventory->price }}</p>
          <hr>

          <form method="POST" action="{{ url('/inventory/'.$inventory->id) }}" >
            @csrf

            <input type="hidden" name="id" value="{{ $inventory->id }}">
            <label>Name</label><br>
            <input type="text" name="name" id="name" class="form-control" value="{{ $inventory->name }}"><br>

            <label>Quantity</label><br>
            <input type="text" name="quantity" id="quantity" class="form-control" value="{{ $inventory->quantity }}"><br>

            <div class="form-group">
              <label for="age_category">Age Category</label>
              <select class="form-control" id="age_category" name="age_category" value="{{ $inventory->age_category }}" onchange="">
                <option value="Preschool 4-7">Preschool 4-7</option>
                <option value="Kid 8-12">Kid 8-12</option>
                <option value="Teen 13-17">Teen 13-17</option>
                <option value="Adult 18++">Adult 18++</option>
                <option value="Adult/Teen">Adult/Teen</option>
              </select>
              <br>
            </div>

            <label>Price (RM)</label><br>
            <input type="text" name="price" id="price" class="form-control" value="{{ $inventory->price }}"><br>

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