@extends('user_layout.layout')
@section('layout')
<style>
    .div {
        width: 100%;
        height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .div div {
        text-align: center;
        margin: 0;
    }

    .profile-card {
        width: 100%;
        margin: 20px auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
        display: flex;
        flex-wrap: wrap;
    }

    .profile-image {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        margin-right: 20px;
        flex: 0 0 auto;
    }

    .profile-info {
        flex: 1 1 auto;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .profile-name {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .profile-details {
        font-size: 16px;
        margin-bottom: 10px;
    }

    .rating {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .rating-label {
        font-weight: bold;
        margin-right: 10px;
    }

    .star-rating {
        display: inline-block;
        color: orange;
    }

    .star-rating .fa {
        font-size: 24px;
        margin-right: 2px;
    }

    .deals-done {
        font-weight: bold;
    }

    .other-div {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        padding-left: 30px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
        display: flex;
        flex-wrap: wrap;
    }

    .deal-list {
        list-style-type: disc;
        margin-left: 20px;
    }

    .container {
        display: flex;
        justify-content: space-between;
    }



    @media (max-width: 768px) {
        .container {
            flex-direction: column;
        }

        .profile-card,
        .other-div {
            width: 100%;
            margin-bottom: 20px;
            /* Add space between the divs on smaller screens */
        }
    }

    .profile-card {
        display: flex;
        align-items: center;
    }

    .profile-image {
        width: 200px;
        /* Adjust the width as needed */
        height: auto;
        margin-right: 20px;
        /* Adjust the margin as needed */
    }

    .profile-info {
        flex: 1;
    }

    .profile-details span {
        font-weight: bold;
    }

    #team {
        width: 100% !important;
    }

    .rating {
        margin-top: 10px;
        /* Adjust the margin as needed */
    }

    .star-rating {
        color: orange;
        /* Adjust the color as needed */
    }

    .deals-done {
        margin-top: 10px;
        /* Adjust the margin as needed */
    }
</style>

<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
        <div class="page-header d-flex align-items-center" style="background-image: url({{asset('/public_user_front/assets/img/head_back.jpg')}});">
            <div class="container position-relative">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6 text-center">
                        <h2>@lang('public.User_Profile')</h2>
                        @if (app()->getLocale() === 'ar')
                        <p style="color: black;">مرحبًا بك في ملف تعريف المستخدم الخاص بك! هنا، يمكنك إدارة إعدادات حسابك وتتبع شحناتك والوصول إلى حلول الشحن المخصصة</p>
                        @else
                        <p style="color: black;">Welcome to your user profile! Here, you can manage your account settings, track your shipments, and access personalized shipping solutions.</p>
                        @endif
                        @if(count($new_messages) > 0)
                        <li id="notification-li">
                            <a href="#new_message" id="notification-link">
                                <p>
                                    <div class="notifier new">
                                        <i class="bell fa fa-bell-o"></i>
                                        <div class="badge">{{ count($new_messages) }} @lang('public.new_message')</div>
                                    </div>
                                </p>
                            </a>
                            <div id="notification-messages" style="display: none;">
                                <!-- Messages content here -->
                            </div>
                        </li>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <nav>
            <div class="container">
                <ol>
                    <li><a href="{{url('/')}}">@lang('public.Home')</a></li>
                    <li>@lang('public.User_Profile')</li>
                </ol>
            </div>
        </nav>
    </div>
    <!-- End Breadcrumbs -->
    <h5 class="text-center" style="padding: 5px;">How People See You</h5>
    <section id="team" class="team pt-0" style="width: 100%;">

        <div class="container">

            <div class="profile-card">
                <!-- Supplier Profile Image -->
                <img class="profile-image" src="{{ asset('/suppliers_image/'.$supplier->image) }}" alt="Supplier Profile Image">
                <div class="profile-info ar">
                    @if (app()->getLocale() === 'ar')
                    <h1 class="profile-name">
                        @if($supplier->name_ar != "")
                        {{$supplier->name_ar}}
                        @else
                        {{$supplier->name}}
                        @endif
                    </h1>
                    <p class="profile-details"><span>الموقع:</span>
                        @if($supplier->country_ar != "")
                        {{$supplier->country_ar}}
                        @else
                        {{$supplier->country}}
                        @endif

                    </p>
                    <p class="profile-details"><span>الشركة:</span>
                        @if($supplier->company_ar != "")
                        {{$supplier->company_ar}}
                        @else
                        {{$supplier->company}}
                        @endif
                    </p>
                    <p class="profile-details"><span>المجال:</span>
                        @if($supplier->field_ar != "")
                        {{$supplier->field_ar}}
                        @else
                        {{$supplier->field}}
                        @endif

                    </p>
                    <p class="profile-details"><span>حول:</span>
                        @if($supplier->about_ar != "")
                        {{$supplier->about_ar}}
                        @else
                        {{$supplier->about}}
                        @endif

                    </p>
                    <p class="profile-details"><span>كود المورد:</span> {{ $supplier->supplier_number	 }}</p>
                    @else
                    <h1 class="profile-name">{{ $supplier->name }}</h1>
                    <p class="profile-details"><span>Location:</span> {{ $supplier->country }}</p>
                    <p class="profile-details"><span>Company:</span> {{ $supplier->company }}</p>
                    <p class="profile-details"><span>Field:</span> {{ $supplier->field }}</p>
                    <p class="profile-details"><span>About:</span> {{ $supplier->about }}</p>
                    <p class="profile-details"><span>Supplier Code:</span> {{ $supplier->supplier_number}}</p>
                    @endif

                    <!-- <p class="deals-done">Deals Done: {{ $supplier->deals_done }}</p> -->
                </div>
            </div>
        </div>
    </section>
    <section class="container">
        <div class="row div">
            <!-- <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="red" class="bi bi-person-gear img" viewBox="0 0 16 16">
                    <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm.256 7a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Zm3.63-4.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382l.045-.148ZM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z" />
                </svg>
                <p>{{ $user->name }}</p>
                <p>Email: {{ $user->email }}</p>

            </div> -->

            <div>
                <h5>Deals Information</h5>
                <div style="height: 300px; overflow-y: auto;">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">@lang('public.City_of_Departure')</th>
                                <th scope="col">@lang('public.Delivery_City')</th>
                                <th scope="col">@lang('public.Tracking_Number')</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                            $encrypted_id = 0;
                            @endphp
                            @foreach($orders as $item)
                            @php
                            $encrypted_id = Crypt::encryptString($item->id);
                            @endphp
                            <tr>
                                <th scope="row">
                                    <a href="/my/order/information/{{$encrypted_id}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#CFD632" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                        </svg>
                                    </a>
                                </th>
                                <td>{{$item->departure}}</td>
                                <td>{{$item->delivery}}</td>
                                <td>{{$item->tracking_no}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>
    <section class="container">
      
        @if(count($new_messages) > 0)
        <div class="row div" id="new_message">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="#CFD632" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                    <path d="M64 0C28.7 0 0 28.7 0 64V352c0 35.3 28.7 64 64 64h96v80c0 6.1 3.4 11.6 8.8 14.3s11.9 2.1 16.8-1.5L309.3 416H448c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64H64z" />
                </svg>
                <p>{{ count($new_messages) }} @lang('public.new_message')</p>

            </div>
            <div>
                <div style="height: 300px; overflow-y: auto;">
                    <table class="table">
                        <thead>
                            <!-- <tr>
                                <th scope="col">#</th>
                                <th scope="col">@lang('public.City_of_Departure')</th>
                                <th scope="col">@lang('public.Delivery_City')</th>
                                <th scope="col">@lang('public.Tracking_Number')</th>
                            </tr> -->
                        </thead>
                        <tbody>

                            @foreach($new_messages as $message)
                            @php
                            $user = App\Models\User::find($message['from_id']);
                            $truncatedBody = Str::limit($message['body'], 50); // Limit the body to 50 characters
                            @endphp
                            <tr>
                                <th><a href="{{ url('/eyJpdiI6Im9ZdmdZZjlzTExsWE1MVGV0cnlyS0E9PSIsInZhbHVlIjoiZmpkMGdaNjdCbVdTSU9LeXZkNFpOdz09IiwibWFjIjoiZGRiMzQ4YWRlNzdiNzNiMDQzNzVmMTVjOTFiMTc1MmE0ODAzZDgyMzZmMGRlYjdiZTI3OGJlOGI5N2RlYzMyZiIsInRhZyI6IiJ9/Chat', $message['from_id']) }}"><svg xmlns="http://www.w3.org/2000/svg" fill="#CFD632" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                            <path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z" />
                                        </svg></th>
                                <td> {{$user->name}}</a></td>
                                <td> {{$truncatedBody}}</td>
                                <td>{{$message['created_at']->diffForHumans() }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        @endif
    </section>


</main>
@endsection