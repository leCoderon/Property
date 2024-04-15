@php
    $color = '#005555';
@endphp
@extends('admin.layout')
<p style="margin-top: -40px"></p>
@section('title', $property->exists ? 'Mettre à jour le bien' : 'Créer un nouveau bien')

@section('content')

    <div class="row">
        {{-- <div class="col-12 col-md-2"></div> --}}
        <div class="col-12">
            <h1>@yield('title')</h1>
            <br><br>
        </div>
        {{-- <!-- This form is both used for editing and creating propertyes --> --}}

    </div>

    <div class="row g-5 justify-content-between">
        {{-- <div class="col-12"> --}}
        <div class="col-12 col-md-8">
            <form class="vstack gap-4 "
                action="{{ route($property->exists ? 'admin.property.update' : 'admin.property.store', $property) }}"
                method="post" enctype="multipart/form-data">

                @csrf
                @method($property->exists ? 'put' : 'post')

                <div class="row">
                    <div class="col-12">

                        <div class="row mb-3">
                            {{-- Property title --}}
                            @include('shared.input', [
                                'name' => 'title',
                                'label' => 'Titre',
                                'value' => $property->title,
                            ])
                            <div class="col row mt-3">

                                {{-- Property surface --}}
                                @include('shared.input', [
                                    'type' => 'number',
                                    'class' => 'col',
                                    'name' => 'surface',
                                    'label' => 'Surface',
                                    'value' => $property->surface,
                                ])

                                {{-- Property price --}}
                                @include('shared.input', [
                                    'type' => 'number',
                                    'class' => 'col',
                                    'name' => 'price',
                                    'label' => 'Prix (CFA)',
                                    'value' => $property->price,
                                ])
                            </div>
                        </div>

                        {{-- Property description --}}
                        @include('shared.input', [
                            'type' => 'textarea',
                            'name' => 'description',
                            'label' => 'Description',
                            'value' => $property->description,
                        ])

                        <div class="row mt-4">
                            {{-- Property rooms --}}
                            @include('shared.input', [
                                'type' => 'number',
                                'class' => 'col',
                                'name' => 'rooms',
                                'label' => 'Pièces',
                                'value' => $property->rooms,
                            ])

                            {{-- Property bedrooms --}}
                            @include('shared.input', [
                                'type' => 'number',
                                'class' => 'col',
                                'name' => 'bedrooms',
                                'label' => 'Chambres',
                                'value' => $property->bedrooms,
                            ])

                            {{-- Property floor --}}
                            @include('shared.input', [
                                'type' => 'number',
                                'class' => 'col',
                                'name' => 'floor',
                                'label' => 'Etage',
                                'value' => $property->floor,
                            ])
                        </div>
                        <div class="row my-4">
                            {{-- Property city --}}
                            @include('shared.input', [
                                'class' => 'col',
                                'name' => 'city',
                                'label' => 'Ville',
                                'value' => $property->city,
                            ])

                            {{-- Property code postal --}}
                            @include('shared.input', [
                                'class' => 'col',
                                'name' => 'postal_code',
                                'label' => 'Code postal',
                                'value' => $property->postal_code,
                            ])

                            {{-- Property address --}}
                            @include('shared.input', [
                                'class' => 'col',
                                'name' => 'address',
                                'label' => 'Adresse',
                                'value' => $property->address,
                            ])
                        </div>
                        <div class="row mb-4">
                            {{-- Property options --}}
                            @include('shared.select', [
                                'name' => 'options',
                                'label' => 'Caractéristiques du bien',
                                'value' => $property->options()->pluck('id'),
                                'options' => $options,
                                'multiple' => true,
                            ])
                        </div>
                        {{-- Property availability --}}
                        @include('shared.checkbox', [
                            'name' => 'sold',
                            'label' => 'Vendu',
                            'value' => $property->sold,
                        ])
                        {{-- Upload Images --}}
                        @include('shared.inputFile', [
                            'name' => 'images[]',
                            'label' => 'Images',
                        ])
                        <br>
                        {{-- <!-- Submit button --> --}}
                        <button class="btn text-white px-5  " style="background-color: {{ $color }}">
                            @if ($property->exists)
                                Mettre à jour
                            @else
                                Créer
                            @endif
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-12 col-md-4">
            <h5>IMages Associées</h5>
            <hr>
            {{-- Listing Images --}}
            @foreach ($property->images as $key => $value)
                <form action="{{ route('admin.deleteImage', $value) }}" method="post" class="mb-3">

                    @csrf
                    @method('delete')
                    <img src="{{ str_contains($value->name, 'https://') ? $value->name : $value->imageUrl() }}"
                        class="img-fluid card-img-top" alt="{{ $value->name }}" style="width: 100%; height:150px">
                    {{-- Delete Images button --}}
                    <button type="submit" class="text-center text-white py-2  w-100 bg-danger">Supprimer
                        cette
                        image</button>
                </form>
            @endforeach

        </div>
        {{-- </div> --}}
    </div>


    {{-- <div class="col-12 col-md-2"></div> --}}
    <br><br>
@endSection>
