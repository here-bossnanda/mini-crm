 <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">
                <div data-simplebar class="h-100">
                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title">Menu</li>
                            <li>
                                <a href="{{url('/')}}" class="waves-effect">
                                    <div class="d-inline-block icons-sm mr-1"><i class="uim uim-airplay"></i></div>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('company.index')}}" class="waves-effect">
                                    <div class="d-inline-block icons-sm mr-1"><i class="uim uim-layer-group"></i></div>
                                    <span>@lang('dashboard.sidebar-company')</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('employee.index')}}" class="waves-effect">
                                    <div class="d-inline-block icons-sm mr-1"><i class="uim uim-sign-in-alt"></i></div>
                                    <span>@lang('dashboard.sidebar-employee')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->
