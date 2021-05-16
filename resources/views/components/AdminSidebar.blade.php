<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color:#2B6CAA">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin/dashboard">
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
    @if(Request::is('admin/dashboard') || Request::is('admin/dashboard'))
    <li class="nav-item active">
    @else
    <li class="nav-item">
    @endif
        <a class="nav-link" href="{{ route('admin.dashboard.index') }}"><i class="fas fa-fw fa-tachometer-alt"></i>Dashboard</a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Menu
    </div>
    
    <!-- Nav Item - Pages Collapse Menu -->
    @if(Request::is('admin/cms') || Request::is('admin/cms/*'))
    <li class="nav-item active">
    @else
    <li class="nav-item">
    @endif
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCMS"
            aria-expanded="true" aria-controls="collapseCMS">
            <i class="fas fa-images fa-cog"></i>
            <span>CMS</span>
        </a>
        <div id="collapseCMS" class="collapse" aria-labelledby="headingTwo" data-parent="#collapseCMS">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="/admin/cms/homepage">Home Page</a>
            </div>
        </div>
    </li>
    
    <!-- Nav Item - Pages Collapse Menu -->
    @if(Request::is('admin/analytics') || Request::is('admin/analytics/*'))
    <li class="nav-item active">
    @else
    <li class="nav-item">
    @endif
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAnalytics"
            aria-expanded="true" aria-controls="collapseAnalytics">
            <i class="fas fa-chart-line"></i>
            <span>Analytics</span>
        </a>
        <div id="collapseAnalytics" class="collapse" aria-labelledby="headingTwo" data-parent="#collapseAnalytics">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="/admin/analytics/online-course">Online Course</a>
                <a class="collapse-item" href="/admin/cms/homepage">Woki</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    @if(Request::is('admin/users') || Request::is('admin/users/*'))
    <li class="nav-item active">
    @else
    <li class="nav-item">
    @endif
        <a class="nav-link" href="{{ route('admin.users.index') }}" 
            aria-expanded="true" >
            <i class="fas fa-users"></i>
            <span>Users</span>
        </a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    @if(Request::is('admin/online-courses') || Request::is('admin/online-courses/*') || Request::is('admin/course-categories') ||
    Request::is('admin/course-categories/*') || Request::is('admin/teachers') || Request::is('admin/teachers/*')|| 
    Request::is('admin/assessments') || Request::is('admin/assessments/*'))
    <li class="nav-item active">
    @else
    <li class="nav-item">
    @endif
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCourse"
            aria-expanded="true" aria-controls="collapseCourse">
            <i class="fas fa-graduation-cap"></i>
            <span>Online Courses</span>
        </a>
        <div id="collapseCourse" class="collapse" aria-labelledby="headingTwo" data-parent="#collapseCourse">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.online-courses.index') }}">Online Courses</a>
                <a class="collapse-item" href="{{ route('admin.course-categories.index') }}">Course Categories</a>
                <a class="collapse-item" href="{{ route('admin.assessments.index') }}">Assesments</a>
                <a class="collapse-item" href="{{ route('admin.teachers.index') }}">Teachers</a>
                <a class="collapse-item" href="/admin/reviews">Reviews</a>

            </div>
        </div>
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
    @if(Request::is('admin/hashtags') || Request::is('admin/hashtags/*'))
    <li class="nav-item active">
    @else
    <li class="nav-item">
    @endif
        <a class="nav-link" href="/admin/hashtags" 
            aria-expanded="true" >
            <i class="fas fa-hashtag"></i>
            <span>Hashtags</span>
        </a>
    </li>

   

    <!-- Nav Item - Pages Collapse Menu 
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
    -->

  

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

    <!-- Nav Item - Pages Collapse Menu
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
     -->

    <!-- Nav Item - Pages Collapse Menu -->
    @if(Request::is('admin/virtual-company-visit') || Request::is('admin/virtual-company-visit/*'))
    <li class="nav-item active">
    @else
    <li class="nav-item">
    @endif
        <a class="nav-link" href="/admin/virtual-company-visit" 
            aria-expanded="true" >
            <i class="fas fa-building"></i>
            <span>Virtual Workshop</span>
        </a>
    </li>

    <!-- Nav Item - Pages Collapse Menu
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
    -->


    
    <!-- Nav Item - Pages Collapse Menu -->
    @if(Request::is('admin/promo') || Request::is('admin/promo/*'))
    <li class="nav-item active">
    @else
    <li class="nav-item">
    @endif
        <a class="nav-link" href="/admin/promo" 
            aria-expanded="true" >
            <i class="fas fa-tags"></i>
            <span>Promo</span>
        </a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    @if(Request::is('admin/newsletter') || Request::is('admin/newsletter/*'))
    <li class="nav-item active">
    @else
    <li class="nav-item">
    @endif
        <a class="nav-link" href="/admin/newsletter" 
            aria-expanded="true" >
            <i class="fas fa-newspaper"></i>
            <span>Newsletter</span>
        </a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    @if(Request::is('admin/information') || Request::is('admin/information/*'))
    <li class="nav-item active">
    @else
    <li class="nav-item">
    @endif
        <a class="nav-link" href="/admin/information" 
            aria-expanded="true" >
            <i class="fas fa-info"></i>
            <span>Information</span>
        </a>
    </li>

    <!-- Nav Item - Pages Collapse Menu
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
     -->

    <!-- Divider -->
    <hr class="sidebar-divider">
</ul>
<!-- End of Sidebar -->