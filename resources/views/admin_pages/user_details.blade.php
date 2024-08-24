@extends('admin_layout.layout')
@section('layout')
<main id="main" class="main" style="height: 80vh;">
    @if(session('error_message'))
    <div id="errorMessage" class="alert alert-danger">{{ session('error_message') }}</div>
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
    @if(session('success_message'))
    <div id="suceesMessage" class="alert alert-success" style="display:none;">{{session('success_message')}}</div>
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
        <h1>@lang('public.User_Data')</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin/index')}}">@lang('public.Home')</a></li>
                <li class="breadcrumb-item">@lang('public.User')</li>
                <li class="breadcrumb-item active">@lang('public.Information')</li>
            </ol>
        </nav>
    </div>
    @php
    $encrypted_id = Crypt::encryptString($User_info->id)
    @endphp
    <section class="section ar">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">@lang('public.User_Information') <a href="/admin/delete/user/{{$encrypted_id}}" class="badge bg-danger"><i class="ri-delete-bin-6-fill"></i>@lang('public.Delete_User') </a>
                            @if(auth()->user()->supplier_stauts == '1')
                            @if($User_info->role_as != 'Supplier$012!_1$')
                            <a href="/admin/change/status/{{$encrypted_id}}" onclick="return myFunction(event)" class="badge bg-info"><i class="bi bi-person-add"></i> @lang('public.Change_Status_Of_User')</a>
                        </h5>
                        @endif
                        @endif
                        @if(auth()->user()->role_as == '1!_1$')
                        <a href="/admin/change/to/support/{{$encrypted_id}}" onclick="return myFunction2(event)" class="badge bg-success"><i class="bi bi-person-add"></i>@lang('public.Change_Status_Of_User_To_Support')</a></h5>
                        @endif
                        <!-- Default Tabs -->
                        <ul class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">
                            <li class="nav-item flex-fill" role="presentation">
                                <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-justified" type="button" role="tab" aria-controls="home" aria-selected="true">@lang('public.Personal_Information') <i class="bi bi-file-earmark-person"></i></button>
                            </li>
                            <li class="nav-item flex-fill" role="presentation">
                                <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-justified" type="button" role="tab" aria-controls="profile" aria-selected="false">@lang('public.Shipping_Requests') <i class="bi bi-truck"></i></button>
                            </li>
                            <li class="nav-item flex-fill" role="presentation">
                                <button class="nav-link w-100" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-justified" type="button" role="tab" aria-controls="contact" aria-selected="false">@lang('public.Mails') <i class="bi bi-envelope-fill"></i></button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2" id="myTabjustifiedContent">
                            <div class="tab-pane fade show active" id="home-justified" role="tabpanel" aria-labelledby="home-tab">
                                <ul style="list-style: none;">
                                    <li><i class="bi bi-file-text"></i> @lang('public.Name'):{{$User_info->name}}</li>
                                    <li><i class="bi bi-envelope-fill"></i> @lang('public.Email'):{{$User_info->email}}</li>
                                    <li><i class="bi bi-telephone-fill"></i> @lang('public.Phone'):{{$User_info->phone}}</li>
                                    <li><i class="bi bi-geo-alt-fill"></i> @lang('public.Address'):{{$User_info->address}}</li>
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="profile-justified" role="tabpanel" aria-labelledby="profile-tab">
                                <ol>
                                    @foreach($shipping_data as $item)
                                    @php
                                    $user_id = auth()->user();
                                    $encrypted_id = Crypt::encryptString($item->id);
                                    @endphp
                                    <li> @lang('public.Tracking_Number'):<a href="/admin/show/shipping/details/{{$encrypted_id}}">{{$item->tracking_no}}</a></li>
                                    @endforeach
                                </ol>
                            </div>
                            <div class="tab-pane fade" id="contact-justified" role="tabpanel" aria-labelledby="contact-tab">
                                <ol>
                                    @foreach($mails as $item)
                                    <li>Message:{{$item->message}},<br>Tme Send:{{$item->created_at}}</li>
                                    @endforeach
                                </ol>
                            </div>
                        </div><!-- End Default Tabs -->
                    </div>
                </div>
            </div>

        </div>
    </section>
</main>
@if (app()->getLocale() === 'ar')
<script>
    function myFunction(event) {
        var confirmation = confirm("هل أنت متأكد أنك تريد تغيير حساب المستخدم من العميل إلى المورد؟");
        if (!confirmation) {
            event.preventDefault(); // Stop the default action
        }
    }

    function myFunction2(even) {
        var confirmation = confirm("هل أنت متأكد أنك تريد تغيير حساب المستخدم من العميل إلى الدعم؟");
        if (!confirmation) {
            event.preventDefault(); // Stop the default action
        }
    }
</script>
@else
<script>
    function myFunction(event) {
        var confirmation = confirm("Are you sure you want to change the user account from  client to supplier?");
        if (!confirmation) {
            event.preventDefault(); // Stop the default action
        }
    }

    function myFunction2(even) {
        var confirmation = confirm("Are you sure you want to change the user account from  client to support?");
        if (!confirmation) {
            event.preventDefault(); // Stop the default action
        }
    }
</script>
@endif
@endsection