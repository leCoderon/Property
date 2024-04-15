@php
    $color = '#005555';
@endphp
@extends('admin.layout')

@section('title', 'Toutes les options')

@section('content')

    <div class="row gy-4 d-flex justify-content-between align-items-center">
        <div class="col-12 col-md-auto">
            <h1>@yield('title')</h1>
        </div>

        <div class="col-12 col-md-auto"><a href="{{ route('admin.option.create') }}" class="btn text-white" style="background-color: {{$color}}">&plus; Ajouter une
                nouvelle option</a></div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nom de l'option</th>
                <th class="text-end">Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($options as $option)
                <tr>

                    <td>{{ $option->name }}</td>
          
                    <td>
                        <div class="d-flex  flex-md-row flex-column text-center gap-2 justify-content-end w-100">
                            <a href="{{ route('admin.option.edit', $option) }}" class="btn text-white" style="background-color: {{$color}}">Editer</a>

                            <form action="{{ route('admin.option.destroy', $option) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger w-100">Supprimer</button>
                            </form>
                        </div>

                    </td>
                </tr>
            @endForeach
        </tbody>
    </table>

    {{ $options->links() }}
@endSection
