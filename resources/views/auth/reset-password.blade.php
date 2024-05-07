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
                    Reset Password
                </h3>
                <p class="mb-5 text-secondary">
                    Simply enter a new set of password to reset your password.
                </p>

                <form action="{{ route('validasi-forgot-password-post') }}" method="post">
                    @csrf
                    <input type="text" name="token" value="{{ $token }}">
                    <div class="input-group mb-3">
                        <input type="password" name="password" id="password" placeholder="Insert new password"
                            class="form-control rounded-end-0 py-2 ps-3 border-end-0">
                        <span class="input-group-text bg-white rounded rounded-start-0 border-start-0 cursor-pointer"
                            onclick="showHide()">
                            <i class="bx bx-low-vision"></i></span>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password_confirmation" id="password-confirm"
                            placeholder="Insert confirm password"
                            class="form-control rounded-end-0 py-2 ps-3 border-end-0">
                        <span class="input-group-text bg-white rounded rounded-start-0 border-start-0 cursor-pointer"
                            onclick="showHideConfirm()">
                            <i class="bx bx-low-vision"></i></span>

                    </div>
                    <button class="btn btn-primary w-100 text-uppercase mb-2" type="submit">Reset Password</button>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="successModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered rounded-3">
            <div class="modal-content">
                <div class="modal-body p-3 p-lg-5">
                    <img src="assets/images/login-success.svg" alt="Success" class="d-block mx-auto mb-3">
                    <h5 class="text-center mb-1">Success!</h5>
                    <p class="text-center mb-4">Password has successfully reset.</p>
                    <a href="login.html"
                        class="text-center text-decoration-underline text-primary fst-italic d-block mx-auto"
                        style="width: max-content;">
                        Back to login page
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        function showHide() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        function showHideConfirm() {
            var x = document.getElementById("password-confirm");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>


</html>
