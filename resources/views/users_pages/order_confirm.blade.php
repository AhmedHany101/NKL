@extends('user_layout.layout')
@section('layout')
<style>
    .page {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        /* Add this line to stack the divs vertically */
        height: 80vh;
        background-repeat: no-repeat;
        background-size: cover;
        background-image: url('{{asset("public_user_front/assets/img/cta-bg.jpg")}}');

    }

    .center-container {

        width: 100%;
        padding: 40px;
        color: white;
        background: rgba(0, 0, 0, 0.9);
        box-sizing: border-box;
        box-shadow: 0 15px 25px rgba(0, 0, 0, .6);
        border-radius: 10px;
        /* Optional: Set the height of the container if you want it to take the full viewport height */
    }

    #trackingNumber {
        cursor: pointer;
    }

    #trackingNumber:hover::after {
        content: "@lang('public.Click_to_copy')";
        font-size: 20px;
        color: white;
        background-color: #900C3F;
        border: 2px solid #900C3F;
    }

    #successMessage {
        display: none;
        /* color: green;
        margin-top: 10px; */

    }
</style>
<main id="main" class="page">
    @if(session('error'))
    <div class="alert" id="errorMessage">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        {{session('error')}}
    </div>
    <script>
        // Show the error message
        document.getElementById('errorMessage').style.display = 'block';
        // Hide the error message after 5 seconds
        setTimeout(function() {
            document.getElementById('errorMessage').style.display = 'none';
        }, 5000);
    </script>
    @endif
    @if(session('success_message'))

    <div class="alert" id="suceesMessage">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        {{session('success_message')}}
    </div>
    <script>
        // Show the error message
        document.getElementById('suceesMessage').style.display = 'block';
        // Hide the error message after 5 seconds
        setTimeout(function() {
            document.getElementById('suceesMessage').style.display = 'none';
        }, 5000);
    </script>
    @endif
    <div class="center-container container ar">
        <div id="successMessage" class="alert alert-success"></div>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="#900C3F" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
            </svg>
        </div>
        <div>
            @if (app()->getLocale() === 'ar')
            <h5>تم إرسال طلبك إلى الإدارة وسوف يقوموا بمراجعته. وسوف يتصلون بك لتقديم معلومات حول تكلفة طلبك.</h5>
            <h5>من فضلك لا تنسى نسخ رقم تتبع طلبك</h5>
            <h5>@lang('public.Tracking_Number'): <span id="trackingNumber" style="color: #CFD632;">{{$tracking_no}}</span></h5>
            @else
            <h5>Your order has been sent to administration and they will be reviewing it. They will contact you to provide information about the cost of your order.</h5>
            <h5>Please do not forget to copy the tracking number of your order.</h5>
            <h5>@lang('public.Tracking_Number'): <span id="trackingNumber" style="color: #900C3F;">{{$tracking_no}}</span></h5>
            @endif
        </div>
    </div>
</main>

<script>
    const trackingNumberElement = document.getElementById('trackingNumber');
    const successMessageElement = document.getElementById('successMessage');

    trackingNumberElement.addEventListener('click', function() {
        const trackingNumber = trackingNumberElement.innerText;
        navigator.clipboard.writeText(trackingNumber)
            .then(() => {
                successMessageElement.textContent = '@lang("public.Tracking_Number_copied")';
                successMessageElement.style.display = 'block';
                setTimeout(() => {
                    successMessageElement.style.display = 'none';
                }, 2000);
            })
            .catch((error) => {
                console.error('Unable to copy tracking number:', error);
            });
    });
</script>
@endsection