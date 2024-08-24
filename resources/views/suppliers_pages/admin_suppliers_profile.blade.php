@extends('admin_layout.layout')
@section('layout')
<main id="main" class="main">
    @if(session('error'))
    <div id="errorMessage" class="alert alert-danger">{{ session('error') }}</div>
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
    @if(session('success'))
    <div id="success" class="alert alert-success" style="display:none;">{{session('success')}}</div>
    <script>
        // Show the error message
        document.getElementById('success').style.display = 'block';
        // Hide the error message after 5 seconds
        setTimeout(function() {
            document.getElementById('success').style.display = 'none';
        }, 5000);
    </script>
    @endif
    <div class="pagetitle">
        <h1>@lang('public.Supplier_Details')</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin/index')}}">@lang('public.Home')</a></li>
                <li class="breadcrumb-item">@lang('public.Supplier')</li>
                <li class="breadcrumb-item active">@lang('public.Information')</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        @if($supplier_profile)
                        @if($supplier_profile->image == "")
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d8/Emblem-person-blue.svg/2048px-Emblem-person-blue.svg.png" alt="Profile" class="rounded-circle">
                        @else
                        <img src="{{asset('/suppliers_image/'.$supplier_profile->image)}}" alt="Profile" class="rounded-circle">
                        @endif
                        @endif
                        <h2>{{$supplier->name}}</h2>
                        <h3>Supplier</h3>
                        <div class="social-links mt-2">
                            @php
                            try {
                            $twitterLink = $supplier_profile->twitter_link ?? null;
                            $facebookLink = $supplier_profile->facebook_link ?? null;
                            $instagramLink = $supplier_profile->instagram_link ?? null;
                            $linkedinLink = $supplier_profile->linkedin_link ?? null;
                            } catch (Exception $e) {
                            // Display a custom error message or alternative content
                            echo '<span class="error-message">Error: Supplier profile data is invalid</span>';
                            }
                            @endphp
                            <a href="{{ $twitterLink }}" class="twitter"><i class="bi bi-twitter"></i></a>
                            <a href="{{ $facebookLink }}" class="facebook"><i class="bi bi-facebook"></i></a>
                            <a href="{{ $instagramLink }}" class="instagram"><i class="bi bi-instagram"></i></a>
                            <a href="{{ $linkedinLink }}" class="linkedin"><i class="bi bi-linkedin"></i></a>
                        </div>
                        @php
                        $encrypted_id = Crypt::encryptString($supplier_profile->user_id)
                        @endphp
                        <div class="social-links mt-2">
                            @if(auth()->user()->supplier_stauts == '1')
                            <a href="/admin/supplier/change/status/{{$encrypted_id}}" class="badge bg-info" onclick="return myFunction(event)"><i class="bi bi-person-add"></i> @lang('public.Change_Supplier')</a></h5>
                            @endif
                            <br>
                            <a href="/admin/Send/Email/{{$encrypted_id}}" class="btn"><i class="bi bi-envelope-fill" style="color: red;"></i></a>
                            <a href="/eyJpdiI6Im9ZdmdZZjlzTExsWE1MVGV0cnlyS0E9PSIsInZhbHVlIjoiZmpkMGdaNjdCbVdTSU9LeXZkNFpOdz09IiwibWFjIjoiZGRiMzQ4YWRlNzdiNzNiMDQzNzVmMTVjOTFiMTc1MmE0ODAzZDgyMzZmMGRlYjdiZTI3OGJlOGI5N2RlYzMyZiIsInRhZyI6IiJ9/Chat/{{$supplier_profile->id}}" class="btn"><i class="bi bi-messenger" style="color: blue;"></i></a>

                        </div>
                    </div>
                </div>

            </div>

            <div class="col-xl-8 ">
                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered ar">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">@lang('public.Overview')</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">@lang('public.Edit_Profile')</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">@lang('public.Setting')</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2 ar">
                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">@lang('public.About')</h5>
                                <p class="small fst-italic">
                                    @if (app()->getLocale() === 'ar')
                                    @if($supplier_profile->about_ar != "")
                                    
                                    {{$supplier_profile->about_ar}}
                                    
                                    @else
                                    {{$supplier_profile->about}}
                                    @endif
                                    @else
                                    {{$supplier_profile->about}}
                                    @endif
                                </p>

                                <h5 class="card-title">@lang('public.Setting')</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">@lang('public.Full_Name')</div>
                                    <div class="col-lg-9 col-md-8">
                                        @if (app()->getLocale() === 'ar')
                                        @if($supplier_profile->name_ar != "")
                                        
                                        {{$supplier_profile->name_ar}}
                                        
                                        @else
                                        {{$supplier_profile->name}}
                                        @endif
                                        @else
                                        {{$supplier_profile->name}}
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">@lang('public.Company')</div>
                                    <div class="col-lg-9 col-md-8">
                                        @if (app()->getLocale() === 'ar')
                                        @if($supplier_profile->company_ar != "")
                                        
                                        {{$supplier_profile->company_ar}}
                                        
                                        @else
                                        {{$supplier_profile->company}}
                                        @endif
                                        @else
                                        {{$supplier_profile->company}}
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">@lang('public.Field')</div>
                                    <div class="col-lg-9 col-md-8">
                                        @if (app()->getLocale() === 'ar')
                                        @if($supplier_profile->field_ar != "")
                                        
                                        {{$supplier_profile->field_ar}}
                                        
                                        @else
                                        {{$supplier_profile->field}}
                                        @endif
                                        @else
                                        {{$supplier_profile->field}}
                                        @endif

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">@lang('public.Job')</div>
                                    <div class="col-lg-9 col-md-8">
                                        @if (app()->getLocale() === 'ar')
                                        @if($supplier_profile->job_ar != "")
                                        
                                        {{$supplier_profile->job_ar}}
                                        
                                        @else
                                        {{$supplier_profile->job}}
                                        @endif
                                        @else
                                        {{$supplier_profile->job}}
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">@lang('public.Country')</div>
                                    <div class="col-lg-9 col-md-8">
                                        @if (app()->getLocale() === 'ar')
                                        @if($supplier_profile->country_ar != "")
                                        
                                        {{$supplier_profile->country_ar}}
                                        
                                        @else
                                        {{$supplier_profile->country}}
                                        @endif
                                        @else
                                        {{$supplier_profile->country}}
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">@lang('public.Address')</div>
                                    <div class="col-lg-9 col-md-8">
                                        @if (app()->getLocale() === 'ar')
                                        @if($supplier_profile->address_ar != "")
                                        
                                        {{$supplier_profile->address_ar}}
                                    
                                        @else
                                        {{$supplier_profile->address}}
                                        @endif
                                        @else
                                        {{$supplier_profile->address}}
                                        @endif
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">@lang('public.Phone')</div>
                                    <div class="col-lg-9 col-md-8">
                                        {{$supplier_profile->phone}}</div>

                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">@lang('public.Email')</div>
                                    <div class="col-lg-9 col-md-8">
                                        {{$supplier_profile->email}}</div>
                                </div>
                            </div>
                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                <!-- Profile Edit Form -->
                                <form action="{{ route('change') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" value="{{$supplier_profile->id}}" name="id">
                                    <div class="row mb-3">
                                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">@lang('public.Profile_Image')</label>
                                        <div class="col-md-8 col-lg-9">
                                            @if($supplier_profile && !$supplier_profile->image)
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d8/Emblem-person-blue.svg/2048px-Emblem-person-blue.svg.png" alt="Profile">
                                            @else
                                            <img src="{{asset('/suppliers_image/'.$supplier_profile->image)}}" alt="Profile" class="rounded-circle">
                                            @endif
                                            <div class="pt-2">
                                                <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image" onclick="document.getElementById('profile-image-input').click(); return false;">
                                                    <i class="bi bi-upload"></i>
                                                </a>
                                                <input id="profile-image-input" type="file" name="image" style="display: none;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">@lang('public.Full_Name')</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" class="form-control" id="fullName" name="name" value="{{$supplier_profile->name}}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="about" class="col-md-4 col-lg-3 col-form-label">@lang('public.About')</label>
                                        <div class="col-md-8 col-lg-9">
                                            <textarea class="form-control" id="about" style="height: 100px" name="about">{{$supplier_profile->about}}</textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="company" class="col-md-4 col-lg-3 col-form-label">@lang('public.Company')</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" class="form-control" id="company" value="{{$supplier_profile->company}}" name="company">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="company" class="col-md-4 col-lg-3 col-form-label">@lang('public.Field')</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" class="form-control" id="field" value="{{$supplier_profile->field}}" name="field">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Job" class="col-md-4 col-lg-3 col-form-label">@lang('public.Job')</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" class="form-control" id="Job" value="{{$supplier_profile->job}}" name="job">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Country" class="col-md-4 col-lg-3 col-form-label">@lang('public.Country')</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" class="form-control" id="Country" value="{{$supplier_profile->country}}" name="country">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Address" class="col-md-4 col-lg-3 col-form-label">@lang('public.Address')</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" class="form-control" id="Address" value="{{$supplier_profile->address}}" name="address">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Phone" class="col-md-4 col-lg-3 col-form-label">@lang('public.Phone')</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" class="form-control" id="Phone" value="{{$supplier_profile->phone}}" name="phone">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Email" class="col-md-4 col-lg-3 col-form-label">@lang('public.Email')</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="email" class="form-control" id="Email" value="{{$supplier_profile->email}}" name="email">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">@lang('public.Twitter_Profile')</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" class="form-control" id="Twitter" value="{{$supplier_profile->twitter_link}}" name="twitter_link">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">@lang('public.Facebook_Profile')</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" class="form-control" id="Facebook" value="{{$supplier_profile->facebook_link}}" name="facebook_link">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">@lang('public.Instagram_Profile')</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" class="form-control" id="Instagram" value="{{$supplier_profile->instagram_link}}" name="instagram_link">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">@lang('public.Linkedin_Profile')</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" class="form-control" id="Linkedin" value="{{$supplier_profile->linkedin_link}}" name="linkedin_link">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row mb-3">
                                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">@lang('public.Full_Name_Ar')</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" class="form-control" id="fullName_ar" name="name_ar" value="{{$supplier_profile->name_ar}}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="about" class="col-md-4 col-lg-3 col-form-label">@lang('public.About_Ar')</label>
                                        <div class="col-md-8 col-lg-9">
                                            <textarea class="form-control" id="about_ar" style="height: 100px" name="about_ar">{{$supplier_profile->about_ar}}</textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="company" class="col-md-4 col-lg-3 col-form-label">@lang('public.Company_Ar')</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" class="form-control" id="company_ar" value="{{$supplier_profile->company_ar}}" name="company_ar">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="company" class="col-md-4 col-lg-3 col-form-label">@lang('public.Field_Ar')</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" class="form-control" id="field_ar" value="{{$supplier_profile->field_ar}}" name="field_ar">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Job" class="col-md-4 col-lg-3 col-form-label">@lang('public.Job_Ar')</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" class="form-control" id="Job_ar" value="{{$supplier_profile->job_ar}}" name="job_ar">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Country" class="col-md-4 col-lg-3 col-form-label">@lang('public.Country_Ar')</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" class="form-control" id="Country" value="{{$supplier_profile->country_ar}}" name="country_ar">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Address" class="col-md-4 col-lg-3 col-form-label">@lang('public.Address_Ar')</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" class="form-control" id="Address_ar" value="{{$supplier_profile->address_ar}}" name="address_ar">
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">@lang('public.Save')</button>
                                    </div>
                            </div>
                            </form>
                            <!-- End Profile Edit Form -->
                        </div>

                        <div class="tab-pane fade pt-3" id="profile-settings">
                            <!-- Settings Form -->
                            <form action="{{url('admin/change/permissions/setting')}}" method="POST">
                                @csrf
                                @if($supplier->communication_role == 1)
                                <div class="row mb-3">
                                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">@lang('public.Prergations')</label>
                                    <div class="col-md-8 col-lg-9">
                                        <div class="form-check">
                                            <input type="hidden" name="id" id="id" value="{{$supplier->id}}">
                                            <input class="form-check-input" type="checkbox" id="changesMade" name="communication_role" checked>
                                            <label class="form-check-label" for="changesMade">
                                                @lang('public.key000001')
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="row mb-3">
                                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">@lang('public.Prergations')</label>
                                    <div class="col-md-8 col-lg-9">
                                        <div class="form-check">
                                            <input type="hidden" name="id" id="id" value="{{$supplier->id}}">
                                            <input class="form-check-input" type="checkbox" id="changesMade" name="communication_role">
                                            <label class="form-check-label" for="changesMade">
                                                @lang('public.key000001') </label>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">@lang('public.Save')</button>
                                </div>
                            </form><!-- End settings Form -->
                        </div>
                    </div>
                    <!-- End Bordered Tabs -->
                </div>
            </div>
        </div>
        </div>
    </section>
</main>
<script>
    function myFunction(event) {
        var confirmation = confirm("Are you sure you want to change the user account from supplier  to client?");
        if (!confirmation) {
            event.preventDefault(); // Stop the default action
        }
    }
</script>