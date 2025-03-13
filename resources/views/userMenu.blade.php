<nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
    <ul class="app-menu list-unstyled accordion" id="menu-accordion">
      
        <li class="nav-item">
            <a class="nav-link @php if($menu_active=="home"){echo "active";}else{echo "";} @endphp" href="{{ route('dashboard') }}">
                <span class="nav-icon @php if($menu_active=="home"){echo "activex";}else{echo "";} @endphp">
                    <i class="fas fa-home fa-lg"></i>
                </span>
                <span class="nav-link-text @php if($menu_active=="home"){echo "activex";}else{echo "";} @endphp">الرئيسية</span>
            </a>
        </li>
        
        <!-- 📍 البحث عن السيارات -->
        <li class="nav-item">
            <a class="nav-link @php if($menu_active=="search"){echo "active";}else{echo "";} @endphp" href="{{ route('search.cars') }}">
                <span class="nav-icon @php if($menu_active=="search"){echo "activex";}else{echo "";} @endphp">
                    <i class="fas fa-search fa-lg"></i>
                </span>
                <span class="nav-link-text @php if($menu_active=="search"){echo "activex";}else{echo "";} @endphp">البحث عن السيارات</span>
            </a>
        </li>
        
        <!-- 🏎️ السيارات المتاحة -->
        <li class="nav-item">
            <a class="nav-link @php if($menu_active=="available_cars"){echo "active";}else{echo "";} @endphp" href="{{ route('user.cars') }}">
                <span class="nav-icon @php if($menu_active=="available_cars"){echo "activex";}else{echo "";} @endphp">
                    <i class="fas fa-car fa-lg"></i>
                </span>
                <span class="nav-link-text @php if($menu_active=="available_cars"){echo "activex";}else{echo "";} @endphp">السيارات المتاحة</span>
            </a>
        </li>
        
    </ul><!--//app-menu-->
</nav>
