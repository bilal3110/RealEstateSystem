<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" style="height: auto">
    <div class="app-brand demo">
        <a href="{{route('analytics')}}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img width="65px" src="{{ asset('storage/' . $business->logo) }}" alt="">
            </span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item open">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Dashboards">Dashboards</div>
                <div class="badge bg-danger rounded-pill ms-auto"></div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('analytics') }}" class="menu-link">
                        <div data-i18n="Analytics">Analytics</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('showSpending') }}" class="menu-link">
                        <div data-i18n="Analytics">Spendings</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('showSeekers') }}" class="menu-link">
                        <div data-i18n="Analytics">Property Seekers</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Pages</span>
        </li>
        <!-- Pages -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Property Management</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('r-show') }}" id="rentBtn" class="menu-link">
                        <div data-i18n="Rent">Rent</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('showSale') }}" class="menu-link">
                        <div data-i18n="Sale">Sale</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('showInvestment') }}" class="menu-link">
                        <div data-i18n="Investment">Investment</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
                <div data-i18n="Account Settings">Account Settings</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('registerPage') }}" class="menu-link" target="_blank">
                        <div data-i18n="Basic">Add New Admin</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('businessDetails') }}" class="menu-link">
                        <div data-i18n="Account">Business Details</div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>
