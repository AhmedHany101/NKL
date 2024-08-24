@extends('user_layout.layout')
@section('layout')
<style>
    .pagination {
        display: flex;
        justify-content: center;
        color: #F8DE22;
        padding: 10px 0;
    }

    .pagination>* {
        margin: auto 5px;
    }

    .pagination .page-link {
        color: black;
        background-color: white;
    }

    .pagination .page-item.active .page-link {
        background-color: #F8DE22;
        color: white;
        border: 1px solid #F8DE22;
    }

    .search-form {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 30px;
    }

    .search-input {
        flex: 1;
        max-width: 300px;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #F8DE22;
        border-radius: 4px;
    }

    .search-button {
        margin-left: 10px;
        padding: 10px 20px;
        font-size: 16px;
        background-color: #F8DE22;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    @media (max-width: 600px) {
        .search-form {
            flex-direction: column;
            align-items: stretch;
        }

        .search-input {
            margin-bottom: 10px;
            max-width: none;
        }

        .search-button {
            margin-left: 0;
        }
    }
</style>
<main id="main">
    <div class="breadcrumbs">
        <div class="page-header d-flex align-items-center" style="background-image: url('../public_user_front/assets/img/head_back.jpg');">
            <div class="container position-relative">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6 text-center">
                        <h2>@lang('public.Suppliers')</h2>
                        <p>@lang('public.key0001').</p>
                    </div>
                </div>
            </div>
        </div>
        <nav>
            <div class="container">
                <ol>
                    <li><a href="{{url('/')}}">@lang('public.Home')</a></li>
                    <li>@lang('public.Suppliers')</li>
                </ol>
            </div>
        </nav>
    </div>
    <!-- ======= Our Team Section ======= -->
    <section id="team" class="team pt-0">

        <div class="container" data-aos="fade-up">


            <div class="section-header">
                <h2>Suppliers</h2>
            </div>
            <form action="{{ url('/search/supplier') }}" method="GET" class="search-form">
                <input type="text" id="myInput" name="search" class="search-input" placeholder="@lang('public.Search_for_Supplier')" title="Type in a name">
                <button type="submit" class="search-button">@lang('public.Search')</button>
            </form>

            <div class="row" data-aos="fade-up" data-aos-delay="100">
                @foreach($supplier as $item)
                @php
                $encrypted_id = Crypt::encryptString($item->id)
                @endphp
                <div class="col-lg-4 col-md-6 d-flex">
                    <div class="member">

                        @if($item->image == "")
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d8/Emblem-person-blue.svg/2048px-Emblem-person-blue.svg.png" class="img-fluid" alt="">
                        @else
                        <img src="{{asset('/suppliers_image/'.$item->image)}}" class="img-fluid" alt="">
                        @endif
                        <a href="/Supplier/Profile/{{$encrypted_id}}">
                            <div class="member-content">
                                @if (app()->getLocale() === 'ar')
                                @if($item->name_ar != "")
                                <h4>{{$item->name_ar}}</h4>
                                @else
                                <h4>{{$item->name}}</h4>
                                @endif
                                <span>
                                    @if($item->job_ar != "")
                                    {{$item->job_ar}}
                                    @else
                                    {{$item->job}}
                                    @endif
                                </span>
                                <p>
                                    @if($item->about_ar != "")
                                    {{$item->about_ar}}
                                    @else
                                    {{$item->about}}
                                    @endif
                                </p>
                                @else
                                <h4>{{$item->name}}</h4>
                                <span>{{$item->job}}</span>
                                <p>
                                    {{$item->about}}
                                </p>
                                @endif
                                <div class="social">
                                    <a href="{{$item->twitter_link}}"><i class="bi bi-twitter"></i></a>
                                    <a href="{{$item->facebook_link}}"><i class="bi bi-facebook"></i></a>
                                    <a href="{{$item->instagram_link}}"><i class="bi bi-instagram"></i></a>
                                    <a href="{{$item->linkedin_link}}"><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                @endforeach
                <!-- End Team Member -->
            </div>
            {!!$supplier->links()!!}
        </div>
    </section>
    <!-- End Our Team Section -->
</main>


@endsection