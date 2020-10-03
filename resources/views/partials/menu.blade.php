<div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav">
        {{-- <li class="nav-item">
            <a href="{{ route("admin.home") }}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li> --}}
        @can('modul_item_access')
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="download">
                <i class="nav-icon fas fa-cubes"></i> 
                {{ trans('cruds.itemManagement.title') }} <span class="caret"></span></a>
            <div class="dropdown-menu" aria-labelledby="download">
                @can('item_category_access')
                <a href="{{ route("admin.item-category.index") }}" class="dropdown-item {{ request()->is('admin/item-category') || request()->is('admin/item-category/*') ? 'active' : '' }}">
                    {{-- <i class="fas fa-building nav-icon">

                    </i> --}}
                    {{ trans('cruds.item-category.title') }}
                </a>
                @endcan
                @can('item_unit_access')
                <a href="{{ route("admin.item-unit.index") }}" class="dropdown-item {{ request()->is('admin/item-unit') || request()->is('admin/item-unit/*') ? 'active' : '' }}">
                    {{-- <i class="fas fa-building nav-icon">

                    </i> --}}
                    {{ trans('cruds.item-unit.title') }}
                </a>
                @endcan
                @can('item_access')
                <a href="{{ route("admin.item.index") }}" class="dropdown-item {{ request()->is('admin/item') || request()->is('admin/item/*') ? 'active' : '' }}">
                    {{-- <i class="fas fa-building nav-icon">

                    </i> --}}
                    {{ trans('cruds.item.title') }}
                </a>
                @endcan
            </div>
        </li>
        @endcan
        @can('modul_transaction_access')
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="download">
                <i class="nav-icon fas fa-money"></i> 
                {{ trans('cruds.transactionManagement.title') }} <span class="caret"></span></a>
            <div class="dropdown-menu" aria-labelledby="download">
                @can('transaction_access')
                <a href="{{ route("admin.transaksi.index") }}" class="dropdown-item {{ request()->is('admin/transaksi') || request()->is('admin/transaksi/*') ? 'active' : '' }}">
                    {{-- <i class="fas fa-building nav-icon">

                    </i> --}}
                    {{ trans('cruds.transaction-stock.title') }}
                </a>
                @endcan
            </div>
        </li>
        @endcan
        @can('modul_master_access')
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="download">
                <i class="nav-icon fas fa-database"></i> {{ trans('cruds.masterManagement.title') }} <span class="caret"></span>
            </a>
            <div class="dropdown-menu" aria-labelledby="download">
                @can('gudang_access')
                <a href="{{ route("admin.gudang.index") }}" class="dropdown-item {{ request()->is('admin/gudang') || request()->is('admin/gudang/*') ? 'active' : '' }}">
                    <i class="fas fa-building nav-icon">

                    </i>
                    {{ trans('cruds.warehouse.title') }}
                </a>
                @endcan
                @can('supplier_access')
                <a href="{{ route("admin.supplier.index") }}" class="dropdown-item {{ request()->is('admin/supplier') || request()->is('admin/supplier/*') ? 'active' : '' }}">
                    <i class="fas fa-truck nav-icon">

                    </i>
                    {{ trans('cruds.suppliers.title') }}
                </a>
                @endcan
                @can('customer_access')
                <a href="{{ route("admin.customer.index") }}" class="dropdown-item {{ request()->is('admin/customer') || request()->is('admin/customer/*') ? 'active' : '' }}">
                    <i class="fas fa-users nav-icon">

                    </i>
                    {{ trans('cruds.customer.title') }}
                </a>
                @endcan
            </div>
        </li>
        @endcan
        @can('modul_setting_access')
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="download">
                <i class="nav-icon fas fa-gear"></i> 
                {{ trans('global.setting') }} <span class="caret"></span>
            </a>
            <div class="dropdown-menu" aria-labelledby="download">
                <a href="{{ route("admin.permissions.index") }}" class="dropdown-item {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                    <i class="fas fa-unlock-alt nav-icon">

                    </i>
                    {{ trans('cruds.permission.title') }}
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route("admin.roles.index") }}" class="dropdown-item {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                    <i class="fas fa-briefcase nav-icon">

                    </i>
                    {{ trans('cruds.role.title') }}
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route("admin.users.index") }}" class="dropdown-item {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                    <i class="fas fa-user nav-icon">

                    </i>
                    {{ trans('cruds.user.title') }}
                </a>
                @can('config_access')
                <div class="dropdown-divider"></div>
                <a href="{{ route("admin.configuration.index") }}" class="dropdown-item {{ request()->is('admin/configuration') || request()->is('admin/configuration/*') ? 'active' : '' }}">
                    <i class="fas fa-gear nav-icon">

                    </i>
                    {{ trans('cruds.configuration.title') }}
                </a>
                @endcan
            </div>
        </li>
        @endcan
    </ul>
</div>
<ul class="nav navbar-nav navbar-right">
    @if(count(config('panel.available_languages', [])) > 1)  
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="download">{{ strtoupper(app()->getLocale()) }} 
                <span class="caret"></span>
            </a>
            <div class="dropdown-menu" aria-labelledby="download">
            @foreach(config('panel.available_languages') as $langLocale => $langName)
                    <a  class="dropdown-item" href="{{ url()->current() }}?change_language={{ $langLocale }}">
                        <h4>
                            {{ strtoupper($langLocale) }}
                            ({{ $langName }})
                        </h4>
                    </a>
            @endforeach
            </div>
        </li>
    @endif
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="download">{{ Auth::user()->name }} <span class="caret"></span></a>
        <div class="dropdown-menu" aria-labelledby="download">
        <a href="{{ route('change-passwords') }}" class="dropdown-item">
            <i class="nav-icon fas fa-refresh">
            </i>
            {{ trans('global.change_password') }}
        </a>
        <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
            <i class="nav-icon fas fa-sign-out-alt">
            </i>
            {{ trans('global.logout') }}
        </a>
    </li>
</ul>