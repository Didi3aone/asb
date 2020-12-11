
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <div style="font-size: 12">
    <ul class="navbar-nav">
        {{-- <li class="nav-item">
            <a href="{{ route("admin.home") }}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li> --}}
        {{-- @can('modul_item_access')
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="download">
                <i class="nav-icon fas fa-cubes"></i> 
                {{ trans('cruds.itemManagement.title') }} <span class="caret"></span></a>
            <div class="dropdown-menu" aria-labelledby="download">
                @can('item_category_access')
                <a href="{{ route("admin.item-category.index") }}" class="dropdown-item {{ request()->is('admin/item-category') || request()->is('admin/item-category/*') ? 'active' : '' }}">
                    
                    {{ trans('cruds.item-category.title') }}
                </a>
                @endcan
                @can('item_unit_access')
                <a href="{{ route("admin.item-unit.index") }}" class="dropdown-item {{ request()->is('admin/item-unit') || request()->is('admin/item-unit/*') ? 'active' : '' }}">
                    
                    {{ trans('cruds.item-unit.title') }}
                </a>
                @endcan
                @can('item_access')
                <a href="{{ route("admin.item.index") }}" class="dropdown-item {{ request()->is('admin/item') || request()->is('admin/item/*') ? 'active' : '' }}">
                    
                    {{ trans('cruds.item.title') }}
                </a>
                @endcan
            </div>
        </li>
        @endcan --}}
        @can('modul_member_access')
        
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="download">
                <i class="nav-icon fas fa-cubes"></i> 
                {{ trans('cruds.memberManagement.title') }} <span class="caret"></span>
            </a>
            <div class="dropdown-menu" aria-labelledby="download">
                @can('verified_member_access')
                <a href="{{ route("admin.member-verified") }}" class="dropdown-item {{ request()->is('admin/member-verified') || request()->is('admin/member-verified/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-smile-o"></i> 
                    {{ trans('cruds.verified-member.title') }}
                </a>
                @endcan
                @can('unverified_member_access')
                <a href="{{ route("admin.member-pending") }}" class="dropdown-item {{ request()->is('admin/member-pending') || request()->is('admin/member-pending/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-frown-o"></i> 
                    {{ trans('cruds.unverified-member.title') }}
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
                @can('gudang_access')
                <a href="{{ route("admin.transaksi.index") }}" class="dropdown-item {{ request()->is('admin/gudang') || request()->is('admin/gudang/*') ? 'active' : '' }}">
                    <i class="fas fa-building nav-icon">

                    </i>
                    Transaksi IN/Out
                </a>
                @endcan
                @can('gudang_access')
                <a href="{{ route("admin.invoice.index") }}" class="dropdown-item {{ request()->is('admin/invoice') || request()->is('admin/invoice/*') ? 'active' : '' }}">
                    <i class="fas fa-building nav-icon">

                    </i>
                    {{ trans('cruds.invoice.title') }}
                </a>
                @endcan
                @can('gudang_access')
                <a href="{{ route("admin.do.index") }}" class="dropdown-item {{ request()->is('admin/do') || request()->is('admin/do/*') ? 'active' : '' }}">
                    <i class="fas fa-building nav-icon">

                    </i>
                    {{ trans('cruds.do.title') }}
                </a>
                @endcan
                @can('gudang_access')
                <a href="{{ route("admin.sales-po.index") }}" class="dropdown-item {{ request()->is('admin/sales-po') || request()->is('admin/sales-po/*') ? 'active' : '' }}">
                    <i class="fas fa-building nav-icon">

                    </i>
                    Sales PO
                </a>
                @endcan
                @can('transaction_access')
                <a href="{{ route("admin.ro.index") }}" class="dropdown-item {{ request()->is('admin/ro') || request()->is('admin/ro/*') ? 'active' : '' }}">
                    <i class="fa fa-download nav-icon">

                    </i>
                    {{ trans('cruds.request-order.title') }}
                </a>
                 @endcan
                @can('transaction_access')
                <a href="{{ route("admin.po.index") }}" class="dropdown-item {{ request()->is('admin/po') || request()->is('admin/po/*') ? 'active' : '' }}">
                    <i class="fa fa-upload nav-icon">

                    </i>
                    {{ trans('cruds.purchase-order.title') }}
                </a>
               @endcan
            </div>
        </li>
        @endcan
        @can('modul_information_access')
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="download">
                <i class="nav-icon fa fa-info-circle"></i> 
                {{ trans('cruds.information.title') }} <span class="caret"></span></a>
            <div class="dropdown-menu" aria-labelledby="download">
                @can('information_access')
                <a href="{{ route("admin.info.index") }}" class="dropdown-item {{ request()->is('admin/info') || request()->is('admin/info/*') ? 'active' : '' }}">
                    <i class="fa fa-info nav-icon">

                    </i>
                    {{ trans('cruds.information.title') }}
                </a>
                @endcan
                @can('category_access')
                <a href="{{ route("admin.category.index") }}" class="dropdown-item {{ request()->is('admin/category') || request()->is('admin/category/*') ? 'active' : '' }}">
                    <i class="fa fa-newspaper-o nav-icon">

                    </i>
                    {{ trans('cruds.category.title') }}
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
                @can('item_category_access')
                <a href="{{ route("admin.item-category.index") }}" class="dropdown-item {{ request()->is('admin/item-category') || request()->is('admin/item-category/*') ? 'active' : '' }}">
                    <i class="fas fa-cart-plus nav-icon">

                    </i>
                    {{ trans('cruds.item-category.title') }}
                </a>
                @endcan
                @can('item_unit_access')
                <a href="{{ route("admin.item-unit.index") }}" class="dropdown-item {{ request()->is('admin/item-unit') || request()->is('admin/item-unit/*') ? 'active' : '' }}">
                    <i class="fas fa-suitcase nav-icon">

                    </i>
                    {{ trans('cruds.item-unit.title') }}
                </a>
                @endcan
                @can('item_access')
                <a href="{{ route("admin.item.index") }}" class="dropdown-item {{ request()->is('admin/item') || request()->is('admin/item/*') ? 'active' : '' }}">
                    <i class="fas fa-gift nav-icon">

                    </i>
                    {{ trans('cruds.item.title') }}
                </a>
                @endcan
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
                <a href="{{ route("admin.program.index") }}" class="dropdown-item {{ request()->is('admin/program') || request()->is('admin/program/*') ? 'active' : '' }}">
                    <i class="fa fa-cubes nav-icon">

                    </i>
                    {{ trans('cruds.program.title') }}
                </a>
                @endcan

                @can('member_access')
                <a href="{{ route("admin.master-member.index") }}" class="dropdown-item {{ request()->is('admin/master-member') || request()->is('admin/master-member/*') ? 'active' : '' }}">
                    <i class="fa fa-id-card nav-icon">

                    </i>
                    {{ trans('cruds.member.title') }}
                </a>
                @endcan

               {{--  @can('customer_access')
                <a href="{{ route("admin.wilayah.index") }}" class="dropdown-item {{ request()->is('admin/wilayah') || request()->is('admin/wilayah/*') ? 'active' : '' }}">
                    <i class="fa fa-globe nav-icon">

                    </i>
                    {{ trans('cruds.program.title') }}
                    {{ trans('cruds.wilayah.title') }}
                </a>
                @endcan --}}

                @can('customer_access')
                <a href="{{ route("admin.provinsi.index") }}" class="dropdown-item {{ request()->is('admin/provinsi') || request()->is('admin/provinsi/*') ? 'active' : '' }}">
                    <i class="fa fa-globe nav-icon">

                    </i>
                    {{-- {{ trans('cruds.program.title') }} --}}
                    {{ trans('cruds.provinsi.title') }}
                </a>
                @endcan
                
                @can('customer_access')
                <a href="{{ route("admin.kabupaten.index") }}" class="dropdown-item {{ request()->is('admin/kabupaten') || request()->is('admin/kabupaten/*') ? 'active' : '' }}">
                    <i class="fa fa-globe nav-icon">

                    </i>
                    {{-- {{ trans('cruds.program.title') }} --}}
                    {{ trans('cruds.kabupaten.title') }}
                </a>
                @endcan

                @can('customer_access')
                <a href="{{ route("admin.kecamatan.index") }}" class="dropdown-item {{ request()->is('admin/kecamatan') || request()->is('admin/kecamatan/*') ? 'active' : '' }}">
                    <i class="fa fa-globe nav-icon">

                    </i>
                    {{-- {{ trans('cruds.program.title') }} --}}
                    {{ trans('cruds.kecamatan.title') }}
                </a>
                @endcan

                {{-- @can('customer_access')
                <a href="{{ route("admin.kelurahan.index") }}" class="dropdown-item {{ request()->is('admin/kelurahan') || request()->is('admin/kelurahan/*') ? 'active' : '' }}">
                    <i class="fa fa-globe nav-icon">

                    </i>
                    {{ trans('cruds.program.title') }}
                    {{ trans('cruds.kelurahan.title') }}
                </a>
                @endcan --}}
                
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
        <a href="{{ route("admin.change-template") }}" class="dropdown-item">
            <i class="nav-icon fas fa-palette"></i>
            {{ trans('global.change_theme') }}
        </a>
        <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
            <i class="nav-icon fas fa-sign-out-alt">
            </i>
            {{ trans('global.logout') }}
        </a>
    </li>
</ul>
</div>