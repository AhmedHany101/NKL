@extends('user_layout.layout')
@section('layout')
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: sans-serif;
        /* background: linear-gradient(#141e30, #243b55); */
        background-image: url('{{asset("public_user_front/assets/img/cta-bg.jpg")}}');
        background-repeat: no-repeat;
        background-size: cover;

    }


    .login-box {

        width: 400px;
        padding: 40px;
        margin-top: 70px;
        margin-bottom: 50px;
        height: auto;
      
        background: rgba(0, 0, 0, .7);
        box-sizing: border-box;
        box-shadow: 0 15px 25px rgba(0, 0, 0, .6);
        border-radius: 10px;
    }

    .login-box h2 {
        margin: 0 0 30px;
        padding: 0;
        color: #fff;
        text-align: center;
    }

    .login-box .user-box {
        position: relative;
    }
    section.contact {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    div.con {
        max-width: 400px;
        width: 100%;
    }

    .login-box .user-box input {
        width: 100%;
        padding: 10px 0;
        font-size: 16px;
        color: #fff;
        margin-bottom: 30px;
        border: none;
        border-bottom: 1px solid #fff;
        outline: none;
        background: transparent;
    }

    .login-box .user-box label {
        position: absolute;
        top: 0;
        left: 0;
        padding: 10px 0;
        font-size: 16px;
        color: #fff;
        pointer-events: none;
        transition: .5s;
    }

    .login-box .user-box input:focus~label,
    .login-box .user-box input:valid~label {
        top: -20px;
        left: 0;
        color: #900C3F;
        font-size: 12px;
    }

    .login-box form a {
        position: relative;
        display: inline-block;
        padding: 10px 20px;
        color: #900C3F;
        font-size: 16px;
        text-decoration: none;
        text-transform: uppercase;
        overflow: hidden;
        transition: .5s;
        margin-top: 40px;
        letter-spacing: 4px
    }

    .login-box a:hover {
        background: #900C3F;
        color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 5px #900C3F,
            0 0 25px #900C3F,
            0 0 50px #900C3F,
            0 0 100px #900C3F;
    }

    .login-box a span {
        position: absolute;
        display: block;
    }

    .login-box a span:nth-child(1) {
        top: 0;
        left: -100%;
        width: 100%;
        height: 2px;
        background: linear-gradient(90deg, transparent, #900C3F);
        animation: btn-anim1 1s linear infinite;
    }

    @keyframes btn-anim1 {
        0% {
            left: -100%;
        }

        50%,
        100% {
            left: 100%;
        }
    }

    .login-box a span:nth-child(2) {
        top: -100%;
        right: 0;
        width: 2px;
        height: 100%;
        background: linear-gradient(180deg, transparent, #900C3F);
        animation: btn-anim2 1s linear infinite;
        animation-delay: .25s
    }

    @keyframes btn-anim2 {
        0% {
            top: -100%;
        }

        50%,
        100% {
            top: 100%;
        }
    }

    .login-box a span:nth-child(3) {
        bottom: 0;
        right: -100%;
        width: 100%;
        height: 2px;
        background: linear-gradient(270deg, transparent, #900C3F);
        animation: btn-anim3 1s linear infinite;
        animation-delay: .5s
    }

    @keyframes btn-anim3 {
        0% {
            right: -100%;
        }

        50%,
        100% {
            right: 100%;
        }
    }

    .login-box a span:nth-child(4) {
        bottom: -100%;
        left: 0;
        width: 2px;
        height: 100%;
        background: linear-gradient(360deg, transparent, #900C3F);
        animation: btn-anim4 1s linear infinite;
        animation-delay: .75s
    }

    @keyframes btn-anim4 {
        0% {
            bottom: -100%;
        }

        50%,
        100% {
            bottom: 100%;
        }
    }
    @media (max-width: 767px) {
    .login-box {
        width: 100%;
        margin-left: auto;
        margin-right: auto;
    }
}
</style>
<main id="main">
    <section id="contact" class="contact" >
        <div class="container con" data-aos="fade-up" >

            <div class="login-box">
                <h2>@lang('public.Login')</h2>
                <form action="{{route('login')}}" method="post" id="signup-form">
                    @if(session('error'))
                    <div style="color:red;">{{session('error')}}</div>
                    @endif
                    @csrf

                    <div class="user-box">
                        <input type="text" name="email" required="" class="form-control">
                        <label>@lang('public.Email')</label>
                        <span style="color:red">
                            @error('email')
                            {{$message}}
                            @enderror
                        </span>
                    </div>
                    <div class="user-box">
                        <input type="password" name="password" required="">
                        <label>@lang('public.password')</label>
                        <span style="color:red">
                        @error('password')
                        {{$message}}
                        @enderror
                        </span>
                    </div>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('signup-form').submit();">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        @lang('public.Login')
                    </a>
 <a href="{{url('register')}}" style="color: white;">
                @lang('public.Register')
                </a>
                </form>
               
            </div>
        </div>
    </section>
</main>
@endsection