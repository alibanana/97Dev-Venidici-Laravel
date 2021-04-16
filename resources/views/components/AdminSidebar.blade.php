<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color:#2B6CAA">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin">
        <!--
        <div class="sidebar-brand-icon">
            <img src="/assets/images/admin/logo_circle.png" alt="" class="img-fluid" class="img-fluid" style="width:3vw">
        </div>
        -->
        <div class="sidebar-brand-text mx-3">Venidici</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/admin/dashboard"><i class="fas fa-fw fa-tachometer-alt"></i>Dashboard</a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Menu
    </div>
    
    <!-- Nav Item - Pages Collapse Menu -->
    @if(Request::is('admin/users') || Request::is('admin/users/*'))
    <li class="nav-item active">
    @else
    <li class="nav-item">
    @endif
        <a class="nav-link" href="/admin/users" 
            aria-expanded="true" >
            <i class="fas fa-users"></i>
            <span>Users</span>
        </a>
    </li>


    <!-- Nav Item - Pages Collapse Menu -->
    @if(Request::is('admin/woki') || Request::is('admin/woki/*'))
    <li class="nav-item active">
    @else
    <li class="nav-item">
    @endif
        <a class="nav-link" href="/admin/woki" 
            aria-expanded="true" >
            <i class="fas fa-palette"></i>
            <span>Woki</span>
        </a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    @if(Request::is('admin/online-courses') || Request::is('admin/online-courses/*'))
    <li class="nav-item active">
    @else
    <li class="nav-item">
    @endif
        <a class="nav-link" href="/admin/online-courses" 
            aria-expanded="true" >
            <i class="fas fa-graduation-cap"></i>
            <span>Online Courses</span>
        </a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    @if(Request::is('admin/bootcamp') || Request::is('admin/bootcamp/*'))
    <li class="nav-item active">
    @else
    <li class="nav-item">
    @endif
        <a class="nav-link" href="/admin/bootcamp" 
            aria-expanded="true" >
            <i class="fas fa-campground"></i>
            <span>Bootcamp</span>
        </a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    @if(Request::is('admin/community') || Request::is('admin/community/*'))
    <li class="nav-item active">
    @else
    <li class="nav-item">
    @endif
        <a class="nav-link" href="/admin/community" 
            aria-expanded="true" >
            <i class="fas fa-handshake"></i>
            <span>Community</span>
        </a>
    </li>


    <!-- Nav Item - Pages Collapse Menu -->
    @if(Request::is('admin/krest') || Request::is('admin/krest/*'))
    <li class="nav-item active">
    @else
    <li class="nav-item">
    @endif
        <a class="nav-link" href="/admin/krest" 
            aria-expanded="true" >
            <i class="fas fa-business-time"></i>
            <span>Krest</span>
        </a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    @if(Request::is('admin/mentoring') || Request::is('admin/mentoring/*'))
    <li class="nav-item active">
    @else
    <li class="nav-item">
    @endif
        <a class="nav-link" href="/admin/mentoring" 
            aria-expanded="true" >
            <i class="fas fa-people-arrows"></i>
            <span>Mentoring</span>
        </a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    @if(Request::is('admin/virtual-company-visit') || Request::is('admin/virtual-company-visit/*'))
    <li class="nav-item active">
    @else
    <li class="nav-item">
    @endif
        <a class="nav-link" href="/admin/virtual-company-visit" 
            aria-expanded="true" >
            <i class="fas fa-building"></i>
            <span>Virtual Company Visit</span>
        </a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    @if(Request::is('admin/testimonies') || Request::is('admin/testimonies/*'))
    <li class="nav-item active">
    @else
    <li class="nav-item">
    @endif
        <a class="nav-link" href="/admin/testimonies" 
            aria-expanded="true" >
            <i class="fas fa-comments"></i>
            <span>Testimonies</span>
        </a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    @if(Request::is('admin/trusted-companies') || Request::is('admin/trusted-companies/*'))
    <li class="nav-item active">
    @else
    <li class="nav-item">
    @endif
        <a class="nav-link" href="/admin/trusted-companies" 
            aria-expanded="true" >
            <i class="fas fa-user-tie"></i>
            <span>Trusted Companies</span>
        </a>
    </li>
    

    <!-- Divider -->
    <hr class="sidebar-divider">
</ul>
<!-- End of Sidebar -->