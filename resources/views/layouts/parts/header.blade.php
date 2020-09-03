  <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="{{url('/')}}" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{asset('storage/assets/images/logo-crm.svg')}}" alt="" height="30">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{asset('storage/assets/images/logo-crm.svg')}}" alt="" height="70">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                            <i class="mdi mdi-backburger"></i>
                        </button>
                    </div>

                    <div class="d-flex">
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" role="button" id="page-header-flag-dropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ __('dashboard.switch_language') }}
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="{{ route('localization.switch', 'id') }}" class="dropdown-item notify-item {{ app()->getLocale() == 'id' ? 'active' : '' }}">
                                    <img src="{{asset('storage/assets/images/flags/indo.png')}}" alt="user-image" class="mr-2" height="12"><span class="align-middle">Indonesia</span>
                                </a>
                                <a href="{{ route('localization.switch', 'en') }}" class="dropdown-item notify-item {{ app()->getLocale() == 'en' ? 'active' : '' }}">
                                    <img src="{{asset('storage/assets/images/flags/english.png')}}" alt="user-image" class="mr-2" height="12"><span class="align-middle">English</span>
                                </a>
                                
                            </div>
                        </div>
                        <div class="dropdown d-inline-block d-lg-none ml-2">
                            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-magnify"></i>
                            </button>
                        </div>
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{asset('storage/assets/images/users/default.png')}}" alt="" class="rounded-circle header-profile-user" alt="Header Avatar">
                                <span class="d-none d-sm-inline-block ml-1">{{Auth::user()->username}}</span>
                                <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"><i class="mdi mdi-logout font-size-16 align-middle mr-1"></i> @lang('dashboard.header-logout')</a>
                                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                  </form>
                            </div>
                        </div>

                    </div>
                </div>

            </header>
