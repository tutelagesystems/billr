<nav class="navbar navbar-inverse" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ URL::route('home') }}">MyBillr</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
      <ul class="nav navbar-nav">
        <li><a href="{{ URL::route('home') }}">Home</a></li>
        <li>
            <a href="{{ URL::route('bill') }}">Bills</a>
        </li>
        <li>
            <a href="{{ URL::route('company') }}">Companies</a>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><i class="fa fa-warning"></i> 0 Notifications</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account ({{ Auth::user()->email }})<span class="caret"></span></a>

          <ul class="dropdown-menu" role="menu">
            <li><a href="{{ URL::route('settings') }}"><i class="fa fa-gear"></i> Settings</a></li>
            <li class="divider"></li>
            <li><a href="{{ URL::to('auth/logout') }}"><i class="fa fa-unlock"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container-fluid -->
</nav>