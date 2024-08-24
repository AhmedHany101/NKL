@extends('admin_layout.layout')
@section('layout')
<style>
  .success-message {
    position: fixed;
    top: 10%;
    left: 0;
    width: 100%;
    background-color: green;
    color: white;
    font-weight: bold;
    text-align: center;
    padding: 10px;
    display: none;
  }

  .err-message {
    position: fixed;
    top: 10%;
    left: 0;
    width: 100%;
    background-color: red;
    color: white;
    font-weight: bold;
    text-align: center;
    padding: 10px;
    display: none;
  }
</style>
<main id="main" class="main">
  @if(session('message'))
  <div id="suceesMessage" class="alert alert-success" style="display:none;">{{session('message')}}</div>
  <script>
    // Show the error message
    document.getElementById('suceesMessage').style.display = 'block';
    // Hide the error message after 5 seconds
    setTimeout(function() {
      document.getElementById('suceesMessage').style.display = 'none';
    }, 5000);
  </script>
  @endif
  @if(session('message_error'))
  <div id="errorMessage" class="alert alert-danger" style="display:none;">{{ session('message_error') }}</div>
  <script>
    // Show the error message
    document.getElementById('errorMessage').style.display = 'block';
    // Hide the error message after 5 seconds
    setTimeout(function() {
      document.getElementById('errorMessage').style.display = 'none';
    }, 5000);
  </script>
  @endif
  <div class="pagetitle">
    <h1>@lang('public.Edite_shipping_information')</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/admin/index')}}">@lang('public.Home')</a></li>
        <li class="breadcrumb-item">@lang('public.Shipping_Data')</li>
        <li class="breadcrumb-item active">@lang('public.Edite')</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <section class="section ar">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">@lang('public.key01') : <span style="color: red;">{{$order_details->tracking_no}}</h5>
            @if($order_details->order_type == 0)
            <!-- Vertical Form -->
            <form class="row g-3" id="orderForm0">
              <input type="hidden" name="id" value="{{$order_details->id}}">
              <div class="col-12">
                <label for="inputNanme4" class="form-label">@lang('public.Customer_Name')</label>
                <input type="text" class="form-control" value="{{$order_details->name}}" readonly>
                <span style="color: red;">*@lang('public.key02')*</span>
              </div>
              <div class="col-12">
                <label for="inputEmail4" class="form-label">@lang('public.Customer_Email') </label>
                <input type="email" class="form-control" value="{{$order_details->email}}" readonly>
                <span style="color: red;">*@lang('public.key02')*</span>
              </div>
              <div class="col-12">
                <label for="inputEmail4" class="form-label">@lang('public.Customer_Phone')</label>
                <input type="email" class="form-control" value="{{$order_details->phone}}" readonly>
                <span style="color: red;">*@lang('public.key02')*</span>
              </div>
              <div class="col-12">
                <label for="inputAddress" class="form-label">@lang('public.Customer_Address')</label>
                <input type="text" class="form-control" name="user_address" value="{{$order_details->user_address}}">
              </div>
              <div class="col-12">
                <label for="inputPassword4" class="form-label">@lang('public.City_of_Departure')</label>
                <input type="text" class="form-control" value="{{$order_details->departure}}" readonly>
                <span style="color: red;">*@lang('public.key02')*</span>
              </div>
              <div class="col-12">
                <label for="inputAddress" class="form-label">@lang('public.Delivery_City')</label>
                <input type="text" class="form-control" value="{{$order_details->delivery}}" readonly>
                <span style="color: red;">*@lang('public.key02')*</span>
              </div>
              <div class="col-12">
                <label for="inputEmail4" class="form-label">@lang('public.Total_Weight')</label>
                <input type="text" class="form-control" value="{{$order_details->weight}}" readonly>
                <span style="color: red;">*@lang('public.key02')*</span>
              </div>
              <div class="col-12">
                <label for="inputPassword4" class="form-label">@lang('public.Dimensions')</label>
                <input type="text" class="form-control" value="{{$order_details->dimensions}}" readonly>
                <span style="color: red;">*@lang('public.key02')*</span>
              </div>
              @if($order_details->message != "")
              <div class="col-12">
                <label for="inputAddress" class="form-label">@lang('public.Message')</label>
                <textarea class="form-control" name="message" readonly>{{$order_details->message}}</textarea>
                <span style="color: red;">*@lang('public.key02')*</span>
              </div>
              @endif
              <hr>
              <div class="col-12">
                <label for="inputAddress" class="form-label">@lang('public.Addtion_Details')</label>
              </div>
              <div class="col-12">
                <label for="inputPassword4" class="form-label">@lang('public.Current_Status')</label>
                @if($order_details->status == 0)
                <input type="text" readonly class="form-control" value="@lang('public.Under_Revision') &#x1F570;">
                @elseif($order_details->status == 1)
                <input type="text" readonly class="form-control" value="@lang('public.In_Way') &#x1F69A;">
                @elseif($order_details->status == 2)
                <input type="text" readonly class="form-control" value="@lang('public.Shipping_Done') &#x2714;">
                @endif
                <br>
                <label for="inputPassword4" class="form-label">@lang('public.update_status')</label>
                <select name="status" class="form-control" id="">
                  <option value="{{$order_details->status}}">@lang('public.Current_Status'):
                    @if($order_details->status == 0)
                    @lang('public.Under_Revision')
                    @elseif($order_details->status == 1)
                    @lang('public.In_Way')
                    @elseif($order_details->status == 2)
                    @lang('public.Shipping_Done')
                    @endif
                  </option>
                  <option value="0">@lang('public.Under_Revision')</option>
                  <option value="1">@lang('public.In_Way')</option>
                  <option value="2">@lang('public.Shipping_Done')</option>
                </select>
              </div>
              <div class="col-12">
                <label for="inputEmail4" class="form-label">@lang('public.Shipping_cost')</label>
                <input type="text" class="form-control" name="cost" value="{{$order_details->cost}}">
              </div>
              <div class="col-12">
                <label for="inputPassword4" class="form-label">@lang('public.Customer_payment')</label>
                <input type="text" class="form-control" name="user_payment" value="{{$order_details->user_payment}}">
              </div>
              <div class="col-12">
                <label for="inputEmail4" class="form-label">@lang('public.Supplier_Name')</label>
                <input type="text" class="form-control" name="supplier" value="{{$order_details->Supplier}}">
              </div>
              <div class="col-12">
                <label for="inputText" class="col-sm-2 col-form-label">@lang('public.Delivery_Time') @lang('public.Current')</label>
                <input type="text" class="form-control" readonly value="{{$order_details->delivery_time}}">
              </div>
              <div class="col-12">
                <label for="inputText" class="col-sm-2 col-form-label">@lang('public.Edite') @lang('public.Delivery_Time')</label>
                <input type="date" class="form-control" name="delivery_time" id="delivery_time">
              </div>
              <div class="col-12">
                <label for="inputEmail4" class="form-label">@lang('public.Shipping_Describetion')</label>
                <textarea class="form-control" name="shipping_describetion">{{$order_details->shipping_describetion}}</textarea>
              </div>
              <div class="text-center">
                
                <button type="submit" class="btn btn-primary">@lang('public.Save')</button>
              </div>
            </form>
            @else
            <form class="row g-3" id="requstForm">
              <input type="hidden" name="id" value="{{$order_details->id}}">
              <div class="col-12">
                <label for="inputAddress" class="form-label" style="text-decoration: underline;color:red">@lang('public.Customer_Details')</label>
              </div>
              <div class="col-12">
                <label for="inputEmail4" class="form-label">@lang('public.Customer_Name')</label>
                <input type="text" class="form-control" value="{{$order_details->name}}" id="customer_name" name="customer_name">
              </div>
              <div class="col-12">
                <label for="inputNanme4" class="form-label">@lang('public.Customer_Email')</label>
                <input type="email" class="form-control" id="inputCustomer" list="customerOptions" name="customer_email" value="{{$order_details->email}}">
                <datalist id="customerOptions"></datalist>
                <!-- Add a div to display customer options -->
                <div id="customerOptionsDisplay"></div>
              </div>

              <div class="col-12">
                <label for="inputEmail4" class="form-label">@lang('public.Customer_Phone')</label>
                <input type="text" name="phone" class="form-control" value="{{$order_details->phone}}">
              </div>
              <div class="col-12">
                <label for="inputAddress" class="form-label">@lang('public.Customer_Address')</label>
                <input type="text" class="form-control" name="user_address" value="{{$order_details->user_address}}">
              </div>
              <hr>
              <div class="col-12">
                <label for="inputAddress" class="form-label" style="text-decoration: underline;color:red">@lang('public.Supplier_Details')</label>
              </div>
              <div class="col-12">
                <label for="inputEmail4" class="form-label">@lang('public.Supplier_Name')</label>
                <input type="text" class="form-control" name="supplier_name" id="supplier_name" value="{{$order_details->Supplier}}">
              </div>
              <div class="col-12">
                <label for="inputEmail4" class="form-label">@lang('public.Supplier_Email')</label>
                <input type="text" class="form-control" id="inputSupplier" list="supplierOptions" name="supplier_email" value="{{$order_details->supplier_email}}">
                <datalist id="supplierOptions"></datalist>
                <!-- Add a div to display supplier options -->
                <div id="supplierOptionsDisplay"></div>
              </div>
              <hr>
              <div class="col-12">
                <label for="inputAddress" class="form-label" style="text-decoration: underline;color:red">@lang('public.Deal_Details')</label>
              </div>
              <div class="col-12">
                <label for="inputPassword4" class="form-label">@lang('public.City_of_Departure')</label>
                <input type="text" class="form-control" value="{{$order_details->departure}}" name="departure">
              </div>
              <div class="col-12">
                <label for="inputAddress" class="form-label">@lang('public.Delivery_City')</label>
                <input type="text" class="form-control" value="{{$order_details->delivery}}" name="delivery">
              </div>
              <div class="col-12">
                <label for="inputEmail4" class="form-label">@lang('public.Total_Weight')</label>
                <input type="text" class="form-control" value="{{$order_details->weight}}" name="weight">
              </div>
              <div class="col-12">
                <label for="inputPassword4" class="form-label">@lang('public.Dimensions')</label>
                <input type="text" class="form-control" value="{{$order_details->dimensions}}" name="dimensions">
              </div>
              <div class="col-12">
                <label for="inputText" class="col-sm-2 col-form-label"> @lang('public.Delivery_Time') @lang('public.Current')</label>
                <input type="text" class="form-control" readonly value="{{$order_details->delivery_time}}">
              </div>
              <div class="col-12">
                <label for="inputText" class="col-sm-2 col-form-label">@lang('public.Edite') @lang('public.Delivery_Time')</label>
                <input type="date" class="form-control" name="delivery_time" id="delivery_time">
              </div>
              <div class="col-12">
                <label for="inputPassword4" class="form-label">@lang('public.Current_Status')</label>
                @if($order_details->status == 0)
                <input type="text" readonly class="form-control" value="@lang('public.Under_Revision') &#x1F570;">
                @elseif($order_details->status == 1)
                <input type="text" readonly class="form-control" value="@lang('public.In_Way') &#x1F69A;">
                @elseif($order_details->status == 2)
                <input type="text" readonly class="form-control" value="@lang('public.Shipping_Done') &#x2714;">
                @endif
                <br>
                <label for="inputPassword4" class="form-label"> @lang('public.update_status')</label>
                <select name="status" class="form-control" id="">
                  <option value="{{$order_details->status}}">@lang('public.Current_Status'):
                    @if($order_details->status == 0)
                    @lang('public.Under_Revision')
                    @elseif($order_details->status == 1)
                    @lang('public.In_Way')
                    @elseif($order_details->status == 2)
                    @lang('public.Shipping_Done')
                    @endif
                  </option>
                  <option value="0">@lang('public.Under_Revision')</option>
                  <option value="1">@lang('public.In_Way')</option>
                  <option value="2">@lang('public.Shipping_Done')</option>
                </select>
              </div>
              <div class="col-12">
                <label for="inputEmail4" class="form-label">@lang('public.Shipping_cost')</label>
                <input type="text" class="form-control" name="cost" value="{{$order_details->cost}}">
              </div>
              <div class="col-12">
                <label for="inputPassword4" class="form-label">@lang('public.User_Payment')</label>
                <input type="text" class="form-control" name="user_payment" value="{{$order_details->user_payment}}">
              </div>
              <div class="col-12">
                <label for="inputText" class="col-sm-2 col-form-label">@lang('public.Shipping_Describetion')</label>
                <div class="col-sm-10">
                  <textarea class="form-control" name="shipping_describetion" id="shipping_describetion">{{$order_details->shipping_describetion}}</textarea>
                </div>
              </div>
              <div class="col-12">
                <label for="inputText" class="col-sm-2 col-form-label">@lang('public.Deal_Name')</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="deal_name" id="deal_name" value="{{$order_details->deal_name}}">
                </div>
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary">@lang('public.Save')</button>
              </div>
            </form>
            @endif
            <!-- Vertical Form -->
          </div>
        </div>
      </div>
    </div>
  </section>

</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
  $(document).ready(function() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('#orderForm0').submit(function(event) {
      event.preventDefault(); // Prevent default form submission behavior

      // Serialize the form data
      var formData = $(this).serialize();

      $.ajax({
        url: '/admin/update/information', // Replace with your actual backend endpoint URL
        type: 'POST',
        data: formData,
        success: function(response) {
          // Handle the response from the backend
          var successMessage = $('<div>').addClass('success-message').text('Success');

          $('body').append(successMessage);

          successMessage.fadeIn(500).delay(3000).fadeOut(500, function() {
            $(this).remove();
          });
        },
        error: function(xhr) {
          // Handle the error case
          $('body').append(errorMessage);
          errorMessage.fadeIn(500).delay(3000).fadeOut(500, function() {
            $(this).remove();
          });
        }
      });
    });
  });

  $(document).ready(function() {

    $('#requstForm').submit(function(event) {
      event.preventDefault(); // Prevent default form submission behavior
      var errorFields = [];



      // Continue with AJAX request if there are no validation errors

      // Get form data
      var formData = {
        // departure: $("#departure").val(),
        // delivery: $("#delivery").val(),
        // dimensions: $("#dimensions").val(),
        // weight: $("#weight").val(),
        // cost: $("#cost").val(),
        // user_payment: $("#user_payment").val(),
        // deal_name: $("#deal_name").val(),
        // shipping_describetion: $("#shipping_describetion").val(),
        // status: $("#status").val(),
        // delivery_time: $("#delivery_time").val(),
        customer_email: $('#customer_email').val(),
        customer_name: $('#customer_name').val(),
        // supplier_email: supplier_email,
        // supplier_name: supplier_name
      };
      var formData = $(this).serialize();

      // Make the AJAX request
      $.ajax({
        url: "/admin/update/request/information",
        type: "POST",
        data: formData,
        success: function(response) {
          if (response.error) {
            var errorMessage = $('<div>').addClass('err-message').text(response.message);
            $('body').append(errorMessage);
            errorMessage.fadeIn(500).delay(3000).fadeOut(500, function() {
              $(this).remove();
            });
          } else {
            var successMessage = $('<div>').addClass('success-message').text(response.message);
            $('body').append(successMessage);
            successMessage.fadeIn(500).delay(3000).fadeOut(500, function() {
              $(this).remove();
            });
          }
        },
      });

    });
  });
</script>
<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $(document).ready(function() {
    // Bind the input event on the customer input field
    $('#inputCustomer').on('input', function() {
      var keyword = $(this).val(); // Get the entered keyword

      // Make an AJAX request to fetch the similar customer names
      $.ajax({
        url: '/admin/search-customer', // Replace with the actual URL to fetch customer names
        method: 'GET',
        data: {
          keyword: keyword
        }, // Pass the keyword as a parameter
        success: function(response) {
          var options = '';

          // Iterate over the response and build the options
          for (var i = 0; i < response.length; i++) {
            options += '<option value="' + response[i] + '">';
          }

          // Update the datalist with the new options
          $('#customerOptions').html(options);

          // Update the display element with the new options
          $('#customerOptionsDisplay').html(options);
        }
      });

    });

    // Bind the input event on the supplier input field
    $('#inputSupplier').on('input', function() {
      var keyword = $(this).val(); // Get the entered keyword

      // Make an AJAX request to fetch the similar supplier names
      $.ajax({
        url: '/admin/search-supplier', // Replace with the actual URL to fetch supplier names
        method: 'GET',
        data: {
          keyword: keyword
        }, // Pass the keyword as a parameter
        success: function(response) {
          var options = '';

          // Iterate over the response and build the options
          for (var i = 0; i < response.length; i++) {
            options += '<option value="' + response[i] + '">';
          }

          // Update the datalist with the new options
          $('#supplierOptions').html(options);

          // Update the display element with the new options
          $('#supplierOptionsDisplay').html(options);
        }
      });
    });
  });
</script>
@endsection