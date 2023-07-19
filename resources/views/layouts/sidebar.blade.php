<!--sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Synadmin</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-first-page'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">

        <li class="menu-label">Main</li>

        @if (auth()->user()->hasRole('Administrator'))
        <li>
            <a href="{{ route('admin.dashboard')}}">
                <div class="parent-icon"><i class='bx bx-home'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

        <li>
            <a href="{{ route('admin.users')}}">
                <div class="parent-icon"><i class='bx bx-home'></i>
                </div>
                <div class="menu-title">Users</div>
            </a>
        </li>

        <li>
            <a href="{{ route('buses.index')}}">
                <div class="parent-icon"><i class='bx bx-home'></i>
                </div>
                <div class="menu-title">Buses</div>
            </a>
        </li>

        <li>
            <a href="{{ route('trip_routes.index')}}">
                <div class="parent-icon"><i class='bx bx-home'></i>
                </div>
                <div class="menu-title">Trip Routes</div>
            </a>
        </li>

        <li>
            <a href="{{ route('trip_fares.index')}}">
                <div class="parent-icon"><i class='bx bx-home'></i>
                </div>
                <div class="menu-title">Trip Fares</div>
            </a>
        </li>

        <li>
            <a href="{{ route('bookings.index')}}">
                <div class="parent-icon"><i class='bx bx-home'></i>
                </div>
                <div class="menu-title">Bookings</div>
            </a>
        </li>

        {{-- <li>
            <a href="{{ route('payments.index')}}">
                <div class="parent-icon"><i class='bx bx-home'></i>
                </div>
                <div class="menu-title">Payments</div>
            </a>
        </li> --}}


        @elseif (auth()->user()->hasRole('User'))

        <li>
            <a href="{{ route('user.dashboard')}}">
                <div class="parent-icon"><i class='bx bx-home'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

       


        @endif

    </ul>
    <!--end navigation-->
</div>
<!--end sidebar wrapper -->
