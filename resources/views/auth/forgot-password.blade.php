<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LemariKoe</title>
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/boxicons/css/boxicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

</head>

<body>
    <x-toast-component />
    <div class="container-fluid">
        <div class="row align-items-center authentication">
            <div class="col-lg-6 bg-brown min-h-screen d-none d-lg-flex align-items-center justify-content-center">
                <img src="{{ asset('assets/images/logo-only.png') }}" alt="Logo">
            </div>
            <div class="col-lg-6 form">
                <h3 class="text-dark text-center text-decoration-underline fw-bold mb-5">
                    Forgot Password?
                </h3>
                <h5 class="text-dark">No Worries!</h5>
                <p class="mb-5 text-secondary">
                    Just input your email address to get the link to reset your password.
                </p>

                <form action="{{ route('forgot-password-post') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <input type="email" name="email" id="email" class="form-control rounded-3 py-2 ps-3"
                            placeholder="Email">
                    </div>
                    {{-- <button class="btn btn-primary w-100 text-uppercase mb-2" type="button" data-bs-toggle="modal"
                        data-bs-target="#successModal">Send Reset Link</button> --}}
                    <button class="btn btn-primary w-100 text-uppercase mb-2" type="submit">Send Reset Link</button>
                    <a href="{{ route('login') }}" class="btn btn-outline-secondary w-100 text-uppercase"
                        type="submit">
                        Back to Login
                    </a>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="successModal" tabindex="-1">
        <div class="modal-dialog rounded-1">
            <div class="modal-content bg-warning">
                <div class="modal-body">
                    <div class="d-flex align-items-center justify-content-center gap-2">
                        <i class='bx bx-error text-danger fs-5'></i> A link to your email has been sent
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
