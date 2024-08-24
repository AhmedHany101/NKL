@extends('user_layout.layout')
@section('layout')
<style>
    /* CSS styles for the supplier profile page */


    /* CSS styles for the supplier profile page */

    .profile-card {
        width: 100%;
        margin: 20px auto;
        padding: 20px;
        border: 1px solid #F8DE22;
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
        border: 1px solid #F8DE22;
        border-radius: 5px;
        background-color: #f9f9f9;
        display: flex;
        flex-wrap: wrap;
    }

    .deal-list {
        list-style-type: disc;
        margin-left: 20px;
    }

    .con {
        display: flex;
        justify-content: space-between;
    }



    @media (max-width: 768px) {
        .con {
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
    <div class="breadcrumbs">
        <div class="page-header d-flex align-items-center" style="background-image: url('/public_user_front/assets/img/page-header.jpg');">
            <div class="container position-relative">
                <div class="row d-flex justify-content-center">
                    @if (app()->getLocale() === 'ar')
                    <div class="col-lg-6 text-center">
                        <h2>حول موردنا</h2>
                        <p>مرحبًا بك في صفحة موردنا! نحن فريق مكرس لتقديم خدمات وحلول استثنائية.</p>
                    </div>
                    @else
                    <div class="col-lg-6 text-center">
                        <h2>About Our Supplier</h2>
                        <p>Welcome to our supplier page! We are a team dedicated to providing exceptional services and solutions.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <nav>
            <div class="container ar">
                <ol>
                    <li><a href="{{url('/')}}">@lang('public.Home')</a></li>
                    <li>@lang('public.Suppliers')</li>
                </ol>
            </div>
        </nav>
    </div>
    <section id="team" class="team pt-0" style="width: 100%;">
        <div class="container con">
            <div class="profile-card">
                <!-- Supplier Profile Image -->
                @php
                $id = session('id');

                if (!$id) {
                $user = App\Models\User::where('role_as', '%2_1@s')->where('customer_service',1)->inRandomOrder()->first();

                if ($user) {
                $id = $user->id;
                session(['id' => $id]);
                }
                }
                @endphp
                @if($supplier->image == "")
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d8/Emblem-person-blue.svg/2048px-Emblem-person-blue.svg.png" class="profile-image" alt="">
                @else
                <img src="{{asset('/suppliers_image/'.$supplier->image)}}" class="profile-image" alt="">
                @endif
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
                    <div class="rating">
                        <div class="star-rating">
                            @if($supplier->communication_role == '1')
                            <!-- <a href="/eyJpdiI6Im9ZdmdZZjlzTExsWE1MVGV0cnlyS0E9PSIsInZhbHVlIjoiZmpkMGdaNjdCbVdTSU9LeXZkNFpOdz09IiwibWFjIjoiZGRiMzQ4YWRlNzdiNzNiMDQzNzVmMTVjOTFiMTc1MmE0ODAzZDgyMzZmMGRlYjdiZTI3OGJlOGI5N2RlYzMyZiIsInRhZyI6IiJ9/Chat/{{$supplier->user_id}}" class="btn"><i class="bi bi-messenger" style="color: blue;"></i></a> -->
                            <a href="/eyJpdiI6Im9ZdmdZZjlzTExsWE1MVGV0cnlyS0E9PSIsInZhbHVlIjoiZmpkMGdaNjdCbVdTSU9LeXZkNFpOdz09IiwibWFjIjoiZGRiMzQ4YWRlNzdiNzNiMDQzNzVmMTVjOTFiMTc1MmE0ODAzZDgyMzZmMGRlYjdiZTI3OGJlOGI5N2RlYzMyZiIsInRhZyI6IiJ9/Chat/{{$supplier->user_id}}" type="button" class="btn" style="background-color: #A61111;color:white"><i class="bi bi-messenger"></i> @lang('public.Chat_Direct_with_Supplier')</a>
                            @else
                            <a href="/eyJpdiI6Im9ZdmdZZjlzTExsWE1MVGV0cnlyS0E9PSIsInZhbHVlIjoiZmpkMGdaNjdCbVdTSU9LeXZkNFpOdz09IiwibWFjIjoiZGRiMzQ4YWRlNzdiNzNiMDQzNzVmMTVjOTFiMTc1MmE0ODAzZDgyMzZmMGRlYjdiZTI3OGJlOGI5N2RlYzMyZiIsInRhZyI6IiJ9/Chat/{{$id}}" type="button" class="btn btn-primary"><i class="bi bi-messenger"></i> @lang('public.support')</a>
                            @endif
                        </div>
                    </div>
                    <!-- <p class="deals-done">Deals Done: {{ $supplier->deals_done }}</p> -->
                </div>
            </div>
        </div>
    </section>
</main>
@endsection