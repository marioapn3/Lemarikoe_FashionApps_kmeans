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
    <x-navbar-dashboard />
    <section class="py-5 bg-light">
        <div class="container">
            <h1 class="text-center text-decoration-underline mb-5">Manage Account</h1>
            @if (session('success'))
                <div class="alert alert-success mb-3" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger mb-3" role="alert">
                    {{ Session::get('error') }}
                </div>
            @endif
            {{-- <div class="alert alert-success mb-3" role="alert">
                Changes Successfully Saved!
            </div> --}}
            <div class="card mb-4">
                <div class="card-body p-4">
                    <h3 class="mb-2">Profile Information</h3>
                    <p class="mb-4 text-secondary">Update and edit your account profile information</p>

                    <form action="{{ route('dashboard.update-profile') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="username">Username</label>
                            <input type="text" name="name" id="username" value="{{ Auth::user()->name }}"
                                class="form-control" placeholder="Insert username">
                        </div>

                        <div class="mb-3">
                            <label for="email">Email Address</label>
                            <input value="{{ Auth::user()->email }}" type="email" name="email" id="email"
                                class="form-control" placeholder="Insert email address">
                        </div>
                        <button class="btn btn-info text-white px-4" type="submit">Save</button>
                    </form>
                </div>
            </div>


            <div class="card mb-4">
                <div class="card-body p-4">
                    <h3 class="mb-2">Update Password</h3>
                    <p class="mb-4 text-secondary">Keep your account safe and secure!</p>
                    <form action="{{ route('dashboard.update-password') }}" method="post">
                        @csrf
                        @method('POST')
                        <div class="mb-3">
                            <label for="password">Current Password</label>
                            <input type="password" name="current-password" id="password" class="form-control"
                                placeholder="Insert current password">
                        </div>
                        <div class="mb-3">
                            <label for="password">New Password</label>
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Insert new password">
                        </div>
                        <button class="btn btn-info text-white px-4" type="submit">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('assets/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
