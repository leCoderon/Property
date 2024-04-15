@extends('layout')

@section('title', 'All properties')

@section('content')
    <div class="hero page-inner overlay" style="background-image: url('images/hero_bg_1.jpg')">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-9 text-center mt-5">
                    <h1 class="heading" data-aos="fade-up">Properties</h1>

                    <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                        <ol class="breadcrumb text-center justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Home</a></li>
                            <li class="breadcrumb-item active text-white-50" aria-current="page">
                                Properties
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="row mb-5 align-items-center">
                <div class="col-lg-6 text-center mx-auto">
                    <h2 class="font-weight-bold text-primary heading">
                        Featured Properties
                    </h2>

                </div>
            </div>
            <div class="row d-flex justify-content-center mb-5">
                <div class="col-lg-12 text-center mx-auto mb-5">
                    {{-- SEARCH FORM --}}
                    <form action="{{ route('property.index') }}" method="get" class="d-flex gap-2 row mb-5"
                        data-aos="fade-up" data-aos-delay="200">
                        <input type="number" class="form-control col" name="surface" placeholder="Surface minimum"
                            value="{{ $input['surface'] ?? '' }}" />
                        <input type="number" class="form-control col" name="rooms" placeholder="Nombre de pièces"
                            value="{{ $input['rooms'] ?? '' }}" />
                        <input type="number" class="form-control col" name="price" placeholder="Budget max"
                            value="{{ $input['price'] ?? '' }}" />
                        <input type="text" class="form-control col" name="title" placeholder="Mot clef"
                            value="{{ $input['title'] ?? '' }}" />

                        <div class="mt-3"> <button type="submit" class="btn btn-primary btn-md">Search</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">

                @forelse ($properties as $property)
                    {{-- @dump($property->images->first()->name) --}}

                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 mb-5">
                        @php
                            $imgPath = str_contains($property->images->first()->name, 'https://') ? $property->images->first()->name : $property->images->first()?->imageUrl() ;
                        @endphp
                        <x-properties.property-item :property="$property" :image="$imgPath"></x-properties.property-item>
                    </div>
                @empty
                    <div class="alert text-white mt-4" style="background: #005555">Aucune propriété ne correspond à votre
                        recherche</div>
                @endforelse

            </div>
            <div class="row align-items-center py-5">
                {{-- <div class="col-lg-3">Pagination  (1 of 10)</div> --}}
                <div class="col-lg-6 text-center">
                    {{ $properties->links() }}
                    {{-- <div class="custom-pagination">
                      <a href="#">1</a>
                      <a href="#" class="active">2</a>
                      <a href="#">3</a>
                      <a href="#">4</a>
                      <a href="#">5</a>
                  </div> --}}
                </div>
            </div>
            {{--  --}}



        </div>
    </div>

    <div class="section section-properties">
        <div class="container">
            <div class="row mb-5 align-items-center">
                <div class="col-lg-12 text-start mx-auto">
                    <h2 class="font-weight-bold text-primary heading">
                        Last Properties
                    </h2>
                    <hr>

                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="property-slider-wrap">
                        <div class="property-slider">
                            @foreach ($propertiesAll as $property)
                                <!-- .item -->
                                <div class="property-item">
                                    <a href="{{ route('property.show', ['slug' => $property->getSlug(), 'property' => $property->id]) }}"
                                        class="img">
                                        <img src="{{ $property->images->first()?->imageUrl() }}" alt="Image"
                                            class="img-fluid" />
                                    </a>

                                    <div class="property-content">
                                        <div class="price mb-2">
                                            <span>${{ number_format($property->price, thousands_separator: ' ') }}</span>
                                        </div>
                                        <div>
                                            <span class="d-block mb-2 text-black-50">{{ $property->postal_code }} -
                                                {{ $property->city }}, {{ $property->address }}</span>
                                            <span class="city d-block mb-3">{{ $property->title }}</span>

                                            <div class="specs d-flex mb-4">
                                                <span class="d-block d-flex align-items-center me-3">
                                                    <span class="icon-bed me-2"></span>
                                                    <span class="caption">2 beds</span>
                                                </span>
                                                <span class="d-block d-flex align-items-center">
                                                    <span class="icon-bath me-2"></span>
                                                    <span class="caption">2 baths</span>
                                                </span>
                                            </div>

                                            <a href="{{ route('property.show', ['slug' => $property->getSlug(), 'property' => $property->id]) }}"
                                                class="btn btn-primary py-2 px-3">See
                                                details</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div id="property-nav" class="controls" tabindex="0" aria-label="Carousel Navigation">
                            <span class="prev" data-controls="prev" aria-controls="property" tabindex="-1">Prev</span>
                            <span class="next" data-controls="next" aria-controls="property" tabindex="-1">Next</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
