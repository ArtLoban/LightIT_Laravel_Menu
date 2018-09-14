@extends('main_layout')

@section('content')

<main role="main">

    <div class="container">
        <div class="text-center">
            <h3>Меню</h3>
        </div>
    </div>

        <div class="container">
            <div id="carouselExampleControls" class="carousel slide" data-ride="false">
                <div class="carousel-inner">

                    @for($page = 1; $page < count($categories)/2; $page++)
                        <div class="carousel-item  @if($page == 1) {{'active'}} @endif">
                            <div class="card-deck">
                                @foreach( $categories->forPage($page, 3) as $category)
                                    <div class="card" style="max-width: 340px;">
                                        <!-- Изображение -->
                                        <img class="card-img-top" src="{{ asset(
                                        $category->image
                                        ? $category->image->path
                                        : App\Services\ImageUploader\ImageUpload::DEFAULT_MO_IMAGE_PATH
                                        ) }}" alt="Card image cap">
                                        <div class="card-body">
                                            <h4 class="card-title">
                                                <a href="{{ route('menu.category', $category->id) }}">{{ $category->name }}</a>
                                            </h4>
                                            {{--<ul class="list-group list-group-flush">
                                                @foreach($category->dishes as $dish)
                                                    <li class="list-group-item">{{ $dish->name }} <span class="text-right">Цена: {{ $dish->price }}</span></li>
                                                @endforeach
                                            </ul>--}}
                                        </div>
                                    </div><!-- Конец карточки -->
                                @endforeach
                            </div>
                        </div>
                    @endfor

                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only ">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>

        {{--<div class="container">

            <div class="card-deck">
                <div class="card">
                    <!-- Изображение -->
                    <img class="card-img-top" data-src="holder.js/100px100?auto=yes&theme=sky" alt="...">
                    <!-- Текстовый контент -->
                    <div class="card-body">
                        <h4 class="card-title">Заголовок</h4>
                        <p class="card-text">Quaerat voluptatem sequi nesciunt, neque porro. Sit, aspernatur aut odit aut
                            officiis debitis aut reiciendis.</p>
                        <a href="#" class="btn btn-primary">Перейти</a>
                    </div>
                </div><!-- Конец карточки -->
                <div class="card">
                    <!-- Изображение -->
                    <img class="card-img-top" data-src="holder.js/100px100?auto=yes&theme=sky" alt="...">
                    <!-- Текстовый контент -->
                    <div class="card-body">
                        <h4 class="card-title">Заголовок</h4>
                        <p class="card-text">Quaerat voluptatem sequi nesciunt, neque porro. Sit, aspernatur aut odit aut
                            officiis debitis aut reiciendis. Quasi architecto beatae vitae dicta sunt, explicabo modi
                            tempora.</p>
                        <a href="#" class="btn btn-primary">Перейти</a>
                    </div>
                </div><!-- Конец карточки -->
                <div class="card">
                    <!-- Изображение -->
                    <img class="card-img-top" data-src="holder.js/100px100?auto=yes&theme=sky" alt="...">
                    <!-- Текстовый контент -->
                    <div class="card-body">
                        <h4 class="card-title">Заголовок</h4>
                        <p class="card-text">Quaerat voluptatem sequi nesciunt, neque porro. Sit, aspernatur aut odit aut
                            officiis debitis aut reiciendis.</p>
                        <a href="#" class="btn btn-primary">Перейти</a>
                    </div>
                </div><!-- Конец карточки -->
            </div>
        </div>--}}

</main>

@endsection
