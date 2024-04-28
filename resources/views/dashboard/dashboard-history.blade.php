<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LemariKoe</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
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
                <div class="row align-items-center justify-content-between mb-5 g-3">
                    <div class="col-lg-5">
                        <h1 class="title text-brown fw-bolder mb-0">Outfit History</h1>
                    </div>
                    <div class="col-lg-7">
                        <div class="d-flex align-items-center justify-content-end gap-2">
                            <button class="btn btn-light" type="button">Delete</button>
                            <div class="d-flex gap-2">
                                <div class="input-group">
                                    <span class="input-group-text border-dark bg-transparent" id="filter"><i
                                            class="bx bx-filter"></i></span>
                                    <input type="text" class="form-control border-start-0 border-dark rounded-end-2"
                                        placeholder="Filter">
                                </div>
                                <button class="btn btn-brown rounded-1" type="submit"><i
                                        class='bx bx-slider'></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- @dd($histories) --}}
                <div class="row row-cols-2 row-cols-lg-5 g-4">
                    <div class="col">
                        @foreach ($histories as $history)
                            <a href="#" data-bs-toggle="modal" data-bs-target="#detailModal"
                                class="card card-outfit rounded-4">
                                {{-- <div class="card-body"> --}}

                                <div class="row  p-3">
                                    @foreach ($history->mixMatch as $item)
                                        {{-- @dd($item->digitalWardrobe) --}}
                                        <img src="{{ asset($item->digitalWardrobe->cloudFilePath) }}" class="top-image"
                                            style="height: 120px;object-fit: contain;" alt="Outfit 1 Top">
                                        {{-- <img src="{{ asset('assets/images/outfit/bottoms-1.png') }}"
                                            class="bottom-image" style="height: 130px;object-fit: contain;"
                                            alt="Outfit 1 Bottom"> --}}
                                    @endforeach
                                </div>

                                {{-- </div> --}}
                            </a>
                        @endforeach

                    </div>
                </div>
            </section>
        </div>
    </div>

    <div class="modal fade" id="detailModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-5">
                    <div class="row align-items-center">
                        <div class="col-lg-5">
                            <img src="assets/images/outfit/outfit-1.png" alt="" class="rounded d-block mx-auto">
                        </div>
                        <div class="col-lg-7">
                            <p>24/04/2024</p>
                            <span class="border border-secondary-subtle rounded p-2">#Formal</span>
                            <span class="border border-secondary-subtle rounded p-2">#Work</span>
                            <span class="border border-secondary-subtle rounded p-2">#Blouse</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="delete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="deleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body py-5">
                    <i class="bx bx-error text-danger text-center fs-1 d-block mx-auto"></i>
                    <h5 class="text-center mt-2">Are you sure want to delete the selected items?</h5>
                    <div class="d-flex align-items-center justify-content-center gap-2">
                        <button class="btn btn-danger" type="submit">Delete</button>
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
