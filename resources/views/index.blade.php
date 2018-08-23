@extends('main_layout')

@section('content')

<main role="main">

        <div class="container">
            <div class="row">
                <a href="{{ route('menu.index')}}" class="btn btn-default">
                    <button class="btn btn-success">Перейти к меню</button>
                </a>
            </div>
            <div class="row">
                <div class="text-center">
                    <img src="{{ asset('/storage/uploads/index.jpg') }}">
                </div>
            </div>
        </div>

</main>

@endsection
