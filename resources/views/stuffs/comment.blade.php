<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="mt-4">

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success rounded-4 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="card mb-4 shadow-sm border-0 rounded-4">
        <div class="card-body">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-3">
                <div>
                    <h4 class="mb-1">Comments</h4>
                    <p class="text-muted mb-0">Read or add feedback on this post.</p>
                </div>
                <span class="badge bg-primary text-white py-2 px-3">{{ $comments->count() }} comment{{ $comments->count() === 1 ? '' : 's' }}</span>
            </div>

            @if(!$userComment)
                <div class="border rounded-4 p-3 bg-light">
                    <h5 class="mb-3">Add Comment</h5>
                    <form action="{{ route('comments.store', $post) }}" method="POST">
                        @csrf
                        <textarea name="comment" class="form-control mb-3" placeholder="Write your comment..." rows="4"></textarea>
                        <button type="submit" class="btn btn-primary w-100">Submit Comment</button>
                    </form>
                </div>
            @else
                <div class="alert alert-info rounded-4">
                    You already posted a comment on this post.
                </div>
            @endif
        </div>
    </div>

    @forelse($comments as $comment)
        <div class="card mb-3 shadow-sm rounded-4">
            <div class="card-body">
                <div class="d-flex flex-column flex-sm-row justify-content-between gap-2 mb-2">
                    <div>
                        <strong>{{ $comment->user->name }}</strong>
                        <div class="text-muted small">{{ optional($comment->created_at)->diffForHumans() }}</div>
                    </div>
                    @if(auth()->id() == $comment->user_id)
                        <div class="d-flex gap-2">
                            <form action="{{ route('comments.edit', $comment) }}" method="GET" class="m-0">
                                @csrf
                                @method('GET')
                                <button class="btn btn-sm btn-outline-warning">Edit</button>
                            </form>
                            <form action="{{ route('comments.delete', $comment) }}" method="POST" class="m-0">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </div>
                    @endif
                </div>
                <p class="mb-0">{{ $comment->comment }}</p>
            </div>
        </div>
    @empty
        <div class="alert alert-secondary rounded-4">
            No comments yet. Be the first to leave feedback.
        </div>
    @endforelse

    <!-- Errors -->
    @if($errors->any())
        <div class="alert alert-danger mt-3 rounded-4 shadow-sm">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

</div>