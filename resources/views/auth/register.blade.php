<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<body class="bg-light d-flex flex-column min-vh-100">

@include('components.layout')

<div class="container flex-grow-1">

    <div class="row justify-content-center align-items-center min-vh-100">

        <div class="col-11 col-sm-10 col-md-8 col-lg-5 col-xl-4">

            <div class="card border-0 shadow-lg">

                <div class="card-body p-4">

                    <h3 class="text-center fw-bold mb-2">
                        Create Account
                    </h1>

                    

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Name
                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                placeholder="Enter your name"
                                value="{{ old('name') }}"
                            >
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                placeholder="Enter your email"
                                value="{{ old('email') }}"
                            >
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Password
                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                placeholder="Enter your password"
                            >
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Confirm Password
                            </label>

                            <input
                                type="password"
                                name="password_confirmation"
                                class="form-control"
                                placeholder="Confirm your password"
                            >
                        </div>

                        <button
                            type="submit"
                            class="btn btn-primary w-100 py-2"
                        >
                            Register
                        </button>

                    </form>

                    <div class="text-center mt-4">
                        <p class="mb-0 text-muted">
                            Already have an account?
                            <a href="{{ route('loginForm') }}" class="text-decoration-none">
                                Log in
                            </a>
                        </p>
                    </div>

                </div>

            </div>

        </div>
     

    </div>


</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
