@extends('admin_layout.layout')
@section('layout')
<main id="main" class="main">
    @if(session('error'))
    <div id="errorMessage" class="alert alert-danger">{{ session('error') }}</div>
    <script>
        // Show the error message
        document.getElementById('errorMessage').style.display = 'block';
        // Hide the error message after 5 seconds
        setTimeout(function() {
            document.getElementById('errorMessage').style.display = 'none';
        }, 5000);
        console.log('err');
    </script>
    @endif
    @if(session('success'))
    <div id="success" class="alert alert-success" style="display:none;">{{session('success')}}</div>
    <script>
        // Show the error message
        document.getElementById('success').style.display = 'block';
        // Hide the error message after 5 seconds
        setTimeout(function() {
            document.getElementById('success').style.display = 'none';
        }, 5000);
    </script>
    @endif
    <div class="pagetitle">
        <h1>@lang('public.stuff_Profile')</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin/index')}}">@lang('public.Home')</a></li>
                <li class="breadcrumb-item">@lang('public.Staff')</li>
                <li class="breadcrumb-item active">@lang('public.Profile')</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d8/Emblem-person-blue.svg/2048px-Emblem-person-blue.svg.png" alt="Profile" class="rounded-circle">
                        <h2>{{$User_info->name}}</h2>
                        <h3>{{$User_info->email}}</h3>
                        <!-- <h2>{{$User_info->name}}</h2> -->
                        <div class="social-links mt-2">
                            <!-- <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            @if(auth()->user()->role_as=='1!_1$')
                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">@lang('public.Overview')</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">@lang('public.Setting')</button>
                            </li>
                            @endif
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">@lang('public.Mails')</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2">
                            @if(auth()->user()->role_as=='1!_1$')
                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">About</h5>
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">@lang('public.Login_History')</th>
                                            <th scope="col">@lang('public.IP')</th>
                                            <th scope="col">@lang('public.Browser_OS')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($login_history as $item)
                                        <tr>
                                            <td>{{$item->login_time}}</td>
                                            <td>{{$item->login_ip}}</td>
                                            <td>{{$item->login_agent}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endif
                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                <h5 class="card-title">@lang('public.About')</h5>
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">@lang('public.Receiver')</th>
                                            <th scope="col">@lang('public.Message')</th>
                                            <th scope="col">@lang('public.Date')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($mails as $item)
                                        @php
                                        $encrypted_id = Crypt::encryptString($item->id);
                                        $sender = '';
                                        $receiver = '';
                                        $message = $item->message;
                                        $date = $item->created_at;
                                        @endphp

                                        @foreach($users as $user)
                                        @if($item->sender_id == $user->id)
                                        @php
                                        $sender = $user->name;
                                        @endphp
                                        @elseif($item->receiver_id == $user->id)
                                        @php
                                        $receiver = $user->name;
                                        @endphp
                                        @endif
                                        @endforeach

                                        <tr>
                                            <td>{{$receiver}}</td>
                                            <td>{{$message}}</td>
                                            <td>{{$date}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade pt-3" id="profile-settings">
                                <!-- Settings Form -->
                                <form action="{{url('admin/change/staff/Prergations/setting')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$User_info->id}}">
                                    <div class="row mb-3">
                                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">@lang('public.Prergations')</label>

                                        <div class="col-md-8 col-lg-9">
                                            @if($User_info->customer_service == 1)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="customer_service" id="customer_service" checked>
                                                <label class="form-check-label" for="changesMade">
                                                @lang('public.key001') 
                                                </label>
                                            </div>
                                            @else
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="customer_service" id="customer_service">
                                                <label class="form-check-label" for="changesMade">
                                                @lang('public.key001') 
                                                </label>
                                            </div>
                                            @endif
                                            @if($User_info->edite_shipping_oreders == 1)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="edite_shipping_oreders" id="edite_shipping_oreders" checked>
                                                <label class="form-check-label" for="changesMade">
                                                @lang('public.key002') 
                                                </label>
                                            </div>
                                            @else
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="edite_shipping_oreders" id="edite_shipping_oreders">
                                                <label class="form-check-label" for="changesMade">
                                                @lang('public.key002') 
                                                </label>
                                            </div>
                                            @endif
                                            @if($User_info->shipping_status == 1)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="shipping_status" id="shipping_status" checked>
                                                <label class="form-check-label" for="changesMade">
                                                @lang('public.key003')
                                                </label>
                                            </div>
                                            @else
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="shipping_status" id="shipping_status">
                                                <label class="form-check-label" for="changesMade">
                                                @lang('public.key003')  
                                                </label>
                                            </div>
                                            @endif
                                            @if($User_info->supplier_deals == 1)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="supplier_deals" id="supplier_deals" checked>
                                                <label class="form-check-label" for="changesMade">
                                                @lang('public.key004') 
                                                </label>
                                            </div>
                                            @else
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="supplier_deals" id="supplier_deals">
                                                <label class="form-check-label" for="changesMade">
                                                @lang('public.key004') 
                                                </label>
                                            </div>
                                            @endif
                                            @if($User_info->supplier_stauts == 1)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="supplier_stauts" id="supplier_stauts" checked>
                                                <label class="form-check-label" for="changesMade">
                                                @lang('public.key005') 
                                                </label>
                                            </div>
                                            @else
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="supplier_stauts" id="supplier_stauts">
                                                <label class="form-check-label" for="changesMade">
                                                @lang('public.key005') 
                                                </label>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">@lang('public.Save')</button>
                                    </div>
                                </form><!-- End settings Form -->
                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main @endsection