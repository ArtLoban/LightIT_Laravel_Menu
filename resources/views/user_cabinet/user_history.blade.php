@extends('user_cabinet.cabinet')

@section('user_data')

    <div class="row justify-content-center">
        <div class="col-10">
            <div class="col">
                <h5>Список заказов</h5>
            </div>
            <div class="table-responsive">
                <table class="table cart text-center" cellspacing="0">
                    <thead>
                    <tr class="table">
                        <th>#</th>
                        <th>Дата</th>
                        <th>Состав заказа</th>
                        <th>Сумма</th>
                        <th>Статус</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr class="table">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $order->created_at }}</td>
                            <td class="text-left">{{ $order->dishOrders->pluck('dish')->implode('name', ', ') }}</td>
                            <td>-</td>
                            <td>{{ $order->status->name }}</td>
                        </tr>
                    @endforeach
                    {{--@foreach($dishes as $dish)
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
                    @endforeach--}}

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection