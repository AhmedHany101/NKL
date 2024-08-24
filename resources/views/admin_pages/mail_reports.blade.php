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
        <h1></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin/index')}}">@lang('public.Home')</a></li>
                <li class="breadcrumb-item">@lang('public.Mails')</li>
                <li class="breadcrumb-item active">@lang('public.Reports')</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body table-responsive">
                        <h5 class="card-title">@lang('public.Mails')</h5>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">@lang('public.Receiver')</th>
                                    <th scope="col">@lang('public.Sender')</th>
                                    <th scope="col">@lang('public.Message')</th>
                                    <th scope="col">@lang('public.Date')</th>
                                    @if(auth()->user()->role_as=='1!_1$')
                                    <th scope="col">@lang('public.Delete')</th>
                                    @endif

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stuff_auth_report as $item)
                                @php
                                $encrypted_id = Crypt::encryptString($item->id);
                                $sender = '';
                                $receiver = '';
                                $message = $item->message;
                                $mail_id = $item->id; // Fix: Assign the mail ID here
                                $date = $item->created_at;
                                @endphp

                                @foreach($users as $user)
                                @if($item->sender_id == $user->id)
                                @php
                                $sender = $user->name;
                                @endphp
                                @elseif($item->receiver_id == $user->id)
                                @php
                                $receiver = $user->name;
                                @endphp
                                @endif
                                @endforeach
                                <tr>
                                    <td><a href="/admin/user/details/{{$encrypted_id}}">{{$receiver}}</a></td>
                                    <td>{{$sender}}</td>
                                    <td>{{$message}}</td>
                                    <td>{{$date}}</td>
                                    @if(auth()->user()->role_as=='1!_1$')
                                    <td><a href="/admin/delete/mail/{{$mail_id}}" class="badge bg-danger"><i class="ri-delete-bin-6-fill"></i>Delete</a></td>
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