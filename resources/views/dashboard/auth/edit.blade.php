@extends('template')

@section('main-content')
    <style>
        .custom-form-container {
            padding: 20px 40px;
            width: 100%;
            box-sizing: border-box;
        }

        .custom-form-card {
            background-color: #121212;
            border: 1px solid #d4af37;
            border-radius: 14px;
            padding: 30px;
            color: #fff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        .custom-form-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #333;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .custom-form-title {
            color: #d4af37;
            margin: 0;
            font-size: 24px;
            font-weight: bold;
            font-family: 'Cinzel', serif;
        }

        .custom-form-subtitle {
            color: #888;
            font-size: 13px;
            margin: 5px 0 0 0;
        }

        .custom-back-btn {
            background: transparent;
            border: 1px solid #d4af37;
            color: #d4af37;
            padding: 6px 15px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            transition: 0.3s;
        }

        .custom-back-btn:hover {
            background: #d4af37;
            color: #121212;
        }

        /* Proper Error Alert Styling */
        .custom-alert-danger {
            background-color: rgba(220, 53, 69, 0.15);
            border: 1px solid #dc3545;
            color: #ff6b6b;
            padding: 12px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .custom-form-group {
            margin-bottom: 20px;
        }

        .custom-form-label {
            display: block;
            color: #d4af37;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .custom-form-control {
            width: 100%;
            background-color: #1a1a1a;
            border: 1px solid #444;
            color: #fff;
            padding: 12px 15px;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            box-sizing: border-box;
            transition: 0.3s;
        }

        .custom-form-control:focus {
            border-color: #d4af37;
        }

        textarea.custom-form-control {
            resize: vertical;
            min-height: 90px;
        }

        .custom-row {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .custom-col {
            flex: 1;
        }

        .error-feedback {
            color: #dc3545;
            font-size: 12px;
            margin-top: 5px;
            display: block;
        }

        .current-avatar {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-top: 10px;
        }

        .current-avatar img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 1px solid #d4af37;
        }

        .custom-submit-container {
            border-top: 1px solid #333;
            padding-top: 20px;
            text-align: right;
            margin-top: 10px;
        }

        .custom-submit-btn {
            background-color: #d4af37;
            color: #121212;
            border: none;
            padding: 10px 28px;
            font-weight: bold;
            font-size: 15px;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }

        .custom-submit-btn:hover {
            opacity: 0.9;
        }
    </style>

    <div class="custom-form-container">
        <div class="custom-form-card">

            <!-- Header Section -->
            <div class="custom-form-header">
                <div>
                    <h2 class="custom-form-title">Edit User</h2>
                    <p class="custom-form-subtitle">Update user information, credentials, and role permissions.</p>
                </div>
                <a href="{{ route('users.show') }}" class="custom-back-btn">&larr; Back to Users</a>
            </div>

            <!-- Edit Form -->
            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Global Error Handling Box -->
                @if ($errors->any())
                    <div class="custom-alert-danger">
                        <strong>Please fix the following errors:</strong>
                        <ul style="margin: 5px 0 0 20px; padding: 0;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Row 1: Name & Email -->
                <div class="custom-row">
                    <div class="custom-col">
                        <label class="custom-form-label">Full Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}"
                            class="custom-form-control" required>
                        @error('name')
                            <span class="error-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="custom-col">
                        <label class="custom-form-label">Email Address</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                            class="custom-form-control" required>
                        @error('email')
                            <span class="error-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Row 2: Phone & City -->
                <div class="custom-row">
                    <div class="custom-col">
                        <label class="custom-form-label">Phone Number</label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                            class="custom-form-control">
                        @error('phone')
                            <span class="error-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="custom-col">
                        <label class="custom-form-label">City</label>
                        <input type="text" name="city" value="{{ old('city', $user->city) }}"
                            class="custom-form-control">
                        @error('city')
                            <span class="error-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Row 3: Role & Profile Picture -->
                <div class="custom-row">
                    <div class="custom-col">
                        <label class="custom-form-label">User Role</label>
                        <select name="role" class="custom-form-control" style="cursor: pointer;">
                            <option value="student" {{ old('role', $user->role) == 'student' ? 'selected' : '' }}>Student
                            </option>
                            <option value="project_manager"
                                {{ old('role', $user->role) == 'project_manager' ? 'selected' : '' }}>Project Manager
                            </option>
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin
                            </option>
                        </select>
                        @error('role')
                            <span class="error-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="custom-col">
                        <label class="custom-form-label">Profile Picture</label>
                        <input type="file" name="profile_picture" class="custom-form-control" style="padding: 9px 15px;">
                        @error('profile_picture')
                            <span class="error-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Skills -->
                <div class="custom-form-group">
                    <label class="custom-form-label">Skills</label>
                    <textarea name="skills" class="custom-form-control" placeholder="e.g. PHP, Laravel, JavaScript...">{{ old('skills', $user->skills) }}</textarea>
                    @error('skills')
                        <span class="error-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Current Picture Preview (if available) -->
                @if ($user->profile_picture)
                    <div class="custom-form-group">
                        <label class="custom-form-label">Current Picture</label>
                        <div class="current-avatar">
                            <img src="{{ asset($user->profile_picture) }}" alt="User Avatar">
                            <span style="color: #888; font-size: 13px;">New image upload karne par yeh replace ho jaye gi.</span>
                        </div>
                    </div>
                @endif

                <!-- Submit Button Container -->
                <div class="custom-submit-container">
                    <button type="submit" class="custom-submit-btn">Update User</button>
                </div>

            </form>

        </div>
    </div>
@endsection