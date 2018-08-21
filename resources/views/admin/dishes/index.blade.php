@extends('admin.layout')

@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Список блюд
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Листинг сущности</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="form-group">
                <a href="{{ route('dishes.create') }}" class="btn btn-success">Добавить</a>
              </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Название</th>
                  <th>Описание блюда</th>
                  <th>Категория блюда</th>
                  <th>Ингредиенты</th>
                  <th>Цена, грн</th>
                  <th>Вес, г</th>
                  <th>Изображение</th>
                  <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach( $dishes as $dish)
                    <tr>
                        <td>{{ $dish->id }}</td>
                        <td>{{ $dish->name }}</td>
                        <td>{{ $dish->description }}</td>
                        <td>{{ $dish->category->name }}</td>
                        <td>
                            <ul>
                                @foreach($dish->ingredients->toArray() as $ingredient)
                                    <li>{{ $ingredient['name'] }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ $dish->price }}</td>
                        <td>{{ $dish->weight }}</td>
                        <td>
                            <img src="{{ asset(
                                $dish->image
                                    ? $dish->image->path
                                    : App\Services\ImageUploader\ImageUpload::DEFAULT_MO_IMAGE_PATH
                                    ) }}"
                                 alt="" class="img-responsive" width="150">
                        </td>
                        <td>
                            <a href="{{ route('dishes.edit', $dish->id) }}" class="fa fa-pencil"></a>
                            {!! Form::open(['route' => ['dishes.destroy', $dish->id],
                                'method' => 'delete']) !!}
                            <button type="submit" class="delete-task"
                                    onclick="return confirm('Are you sure?')">
                                <a class="fa fa-remove"></a>
                            </button>
                            {!! Form::close() !!}
                        </td>
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