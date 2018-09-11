@extends('main_layout')

@section('content')

<main role="main">
    <div class="container">

       {{-- @forelse($dishes as $dish)
            <div>Hello</div>
        @empty
            <div>Buy</div>
        @endforelse--}}

        @if(is_null($dishes))
            <div class="row justify-content-center">
                <div class="col text-center">
                    <p>Ваша корзина пока пуста</p>
                </div>
            </div>
        @else
            <div class="row">
                <div class="table-responsive">
                    <table class="table cart text-center" cellspacing="0">
                        <thead>
                        <tr class="table-active">
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                            <th width="300">Товар</th>
                            <th>Цена</th>
                            <th>Количество</th>
                            <th>Итого</th>
                        </tr>
                        </thead>
                        <tbody>

                            @foreach($dishes as $dish)
                                <tr class="product">
                                    <td class="product-removal align-middle">
                                        {!! Form::open(['route' => ['cart.destroy', $dish->id],
                                                        'method' => 'delete',
                                                        'class' => 'jq-form',
                                                        ]) !!}
                                            <input type="hidden" class="dishId" name="dishId" value="{{ $dish->id }}">
                                            <button class="remove-product">
                                                &times;
                                            </button>
                                        {!! Form::close() !!}
                                    </td>
                                    <td class="align-middle">
                                        <img class="" width="70" src="{{ asset(
                                                        $dish->image
                                                        ? $dish->image->path
                                                        : App\Services\ImageUploader\ImageUpload::DEFAULT_MO_IMAGE_PATH
                                                        ) }}" alt="Card image cap">
                                    </td>
                                    <td class="text-left align-middle">{{ $dish->name }}</td>
                                    <td class="align-middle product-price">{{ $dish->price }} грн</td>
                                    <td class="align-middle">
                                        {!! Form::open(['route' => 'cart.store']) !!}
                                        <div class="number product-quantity">
                                            <input type="hidden" class="dishId" name="dishId" value="{{ $dish->getKey() }}">
                                            <span class="jq-minus btn btn-sm btn-danger">-</span>
                                            <input readonly class="quantity" type="text" value="{{ $quentity = array_sum(session()->get("dishes.$dish->id")) }}" size="2"/>
                                            <span class="jq-plus btn btn-sm btn-success">+</span>
                                        </div>
                                        {!! Form::close() !!}
                                    </td>
                                    <td class="align-middle product-line-price">{{ $quentity * $dish->price }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row justify-content-end">
                <div class="col-6 text-center">
                    <div class="row justify-content-center">
                        <div class="col">
                            <h3>Сумма заказа</h3>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-3">
                            <p>Доставка</p>
                        </div>
                        <div class="col-9">
                            <span class="shipping-conditions">Бесплатная доставка при заказе от 200 грн</span>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-3">
                            <p class="order-total">Итого</p>
                        </div>
                        <div class="col-9">
                            <span class="order-total" id="cart-total" >{{ session()->get('totalPrice') }}</span><span class="order-total"> грн</span>
                        </div>
                        <div class="w-100"></div>

                        <div class="col">
                            <a href="{{ route('checkout.index') }}" class="btn btn-success cart-back-btn">Перейти к оформлению</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            <a href="{{ route('menu') }}" class="btn btn-info cart-back-btn">Вернуться в магазин</a>
        </div>
    </div>
</main>

@endsection
