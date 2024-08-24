<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>NkL</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{asset('nkl_logo1_icon.png')}}" rel="icon">
    <link href="{{asset('nkl_logo1_icon.png')}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{asset('public_user_front/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public_user_front/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('public_user_front/assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('public_user_front/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
    <link href="{{asset('public_user_front/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
    <link href="{{asset('public_user_front/assets/vendor/aos/aos.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Template Main CSS File -->
    <link href="{{asset('public_user_front/assets/css/main.css')}}" rel="stylesheet">

    <style>
        .notifier {
            position: relative;
            display: inline-block;
        }

        .bell {
            font-size: 26px;
            color: #FFF;
            transition: 0.3s;
        }

        .bell:hover {
            color: #EF476F;
        }

        .badge {
            position: absolute;
            top: -5px;
            left: 24px;
            padding: 0 5px;
            font-size: 16px;
            line-height: 22px;
            height: 22px;
            background: #EF476F;
            color: #FFF;
            border-radius: 11px;
            white-space: nowrap;
        }

        .notifier.green .badge {
            background: #06D6A0;
        }

        .notifier.green .bell:hover {
            color: #06D6A0;
        }

        .notifier.new .badge {
            animation: pulse 2s ease-out;
            animation-iteration-count: infinite;
        }

        @keyframes pulse {
            40% {
                transform: scale3d(1, 1, 1);
            }

            50% {
                transform: scale3d(1.3, 1.3, 1.3);
            }

            55% {
                transform: scale3d(1, 1, 1);
            }

            60% {
                transform: scale3d(1.3, 1.3, 1.3);
            }

            65% {
                transform: scale3d(1, 1, 1);
            }
        }

        #sy-whatshelp {
            right: 25px;
            bottom: 55px;
            position: fixed;
            z-index: 9999;
        }

        #sy-whatshelp a {
            position: relative;
        }

        #sy-whatshelp a.sywh-open-services {
            background-color: #129bf4;
            color: #fff;
            line-height: 55px;
            margin-top: 10px;
            border: none;
            cursor: pointer;
            font-size: 23px;
            width: 55px;
            height: 55px;
            text-align: center;
            box-shadow: 2px 2px 8px -3px #000;
            border-radius: 100%;
            -webkit-border-radius: 100%;
            -moz-border-radius: 100%;
            -ms-border-radius: 100%;
            display: inline-block;
        }

        #sy-whatshelp a.sywh-open-services i {
            line-height: 55px;
        }

        #sy-whatshelp a.sywh-open-services i.fa-times {
            display: none;
        }

        #sy-whatshelp .sywh-services {
            width: 55px;
            height: auto;
        }

        #sy-whatshelp .sywh-services a {
            display: none;
        }

        #sy-whatshelp .sywh-services a i {
            background-color: #129bf4;
            color: #fff;
            line-height: 55px;
            margin-top: 10px;
            border: none;
            cursor: pointer;
            font-size: 23px;
            width: 55px;
            height: 55px;
            text-align: center;
            box-shadow: 2px 2px 8px -3px #000;
            border-radius: 100%;
            -webkit-border-radius: 100%;
            -moz-border-radius: 100%;
            -ms-border-radius: 100%;
        }

        #sy-whatshelp .sywh-services a.email i {
            background-color: #b92b27;
        }

        #sy-whatshelp .sywh-services a.instagram i {
            background-color: #e4405f;
        }

        #sy-whatshelp .sywh-services a.messenger i {
            background-color: #0084ff;
        }

        #sy-whatshelp .sywh-services a.whatsapp i {
            background-color: #25d366;
        }

        #sy-whatshelp .sywh-services a.call i {
            background-color: #ff6600;
        }

        a[data-tooltip] {
            position: relative;
        }

        a[data-tooltip]::before,
        a[data-tooltip]::after {
            position: absolute;
            display: none;
            opacity: 0.85;
            transition: all 0.3s ease-in-out;
        }

        a[data-tooltip]::before {
            content: attr(data-tooltip);
            background: #000;
            color: #fff;
            font-size: 13px;
            padding: 7px 11px;
            border-radius: 5px;
            white-space: nowrap;
            text-decoration: none;
        }

        a[data-tooltip]::after {
            width: 0;
            height: 0;
            border: 6px solid transparent;
            content: "";
        }

        a[data-tooltip]:hover::before,
        a[data-tooltip]:hover::after {
            display: block;
        }

        a.sywh-open-services[data-tooltip]::before,
        a.sywh-open-services[data-tooltip]::after {
            display: block;
        }

        a.data-tooltip-hide[data-tooltip]::before,
        a.data-tooltip-hide[data-tooltip]::after {
            display: none !important;
        }

        a.sywh-open-services[data-tooltip][data-placement="left"]::before {
            top: 11px;
        }

        a[data-tooltip][data-placement="left"]::before {
            top: -4px;
            right: 100%;
            line-height: normal;
            margin-right: 10px;
        }

        a[data-tooltip][data-placement="left"]::after {
            border-left-color: #000;
            border-right: none;
            top: 50%;
            right: 100%;
            margin-top: -6px;
            margin-right: 4px;
        }

        a[data-tooltip][data-placement="right"]::before {
            top: -7px;
            left: 100%;
            line-height: normal;
            margin-left: 10px;
        }

        a[data-tooltip][data-placement="right"]::after {
            border-right-color: #000;
            border-left: none;
            top: 50%;
            left: 100%;
            margin-top: -6px;
            margin-left: 4px;
        }

        a[data-tooltip][data-placement="top"]::before {
            bottom: 100%;
            left: 0;
            margin-bottom: 10px;
        }

        a[data-tooltip][data-placement="top"]::after {
            border-top-color: #000;
            border-bottom: none;
            bottom: 100%;
            left: 10px;
            margin-bottom: 4px;
        }

        a[data-tooltip][data-placement="bottom"]::before {
            top: 100%;
            left: 0;
            margin-top: 10px;
        }

        a[data-tooltip][data-placement="bottom"]::after {
            border-bottom-color: #000;
            border-top: none;
            top: 100%;
            left: 10px;
            margin-top: 4px;
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
    <header id="header" class="header ar d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
            <a href="{{url('/')}}" class="logo d-flex align-items-center">
                <img src="{{asset('logo.png')}}" alt="logo">
            </a>
            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="{{url('/')}}" class="active">@lang('public.Home')</a></li>
                    <!-- <li><a href="{{url('/#features')}}">@lang('public.Features')</a></li> -->
                    <li><a href="{{url('/#about')}}">@lang('public.About')</a></li>
                    <!-- <li><a href="#service">Services</a></li> -->
                    <li><a href="{{url('shipping/form')}}">@lang('public.Ship_Now')</a></li>
                    <li><a href="{{url('/#call-to-action')}}">@lang('public.Contact')</a></li>
                    <li><a href="{{url('/Suppliers')}}">@lang('public.Suppliers')</a></li>
                    @guest
                    <li><a class="get-a-quote" href="{{url('signin')}}">@lang('public.Login')</a></li>
                    <li><a class="get-a-quote" href="{{url('register')}}">@lang('public.Register')</a></li>
                    @endguest
                    @auth
                    @php
                    $user_id = auth()->user();
                    $encrypted_id = Crypt::encryptString($user_id->id);
                    @endphp
                    @if(auth()->user()->role_as == "0")
                    <li>
                        <a href="/User/Profile/{{ $encrypted_id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                            </svg>
                        </a>
                    </li>
                  



                    @endif
                    @if(auth()->user()->role_as == "Supplier$012!_1$")
                    <li>
                        <a href="/My/Profile/{{ $encrypted_id }}">

                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                            </svg>
                        </a>
                    </li>
              
                    @endif
                    <li><a class="get-a-quote" href="{{url('logout')}}">@lang('public.Logout')</a></li>
                    @endauth
                    <li class="dropdown"><a href="#"><span style="color: white;">@lang('public.Languages')</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                        <ul>
                            <li @if (app()->getLocale() == 'en') class="selected" @endif>
                                <a href="{{ route('setLang', 'en') }}">EN</a>
                            </li>
                            <li @if (app()->getLocale() == 'ar') class="selected" @endif>
                                <a href="{{ route('setLang', 'ar') }}">AR</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- .navbar -->

        </div>
    </header><!-- End Header -->
    <!-- End Header -->

    <body>

        @php
        $id = session('id');
        $admin3=env('admin3');
        if (!$id) {
        $user = App\Models\User::where('role_as', $admin3)->where('customer_service',1)->inRandomOrder()->first();

        if ($user) {
        $id = $user->id;
        session(['id' => $id]);
        }
        }
        @endphp

        <div id="sy-whatshelp">
            <div class="sywh-services">
                <a href="/eyJpdiI6Im9ZdmdZZjlzTExsWE1MVGV0cnlyS0E9PSIsInZhbHVlIjoiZmpkMGdaNjdCbVdTSU9LeXZkNFpOdz09IiwibWFjIjoiZGRiMzQ4YWRlNzdiNzNiMDQzNzVmMTVjOTFiMTc1MmE0ODAzZDgyMzZmMGRlYjdiZTI3OGJlOGI5N2RlYzMyZiIsInRhZyI6IiJ9/Chat/{{$id}}" class="messenger" data-tooltip="Livechat" data-placement="left" target="_blank">
                    <i class="fa fa-comments"></i>
                </a>
                <a href="" class="whatsapp" data-tooltip="WhatsApp" data-placement="left" target="_blank">
                    <i class="fa-brands fa-whatsapp"></i>
                </a>
                <a href="{{url('/Contact')}}" class="call" data-tooltip="Mail" data-placement="left">
                    <i class="fa-solid fa-envelope"></i>
                </a>
            </div>
            <a class="sywh-open-services" data-tooltip="Contact Us" data-placement="left">
                <i class="fa fa-comments"></i>
                <i class="fa fa-times"></i>
            </a>
        </div>
        @yield("layout")
        <!-- ======= Footer ======= -->
        <footer id="footer" class="footer">
            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-5 col-md-12 footer-info">
                        <a href="index.html" class="logo d-flex align-items-center">
                            <span style="color: white;">NKL</span>
                        </a>
                        
                        @if (app()->getLocale() === 'ar')
                        <p>تأسست شركة NKL لتسهيل العمليات اللوجستية في التجارة الدولية بين البائعين والمشترين من مصر من خلال مجموعة من الخدمات القيمة التي تقدمها الشركة بكفاءة وفعالية لكلا الطرفين</p>
                        @else
                        <p>NKL was established to facilitate logistical operations in international trade between sellers and buyers from Egypt through a set of valuable services that the company provides efficiently and effectively to both parties.</p>
                        @endif
                        <div class="social-links d-flex mt-4">
                            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-6 footer-links">
                        <h4>@lang('public.Useful_Links')</h4>
                        <ul>
                            <li><a href="{{url('/')}}">@lang('public.Home')</a></li>
                            <li><a href="{{url('/#features')}}">@lang('public.About')</a></li>
                            <!-- <li><a href="{{url('/#features')}}">@lang('public.Features')</a></li> -->
                            <li><a href="{{url('/#call-to-action')}}">@lang('public.Contact')</a></li>
                            <li><a href="{{url('shipping/form')}}">@lang('public.Ship_Now')</a></li>
                            <li><a href="{{url('/Suppliers')}}">@lang('public.Suppliers')</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-6 footer-links">
                        <h4>@lang('public.Our_Services')</h4>
                        @if (app()->getLocale() === 'ar')
                        <ul>
                            <li><a href="{{url('/#service')}}">نقل البضائع بالشاحنات</a></li>
                            <li><a href="{{url('/#service')}}">تخليص جمركي</a></li>
                            <li><a href="{{url('/#service')}}">شحن بري</a></li>
                            <li><a href="{{url('/#service')}}">شحن بحري</a></li>
                            <li><a href="{{url('/#service')}}">شحن جوي</a></li>
                        </ul>
                        @else
                        <ul>
                            <li><a href="{{url('/#service')}}">Trucking</a></li>
                            <li><a href="{{url('/#service')}}">Customs Clearance</a></li>
                            <li><a href="{{url('/#service')}}">Road Freight </a></li>
                            <li><a href="{{url('/#service')}}">Ocean Freight </a></li>
                            <li><a href="{{url('/#service')}}">Air Freight</a></li>
                        </ul>
                        @endif
                    </div>
                    <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                        <h4>@lang('public.Contact_Us')</h4>
                        @if (app()->getLocale() === 'ar')
                        <p>
                            A108 Adam Street <br>
                            New York, NY 535022<br>
                            United States <br><br>
                            <strong>Phone:</strong> +1 5589 55488 55<br>
                            <strong>Email:</strong> info@example.com<br>
                        </p>
                        @else
                        <p>
                            A108 Adam Street <br>
                            New York, NY 535022<br>
                            United States <br><br>
                            <strong>Phone:</strong> +1 5589 55488 55<br>
                            <strong>Email:</strong> info@nkl.com.eg<br>
                        </p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="container mt-4">
                <div class="copyright">
                    &copy; Copyright <strong><span>NKL</span></strong>. All Rights Reserved
                </div>
               
            </div>

        </footer><!-- End Footer -->
        <!-- End Footer -->

        <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <div id="preloader"></div>

        <!-- Vendor JS Files -->
        <script src="{{asset('public_user_front/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('public_user_front/assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
        <script src="{{asset('public_user_front/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
        <script src="{{asset('public_user_front/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
        <script src="{{asset('public_user_front/assets/vendor/aos/aos.js')}}"></script>
        <script src="{{asset('public_user_front/assets/vendor/php-email-form/validate.js')}}"></script>

        <!-- Template Main JS File -->
        <script src="{{asset('public_user_front/assets/js/main.js')}}"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <script>
            jQuery(function($) {
                $('a.sywh-open-services').click(function() {
                    if ($('.sywh-services').hasClass('active')) {
                        $('.sywh-services').removeClass('active');
                        $('a.sywh-open-services i.fa-times').hide();
                        $('a.sywh-open-services i.fa-comments').show();
                        $('a.sywh-open-services').removeClass('data-tooltip-hide');
                        $('.sywh-services a:nth-child(1)').delay(0).fadeOut();
                        $('.sywh-services a:nth-child(2)').delay(100).fadeOut();
                        $('.sywh-services a:nth-child(3)').delay(200).fadeOut();
                        $('.sywh-services a:nth-child(4)').delay(300).fadeOut();
                        $('.sywh-services a:nth-child(5)').delay(400).fadeOut();
                    } else {
                        $('.sywh-services').addClass('active');
                        $('a.sywh-open-services i.fa-comments').hide();
                        $('a.sywh-open-services i.fa-times').show();
                        $('a.sywh-open-services').addClass('data-tooltip-hide');
                        $('.sywh-services a:nth-child(5)').delay(0).fadeIn();
                        $('.sywh-services a:nth-child(4)').delay(100).fadeIn();
                        $('.sywh-services a:nth-child(3)').delay(200).fadeIn();
                        $('.sywh-services a:nth-child(2)').delay(300).fadeIn();
                        $('.sywh-services a:nth-child(1)').delay(400).fadeIn();
                    }
                });
            });
        </script>
    </body>

</html>