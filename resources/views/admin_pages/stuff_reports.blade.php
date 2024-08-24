@extends('admin_layout.layout')
@section('layout')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>@lang('public.')</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin/index')}}">@lang('public.Home')</a></li>
                <li class="breadcrumb-item">@lang('public.Staff')</li>
                <li class="breadcrumb-item active">@lang('public.Reports')</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body table-responsive">
                        <h5 class="card-title">@lang('public.stuff_data')</h5>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">@lang('public.Email')</th>
                                    <th scope="col">@lang('public.Role')</th>
                                    <th scope="col">@lang('public.Login_History')</th>
                                    <th scope="col">@lang('public.IP')</th>
                                    <th scope="col">@lang('public.Browser_OS')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($login_history as $item)
                                @php
                                $encrypted_id = Crypt::encryptString($item->id);
                                @endphp
                                <tr>
                                    <td>{{$item->user_email}}</td>
                                    <td>
                                        @if($item->user_status == '1!_1$')
                                            Support1
                                        @elseif($item->user_status == '@1$0S')
                                        Support2
                                        @endif
                                    </td>
                                    <td>{{$item->login_time}}</td>
                                    <td>{{$item->login_ip}}</td>
                                    <td>{{$item->login_agent}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main>
@endsection