@extends('template')

@section('main-content')
    <style>
        .custom-notification-container {
            padding: 20px 40px;
            width: 100%;
            box-sizing: border-box;
            min-height: calc(100vh - 140px);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .custom-notification-card {
            background-color: #121212;
            border: 1px solid #d4af37;
            border-radius: 14px;
            padding: 30px;
            color: #fff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        .custom-notification-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #333;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .custom-notification-title {
            color: #d4af37;
            margin: 0;
            font-size: 24px;
            font-weight: bold;
            font-family: 'Cinzel', serif;
        }

        .custom-notification-subtitle {
            color: #888;
            font-size: 13px;
            margin: 5px 0 0 0;
        }

        .custom-action-btn {
            background-color: transparent;
            color: #d4af37;
            border: 1px solid #d4af37;
            padding: 6px 14px;
            font-weight: bold;
            font-size: 12px;
            border-radius: 6px;
            text-decoration: none;
            transition: 0.3s;
            cursor: pointer;
        }

        .custom-action-btn:hover {
            background-color: #d4af37;
            color: #121212;
        }

        .notification-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .notification-item {
            background-color: #1a1a1a;
            border: 1px solid #333;
            border-left: 4px solid #333;
            border-radius: 8px;
            padding: 18px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: 0.3s;
        }

        .notification-item.unread {
            background-color: #1f1f1f;
            border-color: #444;
            border-left-color: #d4af37;
        }

        .notification-item:hover {
            border-color: #d4af37;
        }

        .notification-content-wrapper {
            display: flex;
            gap: 15px;
            align-items: flex-start;
        }

        .notification-icon {
            color: #d4af37;
            font-size: 18px;
            background: rgba(212, 175, 55, 0.1);
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            border: 1px solid rgba(212, 175, 55, 0.2);
            flex-shrink: 0;
            margin-top: 2px;
        }

        .notification-text h4 {
            color: #fff;
            margin: 0 0 5px 0;
            font-size: 15px;
            font-weight: 600;
        }

        .notification-text p {
            color: #aaa;
            margin: 0;
            font-size: 13px;
            line-height: 1.4;
        }

        .notification-time {
            color: #666;
            font-size: 11px;
            white-space: nowrap;
        }

        .empty-notifications {
            text-align: center;
            padding: 40px;
            color: #888;
            font-size: 14px;
        }
    </style>

    <div class="custom-notification-container">
        <div class="custom-notification-card">

            <div class="custom-notification-header">
                <div>
                    <h2 class="custom-notification-title">System Notifications</h2>
                    <p class="custom-notification-subtitle">Stay updated with recent activities, alerts, and system logs.</p>
                </div>
                
                {{-- Mark All as Read Button (Form ke zariye active kiya hai) --}}
                @if($notifications->where('is_read', false)->count() > 0)
                    <form action="{{ route('notifications.markAllRead') }}" method="POST">
                        @csrf
                        <button type="submit" class="custom-action-btn">
                            <i class="fas fa-check-double"></i> Mark All as Read
                        </button>
                    </form>
                @endif
            </div>

            <div class="notification-list">
                @forelse($notifications as $notification)
                    <div class="notification-item {{ !$notification->is_read ? 'unread' : '' }}">
                        <div class="notification-content-wrapper">
                            <div class="notification-icon">
                                <i class="fas fa-bell"></i>
                            </div>
                            <div class="notification-text">
                                <h4>{{ $notification->title }}</h4>
                                <p>{{ $notification->message }}</p>
                            </div>
                        </div>
                        <div class="notification-time">
                            {{ $notification->created_at->diffForHumans() }}
                        </div>
                    </div>
                @empty
                    <div class="empty-notifications">
                        <i class="fas fa-bell-slash" style="font-size: 28px; margin-bottom: 10px; color: #555;"></i>
                        <p>No new notifications found.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
@endsection