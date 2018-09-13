@extends('main_layout')

@section('content')
    <main role="main">
        <div class="container">


            <div class="text-center">
                <p><h3>Оформление заказа</h3></p>
            </div>


            <div class="row justify-content-center">
                <div class="col-10">
                    <div class="col"><h5>Ваш заказ</h5></div>
                    <div class="table-responsive">
                        <table class="table table-sm cart text-center" cellspacing="0">
                            <thead>
                            <tr class="table-active">
                                <th class="text-left">Товар</th>
                                <th class="text-right">Итого</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($dishes as $dish)
                                <tr class="product">
                                    <td class="text-left align-left">
                                        {{ $dish->name }}
                                        <span class="checkout-quantity">
                                            &times;
                                            {{ $quentity = array_sum(session()->get("dishes.$dish->id")) }}
                                        </span>
                                    </td>
                                    <td class="text-right">{{ $quentity * $dish->price }} грн</td>
                                </tr>
                            @endforeach
                           {{-- <tr class="checkout-shipping">
                                <td class="text-left align-left">Доставка</td>
                                <td class="text-right align-left">Бесплатная доставка при заказе от 200 грн</td>
                            </tr>--}}
                            <tr class="checkout-total">
                                <td class="text-left align-left">Итого</td>
                                <td class="text-right align-left">{{ session()->get('totalPrice') }} грн</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-10">
                    <p>Оплата и доставка</p>
                    @include('admin.errors')
                    {!! Form::open() !!}
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="InputName">Имя<span class="field-star"> *</span></label>
                                    <input type="text" class="form-control" id="InputName" name="name">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="InputPhone">Телефон<span class="field-star"> *</span></label>
                                    <input type="text" class="form-control" id="InputPhone" name="phone_number">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="delivery_id" value="1" id="Check1" checked>
                                    <label class="form-check-label" for="Check1">Самовывоз</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="delivery_id" value="2" id="Check2" disabled>
                                    <label class="form-check-label" for="Check2">Доставка</label>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-success submit-order" type="submit">Подтвердить заказ</button>
                    {!! Form::close() !!}
                </div>
            </div>



        </div>
    </main>
@endsection
