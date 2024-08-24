<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NKL</title>
    <link href="{{asset('nkl_logo1_icon.png')}}" rel="icon">
    <link href="{{asset('nkl_logo1_icon.png')}}" rel="apple-touch-icon">
    <style>
        html {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            /* background: linear-gradient(#141e30, #243b55); */
            background-image: url('{{asset("public_user_front/assets/img/cta-bg.jpg")}}');
            background-repeat: no-repeat;
            background-size: cover;

        }

        .logo {
            position: absolute;
            top: 20%;
            left: 48%;
        }

        .login-box {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 400px;
            padding: 40px;
            transform: translate(-50%, -50%);
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
    </style>
</head>

<body>
    <!-- <div class="logo">
        <h1 style="color:white;"><a href="{{url('/')}}" style="text-decoration: none;  color:#900C3F !important;">NKL</a></h1>
    </div> -->

    <div class="login-box">
        <h2>@lang('public.Verfiy_your_email')</h2>
        <form action="{{url('check/code')}}" method="post" id="signup-form">
            @if(session('error'))
            <div style="color:red;">{{session('error')}}</div>
            @endif
            @csrf

            <div class="user-box">
                <input type="text" name="code" required="">
                <label>@lang('public.Enter_Code')</label>
            </div>
            <a href="#" onclick="event.preventDefault(); document.getElementById('signup-form').submit();">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                @lang('public.confirm')
            </a>
        </form>

    </div>
</body>

</html>