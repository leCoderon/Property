@php
    $color = '#005555';
@endphp
@extends('admin.layout')
<p style="margin-top: -40px"></p>

@section('title', $option->exists ? 'Mettre à jour l\'option' : 'Créer une nouvelle option')

@section('content')

    <div class="row">
        <div class="col-12 col-md-2"></div>
        <div class="col-12 col-md-8">
            <h1>@yield('title')</h1>
            <br><br>

            {{-- <!-- This form is both used for editing and creating options --> --}}

            <form class="vstack gap-4 card p-3"
                action="{{ route($option->exists ? 'admin.option.update' : 'admin.option.store', $option) }}" method="post">

                @csrf
                @method($option->exists ? 'put' : 'post')

                {{-- <!-- option title --> --}}
                <div>
                    @include('shared.input', [
                        'name' => 'name',
                        'label' => 'Titre de l\'option',
                        'value' => $option->name,
                    ])
                </div>

              

                {{-- <!-- Submit button --> --}}
                <button class="btn text-white px-5" style="background-color: {{$color}}">
                    @if ($option->exists)
                        Mettre à jour
                    @else
                        Créer
                    @endif
                </button>
            </form>
        </div>
        <div class="col-12 col-md-2"></div>
    </div>
@endSection>
