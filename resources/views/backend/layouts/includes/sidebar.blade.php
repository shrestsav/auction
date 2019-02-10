
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="https://dummyimage.com/200x200/000/fff.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="@if ($title === 'Dashboard') active @endif"><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
        </li>
        <li class="header">LABELS</li>
        <li class="treeview">
          <a href="#"><i class="fa fa-user-circle-o text-green"></i><span>Vendors</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="@if ($title === 'Vendors') active @endif">
              <a href="{{route('vendors.index')}}"><i class="fa fa-circle-o text-blue"></i> 
                <span>List All</span>
              </a>
            </li>
            <li class="@if ($title === 'Stocks') active @endif">
              <a href="{{route('stocks.index')}}"><i class="fa fa-circle-o text-red"></i> 
                <span>Stock</span>
              </a>
            </li>
          </ul>
        </li>
        <li class="@if ($title === 'Buyers') active @endif"><a href="{{route('buyers.index')}}"><i class="fa fa-user-circle text-yellow"></i> <span>Buyers</span></a></li>
        <li class="@if ($title === 'Auctions') active @endif"><a href="{{route('auctions.index')}}"><i class="fa fa-handshake-o text-aqua"></i> <span>Auction</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
