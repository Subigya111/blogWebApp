<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@include('components.layout')
<div class="container mt-4">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-body">

                    <h3 class="text-center mb-4">Create Post</h3>

                    <form action="{{ route('posts.store') }}" method="POST">
                        @csrf

                        <!-- Title -->
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Enter Title" required>
                        </div>

                        <!-- Content -->
                        <div class="mb-3">
                            <label class="form-label">Content</label>
                            <textarea name="content" class="form-control" rows="20" placeholder="Enter Content" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-success w-100">
                            Save Post
                        </button>

                    </form>
<div class="text-center mt-3">
                        <a href="{{url()->previous() }}" class="btn btn-secondary btn-sm">
                            ← Back
                        </a>
                    </div>
                </div>
                
            </div>

        </div>

    </div>

   

    <!-- Validation Errors -->
    @if($errors->any())
        <div class="alert alert-danger mt-3">

            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>
    @endif

</div>