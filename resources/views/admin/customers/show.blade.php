@extends('admin.layout')

@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Клиент
      </h1>
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
                  <th>ID</th>
                  <th>Имя</th>
                  <th>Номер телефона</th>
                  <th>Все заказы</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $customer->id }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->phone_number }}</td>
                        <td><a href="#">Ссылка на список заказов</a></td>
                    </tr>
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