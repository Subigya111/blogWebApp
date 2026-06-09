<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

@include('components.layout')

<div class="container my-5">
    <header class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h1 class="mb-1">Latest Posts</h1>
            <p class="text-muted mb-0">Browse the latest posts.</p>
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
                                <p class="text-muted mb-2">{{ Str::limit($post->content, 120) }}<a href="{{ route('posts.show', $post) }}" class="text-decoration-none">Read More</a></p>
                                <br>
                                
                                <p class="mb-0 text-secondary">Author: {{ optional($post->user)->name ?? 'Unknown' }}</p>
                                
                                <p class="mb-0 text-secondary">Created: {{ optional($post->created_at)->format('M j, Y g:i A') }}</p>
                            </div>
                            <div class="d-flex flex-wrap gap-2 align-items-center">
                                <span class="badge rounded-pill bg-light text-secondary d-flex align-items-center gap-2">
                                    <span aria-hidden="true">💬</span>
                                    <span>{{ $post->comments()->count() }}</span>
                                </span>

                            <div class="d-flex flex-wrap gap-2">
                                @if(auth()->id() == $post->user_id)
                                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
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
                    No new post from last 24 hrs.   <a href="{{ route('posts.all') }}">  See All Posts. </a> 
                </div>
            </div>
       
        @endforelse
    </div>
     @include('components.page')
</div>
