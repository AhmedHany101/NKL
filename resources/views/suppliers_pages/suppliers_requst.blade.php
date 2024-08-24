@extends('admin_layout.layout')
@section('layout')
<style>
      .success-message {
        position: fixed;
        top: 10%;
        left: 0;
        width: 100%;
        background-color: green;
        color: white;
        font-weight: bold;
        text-align: center;
        padding: 10px;
        display: none;
    }
</style>
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
        <h1>@lang('public.Reports')</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin/index')}}">@lang('public.Home')</a></li>
                <li class="breadcrumb-item">@lang('public.Reports')</li>
                <li class="breadcrumb-item active">@lang('public.Deals_Information')</li>
            </ol>

        </nav>
        <nav style="width: 300px;">
            <form action="/admin/request/filter" method="get" style="display: flex;">
                <select class="form-control" name="quary">
                    <option value="">@lang('public.Status')</option>
                    <option value="0">@lang('public.Under_Revision')</option>
                    <option value="1">@lang('public.In_Way')</option>
                    <option value="2">@lang('public.Shipping_Done')</option>
                </select>
                <button type="submit" class="btn btn-primary">@lang('public.Filter')</button>
            </form>
        </nav>
    </div>
    <!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body table-responsive">
                        <h5 class="card-title">@lang('public.Deals_Information')</h5>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">@lang('public.Tracking_Number')</th>
                                    <th scope="col">@lang('public.Customer_Name')</th>
                                    <th scope="col">@lang('public.Supplier_Name')</th>
                                    <th scope="col">@lang('public.Phone')</th>
                                    <th scope="col">@lang('public.Status')</th>
                                    <th scope="col">@lang('public.Delete')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($shipping_orders as $item)
                                <tr>
                                    <th scope="row"><a href="{{ url('admin/show/shipping/details', ['encrypted_id' => Crypt::encryptString($item->id)]) }}">{{$item->tracking_no}}</a></th>
                                    <td><a href="{{ url('admin/show/shipping/details', ['encrypted_id' => Crypt::encryptString($item->id)]) }}">{{$item->name}}</a></td>
                                    <td><a href="{{ url('admin/show/shipping/details', ['encrypted_id' => Crypt::encryptString($item->id)]) }}">{{$item->Supplier}}</a></td>
                                    <td><a href="{{ url('admin/show/shipping/details', ['encrypted_id' => Crypt::encryptString($item->id)]) }}">{{$item->phone}}</a></td>
                                    <td><a href="{{ url('admin/show/shipping/details', ['encrypted_id' => Crypt::encryptString($item->id)]) }}">
                                            @if($item->status == 0)
                                            <span class="badge bg-danger"><i class="bi bi-arrow-clockwise me-1"></i>@lang('public.Under_Revision')</span>
                                            @elseif($item->status == 1)
                                            <span class="badge bg-warning text-dark"><i class="bi bi-truck me-1"></i>@lang('public.In_Way')</span>
                                            @elseif($item->status == 2)
                                            <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>@lang('public.Shipping_Done')</span>
                                            @endif
                                        </a>
                                    </td>
                                    <td><a class="badge bg-danger" href="{{ url('/admin/delete/shipping/order', ['encrypted_id' => Crypt::encryptString($item->id)]) }}"><i class="ri-delete-bin-6-fill"></i> @lang('public.Delete') </a></td>
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