@extends('admin_layout.layout')
@section('layout')
<style>
    .error-message {
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
    <div class="pagetitle">
        <h1>@lang('public.Request_form')</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin/index')}}">@lang('public.Home')</a></li>
                <li class="breadcrumb-item">@lang('public.Create_Request')</li>
                
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->
    <section class="section ar">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">@lang('public.Create_Request')</h5>
                        <!-- General Form Elements -->
                        <form id="addnewrequest">
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">@lang('public.City_of_Departure')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="departure" id="departure">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">@lang('public.Delivery_City')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="delivery" id="delivery">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">@lang('public.Dimensions')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="dimensions" id="dimensions">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">@lang('public.Total_Weight')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="weight" id="weight">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">@lang('public.Shipping_cost')</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="cost" id="cost">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">@lang('public.User_Payment')</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="user_payment" id="user_payment">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">@lang('public.Deal_Name')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="deal_name" id="deal_name">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">@lang('public.Deal_Details')</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="shipping_describetion" id="shipping_describetion"></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">@lang('public.Status')</label>
                                <div class="col-sm-10">
                                    <select name="status" class="form-control" id="status">
                                        <option value="0">@lang('public.Under_Revision') </option>
                                        <option value="1">@lang('public.In_Way')</option>
                                        <option value="2">@lang('public.Shipping_Done')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">@lang('public.Delivery_Time')</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="delivery_time" id="delivery_time">
                                </div>
                            </div>
                            <!-- End General Form Elements -->
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">@lang('public.Addtion_Details')</h5>
                        <div class="row mb-3">
                            <label for="inputCustomer" class="col-sm-2 col-form-label">@lang('public.Customer_Email')</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputCustomer" list="customerOptions" name="customer_email">
                                <datalist id="customerOptions"></datalist>
                                <!-- Add a div to display customer options -->
                                <div id="customerOptionsDisplay"></div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">@lang('public.Customer_Name')</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="customer_name" id="customer_name">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputSupplier" class="col-sm-2 col-form-label">@lang('public.Supplier_Email')</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputSupplier" list="supplierOptions" name="supplier_email">
                                <datalist id="supplierOptions"></datalist>
                                <!-- Add a div to display supplier options -->
                                <div id="supplierOptionsDisplay"></div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">@lang('public.Supplier_Name')</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="supplier_name" id="supplier_name">
                            </div>
                        </div>
                        <div class="row mb-3">

                            <label for="inputAddress" class="col-sm-2 col-form-label">@lang('public.Customer_Address')</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" name="user_address" id="user_address">
                            </div>
                        </div>
                        <div class="row mb-3">
                            
                            <label for="inputEmail4" class="col-sm-2 col-form-label">@lang('public.Customer_Phone')</label>
                            <div class="col-sm-10">
                            <input type="text" name="phone" id="phone" class="form-control">
                            </div>
                        </div>
                       
                        <div class="row mb-3">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary" id="submitForm">@lang('public.Save')</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
        </div>
    </section>

</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
<script>
    $(document).ready(function() {
        // Event listener for form submission
        $("#submitForm").click(function(e) {
            e.preventDefault(); // Prevent form from submitting normally

            // Perform form validation before sending the data
            var errorFields = [];

            var customer_email = $("#inputCustomer").val().trim();
            var customer_name = $("#customer_name").val().trim();
            var supplier_email = $("#inputSupplier").val().trim();
            var supplier_name = $("#supplier_name").val().trim();

            if (!customer_email) {
                $('#inputCustomer').css('border-color', 'red');
                errorFields.push('@lang("public.Name")');
            } else {
                $('#inputCustomer').css('border-color', '');
            }
            if (!supplier_email) {
                $('#inputSupplier').css('border-color', 'red');
                errorFields.push('@lang("public.Name")');
            } else {
                $('#inputSupplier').css('border-color', '');
            }

            // Continue with AJAX request if there are no validation errors
            if (errorFields.length === 0) {
                // Get form data
                var formData = {
                    departure: $("#departure").val(),
                    delivery: $("#delivery").val(),
                    dimensions: $("#dimensions").val(),
                    weight: $("#weight").val(),
                    cost: $("#cost").val(),
                    user_payment: $("#user_payment").val(),
                    deal_name: $("#deal_name").val(),
                    shipping_describetion: $("#shipping_describetion").val(),
                    status: $("#status").val(),
                    phone: $("#phone").val(),
                    user_address: $("#user_address").val(),
                    delivery_time: $("#delivery_time").val(),
                    customer_email: customer_email,
                    customer_name: customer_name,
                    supplier_email: supplier_email,
                    supplier_name: supplier_name
                };

                // Make the AJAX request
                $.ajax({
                    type: "POST",
                    url: "/admin/add/request",
                    data: formData,
                    success: function(response) {
                        if (response.error) {
                            var errorMessage = $('<div>').addClass('error-message').text(response.message);
                            $('body').append(errorMessage);
                            errorMessage.fadeIn(500).delay(3000).fadeOut(500, function() {
                                $(this).remove();
                            });
                        } else {
                            $('#addnewrequest')[0].reset();
                            var successMessage = $('<div>').addClass('success-message').text(response.message);
                            $('body').append(successMessage);
                            successMessage.fadeIn(500).delay(3000).fadeOut(500, function() {
                                $(this).remove();
                            });
                        }
                    },
                });
            }
        });
    });
</script>
@endsection