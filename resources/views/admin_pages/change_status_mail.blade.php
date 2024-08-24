@extends('admin_layout.layout')
@section('layout')
<style>
   .err-message {
        position: fixed;
        top: 10%;
        left: 0;
        width: 100%;
        background-color: red;
        color: white;
        font-weight: bold;
        text-align: center;
        padding: 10px;
        display: none;
    }
</style>
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
    <h1>Emails</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/admin/index')}}">Home</a></li>
          <li class="breadcrumb-item">Send</li>
          <li class="breadcrumb-item active">Email</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-8">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Send Email</h5>

              <form action="{{url('/admin/Send/new/email')}}" method="POST">
                @csrf
                <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Email to</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control"  name="email" value="{{$email}}" readonly>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Message</label>
                  <div class="col-sm-10">
                    <textarea name="message" class="form-control" required ></textarea>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">send</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- End Horizontal Form -->
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection