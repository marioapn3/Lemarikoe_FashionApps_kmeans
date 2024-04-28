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

<body class="overflow-x-hidden">
    <x-navbar-dashboard />

    <div class="row">
        <x-sidebar-dashboard />
        <div class="col-lg-11 p-4 p-lg-5">
            <section class="mb-5">
                <div class="d-flex align-items-center justify-content-between mb-5">
                    <h1 class="title text-brown fw-bold mb-0">Mix & Match Outfit</h1>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="dashboard-mix-match.html" class="btn btn-soft-brown px-4">Manual</a>
                        <a href="dashboard-auto-mix-match.html" type="button" class="btn btn-brown px-4">Auto</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3">
                        <img src="assets//images/weather-2.png" alt="">
                        <div class="mb-3 mt-4">
                            <label for="occasion">Occasion</label>
                            <select name="occasion" id="occasion" class="form-select rounded">
                                <option value="Formal Event">Formal Event</option>
                                <option value="Casual">Casual</option>
                                <option value="Wedding">Wedding</option>
                                <option value="Business Related">Business Related</option>
                                <option value="Work">Work</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tags">Tags to include</label>
                            <textarea name="tags" id="tags" cols="30" rows="2" class="form-control rounded"></textarea>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-brown" type="submit">Generate</button>
                        </div>
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
                                            @foreach ($histories as $history)
                                                <div class="carousel-item">
                                                    @foreach ($history->mixMatch as $item)
                                                        <img src="{{ asset($item->digitalWardrobe->cloudFilePath) }}"
                                                            class="d-block" alt="...">
                                                    @endforeach
                                                </div>
                                            @endforeach

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
                                <button class="btn btn-primary px-4" type="button" data-bs-toggle="modal"
                                    data-bs-target="#successModal">
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
                    <img src="assets/images/login-success.svg" alt="Success" class="d-block mx-auto mb-3">
                    <h5 class="text-center mb-1">Saved!</h5>
                    <p class="text-center mb-4">Outfit Successfully Saved</p>
                    <a href="dashboard-history.html"
                        class="text-center text-decoration-underline text-primary fst-italic d-block mx-auto"
                        style="width: max-content;">
                        View newly saved outfit
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
