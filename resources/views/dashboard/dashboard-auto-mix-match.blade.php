<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LemariKoe</title>

    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/boxicons/css/boxicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="overflow-x-hidden">
    <x-navbar-dashboard />

    <div class="row">
        <x-sidebar-dashboard />
        <div class="col-lg-11 p-4 p-lg-5">
            <section class="mb-5">
                <div class="d-flex align-items-center justify-content-between mb-5">
                    <h1 class="title text-brown fw-bold mb-0">Mix & Match Outfit</h1>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{ route('dashboard.mix-match') }}" class="btn btn-brown px-4">Manual</a>
                        <a href="{{ route('dashboard.auto-mix-match') }}" type="button"
                            class="btn btn-soft-brown px-4">Auto</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3">
                        <img src="assets//images/weather-2.png" alt="">
                        <form action="{{ route('dashboard.mix-match.generate-auto-mix-match') }}" method="POST">
                            @csrf

                            <div class="mb-3 mt-4">
                                <label for="occasion">Occasion</label>
                                <select name="occasion" id="occasion" class="form-select rounded">
                                    <option value="">Choose Event</option>
                                    <option value="Casual">Casual</option>
                                    <option value="Formal">Formal</option>
                                    <option value="Work">Work</option>
                                    <option value="School">School</option>
                                </select>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button class="btn btn-brown" type="submit">Generate</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6">
                        <section class="mt-5">
                            <div class="row align-items-end">
                                <div class="col-lg-2 d-none d-lg-block">
                                    <img src="assets/images/outfit/outfit-none.png" alt="">
                                </div>
                                <div class="col-lg-8">
                                    <div id="topCarousel" class="carousel slide carousel-outfit carousel-dark mb-2">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <img src="{{ asset('assets/images/outfit/outfit-none.png') }}"
                                                    class="d-block" alt="...">
                                            </div>
                                            @if (isset($top) && isset($bottom))
                                                @foreach ($top as $key => $t)
                                                    <div class="carousel-item">
                                                        <img src="{{ asset($t->cloudFilePath) }}" class="d-block"
                                                            alt="...">
                                                        @if (isset($bottom[$key]))
                                                            <img src="{{ asset($bottom[$key]->cloudFilePath) }}"
                                                                class="d-block" alt="...">
                                                        @endif
                                                    </div>
                                                @endforeach

                                            @endif

                                        </div>
                                        <button class="carousel-control-prev" type="button"
                                            data-bs-target="#topCarousel" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#topCarousel" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-lg-2 d-none d-lg-block">
                                    <img src="assets/images/outfit/outfit-none.png" alt="">
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-lg-3">
                        <section class="mt-5">
                            <div class="mb-3">
                                <label for="tags">Outfit Tags</label>
                                <textarea name="tags" id="tags" cols="30" rows="2" class="form-control rounded"
                                    placeholder="Add tags"></textarea>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-primary px-4" type="button" onclick="saveData()">
                                    Save
                                </button>
                            </div>

                            <div class="d-flex justify-content-end" style="margin-top: 100px;">
                                <a href="dashboard-mix-match.html" class="d-block">
                                    <img src="assets/images/edit.png" alt="">
                                </a>
                            </div>
                        </section>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <div class="modal fade" id="successModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered rounded-4">
            <div class="modal-content">
                <div class="modal-body p-3 p-lg-5">
                    <img src="{{ asset('assets/images/login-success.svg') }}" alt="Success"
                        class="d-block mx-auto mb-3">
                    <h5 class="text-center mb-1">Saved!</h5>
                    <p class="text-center mb-4">Outfit Successfully Saved</p>
                    <a href="{{ route('dashboard.outfit-history') }}"
                        class="text-center text-decoration-underline text-primary fst-italic d-block mx-auto"
                        style="width: max-content;">
                        View newly saved outfit
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function saveData() {
            // Mendapatkan elemen carousel
            var carousel = document.getElementById('topCarousel');

            // Mendapatkan semua elemen gambar di dalam carousel
            var images = carousel.querySelectorAll('.carousel-item img');
            var topCarouselSrc = '';
            var bottomCarouselSrc = '';
            // Loop melalui setiap elemen gambar untuk menemukan yang aktif
            images.forEach(function(image) {
                if (image.parentElement.classList.contains('active')) {
                    var src = image.getAttribute('src');
                    if (src.includes('tops')) {
                        topCarouselSrc = src;
                    } else if (src.includes('bottoms')) {
                        bottomCarouselSrc = src;
                    }
                }
            });
            var tags = document.querySelector('#tags').value;
            console.log(topCarouselSrc);
            console.log(bottomCarouselSrc);
            console.log(tags);
            $.ajax({
                type: "POST",
                url: "/dashboard/mix-match/store",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    topImageUrl: topCarouselSrc,
                    bottomImageUrl: bottomCarouselSrc,
                    tags: tags
                },
                success: function(response) {
                    $(document).ready(function() {
                        $('#successModal').modal('show');
                    });
                },
                error: function(xhr, status, error) {
                    // Tangani kesalahan jika terjadi
                    console.error(xhr.responseText);
                },
            });
        }
    </script>
</body>

</html>
