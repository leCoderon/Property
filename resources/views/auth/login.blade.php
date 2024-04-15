@extends('admin.layout')

@section('title', 'Se connecter')

@section('content')
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <h1>@yield('title')</h1>
            <form class="vstack gap-3" action="{{ route('login') }}" method="post">
                @csrf

                @include('shared.input', [
                    'name' => 'email',
                    'type' => 'email',
                    'label' => 'Votre email',
                ])
                @include('shared.input', [
                    'name' => 'password',
                    'type' => 'password',
                    'label' => 'Votre mot de passe',
                ])

                <div>
                    <button class="btn btn-primary">Se connecter</button>
                </div>
            </form>

        </div>
        <div class="col-md-2"></div>
    </div>
@endsection
