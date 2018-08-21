@extends('admin.layout')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Изменить блюдо
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">

                {!! Form::open([
                    'route' => ['dishes.update', $dish->id],
                    'files' => true,
                    'method' => 'put']) !!}

                <div class="box-body">
                    <div class="col-md-6">

                        @include('admin.errors')

                        <input type="hidden" name="updatedUserId" value="{{ $dish->id }}">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Название</label>
                            <input type="text" class="form-control" name="name" id="exampleInputEmail1"
                                   placeholder="" value="{{ $dish->name }}">
                        </div>
                        <div class="form-group">
                            <label>Описание блюда</label>
                            <textarea class="form-control" name="description" rows="4" placeholder="Enter ..." value="">{{ $dish->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Категория блюда</label>
                            <select name="category_id" class="form-control">
                                <option value="{{ $dish->category->id }}" selected>{{ $dish->category->name }}</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Ингредиенты</label>
                            <select name="ingredient_id[]" class="form-control select2 select2-hidden-accessible" multiple data-placeholder="Select here" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                @foreach($ingredients as $ingredient)
                                    <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                                @endforeach
                            </select>
                            @if(count($dish->ingredients->toArray()))

                                <span class="select2 select2-container select2-container--default select2-container--below select2-container--focus" dir="ltr" style="width: 100%;">
                                    <span class="selection">
                                        <span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1">
                                            <ul class="select2-selection__rendered">

                                                @foreach($dish->ingredients->toArray() as $ingredient)
                                                    <li class="select2-selection__choice" title="{{ $ingredient['name'] }}">
                                                        <span class="select2-selection__choice__remove" role="presentation">×</span>{{ $ingredient['name'] }}
                                                    </li>
{{--                                                    <li>{{ $ingredient['name'] }}</li>--}}
                                                @endforeach

                                                <li class="select2-search select2-search--inline">
                                                    <input class="select2-search__field" type="search" tabindex="-1" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" role="textbox" aria-autocomplete="list" placeholder="" style="width: 0.75em;">
                                                </li>
                                            </ul>
                                        </span>
                                    </span>
                                    <span class="dropdown-wrapper" aria-hidden="true">
                                    </span>
                                </span>

                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Цена, грн</label>
                            <input type="text" class="form-control" name="price" id="exampleInputEmail1" placeholder="" value="{{ $dish->price }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Вес, г</label>
                            <input type="text" class="form-control" name="weight" id="exampleInputEmail1" placeholder="" value="{{ $dish->weight }}">
                        </div>
                        <div class="form-group">
                            <img src="{{ asset(
                                $dish->image
                                    ? $dish->image->path
                                    : App\Services\ImageUploader\ImageUpload::DEFAULT_MO_IMAGE_PATH
                                    ) }}" alt="" class="img-responsive" width="150">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Загрузить изображение блюда</label>
                            <input type="file" id="exampleInputFile">

                            <p class="help-block">Формат изображения: jpeg, jpg, bmp, png. Максимальный размер 1024 Мб</p>
                        </div>

                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-warning">Изменить</button>
                    <button class="btn btn-default">Назад</button>
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