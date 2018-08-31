@extends('admin.layout')

@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Управление заказами
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
                  <th>ID</th>
                  <th>Клиент</th>
                  <th>Метод доставки</th>
                  <th>Статус заказа</th>
                </tr>
                </thead>
                <tbody>
                    {{--@foreach($customers as $customer)--}}
                    <tr>
                        <td>1</td>
                        <td>Имя клиента</td>
                        <td>самовывоз</td>
                        <td>Выпонен</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Имя клиента</td>
                        <td>самовывоз</td>
                        <td>Выпонен</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Имя клиента</td>
                        <td>самовывоз</td>
                        <td>Выпонен</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Имя клиента</td>
                        <td>самовывоз</td>
                        <td>Выпонен</td>
                    </tr>
                    {{--@endforeach--}}
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