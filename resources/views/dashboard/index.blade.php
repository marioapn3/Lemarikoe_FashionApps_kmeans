<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LemariKoe</title>

    {{-- <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendors/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="assets/css/style.css"> --}}
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/boxicons/css/boxicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
    <x-navbar-dashboard /> <x-toast-component />
    <section class="py-5 section-dashboard">
        <div class="container">
            <div class="row align-items-center g-3 mb-4">
                <div class="col-lg-8">
                    <h1 class="text-brown2 text-uppercase">Welcome {{ Auth::user()->name }}!</h1>
                    <p class="title3 mb-0 text-brown2">Let's see what your wardrobe has to offer today!</p>
                </div>
                <div class="col-lg-4">
                    <div class="d-flex justify-content-end">
                        <img src="assets/images/weather.png" alt="Weather">
                    </div>
                </div>
            </div>
            <h5 class="title3 text-brown fw-semibold mb-4">What would you like to do?</h5>
            <div class="row g-4 mb-5">
                <div class="col-6 col-lg-3">
                    <a href="{{ route('dashboard.digital-wardrobe') }}" class="card border-0 rounded-4 card-bg">
                        <div class="card-body p-4">
                            <h4 class="text-white fw-bold mb-3">Digital <br> Wardrobe</h4>
                            <p class="text-white text-end fs-7">
                                Have your wardrobe collection a click away!
                            </p>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-lg-3">
                    <a href="{{ route('dashboard.mix-match') }}" class="card border-0 rounded-4 card-bg">
                        <div class="card-body p-4">
                            <h4 class="text-white fw-bold mb-3">Manual <br> Mix & Match</h4>
                            <p class="text-white text-end fs-7">
                                Create and pick your own outfit combination of desire!
                            </p>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-lg-3">
                    <a href="{{ route('dashboard.auto-mix-match') }}" class="card border-0 rounded-4 card-bg">
                        <div class="card-body p-4">
                            <h4 class="text-white fw-bold mb-3">Auto <br> Mix & Match</h4>
                            <p class="text-white text-end fs-7">
                                Save time and let our smart AI pick an outfit for you!
                            </p>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-lg-3">
                    <a href="{{ route('dashboard.outfit-history') }}" class="card border-0 rounded-4 card-bg">
                        <div class="card-body p-4">
                            <h4 class="text-white fw-bold mb-3">Outfit <br> History</h4>
                            <p class="text-white text-end fs-7">
                                View your past saved outfit selection!
                            </p>
                        </div>
                    </a>
                </div>
            </div>
            <h5 class="title3 text-brown text-end fw-semibold mb-4">See your latest outfit choices?</h5>
            <div class="row g-4 row-cols-2 row-cols-lg-5 mb-5">
                @foreach ($histories as $history)
                    <div class="col">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#detailModal"
                            class="card card-outfit rounded-4">
                            <div class="row  p-3">
                                @foreach ($history->mixMatch as $item)
                                    <img src="{{ asset($item->digitalWardrobe->cloudFilePath) }}" class="top-image"
                                        style="height: 120px;object-fit: contain;" alt="Outfit 1 Top">
                                @endforeach
                            </div>
                        </a>
                    </div>
                    {{-- @dd($history->mixMatch) --}}
                @endforeach
                {{-- <div class="col">
                    <a href="#" class="card card-outfit">
                        <div class="card-body">
                            <img src="assets/images/outfit/outfit-1.png" class="d-block mx-auto" alt="Outfit 1">
                        </div>
                    </a>
                </div> --}}

            </div>
        </div>
    </section>

    {{-- <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script> --}}
    <script src="{{ asset('assets/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
