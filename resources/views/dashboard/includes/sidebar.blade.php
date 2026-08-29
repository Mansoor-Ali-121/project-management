<!-- SIDEBAR NAVIGATION FOR IMPACTHUB -->
<div class="sidebar">
    <div class="sidebar-top">
        <!-- USER PROFILE -->
        <div class="sidebar-top-profile">
            <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150&h=150&fit=crop&crop=faces"
                alt="User Avatar">
            <h3>{{ auth()->user()->name ?? 'Mansoor Ali' }}</h3>
            <p>{{ ucfirst(auth()->user()->role ?? 'Admin') }}</p>
        </div>

        <ul class="sidebar-menu" style="list-style: none; padding: 0;">
            {{-- Dashboard (Sab ke liye) --}}
            <li class="{{ request()->routeIs('dashboard*') || request()->is('/') ? 'active' : '' }}"
                style="margin-bottom: 5px;">
                <a href="{{ route('dashboard') }}"
                    style="display: flex; align-items: center; gap: 15px; padding: 10px 15px; color: #ccc; text-decoration: none;">
                    <i class="fas fa-chart-pie"></i> <span>Dashboard</span>
                </a>
            </li>

            {{-- Profile (Sab ke liye) --}}
            <li class="{{ request()->routeIs('profile*') ? 'active' : '' }}" style="margin-bottom: 5px;">
                <a href="{{ route('profile') }}"
                    style="display: flex; align-items: center; gap: 15px; padding: 10px 15px; color: #ccc; text-decoration: none;">
                    <i class="fas fa-user"></i> <span>Profile</span>
                </a>
            </li>

            {{-- Projects Dropdown --}}
            <li class="has-sub {{ request()->routeIs('project*') ? 'active open' : '' }}" style="margin-bottom: 5px;">
                <a href="javascript:void(0);" onclick="toggleSubmenu('projectsSubmenu')" class="dropdown-toggle"
                    style="display: flex; align-items: center; justify-content: space-between; padding: 10px 15px; text-decoration: none; cursor: pointer;">
                    <div style="display: flex; align-items: center; gap: 15px;">
                        <i class="fas fa-project-diagram"
                            style="color: {{ request()->routeIs('project*') ? '#d4af37' : 'inherit' }};"></i>
                        <span
                            style="color: {{ request()->routeIs('project*') ? '#d4af37' : 'inherit' }};">Projects</span>
                    </div>
                    <i class="fas fa-chevron-down" style="font-size: 0.75rem; color: #ccc;"></i>
                </a>
                <ul class="submenu" id="projectsSubmenu"
                    style="list-style: none; padding-left: 20px; {{ request()->routeIs('project*') ? 'display: block;' : 'display: none;' }}">

                    {{-- View All Projects --}}
                    <li style="margin-bottom: 5px;">
                        <a href="{{ route('projects.show') }}"
                            style="padding: 8px 10px; display: block; color: {{ request()->routeIs('projects.show') ? '#d4af37' : '#ccc' }}; font-weight: {{ request()->routeIs('projects.show') ? 'bold' : 'normal' }}; text-decoration: none;">
                            View All Projects
                        </a>
                    </li>

                    {{-- Create Project (Sirf Admin aur Manager ke liye) --}}
                    @if (auth()->user() && in_array(auth()->user()->role, ['admin', 'project_manager']))
                        <li>
                            <a href="{{ route('projects.add') }}"
                                style="padding: 8px 10px; display: block; color: {{ request()->routeIs('projects.add') ? '#d4af37' : '#ccc' }}; font-weight: {{ request()->routeIs('projects.add') ? 'bold' : 'normal' }}; text-decoration: none;">
                                Create Project
                            </a>
                        </li>
                    @endif
                </ul>
            </li>

            {{-- Volunteer Applications (Sirf Admin aur Manager ke liye) --}}
            @if (auth()->user() && in_array(auth()->user()->role, ['admin', 'project_manager']))
                @php
                    $isVolunteersActive = request()->routeIs('applications.*') || request()->is('applications*');
                @endphp
                <li class="has-sub {{ $isVolunteersActive ? 'active open' : '' }}" style="margin-bottom: 5px;">
                    <a href="javascript:void(0);" onclick="toggleSubmenu('volunteersSubmenu')" class="dropdown-toggle"
                        style="display: flex; align-items: center; justify-content: space-between; padding: 10px 15px; text-decoration: none; cursor: pointer;">
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <i class="fas fa-hands-helping"
                                style="color: {{ $isVolunteersActive ? '#d4af37' : 'inherit' }};"></i>
                            <span style="color: {{ $isVolunteersActive ? '#d4af37' : 'inherit' }};">Volunteers</span>
                        </div>
                        <i class="fas fa-chevron-down" style="font-size: 0.75rem; color: #ccc;"></i>
                    </a>
                    <ul class="submenu" id="volunteersSubmenu"
                        style="list-style: none; padding-left: 20px; {{ $isVolunteersActive ? 'display: block;' : 'display: none;' }}">
                        <li style="margin-bottom: 5px;">
                            <a href="{{ route('applications.show') }}"
                                style="padding: 8px 10px; display: block; color: {{ request()->routeIs('applications.show') ? '#d4af37' : '#ccc' }}; text-decoration: none;">Applications
                                Approval</a>
                        </li>
                        <li>
                            <a href="{{ route('applications.active') }}"
                                style="padding: 8px 10px; display: block; color: {{ request()->routeIs('applications.active') ? '#d4af37' : '#ccc' }}; text-decoration: none;">Active
                                Volunteers</a>
                        </li>
                    </ul>
                </li>
            @endif

            {{-- Tasks Management --}}
            <li class="has-sub {{ request()->routeIs('tasks.*') ? 'active open' : '' }}" style="margin-bottom: 5px;">
                <a href="javascript:void(0);" onclick="toggleSubmenu('tasksSubmenu')" class="dropdown-toggle"
                    style="display: flex; align-items: center; justify-content: space-between; padding: 10px 15px; text-decoration: none; cursor: pointer;">
                    <div style="display: flex; align-items: center; gap: 15px;">
                        <i class="fas fa-tasks"
                            style="color: {{ request()->routeIs('tasks.*') ? '#d4af37' : 'inherit' }};"></i>
                        <span style="color: {{ request()->routeIs('tasks.*') ? '#d4af37' : 'inherit' }};">Tasks</span>
                    </div>
                    <i class="fas fa-chevron-down" style="font-size: 0.75rem; color: #ccc;"></i>
                </a>
                <ul class="submenu" id="tasksSubmenu"
                    style="list-style: none; padding-left: 20px; {{ request()->routeIs('tasks.*') ? 'display: block;' : 'display: none;' }}">

                    {{-- Assign Tasks (Sirf Admin/Manager ke liye) --}}
                    @if (auth()->user() && in_array(auth()->user()->role, ['admin', 'manager']))
                        <li style="margin-bottom: 5px;">
                            <a href="{{ route('tasks.add') }}"
                                style="padding: 8px 10px; display: block; color: {{ request()->routeIs('tasks.add') ? '#d4af37' : '#ccc' }}; text-decoration: none; font-weight: {{ request()->routeIs('tasks.add') ? 'bold' : 'normal' }};">
                                Assign Tasks
                            </a>
                        </li>
                    @endif

                    {{-- Track Progress --}}
                    <li>
                        <a href="{{ route('tasks.show') }}"
                            style="padding: 8px 10px; display: block; color: {{ request()->routeIs('tasks.show') ? '#d4af37' : '#ccc' }}; text-decoration: none; font-weight: {{ request()->routeIs('tasks.show') ? 'bold' : 'normal' }};">
                            {{ auth()->user()?->role === 'student' ? 'My Tasks' : 'Track Progress' }}
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Users / Members (Sirf Admin ke liye) --}}
            @if (auth()->user() && auth()->user()->role === 'admin')
                <li class="{{ request()->routeIs('users*') ? 'active' : '' }}" style="margin-bottom: 5px;">
                    <a href="{{ route('users.show') }}"
                        style="display: flex; align-items: center; gap: 15px; padding: 10px 15px; color: #ccc; text-decoration: none;">
                        <i class="fas fa-users"></i> <span>Manage Users</span>
                    </a>
                </li>
            @endif

            {{-- Reports & Impact (Sirf Admin aur Manager ke liye) --}}
            @if (auth()->user() && in_array(auth()->user()->role, ['admin', 'project_manager']))
                <li class="{{ request()->routeIs('reports*') ? 'active' : '' }}" style="margin-bottom: 5px;">
                    <a href="{{ route('impact.reports') }}"
                        style="display: flex; align-items: center; gap: 15px; padding: 10px 15px; color: #ccc; text-decoration: none;">
                        <i class="fas fa-chart-line"></i> <span>Impact Reports</span>
                    </a>
                </li>
            @endif

            {{-- Notifications (role base) --}}
            <li class="{{ request()->routeIs('notifications*') ? 'active' : '' }}" style="margin-bottom: 5px;">
                <a href="{{ route('notifications.index') }}"
                    style="display: flex; align-items: center; justify-content: space-between; padding: 10px 15px; color: #ccc; text-decoration: none;">
                    <div style="display: flex; align-items: center; gap: 15px;">
                        <i class="fas fa-bell"></i> <span>Notifications</span>
                    </div>

                    {{-- Unread Badge (Dynamic Count) --}}
                    @php
                        $unreadCount = \App\Models\Notification::where('user_id', auth()->id())
                            ->where('is_read', false)
                            ->count();
                    @endphp

                    <span id="notification-badge"
                        style="background-color: #d4af37; color: #121212; font-size: 11px; font-weight: bold; padding: 2px 7px; border-radius: 10px; {{ $unreadCount == 0 ? 'display: none;' : '' }}">
                        {{ $unreadCount }}
                    </span>
                </a>
            </li>

            {{-- Real-time Reverb Listener Script (Isay aap template layout ya yahin rakh sakte hain) --}}
            <script>
                @auth
                window.Echo.private('App.Models.User.{{ auth()->id() }}')
                    .listen('NewNotificationEvent', (e) => {
                        const badge = document.getElementById('notification-badge');
                        if (badge) {
                            // Badge ko visible karein aur count mein 1 ka izafa karein
                            let currentCount = parseInt(badge.innerText) || 0;
                            currentCount++;
                            badge.innerText = currentCount;
                            badge.style.display = 'inline-block';
                        }
                    });
                @endauth
            </script>
        </ul>
    </div>

    <!-- Bottom Section: Logout -->
    <div class="sidebar-bottom-section">
        <form action="/logout" method="POST">
            @csrf
            <button type="submit" class="btn-logout"
                style="background: none; border: none; width: 100%; text-align: left; cursor: pointer; padding: 15px; color: #ccc; display: flex; align-items: center; gap: 15px;">
                <i class="fas fa-power-off"></i> <span>Secure Logout</span>
            </button>
        </form>
    </div>
</div>

{{-- Universal Dropdown Toggle Script --}}
<script>
    function toggleSubmenu(submenuId) {
        var submenu = document.getElementById(submenuId);
        if (submenu) {
            if (submenu.style.display === 'none' || submenu.style.display === '') {
                submenu.style.display = 'block';
            } else {
                submenu.style.display = 'none';
            }
        }
    }
</script>
