@extends('admin.layout')

@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Заказы
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Имя клиента</th>
                  <th>Id клиента</th>
                  <th>Дата</th>
                  <th>Метод доставки</th>
                  <th>Детали заказа</th>
                  <th>Статус заказа</th>
                </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>
                                <a href="{{ route('customers.show', $order->customer->id) }}">
                                    {{ $order->customer->name }}
                                </a>
                            </td>
                            <td>{{ $order->customer->getKey() }}</td>
                            <td>{{ $order->created_at }}</td>
                            <td>{{ $order->delivery->name }}</td>
                            <td>
                                <a href="{{ route('orders.show', $order->getKey()) }}">
                                    {{ 'Перейти' }}
                                </a>
                            </td>
                            <td>{{ $order->status->name }}</td>
                        </tr>
                    @empty
                        {{--No data available--}}
                    @endforelse
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection