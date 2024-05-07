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
                <img src="assets/images/logo-only.png" alt="Logo">
            </div>
            <div class="col-lg-6 form">
                <h3 class="text-dark text-center text-decoration-underline fw-bold mb-5">
                    Register
                </h3>

                <form action="{{ route('register_post') }}" method="post">
                    @csrf
                    <!-- UNCOMMENT CODE JIKA KETIKA ERROR USERNAME & PASSWORD -->
                    <!-- <p class="mb-2 text-danger fs-7">
                        <i class='bx bx-error'></i> The username or password is incorrect!
                    </p> -->
                    <div class="mb-3">
                        <input type="text" name="name" id="username"
                            class="form-control border-0 border-bottom ps-0" placeholder="Insert username" autofocus>
                        <!-- TAMBAHKAN CLASS border-danger KETIKA ERROR USERNAME & PASSWORD -->
                        <!-- <input type="text" name="username" id="username" class="form-control border-0 border-bottom border-danger ps-0"
                            placeholder="Username" autofocus> -->
                    </div>
                    {{-- <div class="mb-3">
                        <input type="text" name="nickname" id="nickname"
                            class="form-control border-0 border-bottom ps-0" placeholder="Insert nickname" autofocus>
                        <!-- TAMBAHKAN CLASS border-danger KETIKA ERROR USERNAME & PASSWORD -->
                        <!-- <input type="text" name="username" id="username" class="form-control border-0 border-bottom border-danger ps-0"
                            placeholder="Username" autofocus> -->
                    </div> --}}
                    <div class="mb-3">
                        <input type="email" name="email" id="email"
                            class="form-control border-0 border-bottom ps-0" placeholder="Insert email address">
                    </div>
                    <div class="mb-3">
                        <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control border-0 border-bottom ps-0"
                                placeholder="Insert password" id="password" aria-describedby="password">
                            <span class="input-group-text bg-white border-0 border-bottom rounded-0 cursor-pointer"
                                onclick="showHide()">
                                <i class="bx bx-low-vision"></i></span>
                        </div>
                    </div>
                    <div class="mb-5">
                        <div class="input-group mb-3">
                            <input type="password" name="password"
                                class="form-control border-0 border-bottom ps-0 password" placeholder="Confirm password"
                                id="password-confirm" aria-describedby="password">
                            <span class="input-group-text bg-white border-0 border-bottom rounded-0 cursor-pointer"
                                onclick="showHideConfirm()">
                                <i class="bx bx-low-vision"></i></span>
                        </div>
                    </div>
                    <button class="btn btn-info text-white py-3 w-100 text-uppercase mb-2"
                        type="submit">Register</button>
                    <p class="text-secondary">
                        Already have an account? <a href="{{ route('login') }}" class="text-primary">Log In</a>
                    </p>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="successModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered rounded-4">
            <div class="modal-content">
                <div class="modal-body p-3 p-lg-5">
                    <img src="assets/images/login-success.svg" alt="Success" class="d-block mx-auto mb-3">
                    <h5 class="text-center mb-1">Success</h5>
                    <p class="text-center mb-4">User Created</p>
                    <a href="{{ route('login') }}"
                        class="text-center text-decoration-underline text-primary fst-italic d-block mx-auto"
                        style="width: max-content;">
                        Back to login page
                    </a>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var myModal = new bootstrap.Modal(document.getElementById('successModal'), {
                    keyboard: false
                });
                myModal.show();
            });
        </script>
    @endif


    {{-- buatkan jika terjadi error apapun maka akan muncul pesan --}}
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{ $error }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endforeach
    @endif
    {{-- <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div> --}}

    {{-- <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script> --}}
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
