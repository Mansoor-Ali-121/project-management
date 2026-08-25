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

        /* Alert Box Styles */
        .alert-box {
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            display: none;
        }

        .alert-danger {
            background-color: rgba(220, 53, 69, 0.2);
            border: 1px solid #dc3545;
            color: #ff6b6b;
        }

        .alert-success {
            background-color: rgba(40, 167, 69, 0.2);
            border: 1px solid #28a745;
            color: #51cf66;
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
        }

        .custom-form-control:focus {
            border-color: #d4af37;
        }

        .custom-row {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .custom-col {
            flex: 1;
        }

        .custom-submit-container {
            border-top: 1px solid #333;
            padding-top: 20px;
            text-align: right;
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

        .custom-submit-btn:disabled {
            background-color: #666;
            cursor: not-allowed;
        }
    </style>

    <div class="custom-form-container">

        <!-- Main Form Card -->
        <div class="custom-form-card">

            <!-- Header Section -->
            <div class="custom-form-header">
                <div>
                    <h2 class="custom-form-title">Edit Project</h2>
                    <p class="custom-form-subtitle">Update the details of the community impact project below.</p>
                </div>
                <a href="{{ route('projects.show') }}" class="custom-back-btn">&larr; Back to Projects</a>
            </div>

            <!-- Inline Alert Message Box (Top) -->
            <div id="form-alert" class="alert-box"></div>

            <!-- Form Start -->
            <form id="ajax-edit-project-form">
                @csrf
                @method('PUT') <!-- Laravel PUT method for updates -->

                <!-- Title -->
                <div class="custom-form-group">
                    <label class="custom-form-label">Project Title</label>
                    <input type="text" name="title" class="custom-form-control"
                        value="{{ old('title', $project->title ?? '') }}" placeholder="e.g. Clean Rawalpindi Campaign"
                        required>
                </div>

                <!-- Description -->
                <div class="custom-form-group">
                    <label class="custom-form-label">Description</label>
                    <textarea name="description" rows="3" class="custom-form-control"
                        placeholder="Enter brief details about the project goals and objectives..." required style="resize: vertical;">{{ old('description', $project->description ?? '') }}</textarea>
                </div>

                <!-- Row 1: Category & Location -->
                <div class="custom-row">
                    <div class="custom-col">
                        <label class="custom-form-label">Category</label>
                        <input type="text" name="category" class="custom-form-control"
                            value="{{ old('category', $project->category ?? '') }}"
                            placeholder="e.g. Environment, Education" required>
                    </div>
                    <div class="custom-col">
                        <label class="custom-form-label">Location</label>
                        <input type="text" name="location" class="custom-form-control"
                            value="{{ old('location', $project->location ?? '') }}" placeholder="e.g. Rawalpindi, Islamabad"
                            required>
                    </div>
                </div>

                <!-- Row 2: Status & Deadline -->
                <div class="custom-row" style="margin-bottom: 25px;">
                    <div class="custom-col">
                        <label class="custom-form-label">Status</label>
                        <select name="status" class="custom-form-control">
                            <option value="pending"
                                {{ old('status', $project->status ?? '') == 'pending' ? 'selected' : '' }}>Pending
                            </option>
                            <option value="approved"
                                {{ old('status', $project->status ?? '') == 'approved' ? 'selected' : '' }}>Approved
                            </option>
                            <option value="rejected"
                                {{ old('status', $project->status ?? '') == 'rejected' ? 'selected' : '' }}>Rejected
                            </option>
                            <option value="completed"
                                {{ old('status', $project->status ?? '') == 'completed' ? 'selected' : '' }}>Completed
                            </option>
                        </select>
                    </div>
                    <div class="custom-col">
                        <label class="custom-form-label">Deadline</label>
                        <input type="date" name="deadline" class="custom-form-control" style="color-scheme: dark;"
                            value="{{ old('deadline', $project->deadline ?? '') }}" required>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="custom-submit-container">
                    <button type="submit" id="submit-btn" class="custom-submit-btn">Update Project</button>
                </div>

            </form>
        </div>
    </div>

    <!-- JavaScript for Fetch API & Inline Loader/Errors -->
    <script>
        document.getElementById('ajax-edit-project-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = this;
            const submitBtn = document.getElementById('submit-btn');
            const alertBox = document.getElementById('form-alert');

            // Hide previous alerts & set loader on button
            alertBox.style.display = 'none';
            alertBox.className = 'alert-box';
            submitBtn.disabled = true;
            submitBtn.innerHTML = 'Updating... <i class="fas fa-spinner fa-spin"></i>';

            const formData = new FormData(form);

            // Update route URL (Make sure your route name matches, e.g., projects.update with project ID)
            const updateUrl = "{{ route('projects.update', $project->id ?? 0) }}";

            fetch(updateUrl, {
                    method: 'POST', // Using POST with @method('PUT') or direct PUT depending on your handler
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(response => response.json().then(data => ({
                    status: response.status,
                    body: data
                })))
                .then(res => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = 'Update Project';

                    if (res.status >= 200 && res.status < 300) {
                        // Success
                        alertBox.className = 'alert-box alert-success';
                        alertBox.style.display = 'block';
                        alertBox.innerText = res.body.message || 'Project successfully updated!';

                        // Redirect back to project list after 1.5 seconds
                        setTimeout(() => {
                            window.location.href = "{{ route('projects.show') }}";
                        }, 1500);

                    } else {
                        // Validation or Server Error
                        alertBox.className = 'alert-box alert-danger';
                        alertBox.style.display = 'block';

                        if (res.body.errors) {
                            let errorMsg = '';
                            for (let key in res.body.errors) {
                                errorMsg += res.body.errors[key][0] + '<br>';
                            }
                            alertBox.innerHTML = errorMsg;
                        } else {
                            alertBox.innerText = res.body.message || 'Something went wrong, please try again.';
                        }
                    }
                })
                .catch(error => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = 'Update Project';

                    alertBox.className = 'alert-box alert-danger';
                    alertBox.style.display = 'block';
                    alertBox.innerText = 'A network error occurred. Please check your connection.';
                    console.error('Error:', error);
                });
        });
    </script>
@endsection
