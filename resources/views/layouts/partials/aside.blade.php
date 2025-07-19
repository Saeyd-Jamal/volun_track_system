<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo" style="overflow: visible">
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

        <li class="menu-header small">
            <span class="menu-header-text" data-i18n="Apps &amp; Pages">الأساسيات</span>
        </li>
        @can('view', 'App\\Models\\Specialization')
            <li
                class="menu-item {{ request()->is('specializations/*') || request()->is('specializations') ? 'active' : '' }}">
                <a href="{{ route('dashboard.specializations.index') }}" class="menu-link">
                    <i class="fa-solid fa-list me-2"></i>
                    <div data-i18n="users">التخصصات</div>
                </a>
            </li>
        @endcan
        <li class="menu-item">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div data-i18n="Dashboards">قائمة الطلبات</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('dashboard.reviewers.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons ti ti-chart-pie-2"></i>
                        <div data-i18n="Analytics">جميع الطلبات</div>
                    </a>
                </li>
                @if (Auth::user()->role == 'admin')
                    <li class="menu-item">
                        <a href="{{ route('dashboard.reviewers.index', ['status' => 'approved']) }}" class="menu-link">
                            <i class="menu-icon tf-icons ti ti-chart-pie-2"></i>
                            <div data-i18n="Analytics">المقبولة</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('dashboard.reviewers.index', ['status' => 'rejected']) }}" class="menu-link">
                            <i class="menu-icon tf-icons ti ti-chart-pie-2"></i>
                            <div data-i18n="Analytics">المرفوضة</div>
                        </a>
                    </li>
                @endif
            </ul>
        </li>

        <li class="menu-header small">
            <span class="menu-header-text" data-i18n="Apps &amp; Pages">الإعدادات</span>
        </li>
        @can('view', 'App\\Models\\User')
            <li class="menu-item {{ request()->is('users/*') || request()->is('users') ? 'active' : '' }}">
                <a href="{{ route('dashboard.users.index') }}" class="menu-link">
                    <i class="fa-solid fa-users me-2"></i>
                    <div data-i18n="users">المستخدمين</div>
                </a>
            </li>
            <li class="menu-item {{ request()->is('logs/*') || request()->is('logs') ? 'active' : '' }}">
                <a href="{{ route('dashboard.logs.index') }}" class="menu-link">
                    <i class="fa-solid fa-history me-2"></i>
                    <div data-i18n="users">سجل الأنشطة</div>
                </a>
            </li>
        @endcan
        @can('view', 'App\\Models\\Constants')
            <li class="menu-item {{ request()->is('constants/*') || request()->is('constants') ? 'active' : '' }}">
                <a href="{{ route('dashboard.constants.edit') }}" class="menu-link">
                    <i class="fa-solid fa-cog me-2"></i>
                    <div data-i18n="users">الثوابت</div>
                </a>
            </li>
        @endcan
        <li class="menu-item {{ request()->is('constants/*') || request()->is('constants') ? 'active' : '' }}">
            <a href="{{ route('dashboard.form-settings.edit') }}" class="menu-link">
                <i class="fa-solid fa-gear me-2"></i>
                <div data-i18n="users">الاعدادات</div>
            </a>
        </li>
    </ul>
</aside>
