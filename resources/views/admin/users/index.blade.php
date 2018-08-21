@extends('admin.layout')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Пользователи
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
                        <a href="{{ route('users.create') }}" class="btn btn-success">Добавить</a>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Имя</th>
                            <th>E-mail</th>
                            <th>Аватар</th>
                            <th>Роль</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <img src="{{ asset(
                                    $user->image
                                        ? $user->image->path
                                        : App\Services\ImageUploader\ImageUpload::DEFAULT_MO_IMAGE_PATH
                                        ) }}"
                                             alt="" class="img-responsive" width="150">
                                    </td>
                                    <td>{{ $user->role->name }}</td>
                                    <td>
                                        <a href="{{ route('users.edit', $user->id) }}" class="fa fa-pencil"></a>
                                        {!! Form::open(['route' => ['users.destroy', $user->id],
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