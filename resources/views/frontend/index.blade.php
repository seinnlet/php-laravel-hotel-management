@extends('frontendtemplate')

@section('title', 'Hotel Riza')

@section('content')

	<!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container position-relative text-center text-lg-left" data-aos="zoom-in" data-aos-delay="100">
      <div class="row">
        <div class="col-lg-8">
          <h1>Welcome to <span>Hotel RIZA</span></h1>
          <h2 class="mt-2">Premium Accommodation in the Heart of the City!</h2>

          <div class="btns">
            <a href="#about" class="btn-menu animated fadeInUp scrollto">About Us</a>
            <a href="#book-a-table" class="btn-book animated fadeInUp scrollto">Book Now</a>
          </div>
        </div>
        <div class="col-lg-4 d-flex align-items-center justify-content-center" data-aos="zoom-in" data-aos-delay="200">
          <a href="https://youtu.be/bQ6QQyKPnSk" class="venobox play-btn" data-vbtype="video" data-autoplay="true"></a>
        </div>

      </div>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-6 order-1 order-lg-2" data-aos="zoom-in" data-aos-delay="100">
            <div class="about-img">
              <img src="{{ asset('frontend/img/about1.jpg') }}" alt="Bedroom">
            </div>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
            <h3>Enjoy and Relax at Hotel Riza!</h3>
            <p class="font-italic my-4">
              Modern architecture with 5-star accomodation near the Beach, the Best Resort for your Summer in Myanmar
            </p>
            <ul>
              <li><i class="icofont-check-circled"></i> Online & Offline Room Bookings</li>
              <li><i class="icofont-check-circled"></i> Best Hotel Services</li>
              <li><i class="icofont-check-circled"></i> Beach View Rooms</li>
              <li><i class="icofont-check-circled"></i> World Luxuary Hotel Awards</li>
            </ul>
            <p class="mt-4">
              <a href="#why-us" class="btn-findout-more animated fadeInUp scrollto">Find out More <i class="icofont-hand-drawn-right"></i></a>
            </p>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Why Us</h2>
          <p>Why Choose Our Hotel</p>
        </div>

        <div class="row">

          <div class="col-lg-4">
            <div class="box" data-aos="zoom-in" data-aos-delay="100">
              <span>01</span>
              <h4>Best Suites</h4>
              <p>Beach COOL VIEWS, also Hotel Riza provides accomodation with balconies to enjoy sunset with your family.</p>
            </div>
          </div>

          <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="box" data-aos="zoom-in" data-aos-delay="200">
              <span>02</span>
              <h4>Spa & Wellness</h4>
              <p>Open daily Spa and other services will help you destress with classic and refreshing treatments.</p>
            </div>
          </div>

          <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="box" data-aos="zoom-in" data-aos-delay="300">
              <span>03</span>
              <h4>Top Restaurant</h4>
              <p>You can also enjoy best meals from famous chefs during your holidays at our hotels.</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Why Us Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Services</h2>
          <p>Our Room Services</p>
        </div>

        <div class="row">
          <div class="col-md-6 mb-5" data-aos="flip-down">
            <div class="shadow-sm p-3"> 
              <div class="row">
                <div class="col-2 text-center">
                  <i class="icofont-wifi"></i>
                </div>
                <div class="col-10">
                  <p class="service-title">Free Wireless Internet Access</p>
                  <span class="tag rounded-pill">- WiFi -</span>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6 mb-5" data-aos="flip-down">
            <div class="shadow-sm p-3"> 
              <div class="row">
                <div class="col-2 text-center">
                  <i class="icofont-clock-time"></i>
                </div>
                <div class="col-10">
                  <p class="service-title">24 Hours Room Services</p>
                  <span class="tag rounded-pill">- 24-hour -</span>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6 mb-5" data-aos="flip-down">
            <div class="shadow-sm p-3"> 
              <div class="row">
                <div class="col-2 text-center">
                  <i class="icofont-washing-machine"></i>
                </div>
                <div class="col-10">
                  <p class="service-title">Laundry & Dry Cleaning Services</p>
                  <span class="tag rounded-pill">- Laundry -</span>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6 mb-5" data-aos="flip-down">
            <div class="shadow-sm p-3"> 
              <div class="row">
                <div class="col-2 text-center">
                  <i class="icofont-bed"></i>
                </div>
                <div class="col-10">
                  <p class="service-title">Extra Bedroom Equipments</p>
                  <span class="tag rounded-pill">- Pillows & Blankets -</span>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6 mb-5 mb-md-0" data-aos="flip-down">
            <div class="shadow-sm p-3"> 
              <div class="row">
                <div class="col-2 text-center">
                  <i class="icofont-beach-bed"></i>
                </div>
                <div class="col-10">
                  <p class="service-title">Swimming Pool & Poolside Bar</p>
                  <span class="tag rounded-pill">- Pool -</span>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6" data-aos="flip-down">
            <div class="shadow-sm p-3"> 
              <div class="row">
                <div class="col-2 text-center">
                  <i class="icofont-bicycle-alt-2"></i>
                </div>
                <div class="col-10">
                  <p class="service-title">Complimentary use of hotel bicycle</p>
                  <span class="tag rounded-pill">- Bicycle -</span>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Services Section -->
    
    <hr class="section-hr">

    <!-- ======= Roomtypes Section ======= -->
    <section id="roomtypes" class="roomtypes">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Room Types</h2>
          <p>Best Rooms</p>
        </div>

        <div class="row inner">
          <div class="col-lg-6 inner-col border mb-5">
            <a href="{{ route('roomtypes.detail', $bestroomtype->id) }}">
              <div class="img-wrap">
                <img src="{{ asset($bestroomtype->image1) }}" class="img-fluid">
                <span class="img-text"><i class="icofont-star"></i> Best Room of the Month</span>
              </div>
            </a>
            <div class="text-wrap">
              <p class="p-title">{{ $bestroomtype->name }}</p>
              <div class="mt-4 mb-5">
                <div class="float-left p-subtitle">
                  <i class="icofont-ui-user-group"></i> {{ $bestroomtype->noofpeople }} {{ $bestroomtype->noofpeople == 1 ? 'Guest' : 'Guests' }} | 
                  <i class="icofont-bed"></i> {{ $bestroomtype->noofbed }} {{ $bestroomtype->noofbed == 1 ? 'Bed' : 'Beds' }}
                </div>
                <div class="float-right text-right">
                  <span class="text-price">$ {{ number_format($bestroomtype->pricepernight, 2) }} <small>/ NIGHT</small></span>
                </div>
                <div class="clearfix"></div>
              </div>
              <a href="" class="btn-book">Book Now</a>
            </div>
          </div>
          <div class="col-lg-6 inner-col mb-5">
            
            <div class="row">
              @php $i = 1; @endphp
              @foreach ($roomtypes as $roomtype)
                <div class="col-6 {{ $i!=4 ? 'mb-5' : '' }} {{ $i==3 ? 'mb-sm-0' : '' }}">
                  <a href="{{ route('roomtypes.detail', $roomtype->id) }}">
                    <div class="square border">
                      <div class="content">
                        <img src="{{ asset($roomtype->image1) }}">
                        <span class="content-text">{{ $roomtype->name }}</span>
                        <span class="content-price">$ {{ number_format($roomtype->pricepernight, 2) }}</span>
                      </div>
                    </div>
                  </a>
                </div>
                @php $i++; @endphp
              @endforeach
                
            </div>

          </div>
        </div>

        <div class="text-center my-3">
          <a href="{{ route('roomtypes.list') }}" class="btn-view">View All Rooms</a>
        </div>

      </div>
    </section><!-- End Roomtypes Section -->

    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Customers' Reviews</h2>
          <p>What they're saying about us</p>
        </div>

        <div class="owl-carousel testimonials-carousel" data-aos="zoom-in" data-aos-delay="100">

          <div class="testimonial-item">
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
              I spend my holidays mostly here and I must say that everything is excellent. The location of the hotel is quite close to the beach, so the best place to enjoy beach views.
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
            <img src="{{ asset('frontend/img/testimonials/testimonials-1.jpg') }}" class="testimonial-img" alt="">
            <h3>John Smith</h3>
            <h4>Regular Visitor</h4>
          </div>

          <div class="testimonial-item">
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
              As for the Single room, even though being small, it is excellent and surprisingly comfortable. I would definitely recommend this hotel to others having a business trip.
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
            <img src="{{ asset('frontend/img/testimonials/testimonials-2.jpg') }}" class="testimonial-img" alt="">
            <h3>Isabella</h3>
            <h4>Designer</h4>
          </div>

          <div class="testimonial-item">
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
              We have stayed at this hotel multiple times and the high quality of service and attention to detail remains. The staff are also amazing, the rooms have been comfortable.
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
            <img src="{{ asset('frontend/img/testimonials/testimonials-3.jpg') }}" class="testimonial-img" alt="">
            <h3>Victoria</h3>
            <h4>Manager</h4>
          </div>

          <div class="testimonial-item">
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
              I really like the place and the house keeping was really nice. The room was also nice with a huge bed and a great view, and the bathroom was big and so nice!
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
            <img src="{{ asset('frontend/img/testimonials/testimonials-4.jpg') }}" class="testimonial-img" alt="">
            <h3>Matt Brandon</h3>
            <h4>Freelancer</h4>
          </div>

          <div class="testimonial-item">
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
              Every aspect of our stay exceeded our expectations. The restaurtant makes a lovely breakfast. I would highly recommend for couples mixing work and pleasure.
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
            <img src="{{ asset('frontend/img/testimonials/testimonials-5.jpg') }}" class="testimonial-img" alt="">
            <h3>John Larson</h3>
            <h4>Entrepreneur</h4>
          </div>

        </div>

      </div>
    </section><!-- End Testimonials Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Contact</h2>
          <p>Contact Us</p>
        </div>
      </div>

      <div data-aos="fade-up">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3818.5441490457433!2d96.13509161415526!3d16.848955788403405!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c19492c4bbe131%3A0x974ebe72a63ebb40!2sPyay%20Rd%2C%20Yangon!5e0!3m2!1sen!2smm!4v1600749198193!5m2!1sen!2smm" width="100%" height="350" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
      </div>

      <div class="container" data-aos="fade-up">

        <div class="row mt-5">

          <div class="col-lg-4">
            <div class="info">
              <div class="address">
                <i class="icofont-google-map"></i>
                <h4>Location:</h4>
                <p>Pyay Road, Yangon, Myanmar</p>
              </div>

              <div class="open-hours">
                <i class="icofont-clock-time icofont-rotate-90"></i>
                <h4>Open Hours:</h4>
                <p>
                  Every Day:<br>
                  24 Hours Open
                </p>
              </div>

              <div class="email">
                <i class="icofont-envelope"></i>
                <h4>Email:</h4>
                <p>hotelriza.info@gmail.com</p>
              </div>

              <div class="phone">
                <i class="icofont-phone"></i>
                <h4>Call:</h4>
                <p>+95 9129 1299 198</p>
              </div>

            </div>

          </div>

          <div class="col-lg-8 mt-5 mt-lg-0">

            <form method="post" role="form" class="php-email-form">
              <div class="form-row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                  <div class="validate"></div>
                </div>
                <div class="col-md-6 form-group">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                  <div class="validate"></div>
                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                <div class="validate"></div>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="message" rows="8" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                <div class="validate"></div>
              </div>
              <div class="mb-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>

          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

@endsection

@section('script')
  
  <script type="text/javascript">
    $(function () {

      var nav_sections = $('section');
      var main_nav = $('.nav-menu, .mobile-nav');
      
      $(window).on('scroll', function() {
        var cur_pos = $(this).scrollTop() + 200;

        nav_sections.each(function() {
          var top = $(this).offset().top,
            bottom = top + $(this).outerHeight();

          if (cur_pos >= top && cur_pos <= bottom) {
            if (cur_pos <= bottom) {
              main_nav.find('li').removeClass('active');
            }
            main_nav.find('a[href="#' + $(this).attr('id') + '"]').parent('li').addClass('active');
          }
           if (cur_pos < 300) {
            $(".nav-menu ul:first li:first").addClass('active');
          }
        });
      });
      
    })
  </script>

@endsection