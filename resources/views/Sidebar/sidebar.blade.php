<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">

        <div class="sidebar-brand-text">Financial</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <a class="nav-link " href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Partner Investment
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ request()->routeIs('partner.*') ? 'active' : '' }}">
        <a class="nav-link collapsed " href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="far fa-user"></i>
            <span>Partner</span>
        </a>
        <div id="collapseTwo" class="collapse {{ request()->routeIs('partner.*') ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Partner:</h6>
                <a class="collapse-item {{ request()->routeIs('partner.create') ? 'active' : '' }}" href="{{route('partner.create')}}">Add</a>
                <a class="collapse-item {{ request()->routeIs('partner.index') ? 'active' : '' }}" href="{{route('partner.index')}}">Show</a>
            </div>
        </div>
    </li>

    <li class="nav-item {{ request()->routeIs('invest.index') ? 'active' : '' }}">
        <a class="nav-link " href="{{route('invest.index')}}">
            <i class="fas fa-money-check-alt"></i>
            <span>Invest</span></a>
        </a>

    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Income
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ request()->routeIs('incomecategory.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('incomecategory.index')}}">
            <span>Income Category</span></a>
        </a>

    </li>

    <li class="nav-item {{ request()->routeIs('incometitle.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('incometitle.index')}}">
            <span>Income Title</span>
        </a>

    </li>

    <li class="nav-item {{ request()->routeIs('incame.*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsemain"
            aria-expanded="true" aria-controls="collapseTwo">
            <span>Income</span>
        </a>
        <div id="collapsemain" class="collapse {{ request()->routeIs('incame.*') ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Incom:</h6>
                <a class="collapse-item {{ request()->routeIs('incame.create') ? 'active' : '' }}" href="{{route('incame.create')}}">Add</a>
                <a class="collapse-item {{ request()->routeIs('incame.index') ? 'active' : '' }}" href="{{route('incame.index')}}">Show</a>
            </div>
        </div>
    </li>
    <div class="sidebar-heading">
        Expense
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ request()->routeIs('expenscategory.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('expenscategory.index')}}">
            <span>Expense Category</span></a>
        </a>

    </li>

    <li class="nav-item {{ request()->routeIs('expenstitle.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('expenstitle.index')}}">
            <span>Expense Title</span>
        </a>

    </li>

    <li class="nav-item {{ request()->routeIs('expense.*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseexpen"
            aria-expanded="true" aria-controls="collapseTwo">
            <span>Expense</span>
        </a>
        <div id="collapseexpen" class="collapse {{ request()->routeIs('expense.*') ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Expense:</h6>
                <a class="collapse-item {{ request()->routeIs('expense.create') ? 'active' : '' }}" href="{{route('expense.create')}}">Add</a>
                <a class="collapse-item {{ request()->routeIs('expense.index') ? 'active' : '' }}" href="{{route('expense.index')}}">Show</a>
            </div>
        </div>
    </li>


    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Report
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ request()->routeIs('income.report.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('income.report.index')}}">
            <span>Income Report</span></a>
        </a>

    </li>

    <li class="nav-item {{ request()->routeIs('expenses.report.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('expenses.report.index')}}">
            <span>Expense Report</span>
        </a>

    </li>
    <li class="nav-item {{ request()->routeIs('report.partner.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('report.partner.index')}}">
            <span>Partner Report</span>
        </a>

    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
