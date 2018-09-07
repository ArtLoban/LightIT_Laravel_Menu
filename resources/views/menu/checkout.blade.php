@extends('main_layout')

@section('content')
    <main role="main">
        <div class="container">


            <div class="text-center">
                <p><h3>Оформление заказа</h3></p>
            </div>

            <div class="row">
                <div class="col"><h5>Ваш заказ</h5></div>
            </div>
            <div class="row">
                <div class="table-responsive">
                    <table class="table cart text-center" cellspacing="0">
                        <thead>
                        <tr class="table-active">
                            <th class="text-left">Товар</th>
                            <th class="text-right">Итого</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($orderItems as $orderItem)
                                <tr class="product">
                                    <td class="text-left align-left">{{ $orderItemh->name }}</td>
                                    <td class="text-right">{{ 'Price*Quantity' }} грн</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>



        </div>
    </main>
@endsection
