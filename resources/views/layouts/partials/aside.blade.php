<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo"  style="overflow: visible">
        <a href="{{ route('dashboard.home') }}" class="app-brand-link">
            <span class="app-brand-logo demo" style="overflow: visible">
                <img src=" {{ asset('imgs/favicon.ico') }}" alt="Logo" width="60">
            </span>
            {{-- <span class="app-brand-text demo menu-text fw-bold">{{ $title }}</span> --}}
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="align-middle ti menu-toggle-icon d-none d-xl-block"></i>
            <i class="align-middle ti ti-x d-block d-xl-none ti-md"></i>
        </a>
    </div>
    <div class="menu-inner-shadow"></div>
    <ul class="py-1 menu-inner">
        <li class="menu-header small">
            <span class="menu-header-text" data-i18n="Apps &amp; Pages">العامة</span>
        </li>
        <!-- Page -->
        <li class="menu-item {{ request()->is('/') ? 'active' : '' }}">
            <a href="{{ route('dashboard.home') }}" class="menu-link">
                <i class="fa-solid fa-house me-2"></i>
                <div data-i18n="home">الرئيسية</div>
            </a>
        </li>
        @can('view', 'App\\Models\\User')
        <li class="menu-item {{ request()->is('users/*') || request()->is('users') ? 'active' : '' }}">
            <a href="{{ route('dashboard.users.index') }}" class="menu-link">
                <i class="fa-solid fa-users me-2"></i>
                <div data-i18n="users">المستخدمين</div>
            </a>
        </li>
        @endcan
        @can('view', 'App\\Models\\Specialization')
        <li class="menu-item {{ request()->is('specializations/*') || request()->is('specializations') ? 'active' : '' }}">
            <a href="{{ route('dashboard.specializations.index') }}" class="menu-link">
                <i class="fa-solid fa-list me-2"></i>
                <div data-i18n="users">التخصصات</div>
            </a>
        </li>
        @endcan

        <li class="menu-item {{ request()->is('reviewers/*') || request()->is('reviewers') ? 'active' : '' }}">
            <a href="{{ route('dashboard.reviewers.index') }}" class="menu-link">
                <i class="fa-solid fa-list me-2"></i>
                <div data-i18n="users">قائمة الطلبات</div>
            </a>
        </li>
        @can('view', 'App\\Models\\Constants')
        <li class="menu-item {{ request()->is('constants/*') || request()->is('constants') ? 'active' : '' }}">
            <a href="{{ route('dashboard.constants.index') }}" class="menu-link">
                <i class="fa-solid fa-list me-2"></i>
                <div data-i18n="users">الثوابت</div>
            </a>
        </li>
        @endcan
        {{-- <li class="menu-item">
            <a href="page-2.html" class="menu-link">
                <i class="menu-icon tf-icons ti ti-app-window"></i>
                <i class="fa-solid fa-house me-2"></i>
                <div data-i18n="Page 2">Page 2</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div data-i18n="Dashboards">Dashboards</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="index.html" class="menu-link">
                        <i class="menu-icon tf-icons ti ti-chart-pie-2"></i>
                        <div data-i18n="Analytics">Analytics</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="dashboards-crm.html" class="menu-link">
                        <i class="menu-icon tf-icons ti ti-3d-cube-sphere"></i>
                        <div data-i18n="CRM">CRM</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="app-ecommerce-dashboard.html" class="menu-link">
                        <i class="menu-icon tf-icons ti ti-shopping-cart"></i>
                        <div data-i18n="eCommerce">eCommerce</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="app-logistics-dashboard.html" class="menu-link">
                        <i class="menu-icon tf-icons ti ti-truck"></i>
                        <div data-i18n="Logistics">Logistics</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="app-academy-dashboard.html" class="menu-link">
                        <i class="menu-icon tf-icons ti ti-book"></i>
                        <div data-i18n="Academy">Academy</div>
                    </a>
                </li>
            </ul>
        </li> --}}
    </ul>
</aside>
