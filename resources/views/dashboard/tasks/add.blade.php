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
            max-width: 900px;
            margin: 0 auto;
            width: 100%;
            position: relative;
        }

        .custom-form-header {
            border-bottom: 1px solid #333;
            padding-bottom: 15px;
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
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

        .btn-back {
            background-color: transparent;
            border: 1px solid #d4af37;
            color: #d4af37;
            padding: 6px 15px;
            border-radius: 6px;
            font-size: 13px;
            text-decoration: none;
            transition: 0.3s;
            display: inline-block;
        }

        .btn-back:hover {
            background-color: rgba(212, 175, 55, 0.1);
            color: #d4af37;
        }

        .form-row {
            display: flex;
            gap: 20px;
        }

        .form-col {
            flex: 1;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            color: #d4af37;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            background-color: #1a1a1a;
            border: 1px solid #333;
            border-radius: 8px;
            padding: 12px 15px;
            color: #fff;
            font-size: 14px;
            box-sizing: border-box;
            transition: 0.3s;
        }

        .form-control:focus {
            border-color: #d4af37;
            outline: none;
            box-shadow: 0 0 5px rgba(212, 175, 55, 0.3);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 110px;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 25px;
        }

        .btn-submit {
            background-color: #d4af37;
            color: #121212;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: bold;
            font-size: 15px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-submit:hover {
            background-color: #c19b2e;
            box-shadow: 0 5px 15px rgba(212, 175, 55, 0.4);
        }

        .alert-error {
            background-color: rgba(220, 53, 69, 0.2);
            border: 1px solid #dc3545;
            color: #ff6b6b;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }
    </style>

    <div class="custom-form-container">
        <div class="custom-form-card">
            
            <div class="custom-form-header">
                <div>
                    <h2 class="custom-form-title">Assign New Task</h2>
                    <p class="custom-form-subtitle">Create and assign project tasks to approved volunteers.</p>
                </div>
                <div>
                    {{-- Agar task list ka route mojood hai toh yahan dein, warna apni marzi ka route lagayein --}}
                    <a href="{{ route('tasks.show') }}" class="btn-back">&larr; Back to Tasks</a>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert-error">
                    <ul style="margin: 0; padding-left: 15px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('tasks.add') }}" method="POST">
                @csrf

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Select Project</label>
                            <select name="project_id" class="form-control" required>
                                <option value="" disabled selected>-- Choose Approved Project --</option>
                                @isset($projects)
                                    @foreach($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->title }}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Assign To (Volunteer)</label>
                            <select name="assigned_to" class="form-control" required>
                                <option value="" disabled selected>-- Choose Volunteer --</option>
                                @isset($volunteers)
                                    @foreach($volunteers as $volunteer)
                                        <option value="{{ $volunteer->id }}">{{ $volunteer->name }}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Task Title</label>
                    <input type="text" name="title" class="form-control" placeholder="e.g. Design Landing Page UI" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" placeholder="Enter detailed task description and instructions..."></textarea>
                </div>

                <div class="form-group" style="max-width: 50%;">
                    <label class="form-label">Deadline</label>
                    <input type="date" name="deadline" class="form-control" required>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit">
                        Assign Task
                    </button>
                </div>

            </form>

        </div>
    </div>
@endsection