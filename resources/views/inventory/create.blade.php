<link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
<script src="https://kit.fontawesome.com/bc8e231302.js" crossorigin="anonymous"></script>


@section('content')
  @extends('layouts.app')
  <!-- Main Sidebar Container -->
  @include('layouts.sidebar')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper1" style="height: 100px;">
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
        <div class="card-header">Add Item Page
          <span class="float-right">
            <a class="btn btn-primary" href="{{ route('inventory.index') }}">Back</a>
          </span>
        </div>
        <div class="card-body">

          <form action="{{ url('inventory') }}" method="post" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <label>Item Photo</label><br>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input" name="photo" id="photo" accept="image/*" onchange="displayImage(this)">
                <label class="custom-file-label" for="photo" id="photo-label">Choose file</label>
              </div>
            </div>
            <script>
              // Add the following code above the </body> tag.
              document.getElementById("photo").addEventListener("change", function() {
                var fileName = document.getElementById("photo").files[0].name;
                document.getElementById("photo-label").innerText = fileName;
              });
            </script>
            <div style="display: flex; justify-content: flex-start; align-items: center; margin-top: 10px;">
              <img src="" id="item_photo" style="max-width: 100%; max-height: 200px; display: none;">
            </div>
            <br>

            <script>
              function displayImage(input) {
                if (input.files && input.files[0]) {
                  var reader = new FileReader();
                  reader.onload = function(e) {
                    $('#item_photo').attr('src', e.target.result);
                  }
                  reader.readAsDataURL(input.files[0]);
                  $('#item_photo').show();
                }
              }
            </script>

            <label>Name</label><br>
            <input type="text" required name="name" id="name" class="form-control"><br>

            <label>Quantity</label><br>
            <input type="number" min="0" required name="quantity" id="quantity" class="form-control" value="0"
              onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"><br>

            <div class="form-group">
              <label for="age_category">Age Category</label>
              <select class="form-control" required id="age_category" name="age_category" onchange="">
                <option value="">Select Option</option>
                <option value="Preschool 4-7">Preschool 4-7</option>
                <option value="Kid 8-12">Kid 8-12</option>
                <option value="Teen 13-17">Teen 13-17</option>
                <option value="Adult 18++">Adult 18++</option>
                <option value="Adult/Teen">Adult/Teen</option>
              </select>
              <br>
            </div>

            <label>Price (RM)</label><br>
            <input type="number" min="0" required name="price" id="price" step=".01" class="form-control" placeholder="0.00" value="" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46"><br>

            <input type="submit" value="Save" class="btn btn-success"></br>
          </form>


        </div>
      </div>
    </div>
  @stop
