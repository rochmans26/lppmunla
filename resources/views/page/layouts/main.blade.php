<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>{{ $title }}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="landingassets/img/Unla.png" rel="icon">
    <link href="landingassets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="landingassets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="landingassets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="landingassets/vendor/aos/aos.css" rel="stylesheet">
    <link href="landingassets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="landingassets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="landingassets/vendor/remixicon/remixicon.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="landingassets/css/main.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Nova - v1.3.0
  * Template URL: https://bootstrapmade.com/nova-bootstrap-business-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="page-index">
    @include('page.layouts.header')
    <!-- ======= Hero Section ======= -->
    @include('page.layouts.hero')
    <!-- End Hero Section -->

    <main id="main">
        @yield('content')
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    @include('page.layouts.footer')
    <!-- End Footer -->
    <!-- End Footer -->

    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="landingassets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="landingassets/vendor/aos/aos.js"></script>
    <script src="landingassets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="landingassets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="landingassets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="landingassets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="landingassets/js/main.js"></script>

</body>

</html>
