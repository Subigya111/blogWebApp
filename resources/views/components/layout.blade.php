<style>
    .site-header {
        background: #1f2937;
        color: white;
        padding: 0.75rem 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .site-header .brand {
        font-size: 1.25rem;
        font-weight: 700;
        letter-spacing: 0.02em;
    }

    .site-header .nav-actions {
        display: flex;
        align-items: center;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .site-header .nav-actions .user-name {
        color: #e2e8f0;
        font-weight: 600;
    }

    .site-header .nav-actions a,
    .site-header .nav-actions button {
        background: #3b82f6;
        color: white;
        border: none;
        padding: 0.55rem 0.95rem;
        border-radius: 0.5rem;
        text-decoration: none;
        font-weight: 600;
        cursor: pointer;
    }

    .site-header .nav-actions a:hover,
    .site-header .nav-actions button:hover {
        background: #2563eb;
    }

    .site-header .nav-actions button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .site-header .nav-actions form {
        display: inline;
        margin: 0;
    }

    .site-header .user-section {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .site-header .user-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #3b82f6;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        transition: transform 0.2s ease;
    }

    .site-header .user-avatar:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
    }

    .site-footer {
        border-top: 1px solid #e5e7eb;
        background: #ffffff;
        color: #6b7280;
        padding: 1rem 1.5rem;
        text-align: center;
        font-size: 0.9rem;
    }

    .site-footer a {
        color: #2563eb;
        text-decoration: none;
    }

    .site-footer a:hover {
        text-decoration: underline;
    }

    .brand small {
        display: block;
        margin-top: 0.4rem;
        color: #cbd5e1;
        font-size: 0.85rem;
        line-height: 1.4;
    }
</style>

<nav class="site-header">
    <div class="brand">
        <a href="{{ auth()->check() ? route('posts.index') : route('registerForm') }}" style="color: white; text-decoration: none;">The Blog-App</a>
        <small>
            Made with Laravel ❤️ by
            <a href="https://github.com/Subigya111/blogWebApp" target="_blank" rel="noopener">Subigya</a>
        </small>
    </div>

    <div class="nav-actions">
        @auth
            <div class="user-section">
                <span class="user-name">- Hi, {{ Auth::user()->name }}</span>
                @if(Auth::user()->imagePath)
                    <img src="{{ asset('storage/' . Auth::user()->imagePath) }}" alt="{{ Auth::user()->name }}" class="user-avatar">
                @else
                    <div class="user-avatar" style="background: #cbd5e1;"></div>
                @endif
            </div>

            {{--if not on create post page, button will not be displayed in nav bar--}}
            @if(Route::currentRouteName()!=='posts.create')  
                <a href="{{ route('posts.create') }}">Create Post</a>
            @endif

            @if(Route::currentRouteName() !== 'posts.index')
                <a href="{{ route('posts.index') }}">Latest Posts</a>
            @endif
            
            @if(Route::currentRouteName() !== 'posts.all')
                <a href="{{ route('posts.all') }}">All Posts</a>
            @endif
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @else
            <a href="{{ route('loginForm') }}">Login</a>
            <a href="{{ route('registerForm') }}">Register</a>
        @endauth
    </div>
</nav>

