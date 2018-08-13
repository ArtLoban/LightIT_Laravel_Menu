@extends('admin.layout')

@section('content')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Добавить ингредиент
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">

            {!! Form::open(['route' => 'ingredients.store']) !!}

            <div class="box-header with-border">
                <h3 class="box-title">Добавляем ингредиент</h3>
            </div>
            <div class="box-body">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Название</label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" placeholder="">
                    </div>

                    @include('admin.errors')

                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button class="btn btn-success">Добавить</button>
                <a href="{{ route('ingredients.index')}}" class="btn btn-default">Назад</a>
            </div>
            <!-- /.box-footer-->
            {!! Form::close() !!}

        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection