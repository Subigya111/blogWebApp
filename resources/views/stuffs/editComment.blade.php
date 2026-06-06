<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@include('components.layout')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-sm rounded-4 border-0">
                <div class="card-body p-4">
                    <div class="mb-4 text-center">
                        <h3 class="mb-1">Edit Comment</h3>
                        <p class="text-muted mb-0">Make changes to your comment before saving.</p>
                    </div>

                    <div class="mb-3 px-3 py-2 rounded-4 bg-light">
                        <div class="mb-3">
                            <span class="text-muted">Editing comment for post:</span>
                            <h5 class="mt-1">{{ optional($comment->post)->title ?? 'Unknown post' }}</h5>
                            @if(optional($comment->post)->id)
                                <a href="{{ route('posts.show', $comment->post) }}" class="text-decoration-none">View this post</a>
                            @endif
                        </div>  

                    <form action="{{ route('comments.update', $comment) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Comment</label>
                            <textarea name="comment" class="form-control rounded-4" rows="2">{{ old('comment', $comment->comment) }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-success w-100 py-2 rounded-4">Update Comment</button>
                    </form>

                    <div class="d-flex justify-content-center gap-2 mt-3">
                        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-sm rounded-4">
                            ← Back
                        </a>
                        <form action="{{ route('comments.delete', $comment) }}" method="POST" class="m-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-4">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>