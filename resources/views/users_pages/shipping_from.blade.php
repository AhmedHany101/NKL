@extends('user_layout.layout')
@section('layout')
<style>
  .btnsave:hover{
    background-color: #F8DE22 !important;
    font-weight: bolder;
    color: #900C3F !important;
  }
</style>
<main id="main">
  @if(session('error'))
  <div class="alert_danger" id="errorMessage">
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
  <!-- ======= Breadcrumbs ======= -->
  <div class="breadcrumbs">
    <div class="page-header d-flex align-items-center" style="background-image: url('../public_user_front/assets/img/page-header.jpg');">
      <div class="container position-relative">
        <div class="row d-flex justify-content-center">
          <div class="col-lg-6 text-center">
            <h2>@lang('public.Ship_Now')</h2>
            @if (app()->getLocale() === 'ar')
            <p>في شركة الشحن لدينا، نحن ملتزمون بتسليم البضائع الخاصة بك بأمان وكفاءة إلى وجهاتهم. مع سنوات من الخبرة وفريق متخصص، نحن نضمن خدمات شحن موثوقة وفي الوقت المناسب. مهمتنا هي توفير رضا العملاء الاستثنائي وتبسيط عملية الشحن للشركات والأفراد على حد سواء</p>
            @else
            <p>At our shipping company, we are committed to delivering your goods safely and efficiently to their destinations. With years of experience and a dedicated team, we ensure reliable and timely shipping services. Our mission is to provide exceptional customer satisfaction and streamline the shipping process for businesses and individuals alike</p>
          @endif
          </div>
        </div>
      </div>
    </div>
    <nav>
      <div class="container">
        <ol>
          <li><a href="{{url('/')}}">@lang('public.Home')</a></li>
          <li>@lang('public.Shipping')</li>
        </ol>
      </div>
    </nav>
  </div>
  <!-- End Breadcrumbs -->

  <!-- ======= Get a Quote Section ======= -->
  <section id="get-a-quote" class="get-a-quote">
    <div class="container" data-aos="fade-up">

      <div class="row g-0">

        <div class="col-lg-5 quote-bg" style="background-image: url(../public_user_front/assets/img/quote-bg.jpg);"></div>

        <div class="col-lg-7 ar">
          <form action="{{url('shipping')}}" method="post" class="shipping_form">
            @if($errors->any())
            <div class="alert_danger" id="errorMessage2">
              <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
              <ul style="list-style: none;">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            <script>
              // Show the error message
              document.getElementById('errorMessage2').style.display = 'block';
              // Hide the error message after 5 seconds
              setTimeout(function() {
                document.getElementById('errorMessage2').style.display = 'none';
              }, 5000);
            </script>
            @endif
            @csrf
            <h3>@lang('public.Shipping_Form')</h3>
            @if (app()->getLocale() === 'ar')
                <p>
                املأ نموذج الشحن أدناه للحصول على عرض أسعار مخصص لشحنتك. تقديم التفاصيل اللازمة مثل المنشأ والوجهة وأبعاد الطرد والوزن. سيقوم فريقنا بمراجعة معلوماتك بعناية وسيزودك بسعر شحن تنافسي. نحن نسعى جاهدين لتقديم حلول شحن فعالة ومنخفضة التكلفة ومصممة خصيصًا لتلبية احتياجاتك الخاصة.
                </p>
            @else
            <p>
              Fill out the shipping form below to get a personalized quote for your shipment. Provide the necessary details such as origin, destination, package dimensions, and weight. Our team will carefully review your information and provide you with a competitive shipping rate. We strive to offer efficient and cost-effective shipping solutions tailored to your specific needs.
            </p>
            @endif
            <div class="row gy-4">
              <div class="col-md-6">
                <input type="text" name="departure" class="form-control" placeholder="@lang('public.City_of_Departure')" required>
              </div>

              <div class="col-md-6">
                <input type="text" name="delivery" class="form-control" placeholder="@lang('public.Delivery_City')" required>
              </div>

              <div class="col-md-6">
                <input type="text" name="weight" class="form-control" placeholder="@lang('public.Total_Weight')(kg)" required>
              </div>

              <div class="col-md-6">
                <input type="text" name="dimensions" class="form-control" placeholder="@lang('public.Dimensions') (cm)" required>
              </div>

              <div class="col-lg-12">
                <h4>@lang('public.Your_Personal_Details')</h4>
              </div>

              <div class="col-md-12">
                <input type="text" name="name" class="form-control" placeholder="@lang('public.Your_Name')" required>
              </div>

              <div class="col-md-12 ">
                <input type="email" class="form-control" name="email" placeholder="@lang('public.Your_Email')" required>
              </div>

              <div class="col-md-12">
                <input type="text" class="form-control" name="phone" placeholder="@lang('public.Phone')" required>
              </div>

              <div class="col-md-12">
                <textarea class="form-control" name="message" rows="6" placeholder="@lang('public.Message')"></textarea>
              </div>

              <button type="submit" class="btnsave">@lang('public.Send')</button>
            </div>

        </div>
        </form>
      </div><!-- End Quote Form -->

    </div>

    </div>
  </section><!-- End Get a Quote Section -->

</main><!-- End #main -->
@endsection