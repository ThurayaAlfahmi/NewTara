<nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
    <ul class="app-menu list-unstyled accordion" id="menu-accordion">
      
        <li class="nav-item">
      <!--//Bootstrap Icons: https://icons.getbootstrap.com/ or https://fontawesome.com/v6/search?o=r&m=free -->
      <a class="nav-link @php if($menu_active=="home"){echo "active";}else{echo "";} @endphp" href="{{ route('dashboard') }}">
        <span class="nav-icon @php if($menu_active=="home"){echo "activex";}else{echo "";} @endphp">
          <i class="fas fa-home fa-lg"></i>
        </span>
        <span class="nav-link-text @php if($menu_active=="home"){echo "activex";}else{echo "";} @endphp">الرئيسية</span>
      </a>
    </li>
    
    @if (chk_para(session('user_info')['ui_para'], $menu_active."_show")=="ok" or session('user_info')['ui_type']=="1")
        <li class="nav-item">
          <a class="nav-link @php if($menu_active=="users"){echo "active";}else{echo "";} @endphp" href="{{ route('users_info.list') }}">
            <span class="nav-icon @php if($menu_active=="users"){echo "activex";}else{echo "";} @endphp">
              <i class="fas fa-users fa-lg"></i>
            </span>
            <span class="nav-link-text @php if($menu_active=="users"){echo "activex";}else{echo "";} @endphp">المستخدمون</span>
          </a>
        </li>
    @endif 
    
    @if (chk_para(session('user_info')['myfrind'], $menu_active."_show")=="ok" or session('user_info')['ui_type']=="1")
        <li class="nav-item">
          <a class="nav-link @php if($menu_active=="myfrind"){echo "active";}else{echo "";} @endphp" href="{{ route('myfrind.list') }}">
            <span class="nav-icon @php if($menu_active=="myfrind"){echo "activex";}else{echo "";} @endphp">
              <i class="far fa-calendar-alt fa-lg"></i>
            </span>
            <span class="nav-link-text @php if($menu_active=="myfrind"){echo "activex";}else{echo "";} @endphp">الأصدقاء</span>
          </a>
        </li>
    @endif 
    
     <!-- 📍 الموقع (الخريطة) -->
     @if (chk_para(session('user_info')['location'], $menu_active."_show") == "ok" or session('user_info')['ui_type'] == "1")
     <li class="nav-item">
         <a class="nav-link @php if($menu_active=="location"){echo "active";} @endphp" href="{{ route('location.list') }}">
          <span class="nav-icon @php if($menu_active=="location"){echo "activex";}else{echo "";} @endphp">
             <i class="fas fa-map-marker-alt fa-lg"></i></span>
             <span class="nav-link-text @php if($menu_active=="location"){echo "activex";}else{echo "";} @endphp">الموقع</span>
         </a>
     </li>
    @endif 
    
      <!-- 🏎️ السيارات -->
      @if (chk_para(session('user_info')['car'],  $menu_active."_show") == "ok" or session('user_info')['ui_type'] == "1")
      <li class="nav-item">
          <a class="nav-link @php if($menu_active=="car"){echo "active";}else{echo "";} @endphp" href="{{ route('car.list') }}">
            <span class="nav-icon @php if($menu_active=="car"){echo "activex";}else{echo "";} @endphp">
                <i class="fas fa-car fa-lg"></i></span>
              <span class="nav-link-text @php if($menu_active=="car"){echo "activex";}else{echo "";} @endphp">السيارات</span>
          </a>
      </li>
    @endif 
     {{-- <!-- 📅 الحجز -->
     @if (chk_para(session('user_info')['ui_para'], "booking_show") == "ok" or session('user_info')['ui_type'] == "1")
     <li class="nav-item">
         <a class="nav-link @php if($menu_active=="booking"){echo "active";} @endphp" href="{{ route('booking.list') }}">
             <span class="nav-icon"><i class="fas fa-calendar-check fa-lg"></i></span>
             <span class="nav-link-text">الحجز</span>
         </a>
     </li>
    @endif  --}}
    
    
     {{-- <!-- 💳 الدفع -->
     @if (chk_para(session('user_info')['ui_para'], "payment_show") == "ok" or session('user_info')['ui_type'] == "1")
     <li class="nav-item">
         <a class="nav-link @php if($menu_active=="payment"){echo "active";} @endphp" href="{{ route('payment.list') }}">
             <span class="nav-icon"><i class="fas fa-credit-card fa-lg"></i></span>
             <span class="nav-link-text">الدفع</span>
         </a>
     </li>
    @endif --}}
    
    
    </ul><!--//app-menu-->
    </nav>
    
    </div>
    </div>
    <script src="{{ asset('js/menu.js') }}"></script>
    </header>
    