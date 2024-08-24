@extends('user_layout.layout')
@section('layout')
<style>
</style>
<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
    <div class="page-header d-flex align-items-center" style="background-image: url({{asset('/public_user_front/assets/img/head_back.jpg')}});">
            <div class="container position-relative">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6 text-center">
                        <h2 style="color: #900C3F;">@lang('public.Tracking_Number_Search_Results')</h2>
                        @if (app()->getLocale() === 'ar')
                        <p style="color: black;">فيما يلي نتائج البحث عن رقم التتبع الذي أدخلته. ابحث عن آخر التحديثات وحالة الشحنة الخاصة بك. إذا كانت لديك أية أسئلة أو كنت بحاجة إلى مزيد من المساعدة، فلا تتردد في الاتصال بفريق دعم العملاء لدينا. نحن هنا لمساعدتك في تتبع الحزمة الخاصة بك وتزويدك بالمعلومات التي تحتاجها.</p>
                        @else
                        <p style="color:black">Below are the search results for the tracking number you entered. Find the latest updates and status of your shipment. If you have any questions or need further assistance, please don't hesitate to contact our customer support team. We are here to help you track your package and provide you with the information you need.</p>
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
    @if(auth()->user()->role_as == "0")
    <section id="pricing" class="pricing">
        <div class="container" data-aos="fade-up">
            <div class="row gy-4 ar">
                <div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
                    <div class="pricing-item">
                        <div class="row">
                            <div class="col-9">
                                <div class="row">
                                    <h3>@lang('public.Tracking_Number_Search_Results') : {{$order->tracking_no}}</h3>
                                    <div class="col">
                                        <ul>
                                            <li><i class="bi bi-geo-alt-fill"></i>@lang('public.City_of_Departure'): {{$order->departure}}</li>
                                            <li><i class="bi bi-geo-alt-fill"></i>@lang('public.Delivery_City'): {{$order->delivery}}</li>
                                            <li><i class="fas fa-weight"></i>@lang('public.Total_Weight'): {{$order->weight}}</li>
                                            <li><i class="bi bi-rulers"></i>@lang('public.Dimensions'): {{$order->dimensions}}</li>
                                        </ul>
                                    </div>
                                    <div class="col">
                                        <ul>
                                            <li><i class="bi bi-file-text"></i>@lang('public.Your_Name'): {{$order->name}}</li>
                                            <li><i class="bi bi-envelope-fill"></i>@lang('public.Email'): {{$order->email}}</li>
                                            <li><i class="bi bi-telephone-fill"></i>@lang('public.Phone'): {{$order->phone}}</li>
                                            <li><i class="bi bi-truck"></i>@lang('public.Shipping_cost'): {{$order->cost}}</li>
                                            <li><i class="bi bi-clock-fill"></i>@lang('public.Delivery_Time'): {{$order->delivery_time}}</li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row gy-4 mt-5">
                <div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
                    <div class="pricing-item">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <h3>@lang('public.Tracking_Number') : {{$order->tracking_no}}</h3>
                                    <table class="table">
                                        <thead class="table-light">
                                            <tr>
                                                <th>@lang('public.Date')</th>
                                                <th>@lang('public.Process')</th>
                                                <th>@lang('public.Location')</th>
                                                <th>@lang('public.Time')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $uniqueDates = $shipping_status->unique('date');
                                            @endphp
                                            @foreach($uniqueDates as $date)
                                            <tr>
                                                <td rowspan="{{ $shipping_status->where('date', $date->date)->count() }}">{{$date->date}}</td>
                                                <td>{{$date->process}}</td>
                                                <td>{{$date->location}}</td>
                                                <td>{{$date->time}}</td>
                                            </tr>
                                            @foreach($shipping_status->where('date', $date->date)->skip(1) as $item)
                                            <tr>
                                                <td>{{$item->process}}</td>
                                                <td>{{$item->location}}</td>
                                                <td>{{$item->time}}</td>
                                            </tr>
                                            @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @elseif(auth()->user()->role_as == "Supplier$012!_1$")
    <section id="pricing" class="pricing">
        <div class="container" data-aos="fade-up">
            <div class="row gy-4">
                <div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
                    <div class="pricing-item">
                        <div class="row">
                            <div class="col-9">
                                <div class="row">
                                    <h3>@lang('public.Tracking_Number') : {{$order->tracking_no}}</h3>
                                    <div class="col">
                                        <ul>
                                            <li><i class="bi bi-geo-alt-fill"></i>@lang('public.City_of_Departure'): {{$order->departure}}</li>
                                            <li><i class="bi bi-geo-alt-fill"></i>@lang('public.Delivery_City'): {{$order->delivery}}</li>
                                            <li><i class="fas fa-weight"></i>@lang('public.Total_Weight'): {{$order->weight}}</li>
                                            <li><i class="bi bi-rulers"></i>@lang('public.Dimensions'): {{$order->dimensions}}</li>
                                        </ul>
                                    </div>
                                    <div class="col">
                                        <ul>
                                            <!-- <li><i class="bi bi-file-text"></i>Customer Name: {{$order->name}}</li>
                                            <li><i class="bi bi-envelope-fill"></i>Customer Email: {{$order->email}}</li>
                                            <li><i class="bi bi-telephone-fill"></i>Customer Phone: {{$order->phone}}</li> -->
                                            <!-- <li><i class="bi bi-telephone-fill"></i>Customer Phone: {{$order->phone}}</li> -->
                                            <li><i class="fa fa-handshake-o"></i>@lang('public.Deal_Name'): {{$order->deal_name}}</li>
                                            <li><i class="bi bi-clock-fill"></i>@lang('public.Delivery_Time'): {{$order->delivery_time}}</li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row gy-4 mt-5">
                <div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
                    <div class="pricing-item">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <h3>@lang('public.Tracking_Number') : {{$order->tracking_no}}</h3>
                                    <table class="table">
                                        <thead class="table-light">
                                            <tr>
                                                 <th>@lang('public.Date')</th>
                                                <th>@lang('public.Process')</th>
                                                <th>@lang('public.Location')</th>
                                                <th>@lang('public.Time')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $uniqueDates = $shipping_status->unique('date');
                                            @endphp
                                            @foreach($uniqueDates as $date)
                                            <tr>
                                                <td rowspan="{{ $shipping_status->where('date', $date->date)->count() }}">{{$date->date}}</td>
                                                <td>{{$date->process}}</td>
                                                <td>{{$date->location}}</td>
                                                <td>{{$date->time}}</td>
                                            </tr>
                                            @foreach($shipping_status->where('date', $date->date)->skip(1) as $item)
                                            <tr>
                                                <td>{{$item->process}}</td>
                                                <td>{{$item->location}}</td>
                                                <td>{{$item->time}}</td>
                                            </tr>
                                            @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
</main>
@endsection