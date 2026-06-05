<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@include('components.layout')
<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-7">

            <div class="card shadow">

                <div class="card-body">

                    <h3 class="text-center mb-4">Edit Post</h3>

                    <form action="{{ route('posts.update', $post) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div class="mb-3">
                            <label class="form-label">Title</label>

                            <input 
                                type="text" 
                                name="title" 
                                class="form-control"
                                value="{{ old('title', $post->title) }}"
                            >
                        </div>

                        <!-- Content -->
                        <div class="mb-3">
                            <label class="form-label">Content</label>

                            <textarea 
                                name="content" 
                                class="form-control" 
                                rows="20"
                            >{{ old('content', $post->content) }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-success w-100">
                            Update Post
                        </button>

                    </form>

                    <!-- Back & Delete Buttons (centered) -->
                    <div class="d-flex justify-content-center gap-2 mt-3">
                        <a href="{{ route('posts.index') }}" class="btn btn-secondary btn-sm">← Back</a>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="m-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete </button>
                        </form>
                    </div>
           

                </div>

            </div>

        </div>

    </div>

    <!-- Validation Errors -->
    @if($errors->any())

        <div class="alert alert-danger mt-4">

            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>

    @endif

</div>