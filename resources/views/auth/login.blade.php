<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<body class="bg-light d-flex flex-column min-vh-100">

@include('components.layout')

<div class="container flex-grow-1 ">

    <div class="row justify-content-center align-items-center min-vh-100">

        <div class="col-11 col-sm-10 col-md-6 col-lg-5 col-xl-4">

            <div class="card border-0 shadow-lg">

                <div class="card-body p-4">

                    

                    <p class="text-center text-muted mb-4">
                        Login to continue 
                    </p>

                    <!-- Success Message -->
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Error Message -->
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Validation Errors -->
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                placeholder="Enter your email"
                                value="{{ old('email') }}"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password</label>
                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                placeholder="Enter your password"
                                required
                            >
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2">
                            Login
                        </button>

                    </form>

                    <div class="text-center mt-4">
                        <p class="mb-0 text-muted">
                            Don't have an account?
                            <a href="{{ route('registerForm') }}" class="text-decoration-none">
                                Register
                            </a>
                        </p>
                    </div>

                </div>
            </div>
                            
        </div>
       

    </div>

</div>



</body>