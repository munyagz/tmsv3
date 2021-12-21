<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("admin.home") }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            {{ trans('global.dashboard') }}
                        </p>
                    </a>
                </li>
                @can('fleet_data_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.fleet-datas.index") }}" class="nav-link {{ request()->is("admin/fleet-datas") || request()->is("admin/fleet-datas/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.fleetData.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('money_received_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.money-receiveds.index") }}" class="nav-link {{ request()->is("admin/money-receiveds") || request()->is("admin/money-receiveds/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.moneyReceived.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
              
                @can('report_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/reports*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-users">

                            </i>
                            <p>
                                {{ trans('cruds.report.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            
                                <li class="nav-item">
                                    <a href="{{ route("admin.reports.floats") }}" class="nav-link {{ request()->is("admin/reports/floats") || request()->is("admin/reports/floats/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-unlock-alt">

                                        </i>
                                        <p>
                                            Float Report
                                        </p>
                                    </a>
                                </li>
                            
                            
                                <li class="nav-item">
                                    <a href="{{ route("admin.reports.orders") }}" class="nav-link {{ request()->is("admin/reports/orders") || request()->is("admin/reports/orders/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            Orders Report
                                        </p>
                                    </a>
                                </li>
                            
                            
                                <li class="nav-item">
                                    <a href="{{ route("admin.reports.expenses") }}" class="nav-link {{ request()->is("admin/reports/expenses") || request()->is("admin/reports/expenses/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user">

                                        </i>
                                        <p>
                                            Other Expenses Report
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route("admin.reports.profitloss") }}" class="nav-link {{ request()->is("admin/reports/profitloss") || request()->is("admin/reports/profitloss/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user">

                                        </i>
                                        <p>
                                            Profit/Loss Report
                                        </p>
                                    </a>
                                </li>
                        </ul>
                    </li>
                @endcan
                <!------------------------------end Reports-------------------------------- -->
                @can('user_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/permissions*") ? "menu-open" : "" }} {{ request()->is("admin/roles*") ? "menu-open" : "" }} {{ request()->is("admin/users*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-users">

                            </i>
                            <p>
                                {{ trans('cruds.userManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-unlock-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.permission.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.role.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user">

                                        </i>
                                        <p>
                                            {{ trans('cruds.user.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('float_management_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.float-managements.index") }}" class="nav-link {{ request()->is("admin/float-managements") || request()->is("admin/float-managements/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.floatManagement.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('send_float_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.send-floats.index") }}" class="nav-link {{ request()->is("admin/send-floats") || request()->is("admin/send-floats/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.sendFloat.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('expense_category_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.expense-categories.index") }}" class="nav-link {{ request()->is("admin/expense-categories") || request()->is("admin/expense-categories/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.expenseCategory.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('other_expense_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.other-expenses.index") }}" class="nav-link {{ request()->is("admin/other-expenses") || request()->is("admin/other-expenses/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.otherExpense.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                    @can('profile_password_edit')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                                <i class="fa-fw fas fa-key nav-icon">
                                </i>
                                <p>
                                    {{ trans('global.change_password') }}
                                </p>
                            </a>
                        </li>
                    @endcan
                @endif
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <p>
                            <i class="fas fa-fw fa-sign-out-alt nav-icon">

                            </i>
                            <p>{{ trans('global.logout') }}</p>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>