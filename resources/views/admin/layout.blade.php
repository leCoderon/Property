@php
    $color = '#005555';
@endphp
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> @yield('title') | Administration </title>

    {{-- TOM SELECT --}}
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.bootstrap5.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    {{-- SweetAlert for Toast Notifications --}}
    <link rel="stylesheet" href="../sweetalert.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap Template -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @layer reset {
            button {
                all: unset
            }
        }
    </style>
</head>

<body>
    
    <nav class="navbar navbar-expand-lg navbar-dark" style="background: {{ $color }}">
        <div class="container">
            <a class="navbar-brand" href="{{ route('homepage') }}">Property</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                @php
                $route = request()->route()->getName();
            @endphp
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a @class(['nav-link', 'active' => str_contains($route, 'property')]) href="{{ route('admin.property.index') }}">Gérer les biens </a>
                </li>
                <li class="nav-item">
                    <a @class(['nav-link', 'active' => str_contains($route, 'option')]) href="{{ route('admin.option.index') }}">Gérer les options </a>
                </li>

            </ul>

            @auth
            <div class="ms-auto">
                <ul class="navbar-nav">
                    <li class="nav-item ">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn bg-white" style="color:  {{ $color }}">Se déconnecter</button>
                        </form>
                    </li>
                </ul>
            </div>
        @endauth
            </div>
        </div>
    </nav>
    <div class="container mt-5">

        {{-- Sections Content --}}
        @yield('content')
    </div>

    {{--  SWEET ALERT  --}}
    {{-- FORMS FIELDS ERRORS --}}
    @error('name')
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                iconColor: 'white',
                customClass: {
                    popup: 'colored-toast',
                },
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
            });

            Toast.fire({
                icon: 'error',
                title: "{{ $message }}",
            })
        </script>
    @enderror

    {{-- SUCCESS REQUEST --}}
    @if (session()->has('success'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                iconColor: 'white',
                customClass: {
                    popup: 'colored-toast',
                },
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
            });

            Toast.fire({
                icon: 'success',
                title: "{{ session()->get('success') }}",
            })
        </script>
    @endif

    {{-- ERRORS REQUEST --}}
    @if (session()->has('error'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                iconColor: 'white',
                customClass: {
                    popup: 'colored-toast',
                },
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
            });

            Toast.fire({
                icon: 'error',
                title: "{{ session()->get('error') }}",
            })
        </script>
    @endif

    <script>
        var settings = {};
        new TomSelect('select[multiple]', {
            plugins: {
                remove_button: {
                    title: 'Remove this item',
                }
            }
        });
    </script>
{{-- Boostrap js --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>
