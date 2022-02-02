<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="pt-4">
                @can('dashboard')
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('admin.auth.dashboard') }}" aria-expanded="false">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                @endcan

                @can('role-list')
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('admin.role.index') }}" aria-expanded="false">
                        <i class="fas fa-user-tag"></i>
                        <span class="hide-menu">Role & Permissions</span>
                    </a>
                </li>
                @endcan

                @can('publisher-list')
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('admin.publisher.index') }}" aria-expanded="false">
                        <i class="fas fa-users"></i>
                        <span class="hide-menu">Publisher & Users</span>
                    </a>
                </li>
                @endcan

                @if(auth()->user()->hasRole('publisher-admin'))
                    @can('user-list')
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('admin.user.index',['id'=>auth()->user()->id]) }}" aria-expanded="false">
                            <i class="fas fa-users"></i>
                            <span class="hide-menu">User</span>
                        </a>
                    </li>
                    @endcan
                @endif

                @can('heading-list')
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('admin.heading.index') }}" aria-expanded="false">
                        <i class="fas fa-heading"></i>
                        <span class="hide-menu">Heading & Keywords</span>
                    </a>
                </li>
                @endcan

                @can('business-list')
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('admin.business.index') }}" aria-expanded="false">
                        <i class="fas fa-building"></i>
                        <span class="hide-menu">Business</span>
                    </a>
                </li>
                @endcan

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" aria-expanded="false">
                        <i class="fas fa-cog"></i>
                        <span class="hide-menu">Settings </span>
                    </a>
                    @can('database-backup')
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <a href="{{ route('admin.database.index') }}" class="sidebar-link">
                                <i class="fas fa-database"></i>
                                <span class="hide-menu"> Database Backup </span>
                            </a>
                        </li>
                    </ul>
                    @endcan]
                </li>
            </ul>
        </nav>
    </div>
</aside>
