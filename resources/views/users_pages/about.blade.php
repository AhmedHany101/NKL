@extends('user_layout.layout')
@section('layout')
<main id="main">

<!-- ======= Breadcrumbs ======= -->
<div class="breadcrumbs">
  <div class="page-header d-flex align-items-center" style="background-image: url('./public_user_front/assets/img/page-header.jpg');">
  <div class="container position-relative">
  <div class="row d-flex justify-content-center">
    <div class="col-lg-6 text-center">
      <h2>About Us</h2>
      <p>Welcome to our website! We are a team dedicated to providing exceptional services and solutions.</p>
    </div>
  </div>
</div>
  </div>
  <nav>
    <div class="container">
      <ol>
        <li><a href="{{url('/')}}">Home</a></li>
        <li>About</li>
      </ol>
    </div>
  </nav>
</div>
<!-- End Breadcrumbs -->

<!-- ======= About Us Section ======= -->
<section id="about" class="about">
  <div class="container" data-aos="fade-up">

    <div class="row gy-4">
      <div class="col-lg-6 position-relative align-self-start order-lg-last order-first">
        <img src="{{asset('public_user_front/assets/img/about.jpg')}}" class="img-fluid" alt="">
        <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox play-btn"></a>
      </div>
      <div class="col-lg-6 content order-last  order-lg-first">
        <h3>About Us</h3>
        <p>
          Costa Rica in 4K 60fps HDR (Ultra HD) is a breathtaking video showcasing the beauty of Costa Rica. It captures the stunning landscapes, vibrant culture, and diverse wildlife of this Central American country.
        </p>
        <ul>
          <li data-aos="fade-up" data-aos-delay="100">
            <i class="bi bi-diagram-3"></i>
            <div>
              <h5>Experience the wonders of Costa Rica</h5>
              <p>Immerse yourself in the natural wonders, from lush rainforests to pristine beaches.</p>
            </div>
          </li>
          <li data-aos="fade-up" data-aos-delay="200">
            <i class="bi bi-fullscreen-exit"></i>
            <div>
              <h5>Explore the rich culture</h5>
              <p>Discover the vibrant traditions, delicious cuisine, and warm hospitality of Costa Rica.</p>
            </div>
          </li>
          <li data-aos="fade-up" data-aos-delay="300">
            <i class="bi bi-broadcast"></i>
            <div>
              <h5>Witness the incredible wildlife</h5>
              <p>Encounter a wide variety of unique and exotic wildlife species in their natural habitats.</p>
            </div>
          </li>
        </ul>
      </div>
    </div>

  </div>
</section>
<!-- End About Us Section -->

<!-- ======= Stats Counter Section ======= -->
<section id="stats-counter" class="stats-counter pt-0">
  <div class="container" data-aos="fade-up">

    <div class="row gy-4">

      <div class="col-lg-3 col-md-6">
        <div class="stats-item text-center w-100 h-100">
          <span data-purecounter-start="0" data-purecounter-end="500" data-purecounter-duration="1" class="purecounter"></span>
          <p>Clients Served</p>
        </div>
      </div><!-- End Stats Item -->

      <div class="col-lg-3 col-md-6">
        <div class="stats-item text-center w-100 h-100">
          <span data-purecounter-start="0" data-purecounter-end="1000" data-purecounter-duration="1" class="purecounter"></span>
          <p>Projects Completed</p>
        </div>
      </div><!-- End Stats Item -->

      <div class="col-lg-3 col-md-6">
        <div class="stats-item text-center w-100 h-100">
          <span data-purecounter-start="0" data-purecounter-end="2000" data-purecounter-duration="1" class="purecounter"></span>
          <p>Hours of Support Provided</p>
        </div>
      </div><!-- End Stats Item -->

      <div class="col-lg-3 col-md-6">
        <div class="stats-item text-center w-100 h-100">
          <span data-purecounter-start="0" data-purecounter-end="50" data-purecounter-duration="1" class="purecounter"></span>
          <p>Team Members</p>
        </div>
      </div><!-- End Stats Item -->

    </div>

  </div>
</section>
<!-- End Stats Counter Section -->

<!-- ======= Our Team Section ======= -->
<section id="team" class="team pt-0">
  <div class="container" data-aos="fade-up">

    <div class="section-header">
      <span>Our Team</span>
      <h2>Meet Our Team</h2>
    </div>

    <div class="row" data-aos="fade-up" data-aos-delay="100">

      <div class="col-lg-4 col-md-6 d-flex">
        <div class="member">
          <img src="{{asset('public_user_front/assets/img/team/team-1.jpg')}}" class="img-fluid" alt="">
          <div class="member-content">
            <h4>John Smith</h4>
            <span>Operations Manager</span>
            <p>
              With years of experience in logistics operations, John ensures the smooth functioning of our shipping processes. His expertise and dedication contribute to our company's success.
            </p>
            <div class="social">
              <a href=""><i class="bi bi-twitter"></i></a>
              <a href=""><i class="bi bi-facebook"></i></a>
              <a href=""><i class="bi bi-instagram"></i></a>
              <a href=""><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
        </div>
      </div><!-- End Team Member -->

      <div class="col-lg-4 col-md-6 d-flex">
        <div class="member">
          <img src="{{asset('public_user_front/assets/img/team/team-2.jpg')}}" class="img-fluid" alt="">
          <div class="member-content">
            <h4>Jane Davis</h4>
            <span>Supply Chain Specialist</span>
            <p>
              Jane is responsible for optimizing our supply chain operations. She ensures efficient inventory management and timely deliveries, contributing to customer satisfaction.
            </p>
            <div class="social">
              <a href=""><i class="bi bi-twitter"></i></a>
              <a href=""><i class="bi bi-facebook"></i></a>
              <a href=""><i class="bi bi-instagram"></i></a>
              <a href=""><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
        </div>
      </div><!-- End Team Member -->

      <div class="col-lg-4 col-md-6 d-flex">
        <div class="member">
          <img src="{{asset('public_user_front/assets/img/team/team-3.jpg')}}" class="img-fluid" alt="">
          <div class="member-content">
            <h4>Michael Johnson</h4>
            <span>Customer Service Manager</span>
            <p>
              Michael leads our dedicated customer service team, ensuring that our clients' inquiries and concerns are promptly addressed, and their satisfaction is prioritized.
            </p>
            <div class="social">
              <a href=""><i class="bi bi-twitter"></i></a>
              <a href=""><i class="bi bi-facebook"></i></a>
              <a href=""><i class="bi bi-instagram"></i></a>
              <a href=""><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
        </div>
      </div><!-- End Team Member -->

    </div>

  </div>
</section>
<!-- End Our Team Section -->

<!-- ======= Testimonials Section ======= -->
<section id="testimonials" class="testimonials">
  <div class="container">

    <div class="slides-1 swiper" data-aos="fade-up">
      <div class="swiper-wrapper">

        <div class="swiper-slide">
          <div class="testimonial-item">
            <img src="{{asset('public_user_front/assets/img/testimonials/testimonials-1.jpg')}}" class="testimonial-img" alt="">
            <h3>John Smith</h3>
            <h4>CEO, ABC Shipping and Logistics</h4>
            <div class="stars">
              <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
            </div>
            <p>
              <i class="bi bi-quote quote-icon-left"></i>
              Our experience with ABC Shipping and Logistics has been exceptional. They have consistently provided us with efficient and reliable shipping solutions for our business. Their attention to detail and commitment to customer satisfaction is commendable. We highly recommend their services.
              <i class="bi bi-quote quote-icon-right"></i>
            </p>
          </div>
        </div><!-- End testimonial item -->

        <div class="swiper-slide">
          <div class="testimonial-item">
            <img src="{{asset('public_user_front/assets/img/testimonials/testimonials-2.jpg')}}" class="testimonial-img" alt="">
            <h3>Jane Davis</h3>
            <h4>Supply Chain Manager, XYZ Corporation</h4>
            <div class="stars">
              <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
            </div>
            <p>
              <i class="bi bi-quote quote-icon-left"></i>
              We have been partnering with ABC Shipping and Logistics for our global distribution needs, and they have consistently exceeded our expectations. Their expertise in handling complex logistics operations and their seamless coordination have been instrumental in optimizing our supply chain. We are extremely satisfied with their services.
              <i class="bi bi-quote quote-icon-right"></i>
            </p>
          </div>
        </div><!-- End testimonial item -->

        <div class="swiper-slide">
          <div class="testimonial-item">
            <img src="{{asset('public_user_front/assets/img/testimonials/testimonials-3.jpg')}}" class="testimonial-img" alt="">
            <h3>Michael Johnson</h3>
            <h4>E-commerce Entrepreneur</h4>
            <div class="stars">
              <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
            </div>
            <p>
              <i class="bi bi-quote quote-icon-left"></i>
              ABC Shipping and Logistics has been a reliable partner for my e-commerce business. Their seamless integration with our online platforms and their efficient order fulfillment services have helped us streamline our operations and deliver a great customer experience. I highly recommend their services to fellow entrepreneurs.
              <i class="bi bi-quote quote-icon-right"></i>
            </p>
          </div>
        </div><!-- End testimonial item -->

        <div class="swiper-slide">
          <div class="testimonial-item">
            <img src="{{asset('public_user_front/assets/img/testimonials/testimonials-4.jpg')}}" class="testimonial-img" alt="">
            <h3>Sarah Thompson</h3>
            <h4>Importer/Exporter</h4>
            <div class="stars">
              <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
            </div>
            <p>
              <i class="bi bi-quote quote-icon-left"></i>
              As an importer/exporter, I rely on ABC Shipping and Logistics to ensure the smooth transportation of goods across borders. Their extensive network, knowledge of customs regulations, and proactive communication have made them our trusted logistics partner. I am impressed with their professionalism and highly recommend their services.
              <i class="bi bi-quote quote-icon-right"></i>
            </p>
          </div>
        </div><!-- End testimonial item -->

        <div class="swiper-slide">
          <div class="testimonial-item">
            <img src="{{asset('public_user_front/assets/img/testimonials/testimonials-5.jpg')}}" class="testimonial-img" alt="">
            <h3>Emily Wilson</h3>
            <h4>Small Business Owner</h4>
            <div class="stars">
              <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
            </div>
            <p>
              <i class="bi bi-quote quote-icon-left"></i>
              ABC Shipping and Logistics has played a crucial role in the growth of my small business. Their cost-effective shipping solutions, prompt delivery, and excellent customer service have helped me expand my reach and serve my customers better. I am grateful for their support and highly recommend their services.
              <i class="bi bi-quote quote-icon-right"></i>
            </p>
          </div>
        </div><!-- End testimonial item -->

      </div>
      <div class="swiper-pagination"></div>
    </div>

  </div>
</section>
<!-- End Testimonials Section -->

<section id="faq" class="faq">
  <div class="container" data-aos="fade-up">
    <div class="section-header">
      <span>About NKL Company</span>
      <h2>About NKL Company</h2>
    </div>

    <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="200">
      <div class="col-lg-10">
        <div class="accordion accordion-flush" id="faqlist">

          <div class="accordion-item">
            <h3 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-1">
                <i class="bi bi-question-circle question-icon"></i>
                What services does NKL Company provide?
              </button>
            </h3>
            <div id="faq-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist">
              <div class="accordion-body">
                NKL Company is a shipping and logistics company that offers a wide range of services to facilitate the transportation and delivery of goods. Our services include freight forwarding, customs clearance, warehousing, distribution, and supply chain management solutions.
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <h3 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-2">
                <i class="bi bi-question-circle question-icon"></i>
                How can NKL Company help with shipping and logistics needs?
              </button>
            </h3>
            <div id="faq-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist">
              <div class="accordion-body">
                NKL Company has a team of experienced professionals and a robust network of partners worldwide. We leverage our expertise and resources to provide efficient and reliable shipping and logistics solutions. Whether you need assistance with international freight, customs documentation, or supply chain optimization, we can tailor our services to meet your specific requirements.
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <h3 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-3">
                <i class="bi bi-question-circle question-icon"></i>
                Why choose NKL Company for your shipping needs?
              </button>
            </h3>
            <div id="faq-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist">
              <div class="accordion-body">
                At NKL Company, we prioritize customer satisfaction and strive to deliver exceptional service. Our team is dedicated to understanding your unique shipping requirements and providing personalized solutions. With our extensive industry knowledge, advanced technology, and global network, we can streamline your logistics operations and ensure timely and secure delivery of your goods.
              </div>
            </div>
          </div>

          <!-- Add more FAQ items about NKL Company if needed -->

        </div>
      </div>
    </div>
  </div>
</section>

</main>
@endsection