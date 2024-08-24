@extends('user_layout.layout')
@section('layout')
<style>
  .alert {
    position: fixed;
    top: 20px;
    right: 20px;
    padding: 20px;
    background-color: green;
    /* Red */
    color: white;
    margin-bottom: 15px;
    z-index: 9999999;
  }

  /* The close button */
  .closebtn {
    margin-left: 15px;
    color: white;
    font-weight: bold;
    float: right;
    font-size: 22px;
    line-height: 20px;
    cursor: pointer;
    transition: 0.3s;
  }

  /* When moving the mouse over the close button */
  .closebtn:hover {
    color: black;
  }

  .title {
    color: #CFD632;
  }

  .color_icon {
    color: #CFD632;
  }

  .boxshadow {
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    padding: 15px;
  }
</style>
@if(session('error'))
<div id="errorMessage2" class="alert_danger">{{ session('error') }}</div>
<script>
  // Show the error message
  document.getElementById('errorMessage2').style.display = 'block';
  // Hide the error message after 5 seconds
  setTimeout(function() {
    document.getElementById('errorMessage2').style.display = 'none';
  }, 5000);
  console.log('err');
</script>
@endif
@if(session('error_message'))
<div id="errorMessage" class="alert_danger">{{ session('error_message') }}</div>
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

<div class="alert" id="suceesMessage">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
  {{session('success_message')}}
</div>
<!-- <div class="alert alert-primary alert-dismissable fade in" id="suceesMessage"> <button type="button" data-dismiss="alert" aria-label="close" class="close"><span aria-hidden="true">×</span></button><strong>Well done!</strong> </div> -->
<!-- <div id="suceesMessage" class="alert alert-success" style="display:none;"></div> -->
<script>
  // Show the error message
  document.getElementById('suceesMessage').style.display = 'block';
  // Hide the error message after 5 seconds
  setTimeout(function() {
    document.getElementById('suceesMessage').style.display = 'none';
  }, 5000);
</script>
@endif
@if (app()->getLocale() === 'ar')
<style>
  .ar {
    direction: rtl;
  }
</style>
@endif
<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center" style="height: 60vh;">
  <div class="container">
    <div class="row gy-4 d-flex justify-content-between">
      <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
        <!-- <h2 data-aos="fade-up">Your Reliable Export and Import Partner</h2>
        <p data-aos="fade-up" data-aos-delay="100">We provide fast and efficient services for your international trade
          needs. Our team of experts will guide you through the complexities of customs regulations and paperwork,
          ensuring that your shipments arrive at their destination on time and in good condition. Contact us today to
          experience hassle-free exports and imports.</p> -->
        @if(session('error'))
        <div class="alert alert-success">{{session('error')}}</div>
        @endif
        <form action="{{ url('/tracking/Number') }}" method="GET" class="form-search d-flex align-items-stretch mb-3" data-aos="fade-up" data-aos-delay="200">
          <input type="text" class="form-control" name="tracking_number" placeholder="@lang('public.Tracking_Number')">
          <button type="submit" class="btn btn-primary">@lang('public.Search')</button>
        </form>
      </div>
      <!--<div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out">-->
      <!--  <img src="{{asset('nkl_logo2.png')}}" class="img-fluid mb-3 mb-lg-0" alt="">-->
      <!--</div>-->
    </div>
  </div>
</section>

<main id="main">
  <!-- ======= Featured Services Section ======= -->
  @if (app()->getLocale() === 'ar')
  <section id="featured-services" class="featured-services" style=" padding:80px 0 !important;">
    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 service-item d-flex boxshadow ar" data-aos="fade-up" style="box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);">
          <div class="icon flex-shrink-0" style="width: 40px; height: 40px; border-radius: 50%; border: 4px solid #F8DE22; display: flex; align-items: center; justify-content: center;">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#F8DE22" class="bi bi-eye" viewBox="0 0 16 16">
              <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
              <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
            </svg>
          </div>
          <div>
            <h4 class="title" style="color: #F8DE22;">الرؤية</h4>
            <p class="description" style="color: black;">تعمل الشركة على تعزيز التجارة الخارجية في مصر وتطوير الصادرات المصرية وربط شبكات اللوجستيات والعمل على تطوير سلاسل الإمداد من خلال الأساليب التكنولوجية والحلول اللوجستية الحديثة.</p>
          </div>
        </div>
        <!-- End Service Item -->
        <div class="col-lg-4 col-md-6 service-item d-flex boxshadow ar" data-aos="fade-up" data-aos-delay="100">
          <div class="icon flex-shrink-0" style="width: 40px; height: 40px; border-radius: 50%; border: 4px solid #F8DE22; display: flex; align-items: center; justify-content: center;"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#F8DE22" class="bi bi-rocket" viewBox="0 0 16 16">
              <path d="M8 8c.828 0 1.5-.895 1.5-2S8.828 4 8 4s-1.5.895-1.5 2S7.172 8 8 8Z" />
              <path d="M11.953 8.81c-.195-3.388-.968-5.507-1.777-6.819C9.707 1.233 9.23.751 8.857.454a3.495 3.495 0 0 0-.463-.315A2.19 2.19 0 0 0 8.25.064.546.546 0 0 0 8 0a.549.549 0 0 0-.266.073 2.312 2.312 0 0 0-.142.08 3.67 3.67 0 0 0-.459.33c-.37.308-.844.803-1.31 1.57-.805 1.322-1.577 3.433-1.774 6.756l-1.497 1.826-.004.005A2.5 2.5 0 0 0 2 12.202V15.5a.5.5 0 0 0 .9.3l1.125-1.5c.166-.222.42-.4.752-.57.214-.108.414-.192.625-.281l.198-.084c.7.428 1.55.635 2.4.635.85 0 1.7-.207 2.4-.635.067.03.132.056.196.083.213.09.413.174.627.282.332.17.586.348.752.57l1.125 1.5a.5.5 0 0 0 .9-.3v-3.298a2.5 2.5 0 0 0-.548-1.562l-1.499-1.83ZM12 10.445v.055c0 .866-.284 1.585-.75 2.14.146.064.292.13.425.199.39.197.8.46 1.1.86L13 14v-1.798a1.5 1.5 0 0 0-.327-.935L12 10.445ZM4.75 12.64C4.284 12.085 4 11.366 4 10.5v-.054l-.673.82a1.5 1.5 0 0 0-.327.936V14l.225-.3c.3-.4.71-.664 1.1-.861.133-.068.279-.135.425-.199ZM8.009 1.073c.063.04.14.094.226.163.284.226.683.621 1.09 1.28C10.137 3.836 11 6.237 11 10.5c0 .858-.374 1.48-.943 1.893C9.517 12.786 8.781 13 8 13c-.781 0-1.517-.214-2.057-.607C5.373 11.979 5 11.358 5 10.5c0-4.182.86-6.586 1.677-7.928.409-.67.81-1.082 1.096-1.32.09-.076.17-.135.236-.18Z" />
              <path d="M9.479 14.361c-.48.093-.98.139-1.479.139-.5 0-.999-.046-1.479-.139L7.6 15.8a.5.5 0 0 0 .8 0l1.079-1.439Z" />
            </svg></div>
          <div>
            <h4 class="title" style="color: #F8DE22;">المهمة</h4>
            <p class="description" style="color: black;">تأسست NKL لتسهيل العمليات اللوجستية في التجارة الدولية بين البائعين والمشترين من مصر من خلال مجموعة من الخدمات القيمة التي تقدمها الشركة بكفاءة وفعالية لكلا الطرفين.</p>
          </div>
        </div><!-- End Service Item -->
        <div class="col-lg-4 col-md-6 service-item d-flex boxshadow ar" data-aos="fade-up" data-aos-delay="200">
          <div class="icon flex-shrink-0" style="width: 40px; height: 40px; border-radius: 50%; border: 4px solid #F8DE22; display: flex; align-items: center; justify-content: center;"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#F8DE22" class="bi bi-shield-check" viewBox="0 0 16 16">
              <path d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453a7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625a11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692a1.54 1.54 0 0 1 1.044-1.262a62.456 62.456 0 0 1 2.887-.87z" />
              <path d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
            </svg></div>
          <div>
            <h4 class="title" style="color: #F8DE22;">القيم</h4>
            <p class="description" style="color: black;">تتميز شركتنا بالعمل الجماعي الفعال والمنافسة الهادفة وتعزيز علاقات العملاء.</p>
          </div>
        </div><!-- End Service Item -->
      </div>
    </div>
  </section>
  @else
  <section id="featured-services" class="featured-services" style=" padding:80px 0 !important;">
    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 service-item d-flex boxshadow ar" data-aos="fade-up">
          <div class="icon flex-shrink-0" style="width: 40px; height: 40px; border-radius: 50%; border: 4px solid #F8DE22; display: flex; align-items: center; justify-content: center;"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#F8DE22" class="bi bi-eye" viewBox="0 0 16 16">
              <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
              <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
            </svg></div>
          <div>
            <h4 class="title" style="color: #F8DE22;"> Vision</h4>
            <p class="description" style="color: black;">The company works to enhance foreign trade in Egypt, develop Egyptian exports, connect logistical networks, and work to develop supply chains through technological methods and modern logistical solutions.</p>
          </div>
        </div>
        <!-- End Service Item -->
        <div class="col-lg-4 col-md-6 service-item d-flex boxshadow ar" data-aos="fade-up" data-aos-delay="100">
          <div class="icon flex-shrink-0" style="width: 40px; height: 40px; border-radius: 50%; border: 4px solid #F8DE22; display: flex; align-items: center; justify-content: center;"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#F8DE22" class="bi bi-rocket" viewBox="0 0 16 16">
              <path d="M8 8c.828 0 1.5-.895 1.5-2S8.828 4 8 4s-1.5.895-1.5 2S7.172 8 8 8Z" />
              <path d="M11.953 8.81c-.195-3.388-.968-5.507-1.777-6.819C9.707 1.233 9.23.751 8.857.454a3.495 3.495 0 0 0-.463-.315A2.19 2.19 0 0 0 8.25.064.546.546 0 0 0 8 0a.549.549 0 0 0-.266.073 2.312 2.312 0 0 0-.142.08 3.67 3.67 0 0 0-.459.33c-.37.308-.844.803-1.31 1.57-.805 1.322-1.577 3.433-1.774 6.756l-1.497 1.826-.004.005A2.5 2.5 0 0 0 2 12.202V15.5a.5.5 0 0 0 .9.3l1.125-1.5c.166-.222.42-.4.752-.57.214-.108.414-.192.625-.281l.198-.084c.7.428 1.55.635 2.4.635.85 0 1.7-.207 2.4-.635.067.03.132.056.196.083.213.09.413.174.627.282.332.17.586.348.752.57l1.125 1.5a.5.5 0 0 0 .9-.3v-3.298a2.5 2.5 0 0 0-.548-1.562l-1.499-1.83ZM12 10.445v.055c0 .866-.284 1.585-.75 2.14.146.064.292.13.425.199.39.197.8.46 1.1.86L13 14v-1.798a1.5 1.5 0 0 0-.327-.935L12 10.445ZM4.75 12.64C4.284 12.085 4 11.366 4 10.5v-.054l-.673.82a1.5 1.5 0 0 0-.327.936V14l.225-.3c.3-.4.71-.664 1.1-.861.133-.068.279-.135.425-.199ZM8.009 1.073c.063.04.14.094.226.163.284.226.683.621 1.09 1.28C10.137 3.836 11 6.237 11 10.5c0 .858-.374 1.48-.943 1.893C9.517 12.786 8.781 13 8 13c-.781 0-1.517-.214-2.057-.607C5.373 11.979 5 11.358 5 10.5c0-4.182.86-6.586 1.677-7.928.409-.67.81-1.082 1.096-1.32.09-.076.17-.135.236-.18Z" />
              <path d="M9.479 14.361c-.48.093-.98.139-1.479.139-.5 0-.999-.046-1.479-.139L7.6 15.8a.5.5 0 0 0 .8 0l1.079-1.439Z" />
            </svg></div>
          <div>
            <h4 class="title" style="color: #F8DE22;"> Mision</h4>
            <p class="description" style="color: black;">NKL was established to facilitate logistical operations in international trade between sellers and buyers from Egypt through a set of valuable services that the company provides efficiently and effectively to both parties.</p>
          </div>
        </div><!-- End Service Item -->
        <div class="col-lg-4 col-md-6 service-item d-flex boxshadow ar" data-aos="fade-up" data-aos-delay="200">
          <div class="icon flex-shrink-0" style="width: 40px; height: 40px; border-radius: 50%; border: 4px solid #F8DE22; display: flex; align-items: center; justify-content: center;"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#F8DE22" class="bi bi-shield-check" viewBox="0 0 16 16">
              <path d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453a7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625a11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692a1.54 1.54 0 0 1 1.044-1.262a62.456 62.456 0 0 1 2.887-.87z" />
              <path d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
            </svg></div>
          <div>
            <h4 class="title" style="color: #F8DE22;"> Values</h4>
            <p class="description" style="color: black;">Our company is characterized by effective teamwork, objective competition, and strengthening customer relationships.</p>
          </div>
        </div><!-- End Service Item -->
      </div>
    </div>
  </section>
  @endif
  <!-- End Featured Services Section -->

  <!-- ======= About Us Section ======= -->
  @if (app()->getLocale() === 'ar')
  <section id="about" class="about pt-0">
    <div class="container" data-aos="fade-up">
      <div class="row gy-4">

        <div class="col-lg-6 content order-last  order-lg-first boxshadow ar" style="text-align: center;">
          <h3 style="text-align: center;text-decoration: underline;color:#900C3F;">الخدمات </h3>
          <ul class="">
            <li data-aos="fade-up" data-aos-delay="100" style="display: flex; align-items: center;" class="boxshadow ar" onclick="toggleFAQ(this)">

              <i class="fa-solid fa-handshake-simple" style="color: #900C3F; display: inline-block; vertical-align: middle; font-size: 24px; line-height: 1; border: 4px solid #900C3F; border-radius: 50%; padding: 12px;"></i>
              <div onclick="toggleFAQ(this)">
                <h5 class="title" style="color: #900C3F; cursor: pointer;" onclick="toggleFAQ(this)">التعاقدات</h5>
              </div>
            </li>
            <li id="Contracting" style="display: none;">
              <ul>
                <li>
                  <p style="color:black">كل مشروع عظيم يبدأ بعقد. لدينا فريق عمل متخصص ومؤهل لإبرام العقود. نحن نعمل مع الاهتمام بالتفاصيل والمرونة في التفاوض.</p>
                </li>
              </ul>
            </li>


            <li data-aos="fade-up" data-aos-delay="200" style="display: flex; align-items: center;" class="boxshadow ar" onclick="toggleFAQ2(this)">
              <i class="bi bi-pencil" style="color:#900C3F; display: inline-block; vertical-align: middle; font-size: 24px; line-height: 1; border: 4px solid #900C3F; border-radius: 50%; padding: 12px;"></i>
              <div onclick="toggleFAQ2(this)">
                <h5 class="title" style="color: #900C3F; cursor: pointer;" onclick="toggleFAQ2(this)">الشحن</h5>
              </div>
            </li>
            <li id="Customized" style="display: none;">
              <ul>
                <li>
                  <p style="color: black;">نحن نضمن خدمات شحن سريعة وموثوقة لعملائنا، وتسليم طلباتهم بأمان وكفاءة. يقوم فريقنا المتخصص بإدارة الخدمات اللوجستية ويضمن تسليم منتجاتك في الوقت المناسب، مما يوفر تجربة شحن سلسة. نحن نعطي الأولوية لرضا العملاء من خلال تقديم حلول شحن موثوقة ومصممة خصيصًا لتلبية احتياجاتك الخاصة. ثق بنا للتعامل مع عملية الشحن، حتى تتمكن من التركيز على جوانب أخرى من عملك.</p>
                </li>
              </ul>
            </li>


            <li data-aos="fade-up" data-aos-delay="300" style="display: flex; align-items: center;" class="boxshadow ar" onclick="toggleFAQ3(this)">
              <i class="bi bi-lightbulb" style="color:#900C3F; display: inline-block; vertical-align: middle; font-size: 24px; line-height: 1; border: 4px solid #900C3F; border-radius: 50%; padding: 12px;"></i>
              <div onclick="toggleFAQ3(this)">
                <h5 class="title" style="color: #900C3F; cursor: pointer;" onclick="toggleFAQ3(this)">إستشارات</h5>
              </div>
            </li>
            <li id="Consulting" style="display: none;">
              <ul>
                <li>
                  <p style="color: black;">يقوم فريق الاستشارات اللوجستية لدينا بتقييم عمليات الشحن وسلسلة التوريد وتحسينها للتوصل إلى طرق لتوفير المال مع تحسين الإجراءات. في الأساس، يتأكدون من وصول منتجات شركتك إلى العملاء بكفاءة. يمكنهم أيضًا العمل على تطوير صناعة الشحن والخدمات اللوجستية، بما في ذلك التصنيع والتخزي .</p>
                </li>
              </ul>
            </li>


            <li data-aos="fade-up" data-aos-delay="300" style="display: flex; align-items: center;" class="boxshadow ar" onclick="toggleFAQ4(this)">
              <i class="bi bi-box-seam" style="color:#900C3F; display: inline-block; vertical-align: middle; font-size: 24px; line-height: 1; border: 4px solid #900C3F; border-radius: 50%; padding: 12px;"></i>
              <div onclick="toggleFAQ4(this)">
                <h5 class="title" style="color: #900C3F; cursor: pointer;" onclick="toggleFAQ4(this)">التعبئة والتغليف</h5>
              </div>
            </li>
            <li id="Packaging" style="display: none;">
              <ul>
                <li>
                  <p style="color: black;">نحن نقدم حلولاً جديدة في تغليف المنتجات بطريقة فعالة وفعالة من حيث التكلفة وخالية من الأخطاء من خلال عمليات سلسلة التوريد المحسنة
                  </p>
                </li>
              </ul>
            </li>

            <li data-aos="fade-up" data-aos-delay="300" style="display: flex; align-items: center;" class="boxshadow ar" onclick="toggleFAQ5(this)">
              <i class="bi bi-truck" style="color:#900C3F; display: inline-block; vertical-align: middle; font-size: 24px; line-height: 1; border: 4px solid #900C3F; border-radius: 50%; padding: 12px;"></i>
              <div onclick="toggleFAQ5(this)">
                <h5 class="title" style="color: #900C3F; cursor: pointer;" onclick="toggleFAQ5(this)">سلسلة التوريد الفعالة</h5>
              </div>
            </li>
            <li id="Efficient" style="display: none;">
              <ul>
                <li>
                  <p style="color: black;"> نحن نساعدك على تشغيل سلسلة التوريد بسلاسة وضمان مستوى الخدمة لعملائك من خلال شبكة أعمال سلسلة التوريد الخاصة بنا
                  </p>
                </li>
              </ul>
            </li>

          </ul>
        </div>
        <div class="col-lg-6 position-relative align-self-start order-lg-last order-first">
          <img src="{{asset('vedio_back.jpg')}}" width="100%" height="100%" class="img-fluid" alt="">
          <!-- <a href="#" class="glightbox play-btn"></a> -->
        </div>
      </div>
    </div>
  </section>
  <script>
    function toggleFAQ() {
      var faqList = document.getElementById("Contracting");
      if (faqList.style.display === "none") {
        faqList.style.display = "block";
      } else {
        faqList.style.display = "none";
      }
    }

    function toggleFAQ2() {
      var faqList = document.getElementById("Customized");
      if (faqList.style.display === "none") {
        faqList.style.display = "block";
      } else {
        faqList.style.display = "none";
      }
    }

    function toggleFAQ3() {
      var faqList = document.getElementById("Consulting");
      if (faqList.style.display === "none") {
        faqList.style.display = "block";
      } else {
        faqList.style.display = "none";
      }
    }

    function toggleFAQ4() {
      var faqList = document.getElementById("Packaging");
      if (faqList.style.display === "none") {
        faqList.style.display = "block";
      } else {
        faqList.style.display = "none";
      }
    }

    function toggleFAQ5() {
      var faqList = document.getElementById("Efficient");
      if (faqList.style.display === "none") {
        faqList.style.display = "block";
      } else {
        faqList.style.display = "none";
      }
    }
  </script>

  @else
  <section id="about" class="about pt-0">
    <div class="container" data-aos="fade-up">
      <div class="row gy-4">
        <div class="col-lg-6 position-relative align-self-start order-lg-last order-first">
          <img src="{{asset('vedio_back.jpg')}}" width="100%" height="100vh" class="img-fluid" alt="">
          <!-- <a href="#" class="glightbox play-btn"></a> -->
        </div>
        <div class="col-lg-6 content order-last  order-lg-first boxshadow ar" style="text-align: center;">
          <h3 style="text-align: center;text-decoration: underline;color:#900C3F;">Services</h3>

          <ul class="">
            <li data-aos="fade-up" data-aos-delay="100" style="display: flex; align-items: center;" class="boxshadow ar" onclick="toggleFAQ(this)">
              <i class="fa-solid fa-handshake-simple" style="color: #900C3F; display: inline-block; vertical-align: middle; font-size: 24px; line-height: 1; border: 4px solid #900C3F; border-radius: 50%; padding: 12px;"></i>
              <div onclick="toggleFAQ(this)">
                <h5 class="title" style="color: #900C3F; cursor: pointer;" onclick="toggleFAQ(this)">Contracting</h5>
              </div>
            </li>
            <li id="Contracting" style="display: none;">
              <ul>
                <li>
                  <p style="color:black;">Every great project starts with a contract. We have a specialized and qualified team to conclude contracts. We work with attention to detail and flexibility in negotiation..</p>
                </li>
              </ul>
            </li>


            <li data-aos="fade-up" data-aos-delay="200" style="display: flex; align-items: center;" class="boxshadow ar" onclick="toggleFAQ2(this)">
              <i class="bi bi-pencil" style="color:#900C3F; display: inline-block; vertical-align: middle; font-size: 24px; line-height: 1; border: 4px solid #900C3F; border-radius: 50%; padding: 12px;"></i>
              <div onclick="toggleFAQ2(this)">
                <h5 class="title" style="color: #900C3F; cursor: pointer;" onclick="toggleFAQ2(this)">Shipping</h5>
              </div>
            </li>
            <li id="Customized" style="display: none;">
              <ul>
                <li>
                  <p style="color: black;">We ensure prompt and reliable shipping services to our customers, delivering their orders safely and efficiently. Our dedicated team manages the logistics and ensures timely delivery of your products, providing a seamless shipping experience. We prioritize customer satisfaction by offering reliable shipping solutions tailored to meet your specific needs. Trust us to handle the shipping process, so you can focus on other aspects of your business.</p>
                </li>
              </ul>
            </li>


            <li data-aos="fade-up" data-aos-delay="300" style="display: flex; align-items: center;" class="boxshadow ar" onclick="toggleFAQ3(this)">
              <i class="bi bi-lightbulb" style="color:#900C3F; display: inline-block; vertical-align: middle; font-size: 24px; line-height: 1; border: 4px solid #900C3F; border-radius: 50%; padding: 12px;"></i>
              <div onclick="toggleFAQ3(this)">
                <h5 class="title" style="color: #900C3F; cursor: pointer;" onclick="toggleFAQ3(this)">Consulting</h5>
              </div>
            </li>
            <li id="Consulting" style="display: none;">
              <ul>
                <li>
                  <p style="color: black;">Our logistics consulting team evaluates and optimizes shipping and supply chain operations to come up with ways to save money while improving procedures. Basically, they make sure that products from your company reach customers efficiently. They can also work on developing the shipping and logistics industry, including manufacturing, warehousing, distribution and transportation.</p>
                </li>
              </ul>
            </li>


            <li data-aos="fade-up" data-aos-delay="300" style="display: flex; align-items: center;" class="boxshadow ar" onclick="toggleFAQ4(this)">
              <i class="bi bi-box-seam" style="color:#900C3F; display: inline-block; vertical-align: middle; font-size: 24px; line-height: 1; border: 4px solid #900C3F; border-radius: 50%; padding: 12px;"></i>
              <div onclick="toggleFAQ4(this)">
                <h5 class="title" style="color: #900C3F; cursor: pointer;" onclick="toggleFAQ4(this)">Packaging</h5>
              </div>
            </li>
            <li id="Packaging" style="display: none;">
              <ul>
                <li>
                  <p style="color: black;">We provide new solutions in product packaging in an efficient, cost-effective and error-free manner through improved supply chain processes.</p>
                </li>
              </ul>
            </li>
            <li data-aos="fade-up" data-aos-delay="300" style="display: flex; align-items: center;" class="boxshadow ar" onclick="toggleFAQ5(this)">
              <i class="bi bi-truck" style="color:#900C3F; display: inline-block; vertical-align: middle; font-size: 24px; line-height: 1; border: 4px solid #900C3F; border-radius: 50%; padding: 12px;"></i>
              <div onclick="toggleFAQ5(this)">
                <h5 class="title" style="color: #900C3F; cursor: pointer;" onclick="toggleFAQ5(this)">Developed  Supply Chain</h5>
              </div>
            </li>
            <li id="Efficient" style="display: none;">
              <ul>
                <li>
                  <p style="color: black;">We help you run the supply chain smoothly and ensure the level of service for your customers through our supply chain business network.</p>
                </li>
              </ul>
            </li>

          </ul>
        </div>
      </div>
    </div>
  </section>
  <script>
    function toggleFAQ() {
      var faqList = document.getElementById("Contracting");
      if (faqList.style.display === "none") {
        faqList.style.display = "block";
      } else {
        faqList.style.display = "none";
      }
    }

    function toggleFAQ2() {
      var faqList = document.getElementById("Customized");
      if (faqList.style.display === "none") {
        faqList.style.display = "block";
      } else {
        faqList.style.display = "none";
      }
    }

    function toggleFAQ3() {
      var faqList = document.getElementById("Consulting");
      if (faqList.style.display === "none") {
        faqList.style.display = "block";
      } else {
        faqList.style.display = "none";
      }
    }

    function toggleFAQ4() {
      var faqList = document.getElementById("Packaging");
      if (faqList.style.display === "none") {
        faqList.style.display = "block";
      } else {
        faqList.style.display = "none";
      }
    }

    function toggleFAQ5() {
      var faqList = document.getElementById("Efficient");
      if (faqList.style.display === "none") {
        faqList.style.display = "block";
      } else {
        faqList.style.display = "none";
      }
    }
  </script>
  @endif
  <!-- End About Us Section -->

  <!-- ======= Services Section ======= -->
  @if (app()->getLocale() === 'ar')
  <section id="service" class="services pt-0" style="padding-bottom: 20px;">
    <div class="container" data-aos="fade-up">
      <div class="section-header">
        <span></span>
        <h2 style="color: #F8DE22;">شحنة البضائع</h2>
      </div>
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 ar" data-aos="fade-up" data-aos-delay="200">
          <div class="card">
            <div class="card-img">
              <img src="{{asset('public_user_front/assets/img/logistics-service.jpg')}}" alt="" class="img-fluid">
            </div>
            <h3><a href="#" class="stretched-link">التخليص الجمركي</a></h3>
            <p style="color: black;">تغطي خدمات التخليص الجمركي لدينا كل جانب من جوانب عملية التصدير والاستيراد، مما يضمن إجراءات جمركية وتوثيق وامتثال سلسة وفعالة.</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 ar" data-aos="fade-up" data-aos-delay="400">
          <div class="card">
            <div class="card-img">
              <img src="{{asset('public_user_front/assets/img/shipment.jpg')}}" alt="" class="img-fluid">
            </div>
            <h3><a href="service-details.html" class="stretched-link">النقل بالشاحنات</a></h3>
            <p style="color: black;">توفر خدمات النقل بالشاحنات لدينا نقلًا سلسًا لبضائعك المستوردة والمصدرة، من خلال أسطول من الشاحنات الحديثة والتي تتم صيانتها جيدًا.</p>
          </div>
        </div><!-- End Card Item -->
        <div class="col-lg-4 col-md-6 ar" data-aos="fade-up" data-aos-delay="500">
          <div class="card">
            <div class="card-img">
              <img src="{{asset('public_user_front/assets/img/trucking-service.jpg')}}" alt="" class="img-fluid">
            </div>
            <h3><a href="#" class="stretched-link">شحن بري</a></h3>
            <p style="color: black;">توفر خدمات الشحن البري لدينا حلول نقل موثوقة وفعالة للبضائع والبضائع، مما يضمن التسليم في الوقت المناسب وحلول لوجستية فعالة من حيث التكلفة.</p>
          </div>
        </div><!-- End Card Item -->

        <div class="col-lg-4 col-md-6 ar" data-aos="fade-up" data-aos-delay="600">
          <div class="card">
            <div class="card-img">
              <img src="{{asset('public_user_front/assets/img/Air.jpg')}}" alt="" class="img-fluid">
            </div>
            <h3><a href="#" class="stretched-link">الشحن الجوي</a></h3>
            <p style="color: black;">توفر خدمات الشحن الجوي لدينا حلول نقل سريعة وفعالة للبضائع والبضائع، مما يضمن التسليم السريع والخدمات اللوجستية الموثوقة للشحنات الحساسة للوقت.</p>

          </div>
        </div>
        <div class="col-lg-4 col-md-6 ar" data-aos="fade-up" data-aos-delay="600">
          <div class="card">
            <div class="card-img">
              <img src="{{asset('public_user_front/assets/img/oceanfreight.jpg')}}" alt="" class="img-fluid">
            </div>
            <h3><a href="#" class="stretched-link">الشحن البحري</a></h3>
            <p style="color: black;">تقدم خدمات الشحن البحري لدينا حلول شحن شاملة للبضائع والبضائع من خلال النقل البحري، مما يوفر خيارات لوجستية موثوقة وفعالة من حيث التكلفة للتجارة الدولية.</p>

          </div>
        </div>
        <!-- End Card Item -->
      </div>
    </div>
  </section>
  @else
  <section id="service" class="services pt-0" style="padding-bottom: 20px;">
    <div class="container" data-aos="fade-up">
      <div class="section-header">
        <span></span>
        <h2 style="color:#F8DE22;">Cargo Shipment</h2>
      </div>
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
          <div class="card">
            <div class="card-img">
              <img src="{{asset('public_user_front/assets/img/logistics-service.jpg')}}" alt="" class="img-fluid">
            </div>
            <h3><a href="{{url('/#f1')}}" class="stretched-link">Customs Clearance</a></h3>
            <p style="color: black;">Our Customs Clearance services cover every aspect of the export and import process, ensuring smooth and efficient customs procedures, documentation, and compliance.</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
          <div class="card">
            <div class="card-img">
              <img src="{{asset('public_user_front/assets/img/shipment.jpg')}}" alt="" class="img-fluid">
            </div>
            <h3><a href="{{url('/#f2')}}" class="stretched-link">Trucking</a></h3>
            <p style="color: black;">Our trucking services provide seamless transportation of your imported and exported goods, with a fleet of modern and well-maintained trucks.</p>
          </div>
        </div><!-- End Card Item -->
        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
          <div class="card">
            <div class="card-img">
              <img src="{{asset('public_user_front/assets/img/trucking-service.jpg')}}" alt="" class="img-fluid">
            </div>
            <h3><a href="{{url('/#f3')}}" class="stretched-link">Road Freight</a></h3>
            <p style="color: black;">Our Road Freight services provide reliable and efficient transportation solutions for goods and cargo, ensuring timely delivery and cost-effective logistics solutions.</p>
          </div>
        </div><!-- End Card Item -->

        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
          <div class="card">
            <div class="card-img">
              <img src="{{asset('public_user_front/assets/img/Air.jpg')}}" alt="" class="img-fluid">
            </div>
            <h3><a href="{{url('/#f4')}}" class="stretched-link">Air Freight</a></h3>
            <p style="color: black;">Our Air Freight services provide fast and efficient transportation solutions for goods and cargo, ensuring swift delivery and reliable logistics for time-sensitive shipments.</p>

          </div>
        </div>
        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
          <div class="card">
            <div class="card-img">
              <img src="{{asset('public_user_front/assets/img/oceanfreight.jpg')}}" alt="" class="img-fluid">
            </div>
            <h3><a href="{{url('/#f5')}}" class="stretched-link">Ocean Freight </a></h3>
            <p style="color: black;">Our Ocean Freight services offer comprehensive shipping solutions for goods and cargo through sea transportation, providing reliable and cost-effective logistics options for international trade..</p>

          </div>
        </div>
        <!-- End Card Item -->

      </div>
    </div>
  </section>
  @endif
  <!-- end section -->
  <!-- contact section  -->
  <section id="call-to-action" class="call-to-action ar">
    <div class="section-header">
      <h2>@lang('public.Contact_Us')</h2>
    </div>
    <div class="container" data-aos="fade-up">
      <div class="row gy-4 mt-4">
        <div class="col-lg-4">
          <div class="info-item d-flex">
            <i class="bi bi-geo-alt flex-shrink-0" style="color:#F8DE22"></i>
            <div>
              <h4 style="color:#F8DE22">@lang('public.Location'):</h4>
              @if (app()->getLocale() === 'ar')
              <p> مصر، القاهرة، مدينة نصر، شارع مصطفى النحاس</p>
              @else
              <p>Egypt, Cairo , Nasr City , Mostafa Al Nahas Street</p>

              @endif
            </div>
          </div><!-- End Info Item -->
          <div class="info-item d-flex">
            <i class="bi bi-envelope flex-shrink-0" style="color:#F8DE22"></i>
            <div>
              <h4 style="color:#F8DE22">@lang('public.Email'):</h4>
              <p>info@nkl.com.eg</p>
            </div>
          </div><!-- End Info Item -->
          <div class="info-item d-flex">
            <i class="bi bi-phone flex-shrink-0" style="color:#F8DE22"></i>
            <div>
              <h4 style="color:#F8DE22">@lang('public.Call'):</h4>
              <p>+2010229936375</p>
            </div>
          </div><!-- End Info Item -->
        </div>
        <div class="col-lg-8">
          <form action="{{url('/contact/from')}}" method="post">
            @csrf
            <div class="row">
              <div class="col-md-6 form-group">
                <input type="text" name="name" class="form-control" id="name" placeholder="@lang('public.Your_Name')" required>
              </div>
              <div class="col-md-6 form-group mt-3 mt-md-0">
                <input type="email" class="form-control" name="email" id="email" placeholder="@lang('public.Your_Email')" required>
              </div>
            </div>
            <div class="form-group mt-3">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="@lang('public.Subject')" required>
            </div>
            <div class="form-group mt-3">
              <textarea class="form-control" name="message" rows="5" placeholder="@lang('public.Message')" required></textarea>
            </div>
            <div class="text-center" style="padding: 10px;"><button type="submit" class="btn" style="background-color: #F8DE22;color:white">@lang('public.Send_Message')</button></div>
          </form>
        </div><!-- End Contact Form -->
      </div>
    </div>
  </section>
  <!-- End Section -->
  <!-- ======= Features Section ======= -->

  <!-- End Features Section -->

  <!-- ======= Frequently Asked Questions Section ======= -->
  @if (app()->getLocale() === 'ar')
  <section id="faq" class="faq ar">
    <div class="container" data-aos="fade-up">
      <div class="section-header">
        <h2>الحلول التي تقدمها الشركة</h2>
      </div>
      <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="200">
        <div class="col-lg-10">
          <div class="accordion accordion-flush" id="faqlist">
            <div class="accordion-item">
              <h3 class="accordion-header"> <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-1"> <i class="bi bi-question-circle question-icon"></i> ما هي الخدمات التي توفرها شركة NKL؟ </button> </h3>
              <div id="faq-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                <div class="accordion-body"> شركة NKL هي شركة شحن ولوجستية توفر مجموعة واسعة من الخدمات لتسهيل نقل وتسليم البضائع. تشمل خدماتنا إعادة توجيه الشحنات، واستيراد وتصدير البضائع، والتخليص الجمركي، والتخزين، والتوزيع، وحلول إدارة سلاسل الإمداد. </div>
              </div>
            </div>
            <div class="accordion-item">
              <h3 class="accordion-header"> <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-2"> <i class="bi bi-question-circle question-icon"></i> كيف يمكن لشركة NKL مساعدتك في احتياجات الشحن واللوجستيات؟ </button> </h3>
              <div id="faq-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                <div class="accordion-body"> تتمتع شركة NKL بفريق من المحترفين ذوي الخبرة وشبكة قوية من الشركاء في جميع أنحاء العالم. نستغل خبرتنا ومواردنا لتقديم حلول شحن ولوجستية فعالة وموثوقة. سواء كنت بحاجة إلى مساعدة في الشحن الدولي، أو الوثائق الجمركية، أو تحسين سلسلة الإمداد، يمكننا تصميم خدماتنا لتلبية متطلباتك الخاصة. </div>
              </div>
            </div>
            <div class="accordion-item">
              <h3 class="accordion-header"> <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-3"> <i class="bi bi-question-circle question-icon"></i> لماذا تختار شركة NKL لاحتياجات الشحن الخاصة بك؟ </button> </h3>
              <div id="faq-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                <div class="accordion-body"> في شركة NKL، نعتبر رضا العملاء أمرًا أساسيًا ونسعى جاهدين لتقديم خدمة استثنائية. فريقنا ملتزم بفهم متطلبات الشحن الفريدة لديك وتقديم حلول مخصصة. بفضل معرفتنا الواسعة في الصناعة، والتكنولوجيا المتقدمة، والشبكة العالمية، يمكننا تبسيط عمليات اللوجستيات الخاصة بك وضمان تسليم البضائع في الوقت المناسب وبأمان.</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  @else
  <section id="faq" class="faq">
    <div class="container" data-aos="fade-up">
      <div class="section-header">
        <h2>Solutions provided by the company</h2>
      </div>
      <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="200">
        <div class="col-lg-10">
          <div class="accordion accordion-flush" id="faqlist">
            <div class="accordion-item">
              <h3 class="accordion-header"> <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-1"> <i class="bi bi-question-circle question-icon"></i> What services does NKL company provide? </button> </h3>
              <div id="faq-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                <div class="accordion-body"> NKL is a shipping and logistics company that provides a wide range of services to facilitate the transportation and delivery of goods. Our services include shipment forwarding, import and export of goods, customs clearance, storage, distribution, and supply chain management solutions. </div>
              </div>
            </div>
            <div class="accordion-item">
              <h3 class="accordion-header"> <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-2"> <i class="bi bi-question-circle question-icon"></i> How can NKL company assist you with your shipping and logistics needs? </button> </h3>
              <div id="faq-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                <div class="accordion-body"> NKL has a team of experienced professionals and a strong network of partners worldwide. We leverage our expertise and resources to provide efficient and reliable shipping and logistics solutions. Whether you need assistance with international shipping, customs documentation, or supply chain optimization, we can tailor our services to meet your specific requirements. </div>
              </div>
            </div>
            <div class="accordion-item">
              <h3 class="accordion-header"> <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-3"> <i class="bi bi-question-circle question-icon"></i> Why choose NKL for your shipping needs? </button> </h3>
              <div id="faq-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                <div class="accordion-body"> At NKL, customer satisfaction is paramount, and we strive to deliver exceptional service. Our team is committed to understanding your unique shipping requirements and providing customized solutions. With our extensive industry knowledge, advanced technology, and global network, we can streamline your logistics operations and ensure timely and secure delivery of goods.</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  @endif
  <!-- End Frequently Asked Questions Section -->
</main>
<!-- End #main -->
@endsection