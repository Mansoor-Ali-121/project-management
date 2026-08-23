@extends('template')

@section('main-content')
    <div class="container-fluid px-4 py-4">
        <div class="card bg-dark text-light border-warning shadow-lg p-4" style="background-color: #121212 !important;">
            <h2 class="text-warning mb-4">Add New Project</h2>

            <form action="{{ route('projects.add') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label text-warning">Project Title</label>
                    <input type="text" class="form-control bg-black text-light border-warning" id="title"
                        name="title" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label text-warning">Description</label>
                    <textarea class="form-control bg-black text-light border-warning" id="description" name="description" rows="3"
                        required></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="category" class="form-label text-warning">Category</label>
                        <input type="text" class="form-control bg-black text-light border-warning" id="category"
                            name="category" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="location" class="form-label text-warning">Location</label>
                        <input type="text" class="form-control bg-black text-light border-warning" id="location"
                            name="location" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label text-warning">Status</label>
                        <select class="form-control bg-black text-light border-warning" id="status" name="status">
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="deadline" class="form-label text-warning">Deadline</label>
                        <input type="date" class="form-control bg-black text-light border-warning" id="deadline"
                            name="deadline" required>
                    </div>
                </div>

                <input type="hidden" name="user_id" value="1">

                <button type="submit" class="btn btn-warning text-dark fw-bold px-4 py-2 mt-3">Save Project</button>
            </form>
        </div>
    </div>
@endsection
