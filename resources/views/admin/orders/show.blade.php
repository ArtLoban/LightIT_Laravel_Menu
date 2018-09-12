@extends('admin.layout')

@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Заказ # {{ $order->getKey() }}
      </h1>
      <p>Список заказанных блюд</p>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
          <div>
            <a href="{{ url()->previous() }}" class="btn btn-primary back-btn">Вернуться</a>
          </div>

            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Название</th>
                    <th>Цена, грн</th>
                    <th>Количество, ед.</th>
                    <th>Сумма, грн</th>
                  </tr>
                </thead>
                <tbody>
                  @php $total = 0 @endphp
                  @foreach($order->dishOrders as $dishOrder)
                    <tr>
                      <td>{{ $dishOrder->getKey() }}</td>
                      <td>{{ $dishOrder->dish->name }}</td>
                      <td>{{ $price = $dishOrder->price }}</td>
                      <td>{{ $quantity = $dishOrder->dish_quantity }}</td>
                      <td>{{ $subtotal = $price * $quantity }}</td>
                    </tr>
                    @php $total += $subtotal @endphp
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><b>Общая сумма</b></td>
                    <td><b>{{ $total }}</b></td>
                  </tr>
                </tfoot>>
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