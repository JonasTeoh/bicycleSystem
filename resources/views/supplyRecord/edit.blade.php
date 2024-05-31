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
            <h1 class="m-0">Supply Records</h1>
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
        @if ($errors->has('quantity'))
          <div class="alert alert-danger">
            {{ $errors->first('quantity') }}
          </div>
        @endif
        <div class="card-header">Supply Record Edit Page
          <span class="float-right">
            <a class="btn btn-primary" href="{{ url('/supplyRecord') }}">Back</a>
          </span>
        </div>
        <div class="card-body">
          <h5 class="card-title"><b>Current Data</b></h5>
          <br>
          <hr>
          <p class="card-text">Supplied Date: {{ $supplyRecord->supplierd_date }}</p>
          <p class="card-text">Item ID: {{ $supplyRecord->item_id }}</p>
          <p class="card-text">Item Name: {{ $supplyRecord->inventory->name }}</p>
          <p class="card-text">Quantity: {{ $supplyRecord->quantity }}</p>
          <p class="card-text">Supplier Unit Price: {{ $supplyRecord->supplier_price }}</p>
          <p class="card-text">Supplier Total Price:
            {{ number_format($supplyRecord->supplier_price * $supplyRecord->quantity, 2) }}</p>
          <p class="card-text">Supplier ID: {{ $supplyRecord->supplier_id }}</p>
          <p class="card-text">Supplier Name: {{ $supplyRecord->supplier->name }}</p>
          <hr>

          <form method="POST" action="{{ url('/supplyRecord/' . $supplyRecord->id) }}">
            @csrf

            <input type="hidden" name="id" value="{{ $supplyRecord->id }}">
            <label>Supplied Date</label><br>
            <input type="date" name="supplied_date" id="supplied_date" class="form-control"
              value="{{ $supplyRecord->supplied_date }}"><br>

            <label>Item ID</label><br>
            <select class="form-control" required name="item_id" onchange="displayItemName(this)"
              value="{{ $supplyRecord->item_id }}">
              @foreach ($inventory as $itemId => $itemName)
                <option value="{{ $itemId }}" @if ($itemId == $supplyRecord->item_id) selected @endif>
                  {{ $itemId }} - {{ $itemName }}</option>
              @endforeach
            </select><br>

            <label>Item Name</label><br>
            <input type="text" disabled required name="item_name" id="item_name" class="form-control"
              value="{{ $supplyRecord->inventory->name }}"><br>

            <label>Quantity</label><br>
            <input type="number" min="0" required name="quantity" id="quantity" class="form-control"
              onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"
              value="{{ $supplyRecord->quantity }}" onchange="displayTotalPriceFromQuantity(this)"><br>

            <label>Supplier Unit Price (RM)</label><br>
            <input type="number" min="0" required name="supplier_price" id="supplier_price" step=".01" class="form-control"
              placeholder=0.00
              onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : (event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46"
              onchange="displayTotalPrice(this)" value="{{ $supplyRecord->supplier_price }}"><br>

            <label>Supplier Total Price (RM)</label><br>
            <input type="number" min="0" disabled required name="supplier_total_price" id="supplier_total_price" step=".01"
              class="form-control" placeholder="0.00" value=""><br>

            <label>Supplier ID</label><br>
            <select class="form-control" required name="customer_id" onchange="displaySupplierName(this)"
              value="{{ $supplyRecord->supplier_id }}">
              @foreach ($supplier as $supplierId => $supplierName)
                <option value="{{ $supplierId }}" @if ($supplierId == $supplyRecord->supplier_id) selected @endif>
                  {{ $supplierId }} - {{ $supplierName }}</option>
              @endforeach
            </select><br>

            <label>Supplier Name</label><br>
            <input type="text" disabled required name="supplier_name" id="supplier_name" class="form-control"
              value="{{ $supplyRecord->supplier->name }}"><br>


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

  <script>
    function displayItemName(selectElement) {
      var selectedOptionText = selectElement.options[selectElement.selectedIndex].text;
      var itemName = selectedOptionText.split(' - ')[1];
      document.getElementById('item_name').value = itemName;
    }

    function displaySupplierName(selectElement) {
      var selectedOptionText = selectElement.options[selectElement.selectedIndex].text;
      var supplierName = selectedOptionText.split(' - ')[1];
      document.getElementById('supplier_name').value = supplierName;
    }

    function displayTotalPrice(selectElement) {
      var selectedOptionText = selectElement.value;
      var totalPrice = selectedOptionText * document.getElementById('quantity').value;
      totalPrice = totalPrice.toFixed(2);
      document.getElementById('supplier_total_price').value = totalPrice;
    }

    function displayTotalPriceFromQuantity(selectElement) {
      var selectedOptionText = selectElement.value;
      var totalPrice = selectedOptionText * document.getElementById('supplier_price').value;
      totalPrice = totalPrice.toFixed(2);
      document.getElementById('supplier_total_price').value = totalPrice;
    }

    document.addEventListener('DOMContentLoaded', function() {
      var quantity = {{ $supplyRecord->quantity }};
      var totalPrice = {{ $supplyRecord->supplier_price }} * quantity;

      totalPriceInFormat = totalPrice.toFixed(2);
      document.getElementById('supplier_total_price').value = totalPriceInFormat;
    })
  </script>
