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
                            <p class="text-left price-p">{{ $dish->ingredients->implode('name', ', ') }}</p>
                            <p class="text-right">Вес: {{ $dish->weight }} г</p>
                            <p class="text-left price-p lead">Цена: {{ $dish->price }} грн</p>

                            {!! Form::open(['route' => 'cart.store', 'class' => 'dish-order']) !!}
                                <div class="order-block">
                                    <span>Кло-во:</span>
                                    <div class="item-counter">
                                        <input type="hidden" class="dishId" name="dishId" value="{{ $dish->id }}">
                                        <div class="number">
                                            <span class="minus btn btn-sm btn-danger">-</span>
                                            <input readonly type="text" class="dish-quantity" name="dish-quantity" value="1" size="2"/>
                                            <span class="plus btn btn-sm btn-success">+</span>
                                        </div>
                                    </div>
                                    <div class="d-inline">
                                        <button type="submit" class="btn btn-info order-dish">В корзину</button>
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



</main>

@endsection
