
    <!--  BEGIN SIDEBAR  -->
    <div class="sidebar-wrapper sidebar-theme">
            
        <nav id="sidebar">
            
            <ul class="list-unstyled menu-categories" id="accordionExample">
                <li class="menu d-none"><a href="" aria-expanded="true" class="dropdown-toggle"></a></li>
                <li class="menu {{ (request()->is('admin/dashboard')) ? 'active' : '' }}">
                    <a href="{{route('admin')}}" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                            <span>Dashboard</span>
                        </div>
                    </a>
                </li>
                <li class="menu {{ (request()->is('admin/user')) ? 'active' : '' }}">
                    <a href="{{ route('user.index') }}" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
                            <span>Users</span>
                        </div>
                    </a>
                </li>

                <li class="menu {{ (request()->is('admin/task')) ? 'active' : '' }}">
                    <a href="{{ route('task.index') }}" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
                            <span>Task</span>
                        </div>
                    </a>
                </li>
            </ul>
        </nav>

    </div>
    <!--  END SIDEBAR  -->