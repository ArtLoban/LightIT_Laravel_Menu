@extends('main_layout')

@section('content')

<main role="main">

    <div class="container">

        <div class="row">
            <div class="col offset-1">
                <a href="{{ url()->previous() }}" class="btn btn-success back-btn">< Back</a>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-10">
                <div class="row align-items-center justify-content-center dish-item">
                    <div class="col-4">
                        <div class="text-center">
                            <img class="" width="300" src="{{ asset(
                                    $dish->image
                                    ? $dish->image->path
                                    : App\Services\ImageUploader\ImageUpload::DEFAULT_MO_IMAGE_PATH
                                    ) }}" alt="Card image cap">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-center">
                            <p><h3>{{ $dish->name }}</h3></p>
                            <p class="text-left price-p">{{ $dish->ingredients->implode('name', ', ')}}</p>
                            <p class="text-right">Вес: {{ $dish->weight }} г</p>
                            <p class="text-left price-p">Цена: {{ $dish->price }} грн</p>
                            <div class="order-block">
                                <span>Кло-во:</span>
                                <div class="item-counter">
                                    {!! Form::open(['route' => 'categories.store']) !!}
                                    <div class="number">
                                        <span class="minus btn btn-sm btn-danger">-</span>
                                        <input type="text" value="1" size="2"/>
                                        <span class="plus btn btn-sm btn-success">+</span>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                                <a href="{{ route('menu') }}" class="btn btn-info order-dish">В корзину</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



</main>

@endsection
