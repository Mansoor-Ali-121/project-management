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
            font-size: 14px;
        }

        .custom-table th {
            color: #d4af37;
            background-color: #1a1a1a;
            padding: 12px 15px;
            border-bottom: 2px solid #333;
            font-weight: 600;
        }

        .custom-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #222;
            color: #ddd;
            vertical-align: middle;
        }

        .custom-table tr:hover {
            background-color: rgba(212, 175, 55, 0.03);
        }

        /* Status Badges */
        .badge {
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            text-transform: capitalize;
        }

        .badge-pending {
            background-color: rgba(255, 193, 7, 0.2);
            color: #ffc107;
            border: 1px solid #ffc107;
        }

        .badge-approved {
            background-color: rgba(40, 167, 69, 0.2);
            color: #28a745;
            border: 1px solid #28a745;
        }

        .badge-rejected {
            background-color: rgba(220, 53, 69, 0.2);
            color: #dc3545;
            border: 1px solid #dc3545;
        }

        .badge-completed {
            background-color: rgba(23, 162, 184, 0.2);
            color: #17a2b8;
            border: 1px solid #17a2b8;
        }

        /* Action Buttons */
        .action-btns {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .btn-edit {
            background-color: rgba(23, 162, 184, 0.15);
            color: #17a2b8;
            border: 1px solid #17a2b8;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
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
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-delete:hover {
            background-color: #dc3545;
            color: #fff;
        }

        .btn-apply {
            background-color: #d4af37;
            color: #121212;
            border: none;
            padding: 6px 14px;
            font-weight: bold;
            border-radius: 4px;
            font-size: 12px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-apply:hover {
            opacity: 0.9;
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
                    <h2 class="custom-show-title">All Projects</h2>
                    <p class="custom-show-subtitle">Manage and monitor all deployed community impact projects.</p>
                </div>
                @if (auth()->check() &&
                        (auth()->user()->role === 'admin' || auth()->user()->role === 'project_manager' || auth()->user()->is_admin))
                    <a href="{{ route('projects.add') }}" class="custom-add-btn">+ Add New Project</a>
                @endif
            </div>

            <!-- Search & Filter Form Bar -->
            <form method="GET" action="{{ route('projects.show') }}"
                style="display: flex; gap: 12px; margin-bottom: 25px; flex-wrap: wrap; align-items: center;">

                <!-- Search Input -->
                <div style="flex: 1; min-width: 220px;">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search by project title..."
                        style="width: 100%; background-color: #1a1a1a; border: 1px solid #333; color: #fff; padding: 10px 14px; border-radius: 6px; font-size: 13px; outline: none;">
                </div>

                <!-- Category Filter -->
                <div style="width: 160px;">
                    <input type="text" name="category" value="{{ request('category') }}" placeholder="Category..."
                        style="width: 100%; background-color: #1a1a1a; border: 1px solid #333; color: #fff; padding: 10px 14px; border-radius: 6px; font-size: 13px; outline: none;">
                </div>

                <!-- Location Filter -->
                <div style="width: 160px;">
                    <input type="text" name="location" value="{{ request('location') }}" placeholder="Location..."
                        style="width: 100%; background-color: #1a1a1a; border: 1px solid #333; color: #fff; padding: 10px 14px; border-radius: 6px; font-size: 13px; outline: none;">
                </div>

                <!-- Filter Button -->
                <button type="submit"
                    style="background-color: #d4af37; color: #121212; border: none; padding: 10px 20px; font-weight: bold; border-radius: 6px; font-size: 13px; cursor: pointer; transition: 0.3s;">
                    Filter
                </button>

                <!-- Reset Button -->
                @if (request()->anyFilled(['search', 'category', 'location', 'status']))
                    <a href="{{ route('projects.show') }}"
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
                            <th>Title</th>
                            <th>Category</th>
                            <th>Location</th>
                            <th>Deadline</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($projects as $project)
                            <tr>
                                <td>{{ $project->id }}</td>
                                <td style="font-weight: 600; color: #fff;">{{ $project->title }}</td>
                                <td>{{ $project->category }}</td>
                                <td>{{ $project->location }}</td>
                                <td>{{ $project->deadline }}</td>
                                <td>
                                    <div class="action-btns">
                                        @auth
                                            @if (auth()->user()->role === 'admin' || auth()->user()->role === 'project_manager' || auth()->user()->is_admin)
                                                <!-- Edit Button -->
                                                <a href="{{ route('projects.edit', $project->id) }}" class="btn-edit">Edit</a>

                                                <!-- Delete Form -->
                                                <form action="{{ route('projects.delete', $project->id) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this project?');"
                                                    style="margin:0;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-delete">Delete</button>
                                                </form>
                                            @else
                                                <!-- Student / Volunteer View -->
                                                @php
                                                    $existingApplication = \App\Models\ProjectApplication::where(
                                                        'project_id',
                                                        $project->id,
                                                    )
                                                        ->where('user_id', auth()->id())
                                                        ->first();
                                                @endphp

                                                @if ($existingApplication)
                                                    <span class="badge badge-{{ strtolower($existingApplication->status) }}">
                                                        {{ ucfirst($existingApplication->status) }}
                                                    </span>
                                                @else
                                                    <form action="{{ url('/applications/add') }}" method="POST"
                                                        style="margin: 0;">
                                                        @csrf
                                                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                                                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                                        <button type="submit" class="btn-apply">
                                                            Apply Now
                                                        </button>
                                                    </form>
                                                @endif
                                            @endif
                                        @endauth
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="empty-state">
                                    No projects found matching your criteria.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination & Showing Info Footer -->
            @if (isset($projects) && method_exists($projects, 'hasPages') && $projects->count() > 0)
                <div class="pagination-footer">
                    <div class="pagination-info">
                        Showing {{ $projects->firstItem() }} to {{ $projects->lastItem() }} of {{ $projects->total() }}
                        results
                    </div>
                    <div class="pagination-container">
                        {{ $projects->appends(request()->query())->links() }}
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection
