<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
  integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

@section('content')
  @extends('layouts.app')
  @include('layouts.sidebar')
  <div class="d-flex align-items-center justify-content-center content-wrapper1">
    <div class="d-flex justify-content-center" style="width: 100%;">
      <div class="col-md-8">
        <div class="card shadow-sm">
          <div class="card-header">
            <h3 class="card-title">Dashboard</h3>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-md-4">
                <div class="card bg-primary text-white shadow-sm">
                  <div class="card-body position-relative">
                    <h5 class="card-title">{{ \App\Models\User::count() }}</h5>
                    <p class="card-text">Total Users</p>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                      stroke="currentColor" class="position-absolute top-0 end-0 mt-2 me-2"
                      style="width: 24px; height: 24px;">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>

                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card bg-success text-white shadow-sm">
                  <div class="card-body position-relative">
                    <h5 class="card-title">{{ \App\Models\Customer::count() }}</h5>
                    <p class="card-text">Total Customers</p>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                      stroke="currentColor" class="position-absolute top-0 end-0 mt-2 me-2" style="width: 24px; height: 24px;">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                    </svg>

                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card bg-warning text-white shadow-sm">
                  <div class="card-body position-relative">
                    <h5 class="card-title">{{ \App\Models\Inventory::count() }}</h5>
                    <p class="card-text">Total Products</p>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="position-absolute top-0 end-0 mt-2 me-2" style="width: 24px; height: 24px;">
                      <path stroke-linecap="round" stroke-linejoin="round" d="m21 7.5-9-5.25L3 7.5m18 0-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                    </svg>

                  </div>
                </div>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-4">
                <div class="card bg-info text-white shadow-sm">
                  <div class="card-body position-relative">
                    <h5 class="card-title">{{ \App\Models\PurchaseRecord::count() }}</h5>
                    <p class="card-text">Total Purchase Records</p>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="position-absolute top-0 end-0 mt-2 me-2" style="width: 24px; height: 24px;">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                    </svg>

                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card bg-secondary text-white shadow-sm">
                  <div class="card-body position-relative">
                    <h5 class="card-title">{{ \App\Models\SupplyRecord::count() }}</h5>
                    <p class="card-text">Total Supply Records</p>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="position-absolute top-0 end-0 mt-2 me-2" style="width: 24px; height: 24px;">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 0 1 2.25-2.25h7.5A2.25 2.25 0 0 1 18 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 0 0 4.5 9v.878m13.5-3A2.25 2.25 0 0 1 19.5 9v.878m0 0a2.246 2.246 0 0 0-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0 1 21 12v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6c0-.98.626-1.813 1.5-2.122" />
                    </svg>

                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card bg-danger text-white shadow-sm">
                  <div class="card-body position-relative">
                    <h5 class="card-title">{{ \App\Models\Supplier::count() }}</h5>
                    <p class="card-text">Total Supplier</p>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="position-absolute top-0 end-0 mt-2 me-2" style="width: 24px; height: 24px;">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                    </svg>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <style>
    @media (max-width: 991px) {
      .content-wrapper1 {
        margin-left: 0;
      }
    }

    @media (min-width: 992px) {
      .content-wrapper1 {
        margin-left: 250px;
      }
    }
  </style>
@endsection

