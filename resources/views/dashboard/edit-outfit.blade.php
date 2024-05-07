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
    <x-toast-component />
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
                    <div class="col-lg-5">
                        <div class="row g-3">
                            <div class="col-lg-8">
                                <ul class="nav nav-tabs nav-tabs-outfit" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="top-tab" data-bs-toggle="tab"
                                            data-bs-target="#top-tab-pane" type="button" role="tab"
                                            aria-controls="top-tab-pane" aria-selected="true">Tops</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="bottom-tab" data-bs-toggle="tab"
                                            data-bs-target="#bottom-tab-pane" type="button" role="tab"
                                            aria-controls="bottom-tab-pane" aria-selected="false">Bottoms</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="overall-tab" data-bs-toggle="tab"
                                            data-bs-target="#overall-tab-pane" type="button" role="tab"
                                            aria-controls="overall-tab-pane" aria-selected="false">Overalls</button>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-white rounded-end-0" id="search">
                                        <i class="bx bx-search text-brown"></i>
                                    </span>
                                    <input type="text" class="form-control border-start-0 rounded rounded-start-0"
                                        placeholder="Search">
                                </div>
                            </div>
                        </div>
                        <div class="tab-content border border-brown tab-outfit rounded-2" id="myTabContent">
                            <div class="tab-pane fade show active" id="top-tab-pane" role="tabpanel"
                                aria-labelledby="top-tab" tabindex="0">
                                <div class="row row-cols-2 row-cols-lg-3">
                                    @foreach ($topsK as $t)
                                        <div class="col">
                                            <img src="{{ asset($t->cloudFilePath) }}" class="d-block mx-auto"
                                                alt="">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane fade" id="bottom-tab-pane" role="tabpanel"
                                aria-labelledby="profile-tab" tabindex="0">
                                <div class="row row-cols-2 row-cols-lg-3">
                                    @foreach ($bottomsK as $b)
                                        <div class="col">
                                            <img src="{{ asset($b->cloudFilePath) }}" class="d-block mx-auto"
                                                alt="">
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            <div class="tab-pane fade" id="overall-tab-pane" role="tabpanel"
                                aria-labelledby="contact-tab" tabindex="0">
                                <div class="row row-cols-2 row-cols-lg-3">
                                    @foreach ($overalls as $overall)
                                        <div class="col">
                                            <img src="{{ asset($overall->cloudFilePath) }}" class="d-block mx-auto"
                                                alt="">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <section class="mt-5">
                            <div id="topCarousel" class="carousel slide carousel-outfit carousel-dark mb-2">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="{{ asset($top) }}" class="d-block mx-auto" alt="...">
                                    </div>

                                    @foreach ($tops as $top)
                                        <div class="carousel-item">
                                            <img src="{{ asset($top->cloudFilePath) }}" class="d-block mx-auto"
                                                alt="...">
                                        </div>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#topCarousel"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#topCarousel"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                            <div id="bottomCarousel" class="carousel slide carousel-outfit carousel-dark mb-2">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="{{ asset($bot) }}" class="d-block mx-auto" alt="...">
                                    </div>
                                    @foreach ($bottoms as $bottom)
                                        <div class="carousel-item">
                                            <img src="{{ asset($bottom->cloudFilePath) }}" class="d-block mx-auto"
                                                alt="...">
                                        </div>
                                    @endforeach

                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#bottomCarousel"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#bottomCarousel"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </section>
                    </div>
                    <div class="col-lg-3">
                        <section class="mt-5">
                            <div class="mb-3">
                                {{-- occasion --}}
                                <label for="tags">Select Occassion</label>
                                <select name="occasion" id="occasion" class="form-select rounded">
                                    <option value="" {{ $data->occasion == '' ? 'selected' : '' }}>Choose Event
                                    </option>
                                    <option value="Casual" {{ $data->occasion == 'Casual' ? 'selected' : '' }}>Casual
                                    </option>
                                    <option value="Formal" {{ $data->occasion == 'Formal' ? 'selected' : '' }}>Formal
                                    </option>
                                    <option value="Work" {{ $data->occasion == 'Work' ? 'selected' : '' }}>Work
                                    </option>
                                    <option value="School" {{ $data->occasion == 'School' ? 'selected' : '' }}>School
                                    </option>
                                </select>

                            </div>
                            <div class="d-flex justify-content-end">
                                <button onclick="saveData()" class="btn btn-primary px-4" type="button"
                                    id="saveButton">
                                    Save
                                </button>
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
    {{-- script ajjax cdn --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function getActiveImageSrc(carouselId) {
            var activeItem = document.querySelector('#' + carouselId + ' .carousel-item.active img');
            return activeItem.getAttribute('src');
        }
        var selectedValue;
        var selectElement = document.getElementById('occasion');
        var selectedValue = selectElement.value;

        selectElement.addEventListener('change', function() {
            selectedValue = this.value; // Memperbarui nilai variabel global saat perubahan terjadi
        });



        function saveData() {
            var topCarouselSrc = getActiveImageSrc('topCarousel');
            var bottomCarouselSrc = getActiveImageSrc('bottomCarousel');
            var dataId = '{{ $data->id }}';
            console.log(topCarouselSrc);
            console.log(bottomCarouselSrc);
            console.log(selectedValue);
            console.log(dataId);
            $.ajax({
                type: "POST",
                url: "/dashboard/outfit-history/update",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    topImageUrl: topCarouselSrc,
                    bottomImageUrl: bottomCarouselSrc,
                    occasion: selectedValue,
                    id: dataId,
                },
                success: function(response) {
                    $(document).ready(function() {
                        $('#successModal').modal('show');
                    });
                },
                error: function(xhr, status, error) {
                    // Tangani kesalahan jika terjadi
                    console.log(xhr);
                },
            });
        }
    </script>

</body>

</html>
