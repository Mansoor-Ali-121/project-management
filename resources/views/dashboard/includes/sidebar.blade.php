<!-- SIDEBAR NAVIGATION FOR IMPACTHUB -->
<div class="sidebar">
    <div class="sidebar-top">
        <!-- USER PROFILE -->
        <div class="sidebar-top-profile">
            <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150&h=150&fit=crop&crop=faces"
                alt="User Avatar">
            <h3>{{ auth()->user()->name ?? 'Mansoor Ali' }}</h3>
            <!-- Role ko dynamic kar diya gaya hai -->
            <p>{{ ucfirst(auth()->user()->role ?? 'Admin') }}</p>
        </div>

        <ul class="sidebar-menu">
            {{-- Dashboard (Sab ke liye) --}}
            <li class="{{ request()->routeIs('dashboard*') || request()->is('/') ? 'active' : '' }}">
                <a href="/dashboard"><i class="fas fa-chart-pie"></i> <span>Dashboard</span></a>
            </li>

            {{-- Profile (Sab ke liye) --}}
            <li class="{{ request()->routeIs('profile*') ? 'active' : '' }}">
                <a href="{{ route('profile') }}"><i class="fas fa-user"></i> <span>Profile</span></a>
            </li>

            {{-- Projects Dropdown --}}
            <li class="has-sub {{ request()->routeIs('projects*') ? 'active open' : '' }}">
                <a href="#projectsSubmenu" data-toggle="collapse"
                    aria-expanded="{{ request()->routeIs('projects*') ? 'true' : 'false' }}" class="dropdown-toggle"
                    style="display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 15px;">
                        <i class="fas fa-project-diagram"
                            style="color: {{ request()->routeIs('projects*') ? '#d4af37' : 'inherit' }};"></i>
                        <span
                            style="color: {{ request()->routeIs('projects*') ? '#d4af37' : 'inherit' }};">Projects</span>
                    </div>
                    <i class="fas fa-chevron-down" style="font-size: 0.75rem;"></i>
                </a>
                <ul class="submenu" id="projectsSubmenu"
                    style="list-style: none; padding-left: 20px; {{ request()->routeIs('projects*') ? 'display: block;' : 'display: none;' }}">

                    {{-- View All Projects (Sab dekh sakte hain) --}}
                    <li style="margin-bottom: 5px;">
                        <a href="/dashboard/projects"
                            style="padding: 8px 10px; display: block; color: #ccc; text-decoration: none;">View All
                            Projects</a>
                    </li>

                    {{-- Create Project (Sirf Admin aur Manager ke liye) --}}
                    @if (auth()->user() && in_array(auth()->user()->role, ['admin', 'manager']))
                        <li>
                            <a href="/dashboard/projects/create"
                                style="padding: 8px 10px; display: block; color: #ccc; text-decoration: none;">Create
                                Project</a>
                        </li>
                    @endif
                </ul>
            </li>

            {{-- Volunteer Applications (Sirf Admin aur Manager ke liye) --}}
            @if (auth()->user() && in_array(auth()->user()->role, ['admin', 'manager']))
                <li class="has-sub {{ request()->routeIs('applications*') ? 'active open' : '' }}">
                    <a href="javascript:void(0);" class="dropdown-toggle category-toggle"
                        style="display: flex; align-items: center; justify-content: space-between;">
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <i class="fas fa-hands-helping"
                                style="color: {{ request()->routeIs('applications*') ? '#d4af37' : 'inherit' }};"></i>
                            <span
                                style="color: {{ request()->routeIs('applications*') ? '#d4af37' : 'inherit' }};">Volunteers</span>
                        </div>
                        <i class="fas fa-chevron-down" style="font-size: 0.75rem;"></i>
                    </a>
                    <ul class="submenu"
                        style="list-style: none; padding-left: 20px; {{ request()->routeIs('applications*') ? 'display: block;' : 'display: none;' }}">
                        <li style="margin-bottom: 5px;">
                            <a href="/dashboard/applications"
                                style="padding: 8px 10px; display: block; color: #ccc; text-decoration: none;">Applications
                                Approval</a>
                        </li>
                        <li>
                            <a href="/dashboard/applications/active"
                                style="padding: 8px 10px; display: block; color: #ccc; text-decoration: none;">Active
                                Volunteers</a>
                        </li>
                    </ul>
                </li>
            @endif

            {{-- Tasks Management --}}
            <li class="has-sub {{ request()->routeIs('tasks*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="dropdown-toggle category-toggle"
                    style="display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 15px;">
                        <i class="fas fa-tasks"
                            style="color: {{ request()->routeIs('tasks*') ? '#d4af37' : 'inherit' }};"></i>
                        <span style="color: {{ request()->routeIs('tasks*') ? '#d4af37' : 'inherit' }};">Tasks</span>
                    </div>
                    <i class="fas fa-chevron-down" style="font-size: 0.75rem;"></i>
                </a>
                <ul class="submenu"
                    style="list-style: none; padding-left: 20px; {{ request()->routeIs('tasks*') ? 'display: block;' : 'display: none;' }}">

                    {{-- Assign Tasks (Sirf Admin/Manager ke liye) --}}
                    @if (auth()->user() && in_array(auth()->user()->role, ['admin', 'manager']))
                        <li style="margin-bottom: 5px;">
                            <a href="/dashboard/tasks/assign"
                                style="padding: 8px 10px; display: block; color: #ccc; text-decoration: none;">Assign
                                Tasks</a>
                        </li>
                    @endif

                    {{-- Track Progress (Sab ke liye: Students apni progress dekhenge, Manager sab ki) --}}
                    <li>
                        <a href="/dashboard/tasks/progress"
                            style="padding: 8px 10px; display: block; color: #ccc; text-decoration: none;">
                            {{ auth()->user()?->role === 'student' ? 'My Tasks' : 'Track Progress' }}
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Users / Members (Sirf Admin ke liye) --}}
            @if (auth()->user() && auth()->user()->role === 'admin')
                <li class="{{ request()->routeIs('users*') ? 'active' : '' }}">
                    <a href="/dashboard/users"><i class="fas fa-users"></i> <span>Manage Users</span></a>
                </li>
            @endif

            {{-- Reports & Impact (Sirf Admin aur Manager ke liye) --}}
            @if (auth()->user() && in_array(auth()->user()->role, ['admin', 'manager']))
                <li class="{{ request()->routeIs('reports*') ? 'active' : '' }}">
                    <a href="/dashboard/reports"><i class="fas fa-chart-line"></i> <span>Impact Reports</span></a>
                </li>
            @endif

            {{-- Notifications (Sab ke liye) --}}
            <li class="{{ request()->routeIs('notifications*') ? 'active' : '' }}">
                <a href="/dashboard/notifications"><i class="fas fa-bell"></i> <span>Notifications</span></a>
            </li>
        </ul>
    </div>

    <!-- Bottom Section: Logout -->
    <div class="sidebar-bottom-section">
        <form action="/logout" method="POST">
            @csrf
            <button type="submit" class="btn-logout"
                style="background: none; border: none; width: 100%; text-align: left; cursor: pointer; padding: 15px; color: inherit;">
                <i class="fas fa-power-off"></i> <span>Secure Logout</span>
            </button>
        </form>
    </div>
</div>
