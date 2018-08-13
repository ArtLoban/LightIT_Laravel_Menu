@extends('admin.layout')

@section('content')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Добавить блюдо
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">

            {!! Form::open(['route' => 'dishes.store']) !!}

            <div class="box-header with-border">
                <h3 class="box-title">Добавляем блюдо</h3>
            </div>
            <div class="box-body">
                <div class="col-md-6">

                    @include('admin.errors')

                    <div class="form-group">
                        <label for="exampleInputEmail1">Название</label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" placeholder="" value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label>Описание блюда</label>
                        <textarea class="form-control" name="description" rows="4" placeholder="Enter ..." value="{{ old('description') }}"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Категория блюда</label>
                        <select class="form-control" name="category_id">
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Ингредиенты</label>
                        <select class="form-control select2 select2-hidden-accessible" multiple="" data-placeholder="Select here" style="width: 100%;" tabindex="-1" aria-hidden="true">
                            @foreach($ingredients as $ingredient)
                                <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Цена, грн</label>
                        <input type="text" class="form-control" name="price" id="exampleInputEmail1" placeholder="" value="{{ old('price') }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Вес, г</label>
                        <input type="text" class="form-control" name="weight" id="exampleInputEmail1" placeholder="" value="{{ old('weight') }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Загрузить изображение блюда</label>
                        <input type="file" id="exampleInputFile">

                        <p class="help-block">уведомление о форматах..</p>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button class="btn btn-success">Добавить</button>
                <a href="{{ route('dishes.index')}}" class="btn btn-default">Назад</a>
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