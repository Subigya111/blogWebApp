<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@include('components.layout')

<div class="container mt-4">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <!-- Post Card -->
            <div class="card shadow">

                <div class="card-body">
                    <p class="card-text text-muted">
                        Author : {{ $post->user->name  }}
                    </p>
                    
                    <p class="card-text text-muted">
                        Created at: {{ optional($post->created_at)->format('F j, Y \a\t g:i A') }}
                    </p>

                    <h2 class="card-title mb-3">
                        {{ $post->title }}
                    </h2>

                    <p style="white-space: pre-line" class="card-text">
                        {{ $post->content }}
                    </p>

                    <a href="{{ route('posts.index') }}" class="btn btn-secondary mt-3">
                        ← Back
                    </a>

                </div>

            </div>

            <!-- Comments Section -->
            <div class="mt-4">
                @include('stuffs.comment')
            </div>

        </div>

    </div>

</div>