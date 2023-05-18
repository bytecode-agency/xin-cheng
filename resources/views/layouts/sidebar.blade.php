@guest
@else
    <aside class="sidebar vh-100 position-fixed start-0 top-0 py-3 bg-white">
        <div class="logoHead text-center w-100 mb-3">
            <img src="{{ asset('/images/logo.png') }}" alt="site-logo">
        </div>

        <nav class="sideMenu">
            <ul>
                @can('Dashboard')
                    <li {{ Request::is('home*') ? 'class=open' : '' }}>
                        <div class="menuArea">
                            <a href="{{ route('home') }}">
                                {{-- <i class="fa-solid fa-chart-pie"></i> --}}
                                {!! file_get_contents('svg/dashboard.svg') !!}
                                Dashboard
                            </a>
                        </div>
                    </li>
                @endcan
                @can('Sales Module')
                    <li {{ Request::is('sale*') ? 'class=open' : '' }}>
                        <div class="menuArea">
                            <a href="{{ route('sales.dashboard') }}">
                                {!! file_get_contents('svg/Sales _funnel.svg') !!}
                                Sales</a>
                            <span class="MenuToggle"><i class="fa-solid fa-caret-right"></i></span>
                        </div>
                        <div class="submenu">
                            <ul>
                                <li {{ Request::is('salesdashboard') ? 'style=background-color:#dcdcdc' : '' }}><a
                                        href="{{ route('sales.dashboard') }}">Dashboard</a></li>
                                <li {{ Request::is('salescreate') ? 'style=background-color:#dcdcdc' : '' }}><a
                                        href="{{ route('sales.create') }}">Add New Application</a></li>
                                <li {{ Request::is('salesshow*') ? 'style=background-color:#dcdcdc' : '' }}><a
                                        href="{{ route('sales') }}">View Applications</a></li>
                            </ul>
                        </div>
                    </li>
                @endcan
                @can('Wealth Module')
                    <li {{ Request::is('wealth*') ? 'class=open' : '' }}>
                        <div class="menuArea">
                            <a href="{{ route('wealth.dashboard') }}">
                                {!! file_get_contents('svg/wealth.svg') !!}
                                Wealth Management </a>
                            <span class="MenuToggle"><i class="fa-solid fa-caret-right"></i></span>
                        </div>
                        <div class="submenu">
                            <ul>
                                <li {{ Request::is('wealth-dashboard') ? 'style=background-color:#dcdcdc' : '' }}><a
                                        href="{{ route('wealth.dashboard') }}">Dashboard</a></li>
                                <li {{ Request::is('wealth-add') ? 'style=background-color:#dcdcdc' : '' }}><a
                                        href="{{ route('wealth.add') }}">Add New Application</a></li>
                                <li {{ Request::is('wealth-view*') ? 'style=background-color:#dcdcdc' : '' }}><a
                                        href="{{ route('wealth.index') }}">View Applications</a></li>
                            </ul>
                        </div>
                    </li>
                @endcan

                @can('Operation Module')
                    <li {{ Request::is('operation*') ? 'class=open' : '' }}>
                        <div class="menuArea">
                            <a href="{{ route('operation.dashboard') }}">
                                {!! file_get_contents('svg/operation.svg') !!}
                                Operation</a>
                            <span class="MenuToggle"><i class="fa-solid fa-caret-right"></i></span>
                        </div>
                        <div class="submenu">
                            <ul>
                                <li {{ Request::is('operation-dashboard') ? 'style=background-color:#dcdcdc' : '' }}><a href="{{ route('operation.dashboard') }}">Dashboard</a></li>
                                <li {{ Request::is('operationcreate') ? 'style=background-color:#dcdcdc' : '' }}><a
                                        href="{{ route('operation.create') }}">Add New Application</a></li>
                                <li {{ Request::is('operation-view*') ? 'style=background-color:#dcdcdc' : '' }}><a href="{{ route('operation.index') }}">View Applications</a></li>
                            </ul>
                        </div>
                    </li>
                @endcan
                @can('Education Module')
                    <li {{ Request::is('education*') ? 'class=open' : '' }}>
                        <div class="menuArea">
                            <a href="{{ route('education.dashboard') }}">
                                {!! file_get_contents('svg/education.svg') !!}
                                Education</a>
                            <span class="MenuToggle"><i class="fa-solid fa-caret-right"></i></span>
                        </div>
                        <div class="submenu">
                            <ul>
                                <li {{ Request::is('education-dashboard') ? 'style=background-color:#dcdcdc' : '' }}><a
                                        href="{{ route('education.dashboard') }}">Dashboard</a></li>
                                <li {{ Request::is('education-add') ? 'style=background-color:#dcdcdc' : '' }}><a href="{{ route('education.add') }}">Add New Application</a></li>
                                <li {{ Request::is('education-view*') ? 'style=background-color:#dcdcdc' : '' }}><a href="{{ route('education.index') }}">View Applications</a></li>
                            </ul>
                        </div>
                    </li>
                @endcan
                @can('Finance Module')

                <li {{ Request::is('finance*') ? 'class=open' : '' }}>
                        <div class="menuArea">
                            <a href="{{ route('finance.dashboard') }}">
                                {!! file_get_contents('svg/education.svg') !!}
                                Finance</a>
                            <span class="MenuToggle"><i class="fa-solid fa-caret-right"></i></span>
                        </div>
                        <div class="submenu">
                            <ul>
                                <li {{ Request::is('finance-dashboard') ? 'style=background-color:#dcdcdc' : '' }}><a
                                        href="{{ route('finance.dashboard') }}">Dashboard</a></li>
                                <li {{ Request::is('financenewapp') ? 'style=background-color:#dcdcdc' : '' }}><a href="{{ route('finance.newapp') }}">Add New Application</a></li>
                                <li {{ Request::is('financeallapps') ? 'style=background-color:#dcdcdc' : '' }}><a href="{{ route('finance.allapps') }}">View Applications</a></li>
                            </ul>
                        </div>
                    </li>
                @endcan

                <li>
                    <div class="menuArea">
                        <a href="#">
                            {!! file_get_contents('svg/notifications.svg') !!}
                            Notification
                        </a>
                    </div>
                </li>
                @can('User Module')
                    <li {{ Request::is('user*') || Request::is('roles*') ? 'class=open' : '' }}>
                        <div class="menuArea">
                            <a href="{{ route('users.index') }}">
                                {!! file_get_contents('svg/user.svg') !!}
                                User</a>
                            <span class="MenuToggle"><i class="fa-solid fa-caret-right"></i></span>
                        </div>
                        <div class="submenu">
                            <ul>
                                <li {{ Request::is('users*') ? 'style=background-color:#dcdcdc' : '' }}><a
                                        href="{{ route('users.index') }}">User Accounts</a></li>
                                <li {{ Request::is('roles*') ? 'style=background-color:#dcdcdc' : '' }}><a
                                        href="{{ route('roles.index') }}">User Roles</a></li>
                            </ul>
                        </div>
                    </li>
                @endcan
            </ul>
        </nav>
    </aside>

@endguest
