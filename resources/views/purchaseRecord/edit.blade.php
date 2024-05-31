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
            <h1 class="m-0">Purchase Records</h1>
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
        <div class="card-header">Purchase Record Edit Page
          <span class="float-right">
            <a class="btn btn-primary" href="{{ url('/purchaseRecord') }}">Back</a>
          </span>
        </div>
        <div class="card-body">
          <h5 class="card-title"><b>Current Data</b></h5>
          <br>
          <hr>
          <p class="card-text">Purchase Date: {{ $purchaseRecord->purchase_date }}</p>
          <p class="card-text">Item ID: {{ $purchaseRecord->item_id }}</p>
          <p class="card-text">Item Name: {{ $purchaseRecord->inventory->name }}</p>
          <p class="card-text">Quantity: {{ $purchaseRecord->quantity }}</p>
          <p class="card-text">Unit Price (RM): {{ $purchaseRecord->sold_price }}</p>
          <p class="card-text">Total Price (RM):
            {{ number_format($purchaseRecord->sold_price * $purchaseRecord->quantity, 2) }}</p>
          <p class="card-text">Customer ID: {{ $purchaseRecord->customer_id }}</p>
          <p class="card-text">Customer Name: {{ $purchaseRecord->customer->name }}</p>
          <hr>

          <form method="POST" action="{{ url('/purchaseRecord/' . $purchaseRecord->id) }}">
            @csrf

            <input type="hidden" name="id" value="{{ $purchaseRecord->id }}">
            <label>Purchase Date</label><br>
            <input type="date" name="purchase_date" id="purchase_date" class="form-control"
              value="{{ $purchaseRecord->purchase_date }}"><br>

            <label>Item ID</label><br>
            <select class="form-control" required name="item_id" onchange="displayItemName(this)"
              value="{{ $purchaseRecord->item_id }}">
              @foreach ($inventory as $item)
                <option value="{{ $item->id }}" @if ($item->id == $purchaseRecord->item_id) selected @endif>
                  {{ $item->id }} - {{ $item->name }}</option>
              @endforeach
            </select><br>

            <label>Item Name</label><br>
            <input type="text" disabled required name="item_name" id="item_name" class="form-control"
              value="{{ $purchaseRecord->inventory->name }}"><br>

            <label>Quantity</label><br>
            <input type="number" min="0" required name="quantity" id="quantity" class="form-control"
              onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"
              value="{{ $purchaseRecord->quantity }}" onchange="displayTotalPriceFromQuantity(this);"><br>

            <label>Unit Price (RM)</label><br>
            <input type="number" min="0" required name="sold_price" id="sold_price" step=".01"
              class="form-control" placeholder=0.00
              onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : (event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46"
              onchange="displayTotalPrice(this);" value="{{ $purchaseRecord->sold_price }}"><br>

            <label>Total Price (RM)</label><br>
            <input type="number" disabled required name="total_price" id="total_price" step=".01"
              class="form-control" placeholder="0.00" value=""><br>

            <label>Customer ID</label><br>
            <select class="form-control" required name="customer_id" onchange="displayCustomerName(this)"
              value="{{ $purchaseRecord->customer_id }}">
              @foreach ($customer as $customerId => $customerName)
                <option value="{{ $customerId }}" @if ($customerId == $purchaseRecord->customer_id) selected @endif>
                  {{ $customerId }} - {{ $customerName }}</option>
              @endforeach
            </select><br>

            <label>Customer Name</label><br>
            <input type="text" disabled required name="customer_name" id="customer_name" class="form-control"
              value="{{ $purchaseRecord->customer->name }}"><br>


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

      var selectedItemId = selectElement.options[selectElement.selectedIndex].value;
      @foreach ($inventory as $item)
        if (selectedItemId == {{ $item->id }}) {
          var itemPrice = {{ $item->price }};
          itemPrice = itemPrice.toFixed(2);
          document.getElementById('sold_price').value = itemPrice;
        }
      @endforeach
    }

    function displayCustomerName(selectElement) {
      var selectedOptionText = selectElement.options[selectElement.selectedIndex].text;
      var customerName = selectedOptionText.split(' - ')[1];
      document.getElementById('customer_name').value = customerName;
    }

    function displayTotalPrice(selectElement) {
      var selectedOptionText = selectElement.value;
      var totalPrice = selectedOptionText * document.getElementById('quantity').value;
      totalPrice = totalPrice.toFixed(2);
      document.getElementById('total_price').value = totalPrice;
    }

    function displayTotalPriceFromQuantity(selectElement) {
      var selectedOptionText = selectElement.value;
      var totalPrice = selectedOptionText * document.getElementById('sold_price').value;
      totalPrice = totalPrice.toFixed(2);
      document.getElementById('total_price').value = totalPrice;
    }

    document.addEventListener('DOMContentLoaded', function() {

      var quantity = {{ $purchaseRecord->quantity }};
      var totalPrice = document.getElementById('sold_price').value * quantity;

      totalPriceInFormat = totalPrice.toFixed(2);
      document.getElementById('total_price').value = totalPriceInFormat;
    })
  </script>
