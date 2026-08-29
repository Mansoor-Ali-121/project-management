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
            position: relative;
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

        /* Colorful Status Dropdown Styling */
        .status-dropdown {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            outline: none;
            cursor: pointer;
            transition: all 0.3s ease;
            background-color: #1a1a1a;
            color: #fff;
        }

        .status-dropdown option {
            background-color: #1a1a1a;
            color: #fff;
            padding: 8px;
        }

        .status-dropdown[value="todo"] {
            background-color: rgba(108, 117, 125, 0.2);
            color: #adb5bd;
            border: 1px solid #6c757d;
        }

        .status-dropdown option[value="todo"] {
            color: #adb5bd;
        }

        .status-dropdown[value="in_progress"] {
            background-color: rgba(23, 162, 184, 0.2);
            color: #17a2b8;
            border: 1px solid #17a2b8;
        }

        .status-dropdown option[value="in_progress"] {
            color: #17a2b8;
        }

        .status-dropdown[value="completed"] {
            background-color: rgba(40, 167, 69, 0.2);
            color: #28a745;
            border: 1px solid #28a745;
        }

        .status-dropdown option[value="completed"] {
            color: #28a745;
        }

        /* Action Buttons */
        .action-btns {
            display: flex;
            gap: 8px;
            align-items: center;
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

        .empty-state {
            text-align: center;
            padding: 40px;
            color: #888;
        }

        /* Floating Alert Notification Toast */
        #ajax-alert {
            display: none;
            background-color: rgba(40, 167, 69, 0.2);
            border: 1px solid #28a745;
            color: #51cf66;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
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
                    <h2 class="custom-show-title">Track Task Progress</h2>
                    <p class="custom-show-subtitle">Monitor assigned tasks, progress status, and deadlines.</p>
                </div>

                {{-- Sirf Admin ya Project Manager ko Assign New Task ka button dikhega --}}
                @php
                    $authUser = auth()->user();
                @endphp

                @if ($authUser && ($authUser->role === 'admin' || $authUser->role === 'project_manager' || $authUser->is_admin))
                    <a href="{{ route('tasks.add') }}" class="custom-add-btn">+ Assign New Task</a>
                @endif
            </div>

            <!-- Search & Filter Form Bar -->
            <form method="GET" action="{{ route('tasks.show') }}"
                style="display: flex; gap: 12px; margin-bottom: 25px; flex-wrap: wrap; align-items: center;">

                <!-- Search Input -->
                <div style="flex: 1; min-width: 250px;">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search by task title..."
                        style="width: 100%; background-color: #1a1a1a; border: 1px solid #333; color: #fff; padding: 10px 14px; border-radius: 6px; font-size: 13px; outline: none;">
                </div>

                <!-- Status Filter Dropdown -->
                <div style="width: 180px;">
                    <select name="status"
                        style="width: 100%; background-color: #1a1a1a; border: 1px solid #333; color: #fff; padding: 10px 14px; border-radius: 6px; font-size: 13px; outline: none; cursor: pointer;">
                        <option value="">All Status</option>
                        <option value="todo" {{ request('status') == 'todo' ? 'selected' : '' }}>Todo</option>
                        <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress
                        </option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed
                        </option>
                    </select>
                </div>

                <!-- Filter Button -->
                <button type="submit"
                    style="background-color: #d4af37; color: #121212; border: none; padding: 10px 20px; font-weight: bold; border-radius: 6px; font-size: 13px; cursor: pointer; transition: 0.3s;">
                    Filter
                </button>

                <!-- Reset Button -->
                @if (request()->anyFilled(['search', 'status']))
                    <a href="{{ route('tasks.show') }}"
                        style="background-color: #222; color: #aaa; border: 1px solid #444; padding: 10px 15px; border-radius: 6px; font-size: 13px; text-decoration: none; transition: 0.3s; display: inline-flex; align-items: center;">
                        Reset
                    </a>
                @endif
            </form>

            <!-- AJAX Dynamic Success Alert Box -->
            <div id="ajax-alert">
                <i class="fas fa-check-circle" style="margin-right: 8px;"></i> <span id="ajax-alert-message">Task status
                    updated successfully!</span>
            </div>

            <!-- Table Section -->
            <div class="custom-table-responsive">
                <table class="custom-table">

                    {{-- Blade Success Alert Message --}}
                    @if (session('success'))
                        <div
                            style="background-color: rgba(40, 167, 69, 0.2); border: 1px solid #28a745; color: #51cf66; padding: 12px 15px; border-radius: 8px; margin-bottom: 20px; font-size: 14px;">
                            <i class="fas fa-check-circle" style="margin-right: 8px;"></i> {{ session('success') }}
                        </div>
                    @endif

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Task Title</th>
                            <th>Project</th>
                            <th>Description</th>
                            <th>Assigned To</th>
                            <th>Deadline</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tasks as $task)
                            <tr>
                                <td>{{ $task->id }}</td>
                                <td>{{ $task->description }}</td>
                                <td style="font-weight: 600; color: #fff;">{{ $task->title }}</td>
                                <td>{{ $task->project->title ?? 'N/A' }}</td>
                                <td>{{ $task->assignee->name ?? 'N/A' }}</td>
                                <td style="color: #d4af37;">{{ $task->deadline }}</td>

                                <!-- Colorful Status Dropdown Column -->
                                <td>
                                    @php
                                        $authUser = auth()->user();
                                        $isAdminOrManager =
                                            $authUser &&
                                            ($authUser->role === 'admin' ||
                                                $authUser->role === 'project_manager' ||
                                                $authUser->is_admin);
                                    @endphp

                                    @if ($isAdminOrManager)
                                        {{-- Admin aur Project Manager ke liye interactive dropdown --}}
                                        <select class="status-dropdown" data-id="{{ $task->id }}"
                                            value="{{ $task->status }}">
                                            <option value="todo" {{ $task->status == 'todo' ? 'selected' : '' }}>Todo
                                            </option>
                                            <option value="in_progress"
                                                {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                            <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>
                                                Completed</option>
                                        </select>
                                    @else
                                        {{-- Normal User / Student ke liye sirf read-only text/badge --}}
                                        @php
                                            $statusLabels = [
                                                'todo' => 'Todo',
                                                'in_progress' => 'In Progress',
                                                'completed' => 'Completed',
                                            ];
                                            $statusColors = [
                                                'todo' => '#adb5bd',
                                                'in_progress' => '#17a2b8',
                                                'completed' => '#28a745',
                                            ];
                                        @endphp
                                        <span
                                            style="color: {{ $statusColors[$task->status] ?? '#fff' }}; font-weight: 600; font-size: 13px;">
                                            {{ $statusLabels[$task->status] ?? ucfirst($task->status) }}
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="empty-state">
                                    No tasks found matching your criteria.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination & Showing Info Footer -->
            @if (isset($tasks) && method_exists($tasks, 'hasPages') && $tasks->count() > 0)
                <div class="pagination-footer">
                    <div class="pagination-info">
                        Showing {{ $tasks->firstItem() }} to {{ $tasks->lastItem() }} of {{ $tasks->total() }} results
                    </div>
                    <div class="pagination-container">
                        {{ $tasks->appends(request()->query())->links() }}
                    </div>
                </div>
            @endif

        </div>
    </div>

    <!-- jQuery & AJAX Script with Success Toast & Color Toggle -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).on('change', '.status-dropdown', function() {
            let taskId = $(this).data('id');
            let newStatus = $(this).val();
            let dropdown = $(this);

            dropdown.attr('value', newStatus);
            dropdown.css('opacity', '0.5');

            $.ajax({
                url: "/tasks/" + taskId + "/update-status",
                type: "PATCH",
                data: {
                    _token: "{{ csrf_token() }}",
                    status: newStatus
                },
                success: function(response) {
                    dropdown.css('opacity', '1');
                    $('#ajax-alert-message').text(response.message ||
                        'Task status updated successfully!');
                    $('#ajax-alert').fadeIn(300).delay(2500).fadeOut(300);
                },
                error: function(xhr) {
                    dropdown.css('opacity', '1');
                    alert('Something went wrong while updating status.');
                }
            });
        });
    </script>
@endsection
