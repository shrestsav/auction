
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('backend/img/user_default.png') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
 {{--      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> --}}
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">

        <li class="header">MAIN NAVIGATION</li>

        <li class="@if ($title === 'Dashboard') active @endif"><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
        </li>
        <li class="@if ($title === 'Settings') active @endif"><a href="{{route('adjustments.index')}}"><i class="fa fa-cog text-white"></i><span> Adjustments</span></a></li>

        <li class="header">OPERATIONS</li>

        <li class="treeview">
          <a href="#"><i class="fa fa-user-circle-o text-green"></i><span>Vendors</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="@if ($title === 'Vendors') active @endif">
              <a href="{{route('vendors.index')}}"><i class="fa fa-circle-o text-blue"></i> 
                <span>Add / List All</span>
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
        <li class="@if ($title === 'Auctions') active @endif"><a href="{{route('auctions.index')}}"><i class="fa fa-plus-circle text-aqua"></i><span> Auctions</span></a></li>
        
        
        <li class="@if ($title === 'Lotting') active @endif"><a href="{{route('lotting.index')}}"><i class="fa fa-lock text-red"></i> <span>Lotting</span></a></li>
        <li class="@if ($title === 'Auction') active @endif"><a href="{{route('auction_event.index')}}"><i class="fa fa-gavel text-aqua"></i><span> Sale</span></a></li>
        
        <li class="header">REPORTS</li>

        <li class="@if ($title === 'Total Sale') active @endif"><a href="{{route('reports.sales')}}"><i class="fa fa-shopping-cart text-yellow"></i><span>Total Sale</span></a></li>
        <li class="@if ($title === 'Invoices') active @endif"><a href="{{route('reports.invoices')}}"><i class="fa fa-print text-aqua"></i><span>Print Invoices</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
