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
    <nav class="navbar navbar-expand-lg bg-brown py-3" data-bs-theme="dark">
        <div class="container-fluid">
            <a href="." class="navbar-brand fw-bold">Lemarikoe</a>
        </div>
    </nav>

    <section class="py-5">
        <div class="container">
            <form method="POST" action="{{ route('dashboard.questionareUpdate') }}" id="form">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header bg-white py-3">
                        <h3 class="text-center fw-semibold">Hello!</h3>
                        <p class="mb-0 text-center text-secondary">
                            Please fill out the questions bellow
                        </p>
                    </div>
                    <form action="">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="icon">Pick an Icon!</label>
                                        <div class="d-flex align-items-center gap-2">
                                            <div>
                                                <label for="icon-boy" class="cursor-pointer">
                                                    <input type="radio" name="icon" id="icon-boy"
                                                        class="d-none questionnare-icon">
                                                    <img src="{{ asset('assets/images/boy-icon.png') }}" alt="Boy">
                                                </label>
                                            </div>
                                            <div>
                                                <label for="icon-girl" class="cursor-pointer">
                                                    <input type="radio" name="icon" id="icon-girl"
                                                        class="d-none questionnare-icon">
                                                    <img src="{{ asset('assets/images/girl-icon.png') }}"
                                                        alt="Girl">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="style">What kind of fashion style or aesthetics do you
                                            prefer?</label>
                                        <div class="d-flex flex-wrap gap-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="fashion_style"
                                                    value="Vintage" id="vintage">
                                                <label class="form-check-label" for="vintage">Vintage</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="fashion_style"
                                                    value="Classic" id="classic">
                                                <label class="form-check-label" for="classic">Classic</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="fashion_style"
                                                    value="Streetwear" id="streetwear">
                                                <label class="form-check-label" for="streetwear">Streetwear</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="fashion_style"
                                                    value="Minimalistic" id="minimalistic">
                                                <label class="form-check-label" for="minimalistic">Minimalistic</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="fashion_style"
                                                    value="Indie" id="indie">
                                                <label class="form-check-label" for="indie">Indie</label>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="style">What kind of occasions or events do you usually
                                            attend?</label>


                                        <div class="d-flex flex-wrap gap-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="style"
                                                    value="Casual" id="casual">
                                                <label class="form-check-label" for="casual">Casual</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="style"
                                                    value="Formal" id="formal">
                                                <label class="form-check-label" for="formal">Formal</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="style"
                                                    value="Work" id="work">
                                                <label class="form-check-label" for="work">Work</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="style"
                                                    value="School" id="school">
                                                <label class="form-check-label" for="school">School</label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="style">What kind of colours do you prefer?</label>


                                    <div class="d-flex flex-wrap gap-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="color"
                                                value="Dark" id="dark">
                                            <label class="form-check-label" for="dark">Dark</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="color"
                                                value="Colourful" id="colourful">
                                            <label class="form-check-label" for="colourful">Colourful</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="color"
                                                value="Pastels" id="pastels">
                                            <label class="form-check-label" for="pastels">Pastels</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="color"
                                                value="Bright" id="bright">
                                            <label class="form-check-label" for="bright">Bright</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="color"
                                                value="Monochrome" id="monochrome">
                                            <label class="form-check-label" for="monochrome">Monochrome</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-primary px-3" type="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
        </form>
        </div>
    </section>
    <script src="{{ asset('assets/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        document.getElementById("form").addEventListener("submit", function(event) {
            var checkboxes = document.querySelectorAll('.form-check-input:checked');
            if (checkboxes.length < 1) {
                alert("Pilih minimal satu opsi.");
                event.preventDefault(); // Prevent form submission
            }
        });
    </script>
</body>

</html>
