<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

@include('components.layout')

<div class="container my-5">
    <div class="profile-card mb-4 d-flex align-items-center gap-4 p-3 bg-white rounded shadow-sm">
        <a href="{{ route('posts.user') }}">
            @if(Auth::user()->imagePath)
                <img src="{{ asset('storage/' . Auth::user()->imagePath) }}" alt="{{ Auth::user()->name }}" style="width:96px;height:96px;object-fit:cover;border-radius:50%;border:4px solid #3b82f6;">
            @else
                <div style="width:96px;height:96px;border-radius:50%;background:#cbd5e1;border:4px solid #3b82f6;"></div>
            @endif
        </a>
        <div>
            <h2 class="mb-1">{{ Auth::user()->name }}</h2>
            <p class="text-muted mb-1">{{ $pageDescription ?? 'Your posts' }}</p>
            <p class="text-muted small mb-0">Total posts: {{ $posts->total() }}</p>
        </div>
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
                                
                                
                                <p class="mb-0 text-secondary">Created: {{ optional($post->created_at)->format('M j, Y g:i A') }}</p>
                                
                            </div>

                            <div class="d-flex flex-wrap gap-2">
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
                    You have not posted anything. Click<a href="{{ route('posts.create') }}"> here </a> to create one.
                </div>
            </div>
       
        @endforelse
    </div>
    @include('components.page')
    <div class="text-center mt-3">
                        <a href="{{ route('posts.all') }}" class="btn btn-secondary btn-sm">
                            ← Back
                        </a>
</div>
