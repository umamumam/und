<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Signup - {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('inapp/dist/assets/images/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('inapp/dist/assets/images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('inapp/dist/assets/images/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('inapp/dist/assets/site.webmanifest') }}">
    <meta name="theme-color" content="#ffffff">

    <script type="module" crossorigin src="{{ asset('inapp/dist/assets/js/main.js') }}"></script>
    <link rel="stylesheet" crossorigin href="{{ asset('inapp/dist/assets/css/main.css') }}">
</head>

<body>


    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="card " style="max-width:420px; width:100%;">
            <div class="card-body p-5">
                <div class="text-center mb-3">
                    <a href="/" class="mb-4 d-inline-block"><img
                            src="data:image/svg+xml,%3csvg%20width='62'%20height='67'%20viewBox='0%200%2062%2067'%20fill='none'%20xmlns='http://www.w3.org/2000/svg'%3e%3cpath%20d='M30.604%2066.378L0.00805664%2048.1582V35.7825L30.604%2054.0023V66.378Z'%20fill='%23302C4D'/%3e%3cpath%20d='M61.1996%2048.1582L30.604%2066.378V54.0023L61.1996%2035.7825V48.1582Z'%20fill='%23E66239'/%3e%3cpath%20d='M30.5955%200L0%2018.2198V30.5955L30.5955%2012.3757V0Z'%20fill='%23657E92'/%3e%3cpath%20d='M61.191%2018.2198L30.5955%200V12.3757L61.191%2030.5955V18.2198Z'%20fill='%23A3B2BE'/%3e%3cpath%20d='M30.604%2048.8457L0.00805664%2030.6259V18.2498L30.604%2036.47V48.8457Z'%20fill='%23302C4D'/%3e%3cpath%20d='M61.1996%2030.6259L30.604%2048.8457V36.47L61.1996%2018.2498V30.6259Z'%20fill='%23E66239'/%3e%3c/svg%3e"
                            alt="" width="36">
                        <span class="ms-2"> <img src="{{ asset('inapp/dist/assets/images/logo.svg') }}"
                                alt=""></span>
                    </a>
                    <h1 class="card-title mb-5 h5">Create your account</h1>

                </div>

                <form class="needs-validation mt-3" method="POST" action="{{ route('register') }}" novalidate>
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Full name</label>
                        <input id="name" type="text" name="name" class="form-control" placeholder="Jane Doe"
                            value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                        <div class="invalid-feedback">Please enter your name.</div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input id="email" type="email" name="email" class="form-control"
                            placeholder="name@example.com" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                        <div class="invalid-feedback">Please enter a valid email.</div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" type="password" name="password" class="form-control"
                            placeholder="Create a password" required minlength="8">
                        @error('password')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                        <div class="invalid-feedback">Please provide a password (min 8 characters).</div>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation"
                            class="form-control" placeholder="Repeat password" required>
                        @error('password_confirmation')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                        <div class="invalid-feedback">Passwords must match.</div>
                    </div>

                    <div class="mb-3 form-check">
                        <input id="terms" class="form-check-input" type="checkbox" required>
                        <label class="form-check-label small" for="terms">I agree to the <a href="#"
                                class="text-decoration-none">terms and privacy</a></label>
                        <div class="invalid-feedback">You must agree before continuing.</div>
                    </div>

                    <button class="btn btn-primary w-100" type="submit">Sign up</button>
                </form>

                <div class="text-center mt-3 small text-muted">
                    Already have an account? <a href="{{ route('login') }}" class="link-primary">Sign in</a>
                </div>
            </div>
        </div>
    </div>



    <!-- Bootstrap JS -->


</body>

</html>
