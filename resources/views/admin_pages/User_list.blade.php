@extends('admin_layout.layout')
@section('layout')
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
    <div class="pagetitle">
        <h1>@lang('public.Users')</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin/index')}}">@lang('public.Home')</a></li>
                <li class="breadcrumb-item">@lang('public.User')</li>
                <li class="breadcrumb-item active">@lang('public.List')</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body table-responsive">
                        <h5 class="card-title">@lang('public.User_Data')</h5>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">@lang('public.Email')</th>
                                    <th scope="col">@lang('public.Name')</th>
                                    <th scope="col">@lang('public.shipping_requests')</th>
                                    @if(auth()->user()->customer_service=='1')
                                    <th scope="col">@lang('public.Chat')</th>
                                    <th scope="col">@lang('public.Delete')</th>
                                    @endif
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $item)
                                @php
                                $shipping_requests = 0;
                                @endphp
                                @foreach($shipping_requset as $item2)
                                @php
                                if ($item->id == $item2->user_id) {
                                $shipping_requests++;
                                }
                                @endphp
                                @endforeach
                                @php
                                    $encrypted_id = Crypt::encryptString($item->id);
                                    $random_number= Crypt::encryptString($item->id);
                                    @endphp
                                <tr>
                                   <td><a href="/admin/user/details/{{$encrypted_id}}">{{$item->code}}</a></td>

                                    <td><a href="/admin/user/details/{{$encrypted_id}}">{{$item->email}}</a></td>
                                    <td>{{$item->name}}</td>
                                    <td><a href="/admin/user/details/{{$encrypted_id}}/#profile">{{$shipping_requests}}</a></td>
                                    @if(auth()->user()->customer_service=='1')
                                    <td>
                                        <a href="/admin/Send/Email/{{$encrypted_id}}" class="btn"><i class="bi bi-envelope-fill" style="color: red;"></i></a>
                                        <a href="/eyJpdiI6Im9ZdmdZZjlzTExsWE1MVGV0cnlyS0E9PSIsInZhbHVlIjoiZmpkMGdaNjdCbVdTSU9LeXZkNFpOdz09IiwibWFjIjoiZGRiMzQ4YWRlNzdiNzNiMDQzNzVmMTVjOTFiMTc1MmE0ODAzZDgyMzZmMGRlYjdiZTI3OGJlOGI5N2RlYzMyZiIsInRhZyI6IiJ9/Chat/{{$item->id}}" class="btn"><i class="bi bi-messenger" style="color: blue;"></i></a>
                                    </td>
                                   
                                    <td><a href="/admin/delete/user/{{$encrypted_id}}" class="badge bg-danger"><i class="ri-delete-bin-6-fill"></i> @lang('public.Delete') </a></td>                      
                                    @endif
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