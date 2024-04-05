<div class="dashboard_sidebar">
    <span class="close_icon">
      <i class="far fa-bars dash_bar"></i>
      <i class="far fa-times dash_close"></i>
    </span>
    <a href="{{ url('/') }}" class="dash_logo"><img src="{{ asset('uploads/logo-removebg.png') }}" alt="logo" class="img-fluid"></a>
    <ul class="dashboard_link" style="margin-top: 18px">
      <li><a class="active" href="{{ route('vendor.dashboard') }}"><i class="fas fa-tachometer"></i>Dashboard</a></li>
      <li><a href="{{ route('vendor.orders') }}"><i class="far fa-store"></i> Orders</a></li>
      <li><a href="{{ route('vendor.products.index') }}"><i class="far fa-store"></i> Products</a></li>
      <li><a href="{{ route('vendor.shop-profile.index') }}"><i class="far fa-store"></i> Shop Profile</a></li>
      <li><a href="{{ route('vendor.profile') }}"><i class="far fa-user"></i> My Profile</a></li>
      <li>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}" onclick="event.preventDefault();
            this.closest('form').submit();"><i class="far fa-sign-out-alt"></i> Log out</a>
        </form>
      </li>

    </ul>
</div>
