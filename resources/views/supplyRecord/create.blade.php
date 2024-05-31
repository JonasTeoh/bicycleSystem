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
            <h1 class="m-0">Supply Record</h1>
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
        <div class="card-header">Add Supply Record Page
          <span class="float-right">
            <a class="btn btn-primary" href="{{ route('supplyRecord.index') }}">Back</a>
          </span>
        </div>
        <div class="card-body">

          <form action="{{ url('supplyRecord') }}" method="post">
            {!! csrf_field() !!}
            <label>Supplied Date</label><br>
            <input type="date" required name="supplied_date" id="supplied_date" class="form-control"><br>

            <label>Item ID</label><br>
            {{-- <input type="number" required name="item_id" id="item_id" class="form-control"><br> --}}
            <select class="form-control" required name="item_id" onchange="displayItemName(this)">
              <option value="">Select Item</option>
              @foreach ($inventory as $itemId => $itemName)
                <option value="{{ $itemId }}">{{ $itemId }} - {{ $itemName }}</option>
              @endforeach
            </select><br>

            <label>Item Name</label><br>
            <input type="text" disabled required name="item_name" id="item_name" class="form-control"
              value=""><br>

            <label>Quantity</label><br>
            <input type="number" min="0" required name="quantity" id="quantity" class="form-control"
              onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" onchange="displayTotalPriceFromQuantity(this)"><br>

            <label>Supplier Unit Price (RM)</label><br>
            <input type="number" min="0" required name="supplier_price" id="supplier_price" step=".01" class="form-control"
              placeholder=0.00
              onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : (event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46" onchange="displayTotalPrice(this);"><br>

              <label>Supplier Total Price (RM)</label><br>
            <input type="number" min="0" disabled required name="supplier_total_price" id="supplier_total_price" step=".01" class="form-control" placeholder="0.00" value=""><br>

            <label>Supplier ID</label><br>
            <select class="form-control" required name="supplier_id" onchange="displaySupplierName(this)">
              <option value="">Select Item</option>
              @foreach ($supplier as $supplierId => $supplierName)
                <option value="{{ $supplierId }}">{{ $supplierId }} - {{ $supplierName }}</option>
              @endforeach
            </select><br>

            <label>Supplier Name</label><br>
            <input type="text" disabled required name="supplier_name" id="supplier_name" class="form-control"
              value=""><br>

            <input type="submit" value="Save" class="btn btn-success"></br>
          </form>
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

    function displayTotalPriceFromQuantity(selectElement) {
      var selectedOptionText = selectElement.value;
      var totalPrice = selectedOptionText * document.getElementById('supplier_price').value;
      totalPrice = totalPrice.toFixed(2);
      document.getElementById('supplier_total_price').value = totalPrice;
    }

    function displayTotalPrice(selectElement) {
      var selectedOptionText = selectElement.value;
      var totalPrice = selectedOptionText * document.getElementById('quantity').value;
      totalPrice = totalPrice.toFixed(2);
      document.getElementById('supplier_total_price').value = totalPrice;
    }
  </script>
