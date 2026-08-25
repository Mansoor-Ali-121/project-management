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

        .badge-approved {
            background-color: rgba(40, 167, 69, 0.2);
            color: #28a745;
            border: 1px solid #28a745;
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
                    <h2 class="custom-show-title">Active Volunteers</h2>
                    <p class="custom-show-subtitle">View all approved student/volunteer project applications.</p>
                </div>
            </div>

            <!-- Table Section -->
            <div class="custom-table-responsive">
                <table class="custom-table">

                    {{-- Success/Error Alert Messages --}}
                    @if (session('success'))
                        <div style="background-color: rgba(40, 167, 69, 0.2); border: 1px solid #28a745; color: #51cf66; padding: 12px 15px; border-radius: 8px; margin-bottom: 20px; font-size: 14px;">
                            <i class="fas fa-check-circle" style="margin-right: 8px;"></i> {{ session('success') }}
                        </div>
                    @endif

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User ID</th>
                            <th>Project Title</th>
                            <th>Applicant</th>
                            <th>Status</th>
                            <th style="text-align: right;">Applied Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($applications as $application)
                            <tr>
                                <td>{{ $application->id }}</td>
                                <td>{{ $application->user_id }}</td>
                                <td style="font-weight: 600; color: #fff;">{{ $application->project->title ?? 'N/A' }}</td>
                                <td>{{ $application->user->name ?? 'User #' . $application->user_id }}</td>
                                <td>
                                    <span class="badge badge-approved">
                                        {{ ucfirst($application->status) }}
                                    </span>
                                </td>
                                <td style="text-align: right;">{{ $application->created_at->format('Y-m-d') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="empty-state">
                                    No active volunteers or approved applications found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Footer -->
            @if (isset($applications) && method_exists($applications, 'hasPages') && $applications->count() > 0)
                <div class="pagination-footer">
                    <div class="pagination-info">
                        Showing {{ $applications->firstItem() }} to {{ $applications->lastItem() }} of
                        {{ $applications->total() }} results
                    </div>
                    <div class="pagination-container">
                        {{ $applications->appends(request()->query())->links() }}
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection