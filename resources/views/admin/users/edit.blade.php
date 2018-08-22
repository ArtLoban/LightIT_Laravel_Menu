@extends('admin.layout')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Добавить пользователя
                <small>приятные слова..</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">

                {!! Form::open([
                    'route' => ['users.update', $user->id],
                    'files' => true,
                    'method' => 'put'
                ]) !!}

                <div class="box-header with-border">
                    <h3 class="box-title">Добавляем пользователя</h3>
                </div>
                <div class="box-body">
                    <div class="col-md-6">

                        @include('admin.errors')
                        <input type="hidden" name="updatedUserId" value="{{ $user->id }}">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Имя</label>
                            <input type="text" class="form-control" name="name" id="exampleInputEmail1" placeholder="" value="{{ $user->name }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">E-mail</label>
                            <input type="text" class="form-control" name="email" id="exampleInputEmail1" placeholder="" value="{{ $user->email }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Пароль</label>
                            <input type="password" class="form-control" name="password" id="exampleInputEmail1" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Подтверждение Пароля</label>
                            <input type="password" name="password_confirmation" class="form-control" id="exampleInputEmail1" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Статус пользователя</label>
                            <select class="form-control" name="role_id">
                                <option value="" disabled selected>Select your option</option>
                                <option value="1">Editor</option>
                                <option value="2">Admin</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <img src="{{ asset(
                                $user->image
                                    ? $user->image->path
                                    : App\Services\ImageUploader\ImageUpload::DEFAULT_MO_IMAGE_PATH
                                    ) }}" alt="" class="img-responsive" width="150">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Загрузить аватар</label>
                            <input type="file" name="image" id="exampleInputFile">

                            <p class="help-block">Формат изображения: jpeg, jpg, bmp, png. Максимальный размер 1024 Мб</p>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-warning">Изменить</button>
                    <a href="{{ route('users.index')}}" class="btn btn-default">Назад</a>
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