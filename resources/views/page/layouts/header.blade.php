  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center fixed-top">
      <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

          <a href="index.html" class="logo d-flex align-items-center">
              <!-- Uncomment the line below if you also wish to use an image logo -->
              <!-- <img src="assets/img/logo.png" alt=""> -->
              <h1 class="d-flex align-items-center">
                  <img src="landingassets/img/Unla.png" alt="" width="35px" srcset="">
                  LPPM UNLA
              </h1>
          </a>

          <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
          <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

          <nav id="navbar" class="navbar">
              <ul>
                  <li><a href="#home" class="active">Home</a></li>
                  <li><a href="about.html">About</a></li>
                  <li><a href="services.html">Contact</a></li>
                  @auth
                      <li class="dropdown">
                          <a href="#">
                              {{ Auth::user()->name }}
                          </a>
                          <ul>
                              <li><a href="/admin">Dashboard</a></li>
                              <li><a href="{{ route('logout') }}">Logout</a></li>
                          </ul>
                      </li>
                  @else
                      <li>
                          <a href="/login">
                              <div class="hstack gap-1">
                                  <span>Login</span>
                                  <i class="bi bi-box-arrow-in-left fs-5"></i>
                              </div>
                          </a>
                      </li>
                  @endauth

              </ul>
          </nav><!-- .navbar -->

      </div>
  </header><!-- End Header -->
