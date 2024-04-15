@php
    $color = '#005555';
@endphp
@extends('admin.layout')

@section('title', 'Tous les biens')

@section('content')

    <div class="row gy-4 d-flex justify-content-between align-items-center">
        <div class="col-12 col-md-auto">
            <h1>@yield('title') </h1>
        </div>
        

        <div class="col-12 col-md-auto"><a href="{{ route('admin.property.create') }}" class="btn text-white"
                style="background-color: {{ $color }}">&plus; Ajouter
                un nouveau bien</a></div>
                <div>{{ __('pagination.next') }}</div>
    </div>
    <br>
    

    <table class="table table-striped">
        <thead>
            <tr>
                <th><span class="d-none d-md-flex">Sold</span></th>
                {{-- <th>Sold?</th> --}}
                <th>#</th>
                <th>Titre</th>
                <th><span class="d-none d-md-flex">Surface</span></th>
                <th><span class="d-none d-md-flex">Prix (CFA)</span></th>
                {{-- <th>Prix (CFA)</th> --}}
                <th><span class="d-none d-sm-flex">Ville</span></th>
                <th class="text-end">Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($properties as $property)
                <tr>

                    {{-- <td>{{ $property->sold ? 'Yes' : 'No' }}</td> --}}

                    <td>
                        <div class="d-none d-md-flex">
                            {{ $property->sold ? 'Yes' : 'No' }}
                        </div>
                    </td>
                    <td>{{ $property->id }}</td>
                    <td>{{ Str::limit($property->title, 10) }}</td>

                    <td>
                        <div class="d-none d-md-flex">
                            {{ $property->surface }}
                        </div>
                    </td>

                    <td>
                        <div class="d-none d-md-flex">
                            {{ number_format($property->price, thousands_separator: ' ') }}
                        </div>
                    </td>
                    {{-- <td>{{ number_format($property->price, thousands_separator: ' ') }}</td> --}}

                    <td>
                        <div class="d-none d-sm-flex">
                            {{ $property->city }}
                        </div>
                    </td>

                    <td>
                        <div class="d-flex flex-md-row flex-column gap-2 justify-content-end text-center">
                            <a href="{{ route('admin.property.edit', $property) }}" class="btn btn-sm text-white"
                                style="background:  {{ $color }}">Editer</a>

                            <form action="{{ route('admin.property.destroy', $property) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger w-100 btn-sm">Supprimer</button>
                            </form>
                        </div>

                    </td>
                </tr>

            @empty
                <div class="alert alert-info">
                    <h6>Vous n'avez aucun bien declarer pour l'instant</h6>
                </div>
            @endforelse
        </tbody>
    </table>

    {{ $properties->links() }}
@endSection

{{-- @forelse ( as )
    
@empty
    
@endforelse --}}
