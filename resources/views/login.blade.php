@include('partials.header')

@section('title', 'login') 

<main class="container my-4">
    <div class="col-md-6 m-auto border p-5">
        <h1 class="text-center pb-3">Login</h1>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('failure'))
        <div class="alert alert-danger">{{ session('failure') }}</div>
        @endif
        <form action="{{ route('user_register.login') }}" method="POST" class="needs-validation" novalidate>
            @csrf
            <div class="form-row">
                <div class="col-md-12 mb-3">
                    <label for="username_or_email">Username or Email</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                        </div>
                        <input type="text" name="username_or_email" 
                               class="form-control @error('username_or_email') is-invalid @enderror" 
                               id="username_or_email" 
                               placeholder="Username or Email" 
                               value="{{ old('username_or_email') }}" required>
                        @error('username_or_email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="password">Password</label>
                    <input type="password" name="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           id="password" placeholder="Password" required>
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
            <div class="mt-3">
                <p>Don't have an account? <a href="{{ url('registration') }}">Register here</a>.</p>
            </div>
        </form>
    </div>
</main>
