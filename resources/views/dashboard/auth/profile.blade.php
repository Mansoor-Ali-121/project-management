@extends('template')
@section('main-content')
    <!-- background orbs -->
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>

    <div class="card-wrapper">
        <div class="card">

            <!-- Header -->
            <div class="brand-icon">
                <svg width="42" height="42" viewBox="0 0 24 24" fill="none" stroke="#d4af37" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 2L2 7l10 5 10-5-10-5z" />
                    <path d="M2 17l10 5 10-5" />
                    <path d="M2 12l10 5 10-5" />
                </svg>
                <span class="brand-text">EXECUTIVE</span>
            </div>

            <h3 class="text-center">✦ OPERATIVE PROFILE ✦</h3>
            <div class="divider"></div>

            <!-- Profile Avatar -->
            <div class="profile-avatar-container">
                @if (Auth::user()->profile_picture)
                    <img src="{{ asset(Auth::user()->profile_picture) }}" alt="Avatar" class="profile-avatar">
                @else
                    <div class="profile-avatar-initial">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                @endif
            </div>

            <!-- User Info Grid -->
            <div class="info-grid">
                <div class="info-group">
                    <div class="info-label">Full Name</div>
                    <div class="info-value">{{ Auth::user()->name }}</div>
                </div>
                <div class="info-group">
                    <div class="info-label">Email Address</div>
                    <div class="info-value">{{ Auth::user()->email }}</div>
                </div>
                <div class="info-group">
                    <div class="info-label">Phone Number</div>
                    <div class="info-value">{{ Auth::user()->phone ?? 'Not Specified' }}</div>
                </div>
                <div class="info-group">
                    <div class="info-label">City</div>
                    <div class="info-value">{{ Auth::user()->city ?? 'Not Specified' }}</div>
                </div>
                <div class="info-group">
                    <div class="info-label">Skills / Clearance</div>
                    <div class="info-value">{{ Auth::user()->skills ?? 'None' }}</div>
                </div>
                <div class="info-group">
                    <div class="info-label">Assigned Role</div>
                    <div class="info-value">
                        <span class="badge-role">{{ Auth::user()->role ?? 'Operative' }}</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="button-group">
                <a href="{{ route('dashboard') }}" class="btn-gold btn-command">
                    <span class="btn-icon">◄</span> Command Center
                </a>
                <form action="{{ route('logout') }}" method="POST" class="logout-form">
                    @csrf
                    <button type="submit" class="btn-gold btn-danger">
                        <span class="btn-icon">⛔</span> Terminate Session
                    </button>
                </form>
            </div>

        </div>
    </div>

    <style>
        /* ===== RESET & BASE ===== */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background: radial-gradient(circle at 20% 30%, #0e0c14, #030303 90%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', 'Segoe UI', system-ui, -apple-system, sans-serif;
            padding: 1.5rem;
            position: relative;
            overflow-x: hidden;
        }

        /* ===== FLOATING ORBS ===== */
        .orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(90px);
            opacity: 0.4;
            pointer-events: none;
            z-index: 0;
            animation: floatDrift 16s ease-in-out infinite alternate;
        }

        .orb-1 {
            width: 500px;
            height: 500px;
            background: #d4af37;
            top: -10%;
            left: -8%;
            animation-delay: 0s;
        }

        .orb-2 {
            width: 450px;
            height: 450px;
            background: #b8860b;
            bottom: -12%;
            right: -6%;
            animation-delay: -5s;
        }

        .orb-3 {
            width: 300px;
            height: 300px;
            background: #f1c40f;
            top: 50%;
            left: 60%;
            animation-delay: -10s;
            opacity: 0.2;
        }

        @keyframes floatDrift {
            0% {
                transform: translate(0, 0) scale(1);
            }

            33% {
                transform: translate(20px, -30px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }

            100% {
                transform: translate(10px, -10px) scale(1.05);
            }
        }

        /* ===== CARD WRAPPER ===== */
        .card-wrapper {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 720px;
            padding: 4px;
            border-radius: 32px;
            background: linear-gradient(145deg, #d4af37, #7a5f1a, #d4af37, #b8860b);
            background-size: 300% 300%;
            animation: shimmerBorder 8s ease-in-out infinite;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.9), 0 0 0 1px rgba(212, 175, 55, 0.2) inset;
            margin: 2rem auto;
        }

        @keyframes shimmerBorder {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .card {
            background: #0b0d12;
            backdrop-filter: blur(2px);
            border: none;
            border-radius: 28px;
            padding: 2rem 2.2rem;
            color: #e5e9f0;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.7);
        }

        /* ===== HEADER ===== */
        .brand-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 0.5rem;
        }

        .brand-icon svg {
            filter: drop-shadow(0 0 8px #d4af37);
        }

        .brand-text {
            font-size: 1rem;
            font-weight: 300;
            letter-spacing: 4px;
            color: #b9c2d9;
        }

        h3 {
            font-weight: 700;
            letter-spacing: 3px;
            color: #d4af37;
            text-transform: uppercase;
            font-size: 1.6rem;
            text-shadow: 0 0 18px rgba(212, 175, 55, 0.3);
            margin-bottom: 1.2rem;
            text-align: center;
        }

        .divider {
            height: 2px;
            background: linear-gradient(90deg, transparent, #d4af3760, #d4af37, #d4af3760, transparent);
            margin: 0.5rem 0 1.8rem 0;
            width: 70%;
            margin-left: auto;
            margin-right: auto;
            border-radius: 10px;
        }

        /* ===== PROFILE AVATAR ===== */
        .profile-avatar-container {
            display: flex;
            justify-content: center;
            margin-bottom: 1.8rem;
        }

        .profile-avatar {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            border: 3px solid #d4af37;
            object-fit: cover;
            box-shadow: 0 0 30px rgba(212, 175, 55, 0.25);
            background: #131823;
        }

        .profile-avatar-initial {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            border: 3px solid #d4af37;
            background: linear-gradient(135deg, #1a1d28, #0b0d12);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            font-weight: 700;
            color: #d4af37;
            box-shadow: 0 0 30px rgba(212, 175, 55, 0.2);
            text-shadow: 0 0 20px rgba(212, 175, 55, 0.3);
        }

        /* ===== INFO GRID ===== */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 1.5rem;
        }

        .info-group {
            background: rgba(18, 22, 30, 0.85);
            border: 1px solid #2b3142;
            border-radius: 14px;
            padding: 12px 16px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .info-group:hover {
            border-color: #d4af37;
            box-shadow: 0 0 20px rgba(212, 175, 55, 0.05);
        }

        .info-label {
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: #9aa3b8;
            margin-bottom: 2px;
        }

        .info-value {
            font-size: 0.95rem;
            color: #f0f3fa;
            font-weight: 500;
            word-break: break-word;
        }

        /* ===== BADGE ===== */
        .badge-role {
            background: rgba(212, 175, 55, 0.15);
            border: 1px solid #d4af37;
            color: #d4af37;
            padding: 4px 16px;
            border-radius: 20px;
            font-size: 0.75rem;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 1px;
            display: inline-block;
        }

        /* ===== BUTTONS ===== */
        .button-group {
            display: flex;
            gap: 16px;
            margin-top: 0.5rem;
            align-items: stretch;
        }

        .btn-gold {
            position: relative;
            background: rgba(18, 22, 30, 0.4);
            color: #d4af37;
            font-weight: 700;
            letter-spacing: 2px;
            border: 2px solid #d4af37;
            border-radius: 50px;
            padding: 14px 28px;
            transition: all 0.3s ease;
            overflow: hidden;
            z-index: 1;
            text-transform: uppercase;
            font-size: 0.8rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            flex: 1;
            gap: 10px;
            min-height: 52px;
            backdrop-filter: blur(4px);
        }

        .btn-gold::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(120deg, #d4af37, #f1c40f, #d4af37);
            z-index: -1;
            transition: left 0.45s cubic-bezier(0.65, 0, 0.35, 1);
            border-radius: 50px;
        }

        .btn-gold:hover::before {
            left: 0;
        }

        .btn-gold:hover {
            color: #0b0d12 !important;
            border-color: #f1c40f;
            box-shadow: 0 0 30px rgba(212, 175, 55, 0.4);
            transform: translateY(-2px);
        }

        .btn-gold:active {
            transform: scale(0.97);
        }

        .btn-icon {
            font-size: 1.1rem;
            line-height: 1;
            display: inline-block;
        }

        /* Command Button */
        .btn-command {
            border-color: #d4af37;
            color: #d4af37;
        }

        /* Danger Button */
        .btn-danger {
            border-color: #ff4d4d !important;
            color: #ff4d4d !important;
            background: rgba(255, 77, 77, 0.05) !important;
        }

        .btn-danger::before {
            background: linear-gradient(120deg, #ff4d4d, #ff6b6b, #ff4d4d) !important;
        }

        .btn-danger:hover {
            color: #0b0d12 !important;
            border-color: #ff6b6b !important;
            box-shadow: 0 0 30px rgba(255, 77, 77, 0.3) !important;
            background: transparent !important;
        }

        .logout-form {
            flex: 1;
            margin: 0;
            display: flex;
        }

        .logout-form .btn-gold {
            width: 100%;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .info-grid {
                grid-template-columns: 1fr;
                gap: 10px;
            }
        }

        @media (max-width: 576px) {
            .card {
                padding: 1.5rem 1rem;
            }

            h3 {
                font-size: 1.3rem;
            }

            .orb-1,
            .orb-2 {
                width: 250px;
                height: 250px;
            }

            .profile-avatar,
            .profile-avatar-initial {
                width: 80px;
                height: 80px;
                font-size: 2rem;
            }

            .button-group {
                flex-direction: column;
                gap: 12px;
            }

            .btn-gold {
                padding: 12px 20px;
                min-height: 48px;
                font-size: 0.75rem;
            }
        }
    </style>
@endsection
