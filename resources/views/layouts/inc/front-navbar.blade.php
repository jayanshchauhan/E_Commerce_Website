<!-- Navbar -->


<div class="white scrolling-navbar sticky-top ">
  
      <div class="row">
           <div class="col-md-12">
              <nav style="color:black" class="navbar navbar-expand-lg ">

                <div class="container">
              
                    <!-- Left -->
                    <ul class="navbar-nav mr-auto ">
                  
                        <a style="font-size:30px;color:black" class="navbar-brand" id="temp" href="{{ url('/') }}">JAYKART</a>
                      
                      <a class="navbar-brand waves-effect" href="{{ url('/') }}" target="_blank">
                      <img src= {{url('images/logo.png')}} alt="Trulli" width="50" height="50">
                    </a>
                    </ul>
              
                    
                    <ul class="navbar-nav ml-auto ">
                      <!-- Right -
                      <li class="nav-item">
                        <a style="color:black" class="nav-link waves-effect" href="#">Home
                          <span class="sr-only">(current)</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a style="color:black" class="nav-link waves-effect" href="#" target="_blank">Collections</a>
                      </li>
                      <li class="nav-item">
                        <a style="color:black" class="nav-link waves-effect" href="#" target="_blank">All Products</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link waves-effect">
                          <span class="badge red z-depth-1 mr-1"> 1 </span>
                          <i class="fas fa-shopping-cart"></i>
                          <span class="clearfix d-none d-sm-inline-block"> Cart </span>
                        </a>
                      </li>
              -->
                      <!-- Authentication Links -->
                      @if (Auth::guest())
                              <li class="nav-item"><a style="color:black" class="nav-link" href="{{ route('login') }}">Login</a></li>
                              <li class="nav-item"><a style="color:black" class="nav-link" href="{{ route('register') }}">Register</a></li>
                      @else
                          <li class="nav-item dropdown">
                              <a style="color:black" id="navbarDropdown" href="#" class="nav-link border border-light rounded waves-effect dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                  {{ Auth::user()->name.' '.Auth::user()->lname}} <span class="caret"></span>
                              </a>
              
                              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              
                                  <a style="color:black" class="dropdown-item" href="{{url('my-profile')}}">
                                    My Profile
                                  </a>
              
                                  <a style="color:black" class="dropdown-item" href="{{ route('logout') }}"
                                      onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                      Logout
                                  </a>
              
                                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                      {{ csrf_field() }}
                                  </form>
                              </div>
                          </li>
                      @endif
              
                    </ul>
              
                  </div>
              
                </div>
              </nav>
           </div>
      </div>
      <div class="row">
          <div class="col-md-12 py-2 bg-info shadow">
           @php
           $group = App\Models\Groups::where('status', '!=','2')->get();
           @endphp
           @foreach ($group as $group_nav_item)
                <a href="{{url('collection/'. $group_nav_item->url) }}" class="px-4 text-white">{{ $group_nav_item->name }}</a>
           @endforeach
           </div>
      </div>

</div>
  <!-- Navbar -->



