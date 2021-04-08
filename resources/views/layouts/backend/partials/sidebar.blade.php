<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">Dashboards</li>
                <li>
                    @if(Auth::user()->hasPermission('app.dashboard'))
                    <a href="{{ route('app.dashboard') }}" class="{{ Route::is('app.dashboard') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Dashboard
                    </a>
                    @endif
                </li>

                <li>
                    @if(Auth::user()->hasPermission('app.roles.index'))
                        <a href="{{ route('app.roles.index') }}" class="{{ Request::is('app/roles*') ? 'mm-active' : '' }}">
                            <i class="metismenu-icon pe-7s-check"></i>
                            Roles
                        </a>
                    @endif
                </li>

                <li>
                    @if(Auth::user()->hasPermission('app.users.index'))
                        <a href="{{ route('app.users.index') }}" class="{{ Request::is('app/users*') ? 'mm-active' : '' }}">
                            <i class="metismenu-icon pe-7s-users"></i>
                            Users
                        </a>
                    @endif
                </li>

                <li>
                    @if(Auth::user()->hasPermission('app.backups.index'))
                        <a href="{{ route('app.backups.index') }}" class="{{ Request::is('app/backups*') ? 'mm-active' : '' }}">
                            <i class="metismenu-icon pe-7s-cloud"></i>
                            Backups
                        </a>
                    @endif
                </li>






            </ul>
        </div>
    </div>
</div>
