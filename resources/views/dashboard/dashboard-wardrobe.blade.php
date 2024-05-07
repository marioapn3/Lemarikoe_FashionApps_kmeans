<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LemariKoe</title>
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/boxicons/css/boxicons.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

</head>

<body class="overflow-x-hidden">
    <x-navbar-dashboard />
    <x-toast-component />
    <div class="row">
        <x-sidebar-dashboard />
        <div class="col-lg-11 p-4 p-lg-5">
            <div class="row align-items-center justify-content-between mb-5 g-3">
                <div class="col-lg-5">
                    <h1 class="title text-brown fw-bolder mb-0">Digital Wardrobe</h1>
                </div>
                <div class="col-lg-7">
                    <form action="{{ route('dashboard.digital-wardrobe.filter') }}" method="GET">
                        <div class="d-flex align-items-center justify-content-end gap-2">
                            <div class="d-flex gap-2">
                                <div class="input-group gap-2">
                                    <select name="fashion_style" class="form-select rounded">
                                        {{-- mendapatkan data dari get url --}}
                                        <option value="" {{ !request()->has('fashion_style') ? 'selected' : '' }}>
                                            Filter Fashion Style</option>
                                        <option value="Vintage"
                                            {{ request('fashion_style') == 'Vintage' ? 'selected' : '' }}>Vintage
                                        </option>
                                        <option value="Classic"
                                            {{ request('fashion_style') == 'Classic' ? 'selected' : '' }}>Classic
                                        </option>
                                        <option value="Streetwear"
                                            {{ request('fashion_style') == 'Streetwear' ? 'selected' : '' }}>Streetwear
                                        </option>
                                        <option value="Minimalistic"
                                            {{ request('fashion_style') == 'Minimalistic' ? 'selected' : '' }}>
                                            Minimalistic</option>
                                        <option value="Indie"
                                            {{ request('fashion_style') == 'Indie' ? 'selected' : '' }}>Indie</option>
                                    </select>
                                    <select name="style" class="form-select rounded">
                                        <option value="" {{ !request()->has('style') ? 'selected' : '' }}>Filter
                                            Fashion Style</option>
                                        <option value="Casual" {{ request('style') == 'Casual' ? 'selected' : '' }}>
                                            Casual</option>
                                        <option value="Formal" {{ request('style') == 'Formal' ? 'selected' : '' }}>
                                            Formal</option>
                                        <option value="Work" {{ request('style') == 'Work' ? 'selected' : '' }}>Work
                                        </option>
                                        <option value="School" {{ request('style') == 'School' ? 'selected' : '' }}>
                                            School</option>
                                    </select>


                                    <select name="color" class="form-select rounded">
                                        <option value="" {{ !request()->has('color') ? 'selected' : '' }}>Filter
                                            Fashion Style</option>
                                        <option value="Dark" {{ request('color') == 'Dark' ? 'selected' : '' }}>Dark
                                        </option>
                                        <option value="Colourful"
                                            {{ request('color') == 'Colourful' ? 'selected' : '' }}>Colourful</option>
                                        <option value="Pastels" {{ request('color') == 'Pastels' ? 'selected' : '' }}>
                                            Pastels</option>
                                        <option value="Bright" {{ request('color') == 'Bright' ? 'selected' : '' }}>
                                            Bright</option>
                                        <option value="Monochrome"
                                            {{ request('color') == 'Monochrome' ? 'selected' : '' }}>Monochrome
                                        </option>

                                    </select>
                                </div>
                                <button class="btn btn-brown rounded-1" type="submit"><i
                                        class='bx bx-slider'></i></button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

            <!-- TOP -->

            <section class="mb-5 position-relative px-3 px-lg-5">
                <h2 class="title2 text-brown fw-bold mb-4">Tops</h2>
                <!-- EMPTY -->
                <!-- <div class="rounded-2 bg-light d-flex align-items-center justify-content-center" style="height: 300px;">
                    Added items will be displayed here
                </div> -->
                <div class="swiper topSwiper">
                    <div class="swiper-wrapper">
                        @foreach ($tops as $top)
                            <a href="#" data-id="{{ $top->id }}" href="javascript:void(0)"
                                id="btn-edit-post"
                                class="swiper-slide card card-outfit d-flex align-items-center justify-content-center">
                                <div class="card-body">
                                    <img src="{{ asset($top->cloudFilePath) }}" class="d-block mx-auto" alt="Outfit 1">
                                </div>
                            </a>
                        @endforeach

                    </div>
                </div>

                <div class="btn btn-light btn-sm rounded-circle cursor-pointer position-absolute"
                    style="top: 50%; left: 0px; width: 40px; height: 40px" id="nextTop">
                    <i class="bx bx-chevron-left fs-2"></i>
                </div>
                <div class="btn btn-light btn-sm rounded-circle cursor-pointer position-absolute"
                    style="top: 50%; right: -0; width: 40px; height: 40px" id="prevTop">
                    <i class="bx bx-chevron-right fs-2"></i>
                </div>
            </section>
            <!-- BOTTOM -->
            <section class="mb-5 position-relative px-3 px-lg-5">
                <h2 class="title2 text-brown fw-bold mb-4">Bottoms</h2>
                <div class="swiper bottomSwiper">
                    <div class="swiper-wrapper">
                        @foreach ($bottoms as $bottom)
                            <a href="#" data-id="{{ $bottom->id }}" href="javascript:void(0)"
                                id="btn-edit-post"
                                class="swiper-slide card card-outfit d-flex align-items-center justify-content-center">
                                <div class="card-body">
                                    <img src="{{ asset($bottom->cloudFilePath) }}" class="d-block mx-auto"
                                        alt="Outfit 1">
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="btn btn-light btn-sm rounded-circle cursor-pointer position-absolute"
                    style="top: 50%; left: 0px; width: 40px; height: 40px" id="nextBottom">
                    <i class="bx bx-chevron-left fs-2"></i>
                </div>
                <div class="btn btn-light btn-sm rounded-circle cursor-pointer position-absolute"
                    style="top: 50%; right: -0; width: 40px; height: 40px" id="prevBottom">
                    <i class="bx bx-chevron-right fs-2"></i>
                </div>
            </section>

            <!-- OVERALL -->
            <section class="mb-5 position-relative px-3 px-lg-5">
                <h2 class="title2 text-brown fw-bold mb-4">Overall</h2>
                <div class="swiper overallSwiper">
                    <div class="swiper-wrapper">

                        @foreach ($overalls as $overall)
                            <a data-id="{{ $overall->id }}" href="javascript:void(0)" id="btn-edit-post"
                                class="swiper-slide card card-outfit d-flex align-items-center justify-content-center">
                                <div class="card-body">
                                    <img src="{{ asset($overall->cloudFilePath) }}" class="d-block mx-auto"
                                        alt="Outfit 1">
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="btn btn-light btn-sm rounded-circle cursor-pointer position-absolute"
                    style="top: 50%; left: 0px; width: 40px; height: 40px" id="nextOverall">
                    <i class="bx bx-chevron-left fs-2"></i>
                </div>
                <div class="btn btn-light btn-sm rounded-circle cursor-pointer position-absolute"
                    style="top: 50%; right: -0; width: 40px; height: 40px" id="prevOverall">
                    <i class="bx bx-chevron-right fs-2"></i>
                </div>
            </section>
        </div>
    </div>

    <button class="btn btn-success rounded-circle position-fixed"
        style="width: 60px; height: 60px; bottom: 20px; right: 20px; z-index: 999" type="button"
        data-bs-toggle="modal" data-bs-target="#addOutfit">
        <i class="bx bx-plus fs-2"></i>
    </button>
    {{-- ADD MODAL --}}
    <div class="modal fade" id="addOutfit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="addOutfitLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addOutfitLabel">Outfit Form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form action="{{ route('dashboard.digital-wardrobe.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="col-lg-5">
                                <input type="file" accept="image/*" name="cloudFilePath" id="cloudFilePath"
                                    class="form-control">
                            </div>
                            <div class="col-lg-7">
                                {{-- buatkan label --}}
                                <label for="category-add"
                                    class="form-label
                                mb-2">Category</label>
                                <select name="category" id="category-add" class="form-select mb-3">
                                    <option value="">Category</option>
                                    <option value="Tops">Tops</option>
                                    <option value="Bottoms">Bottoms</option>
                                    <option value="Overalls">Overalls</option>
                                </select>
                                <label for="fashion_style"
                                    class="form-label
                                mb-2">Fashion Style</label>
                                <select name="fashion_style" class="form-select mb-3">
                                    <option value="Vintage">Vintage</option>
                                    <option value="Classic">Classic</option>
                                    <option value="Streetwear">Streetwear</option>
                                    <option value="Minimalistic">Minimalistic</option>
                                    <option value="Indie">Indie</option>
                                </select> <label for="style"
                                    class="form-label
                                mb-2">Ocassion</label>
                                <select name="style" class="form-select mb-3">
                                    <option value="Casual">Casual</option>
                                    <option value="Formal">Formal</option>
                                    <option value="Work">Work</option>
                                    <option value="School">School</option>
                                </select>
                                <label for="color"
                                    class="form-label
                                mb-2">Color</label>
                                <select name="color" class="form-select mb-3">
                                    <option value="Dark">Dark</option>
                                    <option value="Colourful">Colourful</option>
                                    <option value="Pastels">Pastels</option>
                                    <option value="Bright">Bright</option>
                                    <option value="Monochrome">Monochrome</option>
                                </select>

                                <textarea name="wardrobeTag" id="wardrobeTag" cols="30" rows="4" class="form-control mb-4"
                                    placeholder="Tags"></textarea>
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>

    </style>
    {{-- EDIT MODAL --}}
    <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Edit Outfit</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('dashboard.digital-wardrobe.update-data') }}" method="post">
                        @csrf
                        <div class="row">

                            <input type="hidden" name="id" id="id_wardrobe">
                            <div class="col-lg-5">
                                <img id="img" src="" alt="" class="rounded">
                            </div>
                            <div class="col-lg-7">
                                <select name="category" id="category" class="form-select mb-3">
                                    {{-- script if id valuenya adalah Tops maka yang active option Tops else Bottoms --}}
                                    {{-- <option value="">Category</option>
                                <option value="Tops">Tops</option>
                                <option value="Bottoms">Bottoms</option> --}}
                                </select>
                                <textarea id="tags" name="wardrobeTag" id="tags" cols="30" rows="4" class="form-control mb-4"
                                    placeholder="Tags"></textarea>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-primary" type="submit">Save</button>
                                    <button onclick="DeleteFormSubmit()" class="btn btn-light">Delete</button>

                                </div>

                            </div>

                        </div>
                    </form>
                    <form id="delete-form" action="{{ route('dashboard.digital-wardrobe.delete-data') }}"
                        method="post">
                        @csrf
                        <input type="hidden" name="id" id="id_wardrobe_delete">
                        {{-- <button class="btn btn-danger" type="submit">Delete</button> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- DELETE MODAL --}}
    {{-- <div class="modal fade" id="delete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="deleteLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
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
    </div> --}}
    {{-- tampil;kan semua session error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <script src="{{ asset('assets/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $('body').on('click', '#btn-edit-post', function() {
            let id_data = $(this).data('id');
            //fetch detail post with ajax
            let baseUrl = window.location.origin;
            $.ajax({
                url: `/dashboard/digital-wardrobe/edit-data/${id_data}`,
                type: "GET",
                cache: false,
                success: function(response) {
                    //fill data to form
                    let $img = baseUrl + '/' + response.data.cloudFilePath;
                    let $category = response.data.category;
                    $('#id_wardrobe').val(response.data.id);
                    $('#id_wardrobe_delete').val(response.data.id);
                    $('#img').attr('src', $img);
                    $('#tags').val(response.data.wardrobeTag);
                    //open modal
                    $('#editModal').modal('show');
                    if ($category == 'Tops') {
                        $('#category').html(`
                            <option value="">Category</option>
                            <option value="Tops" selected>Tops</option>
                            <option value="Bottoms">Bottoms</option>
                        `);
                    } else {
                        $('#category').html(`
                            <option value="">Category</option>
                            <option value="Tops">Tops</option>
                            <option value="Bottoms" selected>Bottoms</option>
                        `);
                    }

                }
            });
        });
    </script>
    <script>
        function DeleteFormSubmit() {
            event.preventDefault();
            $('#delete-form').submit();
        }
    </script>
    <script>
        var topSwiper = new Swiper(".topSwiper", {
            slidesPerView: 1,
            spaceBetween: 30,
            navigation: {
                nextEl: "#prevTop",
                prevEl: "#nextTop",
            },
            breakpoints: {
                992: {
                    slidesPerView: 4
                },
                768: {
                    slidesPerView: 2
                },
            }
        });
        var bottomSwiper = new Swiper(".bottomSwiper", {
            slidesPerView: 1,
            spaceBetween: 30,
            navigation: {
                nextEl: "#prevBottom",
                prevEl: "#nextBottom",
            },
            breakpoints: {
                992: {
                    slidesPerView: 4
                },
                768: {
                    slidesPerView: 2
                },
            }
        });
        var overallSwiper = new Swiper(".overallSwiper", {
            slidesPerView: 1,
            spaceBetween: 30,
            navigation: {
                nextEl: "#prevOverall",
                prevEl: "#nextOverall",
            },
            breakpoints: {
                992: {
                    slidesPerView: 4
                },
                768: {
                    slidesPerView: 2
                },
            }
        });
    </script>
</body>

</html>
