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

    .edit-link {
        margin-left: 10px;
        margin-right: 10px;
    }
</style>
<main id="main" class="main">
    @if(session('success'))
    <div id="suceesMessage" class="alert alert-success" style="display:none;">{{session('success')}}</div>
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
        <h1>@lang('public.Shipping_Data')</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin/index')}}">@lang('public.Home')</a></li>
                <li class="breadcrumb-item">@lang('public.Shipping_Data')</li>
                <li class="breadcrumb-item active">@lang('public.Shipping_Details')</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile ar">
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-left">
                        <div class="social-links mt-2">
                            <h5 class="card-title">@lang('public.key01'): <span style="color: red;">{{$order_details->tracking_no}}</span></h5>
                            <input type="hidden" value="{{$order_details->tracking_no}}" name="tracking_no">

                            <div class="info-item">
                                <span class="label">@lang('public.City_of_Departure'):</span>
                                <span class="value">{{$order_details->departure}}</span>
                            </div>
                            <hr>
                            <div class="info-item">
                                <span class="label">@lang('public.Delivery_City'):</span>
                                <span class="value">{{$order_details->delivery}}</span>
                            </div>
                            <hr>
                            <div class="info-item">
                                <span class="label">@lang('public.Total_Weight'):</span>
                                <span class="value">{{$order_details->weight}}</span>
                            </div>
                            <hr>
                            <div class="info-item">
                                <span class="label">@lang('public.Dimensions'):</span>
                                <span class="value">{{$order_details->dimensions}}</span>
                            </div>
                            <hr>
                            <div class="info-item">
                                <span class="label">@lang('public.Customer_Name'):</span>
                                <span class="value">{{$order_details->name}}</span>
                            </div>
                            <hr>
                            <div class="info-item">
                                <span class="label">@lang('public.Email'):</span>
                                <span class="value">{{$order_details->email}}</span>
                            </div>
                            <hr>
                            <div class="info-item">
                                <span class="label">@lang('public.Phone')</span>
                                <span class="value">{{$order_details->phone}}</span>
                            </div>
                            <hr>

                            @if($order_details->message != "")
                            <div class="info-item">
                                <span class="label">@lang('public.Message'):</span>
                                <span class="value">{{$order_details->message}}</span>
                            </div>
                            <hr>
                            @endif

                            <p style="text-align: center;text-decoration: underline;color:#A61111">@lang('public.Addtion_Details')</p>
                            <div class="info-item">
                                <span class="label">@lang('public.Under_Revision'):</span>
                                @if($order_details->status == 0)
                                <span class="value">@lang('public.Status') </span>
                                <div class="spinner-border text-danger" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                @elseif($order_details->status == 1)

                                <span class="value">@lang('public.In_Way') <i class="bi bi-truck text-warning"></i> </span>
                                @elseif($order_details->status == 2)
                                <span class="value">@lang('public.Shipping_Done') <i class="bi bi-check-square-fill text-success"></i> </span>
                                @endif
                            </div>
                            <hr>
                            @if($order_details->user_address != "")
                            <div class="info-item">
                                <span class="label">@lang('public.User_Address'):</span>
                                <span class="value">{{$order_details->user_address}}</span>
                            </div>
                            <hr>
                            @endif

                            <div class="info-item">
                                <span class="label">@lang('public.Shipping_cost'):</span>
                                <span class="value">{{$order_details->cost}}</span>
                            </div>
                            <hr>
                            @if($order_details->user_payment !=0)
                            <div class="info-item">
                                <span class="label">@lang('public.User_Payment'):</span>
                                <span class="value">{{$order_details->user_payment}}</span>
                            </div>
                            <hr>
                            @endif
                            @if($order_details->Supplier != "")
                            <div class="info-item">
                                <span class="label">@lang('public.Supplier'):</span>
                                <span class="value">{{$order_details->Supplier}}</span>
                            </div>
                            <hr>
                            @endif
                            @if($order_details->shipping_describetion != "")
                            <div class="info-item">
                                <span class="label">@lang('public.Shipping_Describetion'):</span>
                                <span class="value">{{$order_details->shipping_describetion}}</span>
                            </div>
                            <hr>
                            @endif
                            <div class="info-item">
                                @php
                                $encrypted_id = Crypt::encryptString($order_details->user_id);
                                @endphp
                                @if(auth()->user()->customer_service=='1')
                                <a href="/admin/Send/Email/{{$encrypted_id}}" class="btn"><i class="bi bi-envelope-fill"></i></a>
                                <a href="/eyJpdiI6Im9ZdmdZZjlzTExsWE1MVGV0cnlyS0E9PSIsInZhbHVlIjoiZmpkMGdaNjdCbVdTSU9LeXZkNFpOdz09IiwibWFjIjoiZGRiMzQ4YWRlNzdiNzNiMDQzNzVmMTVjOTFiMTc1MmE0ODAzZDgyMzZmMGRlYjdiZTI3OGJlOGI5N2RlYzMyZiIsInRhZyI6IiJ9/Chat/{{$order_details->user_id}}" class="btn"><i class="bi bi-messenger"></i></a>
                                @endif
                            </div>
                            <hr>
                        </div>
                        @php
                        $user_id = auth()->user();
                        $encrypted_id = Crypt::encryptString($order_details->id);
                        @endphp
                        @if(auth()->user()->edite_shipping_oreders=='1')
                        <a href="/admin/edite/information/{{$encrypted_id}}" class="btn btn-primary">@lang('public.Edite')</a>
                        @endif
                    </div>
                </div>
            </div>
            @if(auth()->user()->shipping_status=='1')
            <div class="col-xl-6 status_data">
                <div class="card">
                    <div class="card-body pt-3" id="status_data">
                        <button type="button" id="add_new" class="btn btn-primary" data-tracking_no="{{ $order_details->tracking_no }}" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        @lang('public.Add_New_Status')
                        </button>
                        @foreach($shipping_status->groupBy('date') as $date => $items)
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#{{$date}}">{{$date}}</button>

                            </li>
                        </ul>
                        <div class="tab-content pt-2">
                            <div class="tab-pane fade show active profile-overview" id="{{$date}}">
                                <p class="small fst-italic"></p>
                                <h5 class="card-title"></h5>
                                @forelse($items as $item)
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">@lang('public.Process')</div>
                                    <div class="col-lg-9 col-md-8">{{$item->process}}</div>
                                    <br>
                                    <div class="col-lg-3 col-md-4 label">@lang('public.Location')</div>
                                    <div class="col-lg-9 col-md-8">{{$item->location}}</div>
                                    <br>
                                    <div class="col-lg-3 col-md-4 label">@lang('public.Time')</div>
                                    <div class="col-lg-9 col-md-8">{{$item->time}}</div>
                                    <div>
                                        @php
                                        $encrypted_id = Crypt::encryptString($item->id);
                                        @endphp
                                        <!-- <button type="button" id="edite" class="btn btn-primary" data-tracking_no="{{ $order_details->tracking_no }}" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                                            Add New Status
                                        </button> -->
                                        <a href="" style="color: green;" id="edite" data-tracking_no="{{ $order_details->tracking_no }}" data-id="{{ $item->id }}" data-process="{{ $item->process }}" data-date="{{ $item->date }}" data-time="{{$item->time}}" data-location="{{$item->location}}" data-bs-toggle="modal" data-bs-target="#exampleModal2" class="edit-link"><i class="ri-edit-2-fill"></i> @lang('public.Edite')</a>
                                        <a href="/admin/Delete/status/{{$encrypted_id}}" class="btn" style="color: red;"> <i class="ri-delete-bin-6-fill"></i>@lang('public.Delete') </a>
                                    </div>
                                    <hr>
                                </div>
                                @empty
                                <div class="row">
                                    <div class="col-md-12">@lang('public.No_status_yet')</div>
                                </div>
                                @endforelse
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>

            </div>
            @endif
        </div>
    </section>

</main>
<!-- End #main -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">@lang('public.New_Status')</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="message-form">

                    <div class="mb-3">
                        <div id="error-message" class="text-danger"></div>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">@lang('public.Tracking_Number')</label>
                        <input type="text" class="form-control" readonly id="tracking_no" name="tracking_no">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">@lang('public.Location')<span style="color: red;">*</span></label>
                        <input type="text" class="form-control" id="up_id" name="location">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">@lang('public.Date')</label>
                        <input type="date" class="form-control" id="date" name="date">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">@lang('public.Time')</label>
                        <input type="time" class="form-control" id="time" name="time">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">@lang('public.Process')</label>
                        <textarea class="form-control" id="process" name="process"></textarea>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('public.Close')</button>
                <button type="submit" class="btn btn-primary">@lang('public.ADD')</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">@lang('public.Edite_Status')</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="Edite_form">

                    <div class="mb-3">
                        <div id="error-message2" class="text-danger"></div>
                    </div>
                    <div class="mb-3">
                        <input type="hidden" name="id" id="up_id2">
                        <label for="recipient-name" class="col-form-label">@lang('public.Tracking_Number')</label>
                        <input type="text" class="form-control" readonly id="tracking_no2" name="tracking_no">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">@lang('public.Location')<span style="color: red;">*</span></label>
                        <input type="text" class="form-control" id="location2" name="location">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">@lang('public.Date')</label>
                        <input type="date" class="form-control" id="date2" name="date">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">@lang('public.Time')</label>
                        <input type="time" class="form-control" id="time2" name="time">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">@lang('public.Process')</label>
                        <textarea class="form-control" id="process2" name="process"></textarea>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('public.Close')</button>
                <button type="submit" class="btn btn-primary">@lang('public.Edite')</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {
        $('#message-form').submit(function(event) {
            event.preventDefault(); // Prevent default form submission behavior

            var trackingNo = $('#tracking_no').val();
            var location = $('#up_id').val();
            var date = $('#date').val();
            var time = $('#time').val();
            var process = $('#process').val();

            // Perform validation
            if (trackingNo === '' || location === '' || date === '' || time === '' || process === '') {
                // Display error message
                $('#error-message').text('Please fill in all the required fields.');
                return;
            }
            // Clear any previous error messages
            $('#error-message').text('');

            // Send the form data to the backend using AJAX
            $.ajax({
                url: '/admin/add/shipping/status', // Replace with your actual backend endpoint URL
                type: 'POST',
                data: {
                    tracking_no: trackingNo,
                    location: location,
                    date: date,
                    time: time,
                    process: process
                },
                success: function(response) {
                    // Handle the response from the backend
                    $('#message-form')[0].reset();
                    $('#exampleModal').modal('hide');

                    var successMessage = $('<div>').addClass('success-message').text('Success');

                    $('body').append(successMessage);

                    successMessage.fadeIn(500).delay(1000).fadeOut(500, function() {
                        $(this).remove();
                        window.location.reload();
                    });
                },
                error: function(xhr) {
                    // Handle the error case
                    alert('Error sending data to the backend.');
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $(document).on('click', '#add_new', function() {
            // Get the tracking_no value from the data attribute
            let tracking_no = $(this).data('tracking_no');

            // Set the value in the form field
            $('#tracking_no').val(tracking_no);
        });
    });
</script>
<script>
    $(document).ready(function() {
        $(document).on('click', '#edite', function() {
            // Get the tracking_no value from the data attribute
            let trackingNo = $(this).data('tracking_no');
            let location = $(this).data('location');
            let time = $(this).data('time');
            let date = $(this).data('date');
            let id = $(this).data('id');
            let process = $(this).data('process');

            // Set the value in the form field
            $('#tracking_no2').val(trackingNo);
            $('#time2').val(time);
            $('#up_id2').val(id);
            $('#location2').val(location);
            $('#process2').val(process);
            $('#date2').val(date);
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
        $('#Edite_form').submit(function(event) {
            event.preventDefault(); // Prevent default form submission behavior

            var trackingNo = $('#tracking_no2').val();
            var location = $('#location2').val();
            var date = $('#date2').val();
            var time = $('#time2').val();
            var id = $('#up_id2').val();

            var process = $('#process2').val();

            // Perform validation
            if (trackingNo === '' || location === '' || date === '' || time === '' || process === '') {
                // Display error message
                $('#error-message2').text('Please fill in all the required fields.');
                return;
            }
            // Clear any previous error messages
            $('#error-message2').text('');

            // Send the form data to the backend using AJAX
            $.ajax({
                url: '/admin/edite/shipping/status', // Replace with your actual backend endpoint URL
                type: 'POST',
                data: {
                    tracking_no: trackingNo,
                    id: id,
                    location: location,
                    date: date,
                    time: time,
                    process: process
                },
                success: function(response) {
                    // Handle the response from the backend
                    $('#Edite_form')[0].reset();
                    $('#exampleModal2').modal('hide');

                    var successMessage = $('<div>').addClass('success-message').text('Success');

                    $('body').append(successMessage);

                    successMessage.fadeIn(500).delay(1000).fadeOut(500, function() {
                        $(this).remove();
                        window.location.reload();
                    });
                },
                error: function(xhr) {
                    // Handle the error case
                    alert('Error sending data to the backend.');
                }
            });
        });
    });
</script>
@endsection