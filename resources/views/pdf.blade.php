<!doctype html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Invoice</title>
  <link rel="stylesheet" href="{{ public_path('css/pdf.css') }}" type="text/css">
</head>

<body>
  <table class="w-full">
    <tr>
      <td class="w-half">
        <img src="{{ public_path('img/logo.png') }}" alt="logo" width="200" height="100" />
      </td>
      <td class="w-half">
        <h2>Invoice ID: #{{ $purchaseRecord->id }}</h2>
      </td>
    </tr>
    <tr>
      <td class="w-half">
        <h3>Purchased Date: {{ $purchaseRecord->purchase_date }}</h3>
      </td>
      <td class="w-half">
        <h3>Invoice Date: @if ($currentTime = Carbon\Carbon::now('Asia/Shanghai')->format('Y-m-d H:i:s')) @endif {{ $currentTime }}</h3>
      </td>
  </table>

  <div class="margin-top">
    <table class="w-full">
      <tr>
        <td class="w-half">
          <div>
            <h4>To:</h4>
          </div>
          <div>{{ $customer->name }}</div>
          <div>Contact No.: {{ $customer->contact_number }}</div>
        </td>
        <td class="w-half">
          <div>
            <h4>From:</h4>
          </div>
          <div>{{ Auth::user()->name }}</div>
          <div>{{ Auth::user()->getRoleNames()->first() }} of Kedai Basikal Budget & Customized</div>
        </td>
      </tr>
      <tr>
        <td>
          <div></div>
        </td>
        <td>
          <div>31, Jalan Universiti 4, Taman Universiti, 86400 Parit Raja, Johor</div>
        </td>
      </tr>
    </table>
  </div>

  <div class="margin-top">
    <table class="products">
      <tr>
        <th>Item ID</th>
        <th>Item Name</th>
        <th>Quantity</th>
        <th>Unit Price (RM)</th>
        <th>Total Price (RM)</th>
      </tr>
      <tr class="items">
        <td>
          {{ $purchaseRecord->item_id }}
        </td>
        <td>
          {{ $purchaseRecord->inventory->name }}
        </td>
        <td>
          {{ $purchaseRecord->quantity }}
        </td>
        <td>
          {{ $purchaseRecord->sold_price }}
        </td>
        <td>
          {{ number_format($purchaseRecord->sold_price * $purchaseRecord->quantity, 2) }}
        </td>
      </tr>
    </table>
  </div>

  <div class="total">
    Total: RM {{ number_format($purchaseRecord->sold_price * $purchaseRecord->quantity, 2) }}
  </div>

  <div class="footer margin-top">
    <div>Thank you</div>
    <div>&copy; Kedai Basikal Budget & Customized</div>
    <div>31, Jalan Universiti 4, Taman Universiti, 86400 Parit Raja, Johor</div>
  </div>
</body>

</html>
