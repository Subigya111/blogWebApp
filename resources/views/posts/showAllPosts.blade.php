<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

@include('components.layout')

<div class="container my-5">
    <header class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h1 class="mb-1">All Posts</h1>
            <p class="text-muted mb-0">Browse the latest posts from your blog.</p>
        </div>

        
    </header>

    @if(session('success'))
        <div class="alert alert-success rounded-4 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="row g-4">
        @forelse($posts as $post)
            <div class="col-12">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body">
                        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center gap-3">
                            <div>
                                <h2 class="h4 card-title mb-2">{{ $post->title }}</h2>
                                <p class="text-muted mb-2">{{ Str::limit($post->content, 140) }}</p>
                                <br>
                                
                                <p class="mb-0 text-secondary">Author: {{ optional($post->user)->name ?? 'Unknown' }}</p>
                                
                                <p class="mb-0 text-secondary">Created: {{ optional($post->created_at)->format('M j, Y g:i A') }}</p>
                            </div>

                            <div class="d-flex flex-wrap gap-2">
                                <a href="{{ route('posts.show', $post) }}" class="btn btn-outline-primary btn-sm">View</a>
                                @if(auth()->id() == $post->user_id)
                                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-outline-warning btn-sm">Edit</a>
                                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                      

                    </div>
                </div>
            </div>
        

        @empty
            <div class="col-12">
                <div class="alert alert-info rounded-4 shadow-sm">
                    No posts found. Create the first post to get started.
                </div>
            </div>
       
        @endforelse
    </div>
</div>
