<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="author" content="Untree.co">
      <link rel="shortcut icon" href="{{asset('frontend/images/favicon.png')}}">
      <meta name="description" content="" />
      <meta name="keywords" content="bootstrap, bootstrap4" />
      <link href="https://fonts.googleapis.com/css2?family=Display+Playfair:wght@400;700&family=Inter:wght@400;700&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
      <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}">
      <link rel="stylesheet" href="{{asset('frontend/css/animate.min.css')}}">
      <link rel="stylesheet" href="{{asset('frontend/css/owl.carousel.min.css')}}">
      <link rel="stylesheet" href="{{asset('frontend/css/owl.theme.default.min.css')}}">
      <link rel="stylesheet" href="{{asset('frontend/css/jquery.fancybox.min.css')}}">
      <link rel="stylesheet" href="{{asset('frontend/fonts/icomoon/style.css')}}">
      <link rel="stylesheet" href="{{asset('frontend/fonts/flaticon/font/flaticon.css')}}">
      <link rel="stylesheet" href="{{asset('frontend/css/aos.css')}}">
      <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
      <link rel="stylesheet" href="{{asset('frontend/css/custom.css')}}">
      <title>Trung tâm gia sư Đăng Minh</title>
   </head>
   <body>
      <div class="site-mobile-menu">
         <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close">
               <span class="icofont-close js-menu-toggle"></span>
            </div>
         </div>
         <div class="site-mobile-menu-body"></div>
      </div>
      <nav class="site-nav mb-5">
         <div class="pb-2 top-bar mb-3">
            <div class="container">
               <div class="row align-items-center">
                  <div class="col-6 col-lg-9">
                     <a href="#" class="small mr-3"><span class="icon-question-circle-o mr-2"></span> <span class="d-none d-lg-inline-block">Have a questions?</span></a> 
                     <a href="#" class="small mr-3"><span class="icon-phone mr-2"></span> <span class="d-none d-lg-inline-block">0984 930 223</span></a> 
                     <a href="#" class="small mr-3"><span class="icon-envelope mr-2"></span> <span class="d-none d-lg-inline-block">kimhuee2012@gmail.com</span></a> 
                  </div>
                  <div class="col-6 col-lg-3 text-right">
                     <a href="login.html" class="small mr-3">
                     <span class="icon-lock"></span>
                     Đăng nhập
                     </a>
                     <a href="register.html" class="small">
                     <span class="icon-person"></span>
                     Đăng ký
                     </a>
                  </div>
               </div>
            </div>
         </div>
         <div class="sticky-nav js-sticky-header">
            <div class="container position-relative">
               <div class="site-navigation text-center">
                  <a href="index.html" class="logo menu-absolute m-0">ĐĂNG MINH<span class="text-primary">.</span></a>
                  <ul class="js-clone-nav d-none d-lg-inline-block site-menu">
                     <li class="active"><a href="home.php">Home</a></li>
                     <li class="has-children">
                        <a href="#">Dịch vụ gia sư</a>
                        <ul class="dropdown">
                           <li><a href="#">Gia sư môn Toán</a></li>
                           <li><a href="#">Gia sư môn Anh</a></li>
                           <li><a href="#">Gia sư môn Văn</a></li>
                           <li><a href="#">Gia sư môn Hóa</a></li>
                           <li><a href="#">Gia sư môn Lý</a></li>
                           <li><a href="#">Gia sư môn Tiểu học</a></li>
                           <li><a href="#">Gia sư môn Năng khiếu</a></li>
                           <li class="has-children">
                              <a href="#">Menu Two</a>
                              <ul class="dropdown">
                                 <li><a href="#">Sub Menu One</a></li>
                                 <li><a href="#">Sub Menu Two</a></li>
                                 <li><a href="#">Sub Menu Three</a></li>
                              </ul>
                           </li>
                        </ul>
                     </li>
                     <li><a href="staff.html">Phụ huynh</a></li>
                     <li><a href="news.html">Gia sư</a></li>
                     <li><a href="gallery.html">Danh sách gia sư</a></li>
                     <li><a href="about.html">Danh sách lớp mới</a></li>
                     <li><a href="contact.html">Tin tức</a></li>
                  </ul>
                  <a href="#" class="btn-book btn btn-secondary btn-sm menu-absolute">Về chúng tôi</a>
                  <a href="#" class="burger ml-auto float-right site-menu-toggle js-menu-toggle d-inline-block d-lg-none light" data-toggle="collapse" data-target="#main-navbar">
                  <span></span>
                  </a>
               </div>
            </div>
         </div>
      </nav>
      <div class="untree_co-hero overlay" style="background-image: url('{{asset('frontend/images/lophoc1.jpg')}}');">
         <div class="container">
            <div class="row align-items-center justify-content-center">
               <div class="col-12">
                  <div class="row justify-content-center ">
                     <div class="col-lg-6 text-center ">
                        <h1 class="mb-4 heading text-white" data-aos="fade-up" data-aos-delay="100">Trung tâm gia sư Đăng Minh</h1>
                        <p class="mb-0" data-aos="fade-up" data-aos-delay="300"><a href="#" class="btn btn-secondary">Xem thêm</a></p>
                     </div>
                  </div>
               </div>
            </div>
            <!-- /.row -->
         </div>
         <!-- /.container -->
      </div>
      
      @yield('content')
      
      <!-- /.untree_co-section -->
      <div class="site-footer">
         <div class="container">
            <div class="row">
               <div class="col-lg-3 mr-auto">
                  <div class="widget">
                     <h3>Về chúng tôi<span class="text-primary">.</span> </h3>
                     <p>Trung tâm Gia sư Đăng Minh - nơi kết nối học viên với đội ngũ gia sư chất lượng, giàu kinh nghiệm, mang đến giải pháp học tập hiệu quả và phù hợp nhất cho mọi nhu cầu.</p>
                  </div>
                  <!-- /.widget -->
                  <div class="widget">
                     <ul class="list-unstyled social">
                        <li><a href="https://www.instagram.com/"><span class="icon-instagram"></span></a></li>
                        <li><a href="https://www.facebook.com/profile.php?id=61554680451428"><span class="icon-facebook"></span></a></li>
                     </ul>
                  </div>
                  <!-- /.widget -->
               </div>
               <!-- /.col-lg-3 -->
               <div class="col-lg-2 ml-auto">
                  <div class="widget">
                     <h3>Dịch vụ gia sư</h3>
                     <ul class="list-unstyled float-left links">
                        <li><a href="#">Gia sư môn Toán</a></li>
                        <li><a href="#">Gia sư môn Anh</a></li>
                        <li><a href="#">Gia sư môn Văn</a></li>
                        <li><a href="#">Gia sư môn Hóa</a></li>
                        <li><a href="#">Gia sư môn Lý</a></li>
                        <li><a href="#">Gia sư môn Tiểu học</a></li>
                        <li><a href="#">Gia sư môn Năng khiếu</a></li>
                     </ul>
                  </div>
                  <!-- /.widget -->
               </div>
               <!-- /.col-lg-3 -->
               <div class="col-lg-3">
                  <div class="widget">
                     <h3>Hình ảnh</h3>
                     <ul class="instafeed instagram-gallery list-unstyled">
                        <li><a class="instagram-item" href="{{asset('frontend/images/footer1.jpg')}}" data-fancybox="gal"><img src="{{asset('frontend/images/footer1.jpg')}}" alt="" width="72" height="72"></a>
                        </li>
                        <li><a class="instagram-item" href="{{asset('frontend/images/footer2.jpg')}}" data-fancybox="gal"><img src="{{asset('frontend/images/footer2.jpg')}}" alt="" width="72" height="72"></a>
                        </li>
                        <li><a class="instagram-item" href="{{asset('frontend/images/footer3.jpg')}}" data-fancybox="gal"><img src="{{asset('frontend/images/footer3.jpg')}}" alt="" width="72" height="72"></a>
                        </li>
                        <li><a class="instagram-item" href="{{asset('frontend/images/footer4.jpg')}}" data-fancybox="gal"><img src="{{asset('frontend/images/footer4.jpg')}}" alt="" width="72" height="72"></a>
                        </li>
                        <li><a class="instagram-item" href="{{asset('frontend/images/footer5.jpg')}}" data-fancybox="gal"><img src="{{asset('frontend/images/footer5.jpg')}}" alt="" width="72" height="72"></a>
                        </li>
                        <li><a class="instagram-item" href="{{asset('frontend/images/footer6.jpg')}}" data-fancybox="gal"><img src="{{asset('frontend/images/footer6.jpg')}}" alt="" width="72" height="72"></a>
                        </li>
                     </ul>
                  </div>
                  <!-- /.widget -->
               </div>
               <!-- /.col-lg-3 -->
               <div class="col-lg-3">
                  <div class="widget">
                     <h3>Thông tin liên lạc</h3>
                     <address>12 Chùa Bộc, Quang Trung, Đống Đa, Hà Nội</address>
                     <ul class="list-unstyled links mb-4">
                        <li><a href="tel://11234567890">0984 930 223</a></li>
                        <li><a href="mailto:info@mydomain.com">kimhuee2012@gmail.com</a></li>
                     </ul>
                  </div>
                  <!-- /.widget -->
               </div>
               <!-- /.col-lg-3 -->
            </div>
         </div>
         <!-- /.container -->
      </div>
      <!-- /.site-footer -->
      <div id="overlayer"></div>
      <div class="loader">
         <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
         </div>
      </div>
      <script src="{{asset('frontend/js/jquery-3.4.1.min.js')}}"></script>
      <script src="{{asset('frontend/js/popper.min.js')}}"></script>
      <script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
      <script src="{{asset('frontend/js/owl.carousel.min.js')}}"></script>
      <script src="{{asset('frontend/js/jquery.animateNumber.min.')}}js"></script>
      <script src="{{asset('frontend/js/jquery.waypoints.min.js')}}"></script>
      <script src="{{asset('frontend/js/jquery.fancybox.min.js')}}"></script>
      <script src="{{asset('frontend/js/jquery.sticky.js')}}"></script>
      <script src="{{asset('frontend/js/aos.js')}}"></script>
      <script src="{{asset('frontend/js/custom.js')}}"></script>
   </body>
</html>