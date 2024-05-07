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
    <style>
        .top-height {
            height: 60px;
        }

        .bot-height {
            height: 140px;
        }

        @media (min-width: 576px) {
            .top-height {
                height: 70px;
            }

            .bot-height {
                height: 145px;
            }
        }

        @media (min-width: 768px) {
            .top-height {
                height: 70px;
            }

            .bot-height {
                height: 150px;
            }
        }

        @media (min-width: 992px) {
            .top-height {
                height: 85px;
            }

            .bot-height {
                height: 160px;
            }
        }
    </style>
</head>

<body class="overflow-x-hidden">
    <x-navbar-dashboard />
    <x-toast-component />
    <div class="row">
        <x-sidebar-dashboard />
        <div class="col-lg-11 p-4 p-lg-5">
            <section class="mb-5">
                <div class="row align-items-center justify-content-between mb-5 g-3">
                    <div class="col-lg-5">
                        <h1 class="title text-brown fw-bolder mb-0">Outfit History</h1>
                    </div>
                    <div class="col-lg-7">
                        <form action="{{ route('dashboard.outfit-history.filter') }}" method="GET">
                            <div class="d-flex align-items-center justify-content-end gap-2">
                                <div class="d-flex gap-2">
                                    <div class="input-group">

                                        <select name="occasion" id="occasion" class="form-select rounded">

                                            <option value="" {{ !request()->has('occasion') ? 'selected' : '' }}>
                                                Filter
                                                Occasion</option>
                                            <option value="Casual"
                                                {{ request('occasion') == 'Casual' ? 'selected' : '' }}>
                                                Casual</option>
                                            <option value="Formal"
                                                {{ request('occasion') == 'Formal' ? 'selected' : '' }}>
                                                Formal</option>
                                            <option value="Work"
                                                {{ request('occasion') == 'Work' ? 'selected' : '' }}>
                                                Work
                                            </option>
                                            <option value="School"
                                                {{ request('occasion') == 'School' ? 'selected' : '' }}>
                                                School</option>
                                        </select>
                                    </div>
                                    <button class="btn btn-brown rounded-1" type="submit"><i
                                            class='bx bx-slider'></i></button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
                {{-- @dd($histories) --}}
                <div class="row row-cols-2 row-cols-lg-5 g-4">
                    @foreach ($histories as $history)
                        <div class="col">
                            <a data-id="{{ $history->id }}" href="javascript:void(0)" id="btn-edit-post"
                                class="card card-outfit rounded-4">
                                {{-- <div class="card-body"> --}}

                                <div class="row  p-3">
                                    @foreach ($history->mixMatch as $index => $item)
                                        {{-- Cek indeks untuk menentukan tinggi gambar --}}
                                        @if ($index == 0)
                                            <img src="{{ asset($item->digitalWardrobe->cloudFilePath) }}"
                                                class="top-image top-height" style=" object-fit: contain;"
                                                alt="Outfit 1 Top">
                                        @else
                                            <img src="{{ asset($item->digitalWardrobe->cloudFilePath) }}"
                                                class="top-image bot-height" style=" object-fit: contain;"
                                                alt="Outfit 1 Top">
                                        @endif
                                    @endforeach

                                </div>

                                {{-- </div> --}}
                            </a>

                        </div>
                    @endforeach

                </div>
            </section>
        </div>
    </div>
    {{-- <div class="modal fade" id="delete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
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
    </div> --}}
    <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-5">
                    <div class="row align-items-center">
                        <div class="col-lg-5">
                            <img id="tops" src="" alt="" class="rounded d-block mx-auto">
                            <img id="bots" src="" alt="" class="rounded d-block mx-auto">
                        </div>
                        <div class="col-lg-7">
                            <p id="date"></p>
                            <span id="tags" class="border border-secondary-subtle rounded p-2">#Formal</span>
                            <form action="{{ route('dashboard.outfit-history.delete-data') }}" class="mt-4"
                                method="post">
                                @csrf
                                @method('POST')
                                <!-- delete button -->
                                <input name="id" id="id" type="text" hidden>
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                            <form action="{{ route('dashboard.outfit-history.edit-data') }}" class="mt-4"
                                method="get">
                                <!-- delete button -->
                                <input name="id" id="id_edit" type="text" hidden>
                                <button class="btn btn-danger" type="submit">Edit</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $('body').on('click', '#btn-edit-post', function() {
            let id_data = $(this).data('id');
            //fetch detail post with ajax
            let baseUrl = window.location.origin;
            console.log(id_data);
            $.ajax({
                url: `/dashboard/outfit-history/get-data/${id_data}`,
                type: "GET",
                cache: false,
                success: function(response) {
                    // console.log(response.data.);
                    var top = baseUrl + '/' + response.data[0].mix_match[0].digital_wardrobe
                        .cloudFilePath;
                    var bot = baseUrl + '/' + response.data[0].mix_match[1].digital_wardrobe
                        .cloudFilePath;
                    var tags = response.data[0].occasion;
                    var date = response.data[0].created_at;
                    var id = response.data[0].id;
                    //ubah daate nya menjdi dd/mm/yyyy
                    var date = new Date(date);
                    var dd = date.getDate();
                    var mm = date.getMonth() + 1;
                    var yyyy = date.getFullYear();
                    if (dd < 10) {
                        dd = '0' + dd;
                    }
                    if (mm < 10) {
                        mm = '0' + mm;
                    }
                    date = dd + '/' + mm + '/' + yyyy;

                    console.log(top);
                    console.log(bot);
                    console.log(tags);
                    console.log(date);
                    console.log(id);
                    $('#tops').attr('src', top);
                    $('#bots').attr('src', bot);
                    $('#tags').html('#' + tags);
                    $('#date').html(date);
                    $('#id').val(id);
                    $('#id_edit').val(id);

                    $('#editModal').modal('show');
                    // if ($category == 'Tops') {
                    //     $('#category').html(`
                //         <option value="">Category</option>
                //         <option value="Tops" selected>Tops</option>
                //         <option value="Bottoms">Bottoms</option>
                //     `);
                    // } else {
                    //     $('#category').html(`
                //         <option value="">Category</option>
                //         <option value="Tops">Tops</option>
                //         <option value="Bottoms" selected>Bottoms</option>
                //     `);
                    // }

                }
            });
        });
    </script>
</body>

</html>
