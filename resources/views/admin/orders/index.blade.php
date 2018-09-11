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
                  <th>Клиент</th>
                  <th>Id клиента</th>
                  <th>Метод доставки</th>
                  <th>Детали заказа</th>
                  <th>Статус заказа</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>
                                <a href="{{ route('customers.show', $order->customer()->first()->id) }}">
                                    {{ $order->customer()->first()->name }}
                                </a>
                            </td>
                            <td>{{ $order->customer()->first()->id }}</td>
                            <td>{{ $order->delivery()->first()->name }}</td>
                            <td>
                                <a href="#">{{ 'ссылка на список блюд' }}</a>
                            </td>
                            <td>{{ $order->status()->first()->name }}</td>
                        </tr>
                    @endforeach
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