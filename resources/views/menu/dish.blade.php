@extends('main_layout')

@section('content')

<main role="main">

    <div class="container">

        <div class="row">
            <a href="{{ url()->previous() }}" class="btn btn-success">< Back</a>
        </div>

        <div class="row">
            <div class="col">
                <div class="text-center">
                    <p><h3>{{ $dish->name }}</h3></p>
                    <div>
                        <img class="" width="300" src="{{ asset(
                                    $dish->image
                                    ? $dish->image->path
                                    : App\Services\ImageUploader\ImageUpload::DEFAULT_MO_IMAGE_PATH
                                    ) }}" alt="Card image cap">
                    </div>
                    <span>{{ $dish->description }}</span>
                    <p>Цена: {{ $dish->price }} грн</p>
                    <p>Вес: {{ $dish->price }} г</p>
                    <p>Ингредиенты: {{ $dish->ingredients->implode('name', ', ')}}</p>

                </div>
            </div>
        </div>
    </div>



</main>

@endsection
