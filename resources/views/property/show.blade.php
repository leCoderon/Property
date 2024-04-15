@extends('layout')

@section('dir', '../')

@section('title', $property->title)

@section('content')

    <div class="hero page-inner overlay" style="background-image: url('@yield('dir')images/hero_bg_3.jpg')">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-9 text-center mt-5">
                    <h1 class="heading" data-aos="fade-up">
                        {{ $property->title }}
                    </h1>

                    <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                        <ol class="breadcrumb text-center justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Home</a></li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('property.index') }}">Properties</a>
                            </li>
                            <li class="breadcrumb-item active text-white-50" aria-current="page">
                                {{ $property->getSlug() }}

                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-6">
                    <div class="img-property-slide-wrap">
                        <div class="img-property-slide">
                            @foreach ($property->images as $key => $value)
                                {{-- <img src="{{ asset('../storage/' . $value->name) }}" width="250px" alt="{{ $value->name }}"> --}}
                                <img src="{{ str_contains($value->name, 'https://') ? $value->name : asset('../storage/' . $value->name) }}"
                                    alt="{{$value->name}}" class="img-fluid" />
                            @endforeach
                            {{-- <img src="@yield('dir')images/img_3.jpg" alt="Image" class="img-fluid" /> --}}
                        </div>
                    </div>

                </div>

                {{-- Right --}}
                <div class="col-lg-5">
                    <h2 class="heading text-primary"> {{ $property->title }}
                    </h2>
                    <p class="meta"> {{ $property->address }}
                        , {{ $property->city }} .
                        {{ $property->postal_code }}
                    </p>
                    <div class="text-black-50">
                        {!! $property->description !!}

                    </div>


                    <div class="d-block agent-box p-2">
                        <h5>Caractéristiques</h5>
                        <hr>
                        <table class="table table-striped">
                            <tr>
                                <td>Titre</td>
                                <td>{{ $property->title }}</td>
                            </tr>
                            <tr>
                                <td>Prix</td>
                                <td>{{ number_format($property->price, thousands_separator: ' ') }} $</td>
                            </tr>
                            <tr>
                                <td>Pièces</td>
                                <td>{{ $property->rooms }}</td>
                            </tr>
                            <tr>
                                <td>Chambres</td>
                                <td>{{ $property->bedrooms }}</td>
                            </tr>
                            <tr>
                                <td>Etages</td>
                                <td>{{ $property->floor ?: 'Ré de chaussé' }}</td>
                            </tr>
                            <tr>
                                <td>Localisation</td>
                                <td>{{ $property->city }}</td>
                            </tr>
                            <tr>
                                <td>Publié le</td>
                                <td>{{ $property->created_at }}</td>
                            </tr>
                        </table>

                    </div>
                    <div class="d-block agent-box p-2">
                        <h5>Spécificités</h5>
                        <hr>
                        <table class="table table-striped">
                            @foreach ($property->options as $option)
                                <tr>
                                    <td>{{ $option->name }}</td>
                                </tr>
                            @endforeach


                        </table>

                    </div>
                </div>
            </div>
            <br>
            <div class="row col">
                <br>
                <div>
                    <hr>

                    <h5 class="mb-3">Intéressé par ce bien ? Contacter-nous !</h5>
                    @if (session('success'))
                        @include('shared.flash')
                    @else
                        @include('shared.contact')
                    @endif


                </div>
            </div>
        </div>
    </div>

@endsection
