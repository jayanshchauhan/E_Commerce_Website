 <!-- Sidebar -->
 <div class="sidebar-fixed position-fixed">

    <a style="padding-top:30px;padding-bottom:30px" class="navbar-brand waves-effect" href="{{ url('/dashboard') }}" >
      <img src= {{url('images/logo.png')}} alt="Trulli" width="200px" height="100px">
    </a>

    <div class="list-group list-group-flush">
      <a href="{{url('/dashboard')}}" class="list-group-item active waves-effect">
        <i class="fa fa-pie-chart mr-3"></i>ADMIN PORTAL
      </a>
      <a style="padding-top:30px" href="{{url('my-profile')}}" class="list-group-item list-group-item-action waves-effect">
        <i class="fa fa-user mr-3"></i>My Profile
      </a>

      <a href="{{url('registered-user')}}" class="list-group-item list-group-item-action waves-effect">
        <i class="fa fa-users mr-3"></i>Registered Users
      </a>
    </div>

        <button class="dropdown list-group-item list-group-item-action waves-effect dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-list mr-3"></i>Collection
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="{{url('/group')}}">Groups</a>
          <a class="dropdown-item" href="{{url('/category')}}">Category</a>
          <a class="dropdown-item" href="{{url('/sub-category')}}">Sub-Category</a>
          <a class="dropdown-item" href="{{url('/products')}}">Product (Items)</a>
     
  </div>
  <!-- Sidebar -->