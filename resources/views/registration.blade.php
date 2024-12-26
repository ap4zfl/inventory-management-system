@include('partials.header')

@section('title', 'registrations') 

<main class="container my-4">
   
  <div class="col-md-6 m-auto border p-5">
    <h1 class="text-center pb-3">Registration</h1>
    <form action="{{ route('user_register.store') }}" method="POST" class="needs-validation" novalidate>
      @csrf
      <div class="mb-3">
          <label for="username">Username</label>
          <input type="text" class="form-control @error('username') is-invalid @enderror" 
                 id="username" name="username" value="{{ old('username') }}" required>
          @error('username')
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror
      </div>
      <div class="mb-3">
          <label for="useremail">Email</label>
          <input type="email" class="form-control @error('useremail') is-invalid @enderror" 
                 id="useremail" name="useremail" value="{{ old('useremail') }}" required>
          @error('useremail')
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror
      </div>
      <div class="mb-3">
          <label for="userpassword">Password</label>
          <input type="password" class="form-control @error('userpassword') is-invalid @enderror" 
                 id="userpassword" name="userpassword" required>
          @error('userpassword')
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
  </form>
  <div class="mt-3">
    <p>Have an account? <a href="{{ url('login') }}">Login here</a>.</p>
</div>
  @if(session('success'))
      <div class="alert alert-success mt-3">{{ session('success') }}</div>
  @endif
</div>

</main>

@include('partials.footer') 
