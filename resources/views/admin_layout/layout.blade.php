<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>NKL</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{asset('nkl_logo1_icon.png')}}" rel="icon">
    <link href="{{asset('nkl_logo1_icon.png')}}" rel="apple-touch-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{asset('public_admin_front/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public_admin_front/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('public_admin_front/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('public_admin_front/assets/vendor/quill/quill.snow.css')}}" rel="stylesheet">
    <link href="{{asset('public_admin_front/assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
    <link href="{{asset('public_admin_front/assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
    <link href="{{asset('public_admin_front/assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Template Main CSS File -->
    <link href="{{asset('public_admin_front/assets/css/style.css')}}" rel="stylesheet">

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
    </style>
    @if (app()->getLocale() === 'ar')
    <style>
        .ar {
            direction: rtl;
            text-align: right;
        }
    </style>
    @endif
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="{{url('/admin/index')}}" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">NKL</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <div class="search-bar">
            <form class="search-form d-flex align-items-center" method="get" action="{{url('admin/search')}}">
                <input type="text" name="query" placeholder="@lang('public.Search')" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>

        </div><!-- End Search Bar -->
        @if(session('not_found'))
        <div id="suceesMessage" class="alert alert-success" style="display:none;">{{session('not_found')}}</div>
        <script>
            // Show the error message
            document.getElementById('suceesMessage').style.display = 'block';
            // Hide the error message after 5 seconds
            setTimeout(function() {
                document.getElementById('suceesMessage').style.display = 'none';
            }, 2000);
        </script>
        @endif
        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->
                @if(auth()->user()->customer_service=='1' || auth()->user()->edite_shipping_oreders=='1' || auth()->user()->shipping_status=='1')
                <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-bell"></i>
                        <span class="badge bg-primary badge-number">{{ $shippingOrders_today->count() }}</span>
                    </a><!-- End Notification Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">

                        <li class="dropdown-header">
                            @lang('public.You_Have') {{ $shippingOrders_today->count() }} @lang('public.new_Orders')
                            <a href="{{url('/admin/index')}}/#today_shipping"><span class="badge rounded-pill bg-primary p-2 ms-2">@lang('public.View_all')</span></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        @foreach($shippingOrders_today as $item)
                        <a href="{{ url('admin/show/shipping/details', ['encrypted_id' => Crypt::encryptString($item->id)]) }}">
                            <li class="notification-item">
                                <i class="bi bi-info-circle text-primary"></i>
                                <div>
                                    <h4>{{$item->tracking_no}}</h4>
                                    <p>Customer:{{$item->name}}</p>
                                    <p>{{ $item->created_at->diffForHumans() }}</p>
                                </div>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>
                        </a>
                        @endforeach
                        <li class="dropdown-footer">
                            <a href="{{url('admin/Shipping/Orders')}}">@lang('public.View_all')</a>
                        </li>

                    </ul><!-- End Notification Dropdown Items -->

                </li><!-- End Notification Nav -->
                @endif
                <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-chat-left-text"></i>
                        <span class="badge bg-success badge-number">{{ count($new_messages) }} </span>
                    </a><!-- End Messages Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                        <li class="dropdown-header">
                            {{ count($new_messages) }} @lang('public.new_message') {{ count($new_messages) >= 1 ? 's' : '' }}
                            <!-- <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a> -->
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        @php
                        use Illuminate\Support\Str;
                        @endphp

                        @foreach($new_messages as $message)
                        <li class="message-item">
                            @php
                            $user = App\Models\User::find($message['from_id']);
                            $truncatedBody = Str::limit($message['body'], 50); // Limit the body to 50 characters
                            @endphp
                            <a href="{{ url('/eyJpdiI6Im9ZdmdZZjlzTExsWE1MVGV0cnlyS0E9PSIsInZhbHVlIjoiZmpkMGdaNjdCbVdTSU9LeXZkNFpOdz09IiwibWFjIjoiZGRiMzQ4YWRlNzdiNzNiMDQzNzVmMTVjOTFiMTc1MmE0ODAzZDgyMzZmMGRlYjdiZTI3OGJlOGI5N2RlYzMyZiIsInRhZyI6IiJ9/Chat', $message['from_id']) }}">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d8/Emblem-person-blue.svg/2048px-Emblem-person-blue.svg.png" alt="" class="rounded-circle">
                                <div>
                                    <p>{{$user->name}}</p>
                                    <p>{{$truncatedBody}}</p>
                                    <p>{{$message['created_at']->diffForHumans() }}</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        @endforeach


                    </ul><!-- End Messages Dropdown Items -->

                </li><!-- End Messages Nav -->

                <li class="nav-item dropdown pe-3">
                    @php
                    $user_name=auth()->user()->name;
                    $user_role_as=auth()->user()->role_as;
                    $admin=env('admin');
                    $admin2=env('admin2');
                    $admin3=env('admin3');
                    @endphp
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d8/Emblem-person-blue.svg/2048px-Emblem-person-blue.svg.png" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{$user_name}}</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">

                            <h6>
                                {{$user_name}}
                            </h6>
                            <span>
                                @if($user_role_as == $admin)
                                Admin
                                @elseif($user_role_as == $admin2)
                                Support1
                                @elseif($user_role_as == $admin3)
                                Support2
                                @endif
                            </span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        @php
                        $user_id=auth()->user()->id;
                        $encrypted_id = Crypt::encryptString($user_id);
                        @endphp
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="/admin/reports/Staff/details/{{$encrypted_id}}">
                                <i class="bi bi-person"></i>
                                <span>@lang('public.My_Profile')</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <select id="basic" class="form-control selectpicker show-tick form-control" onchange="location = this.value;">
                                <option value="/locale/en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>EN</option>
                                <option value="/locale/ar" {{ app()->getLocale() == 'ar' ? 'selected' : '' }}>AR</option>
                            </select>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{url('logout')}}">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>@lang('public.Logout')</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link " href="{{url('/admin/index')}}">
                    <i class="bi bi-grid"></i>
                    <span>@lang('public.Dashboard')</span>
                </a>
            </li><!-- End Dashboard Nav -->
            @if(auth()->user()->edite_shipping_oreders=='1' || auth()->user()->customer_service=='1' || auth()->user()->shipping_status=='1')
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{url('admin/Shipping/Orders')}}">
                    <i class="bi bi-truck"></i>
                    <span>@lang('public.Shippin_Orders')</span>
                </a>
            </li>
            @endif
            @if(auth()->user()->edite_shipping_oreders=='1' || auth()->user()->customer_service=='1')
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{url('admin/user/list')}}">
                    <i class="ri-account-pin-circle-fill"></i>
                    <span>@lang('public.Users')</span>
                </a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{url('admin/Emails')}}">
                    <i class="bi bi-envelope-fill"></i>
                    <span>@lang('public.Send_Email')</span>
                </a>
            </li>

            @if(auth()->user()->role_as==$admin1)
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{url('admin/Staff')}}">
                    <i class="ri-team-fill"></i>
                    <span>@lang('public.Staff')</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{url('admin/reports/Staff')}}">
                    <i class="bx bxs-report"></i>
                    <span>@lang('public.Staff_Report')</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{url('admin/reports/mails')}}">
                    <i class="ri-mail-settings-fill"></i>
                    <span>@lang('public.Mails_Report')</span>
                </a>
            </li>
            @endif
            @if(auth()->user()->supplier_deals=='1')
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{url('/admin/Suppliers/List')}}">
                    <i class="ri-team-line"></i>
                    <span>@lang('public.Suppliers')</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{url('/admin/Add/Request')}}">
                    <i class="bi bi-pencil-square"></i>
                    <span>@lang('public.Create_Request')</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{url('/admin/Suppliers/Requests')}}">
                    <i class="fa fa-handshake-o"></i>

                    <span>@lang('public.Suppliers_Deals')</span>
                </a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link collapsed" href="/eyJpdiI6Im9ZdmdZZjlzTExsWE1MVGV0cnlyS0E9PSIsInZhbHVlIjoiZmpkMGdaNjdCbVdTSU9LeXZkNFpOdz09IiwibWFjIjoiZGRiMzQ4YWRlNzdiNzNiMDQzNzVmMTVjOTFiMTc1MmE0ODAzZDgyMzZmMGRlYjdiZTI3OGJlOGI5N2RlYzMyZiIsInRhZyI6IiJ9/Chat">
                    <i class="bi bi-messenger"></i>
                    <span>@lang('public.Chat')</span>
                </a>
            </li>
            <!-- End Blank Page Nav -->
        </ul>

    </aside><!-- End Sidebar-->

    @yield("layout")

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>NKL</span></strong>. All Rights Reserved
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{asset('public_admin_front/assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{asset('public_admin_front/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('public_admin_front/assets/vendor/chart.js/chart.umd.js')}}"></script>
    <script src="{{asset('public_admin_front/assets/vendor/echarts/echarts.min.js')}}"></script>
    <script src="{{asset('public_admin_front/assets/vendor/quill/quill.min.js')}}"></script>
    <script src="{{asset('public_admin_front/assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
    <script src="{{asset('public_admin_front/assets/vendor/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('public_admin_front/assets/vendor/php-email-form/validate.js')}}"></script>
    <!-- Template Main JS File -->
    <script src="{{asset('public_admin_front/assets/js/main.js')}}"></script>

</body>