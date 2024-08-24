@extends('user_layout.layout')
@section('layout')
<style>
</style>
<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
    @if (app()->getLocale() === 'ar')
        <div class="page-header d-flex align-items-center" style="background-image: url('../public_user_front/assets/img/head_back.jpg');">
            <div class="container position-relative">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6 text-center">
                        <h2 style="color: #BF4900;">نتائج البحث عن رقم التتبع</h2>
                        <p style="color: black;">فيما يلي نتائج البحث عن رقم التتبع الذي أدخلته. ابحث عن آخر التحديثات وحالة الشحنة الخاصة بك. إذا كانت لديك أية أسئلة أو كنت بحاجة إلى مزيد من المساعدة، فلا تتردد في الاتصال بفريق دعم العملاء لدينا. نحن هنا لمساعدتك في تتبع الحزمة الخاصة بك وتزويدك بالمعلومات التي تحتاجها.</p>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="page-header d-flex align-items-center" style="background-image: url('../public_user_front/assets/img/head_back.jpg');">
            <div class="container position-relative">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6 text-center">
                        <h2 style="color: #BF4900;">Tracking Number Search Results</h2>
                        <p style="color: black;">Below are the search results for the tracking number you entered. Find the latest updates and status of your shipment. If you have any questions or need further assistance, please don't hesitate to contact our customer support team. We are here to help you track your package and provide you with the information you need.</p>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <nav>
        <div class="container ar">
                <ol>
                    <li><a href="{{url('/')}}">@lang('public.Home')</a></li>
                    <li>@lang('public.Ship_Now')</li>
                </ol>
            </div>
        </nav>
    </div>
    <section id="pricing" class="pricing">
        <div class="row gy-4 mt-5">
            <div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
                <div class="pricing-item">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                @if ($tracking_no_details)
                                <h3>Tracking Number: {{ $tracking_no_details->tracking_no }}</h3>
                                <!-- Other details -->
                                @else
                                <p>No tracking details found.</p>
                                @endif
                                <table class="table">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Date</th>
                                            <th>Process</th>
                                            <th>Location</th>
                                            <th>Time</th>
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
</main>
@endsection