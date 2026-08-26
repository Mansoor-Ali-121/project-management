@extends('template')

@section('main-content')
    <style>
        .custom-show-container {
            padding: 20px 40px;
            width: 100%;
            box-sizing: border-box;
            min-height: calc(100vh - 140px);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .custom-show-card {
            background-color: #121212;
            border: 1px solid #d4af37;
            border-radius: 14px;
            padding: 30px;
            color: #fff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        .custom-show-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #333;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .custom-show-title {
            color: #d4af37;
            margin: 0;
            font-size: 24px;
            font-weight: bold;
            font-family: 'Cinzel', serif;
        }

        .custom-show-subtitle {
            color: #888;
            font-size: 13px;
            margin: 5px 0 0 0;
        }

        .custom-add-btn {
            background-color: #d4af37;
            color: #121212;
            border: none;
            padding: 8px 18px;
            font-weight: bold;
            font-size: 14px;
            border-radius: 6px;
            text-decoration: none;
            transition: 0.3s;
        }

        .custom-add-btn:hover {
            opacity: 0.9;
            color: #121212;
        }

        /* Table Design */
        .custom-table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        .custom-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 13px;
        }

        .custom-table th {
            color: #d4af37;
            background-color: #1a1a1a;
            padding: 12px 12px;
            border-bottom: 2px solid #333;
            font-weight: 600;
            white-space: nowrap;
        }

        .custom-table td {
            padding: 12px 12px;
            border-bottom: 1px solid #222;
            color: #ddd;
            vertical-align: middle;
        }

        .custom-table tr:hover {
            background-color: rgba(212, 175, 55, 0.03);
        }

        /* Status Badges / Roles */
        .badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
            text-transform: capitalize;
            display: inline-block;
        }

        .badge-admin {
            background-color: rgba(212, 175, 55, 0.2);
            color: #d4af37;
            border: 1px solid #d4af37;
        }

        .badge-manager,
        .badge-project_manager {
            background-color: rgba(23, 162, 184, 0.2);
            color: #17a2b8;
            border: 1px solid #17a2b8;
        }

        .badge-student,
        .badge-user {
            background-color: rgba(108, 117, 125, 0.2);
            color: #adb5bd;
            border: 1px solid #6c757d;
        }

        .badge-active {
            background-color: rgba(40, 167, 69, 0.2);
            color: #28a745;
            border: 1px solid #28a745;
        }

        .badge-inactive {
            background-color: rgba(220, 53, 69, 0.2);
            color: #dc3545;
            border: 1px solid #dc3545;
        }

        /* Action Buttons */
        .action-btns {
            display: flex;
            gap: 6px;
            align-items: center;
        }

        .btn-edit {
            background-color: rgba(23, 162, 184, 0.15);
            color: #17a2b8;
            border: 1px solid #17a2b8;
            padding: 5px 8px;
            border-radius: 4px;
            font-size: 11px;
            text-decoration: none;
            transition: 0.3s;
        }

        .btn-edit:hover {
            background-color: #17a2b8;
            color: #fff;
        }

        .btn-delete {
            background-color: rgba(220, 53, 69, 0.15);
            color: #dc3545;
            border: 1px solid #dc3545;
            padding: 5px 8px;
            border-radius: 4px;
            font-size: 11px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-delete:hover {
            background-color: #dc3545;
            color: #fff;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: #888;
        }

        /* Pagination Footer Styling */
        .pagination-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 25px;
            padding-top: 15px;
            border-top: 1px solid #222;
            flex-wrap: wrap;
            gap: 15px;
        }

        .pagination-info {
            color: #aaa;
            font-size: 13px;
        }

        .pagination-container nav {
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .pagination-container nav p.text-sm,
        .pagination-container .flex.items-center.justify-between>div:first-child {
            display: none !important;
        }

        .pagination-container svg {
            width: 14px !important;
            height: 14px !important;
            fill: currentColor;
        }

        .pagination-container nav a {
            background-color: #1a1a1a !important;
            border: 1px solid #444 !important;
            color: #d4af37 !important;
            padding: 6px 12px !important;
            border-radius: 6px !important;
            font-size: 13px !important;
            text-decoration: none !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            transition: 0.3s;
            margin: 0 2px;
        }

        .pagination-container nav span[aria-current="page"] {
            background-color: #d4af37 !important;
            color: #121212 !important;
            border-color: #d4af37 !important;
            font-weight: bold !important;
            padding: 6px 12px !important;
            border-radius: 6px !important;
            font-size: 13px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            margin: 0 2px;
        }

        .pagination-container nav a:hover {
            background-color: #d4af37 !important;
            color: #121212 !important;
            border-color: #d4af37 !important;
        }

        .pagination-container nav span[aria-disabled="true"] {
            background-color: #1a1a1a !important;
            border: 1px solid #333 !important;
            color: #555 !important;
            padding: 6px 12px !important;
            border-radius: 6px !important;
            font-size: 13px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            margin: 0 2px;
            cursor: not-allowed !important;
            opacity: 0.6;
        }
    </style>

    <div class="custom-show-container">

        <!-- Main Card -->
        <div class="custom-show-card">

            <!-- Header Section -->
            <div class="custom-show-header">
                <div>
                    <h2 class="custom-show-title">Manage Users</h2>
                    <p class="custom-show-subtitle">View, search, and manage system users and their roles.</p>
                </div>
                @if (auth()->check() && auth()->user()->role === 'admin')
                    <a href="{{ route('register.add') ?? '#' }}" class="custom-add-btn">+ Add New User</a>
                @endif
            </div>

            <!-- Search & Filter Form Bar -->
            <form method="GET" action="{{ route('users.show') ?? '#' }}"
                style="display: flex; gap: 12px; margin-bottom: 25px; flex-wrap: wrap; align-items: center;">

                <!-- Search Input -->
                <div style="flex: 1; min-width: 220px;">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search by name or email..."
                        style="width: 100%; background-color: #1a1a1a; border: 1px solid #333; color: #fff; padding: 10px 14px; border-radius: 6px; font-size: 13px; outline: none;">
                </div>

                <!-- Role Filter Dropdown -->
                <div style="width: 160px;">
                    <select name="role"
                        style="width: 100%; background-color: #1a1a1a; border: 1px solid #333; color: #fff; padding: 10px 14px; border-radius: 6px; font-size: 13px; outline: none; cursor: pointer;">
                        <option value="">All Roles</option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="project_manager" {{ request('role') == 'project_manager' ? 'selected' : '' }}>Manager
                        </option>
                        <option value="student" {{ request('role') == 'student' ? 'selected' : '' }}>Student</option>
                    </select>
                </div>

                <!-- Filter Button -->
                <button type="submit"
                    style="background-color: #d4af37; color: #121212; border: none; padding: 10px 20px; font-weight: bold; border-radius: 6px; font-size: 13px; cursor: pointer; transition: 0.3s;">
                    Filter
                </button>

                <!-- Reset Button -->
                @if (request()->anyFilled(['search', 'role']))
                    <a href="{{ route('users.show') ?? '#' }}"
                        style="background-color: #222; color: #aaa; border: 1px solid #444; padding: 10px 15px; border-radius: 6px; font-size: 13px; text-decoration: none; transition: 0.3s; display: inline-flex; align-items: center;">
                        Reset
                    </a>
                @endif
            </form>

            <!-- Table Section -->
            <div class="custom-table-responsive">
                <table class="custom-table">

                    {{-- Success Alert Message --}}
                    @if (session('success'))
                        <div
                            style="background-color: rgba(40, 167, 69, 0.2); border: 1px solid #28a745; color: #51cf66; padding: 12px 15px; border-radius: 8px; margin-bottom: 20px; font-size: 14px;">
                            <i class="fas fa-check-circle" style="margin-right: 8px;"></i> {{ session('success') }}
                        </div>
                    @endif

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Picture</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>City</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Skills</th>
                            <th>Joined Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>

                                <!-- User Profile Picture Column -->
                                <td>
                                    @if (!empty($user->profile_picture))
                                        <img src="{{ asset($user->profile_picture) }}" alt="Profile"
                                            style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover; border: 1px solid #d4af37;">
                                    @else
                                        <div
                                            style="width: 35px; height: 35px; border-radius: 50%; background-color: #222; color: #d4af37; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 13px; border: 1px solid #444;">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </td>

                                <td style="font-weight: 600; color: #fff;">{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone ?? 'N/A' }}</td>
                                <td>{{ $user->city ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge badge-{{ strtolower($user->role) }}">
                                        {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-{{ strtolower($user->status ?? 'active') }}">
                                        {{ ucfirst($user->status ?? 'Active') }}
                                    </span>
                                </td>
                                <td style="max-width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"
                                    title="{{ $user->skills }}">
                                    {{ $user->skills ?? 'N/A' }}
                                </td>
                                <td>{{ $user->created_at?->format('Y-m-d') ?? 'N/A' }}</td>
                                <td>
                                    <div class="action-btns">
                                        <!-- Edit Button -->
                                        <a href="{{ route('users.edit', $user->id) ?? '#' }}" class="btn-edit">Edit</a>

                                        <!-- Delete Form -->
                                        @if ($user->id !== auth()->id())
                                            <form action="{{ route('users.delete', $user->id) ?? '#' }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this user?');"
                                                style="margin:0;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-delete">Delete</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="empty-state">
                                    No users found matching your criteria.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination & Showing Info Footer -->
            @if (isset($users) && method_exists($users, 'hasPages') && $users->count() > 0)
                <div class="pagination-footer">
                    <div class="pagination-info">
                        Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} results
                    </div>
                    <div class="pagination-container">
                        {{ $users->appends(request()->query())->links() }}
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection
