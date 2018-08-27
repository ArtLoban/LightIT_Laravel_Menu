@extends('main_layout')

@section('content')

<main role="main">

    <div class="container">
        <div class="text-center">
            <p><h3>Блюда</h3></p>
        </div>
    </div>

        <div class="container">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">

                        <div class="card-deck">
                            @foreach( $categories as $category)
                                <div class="card">
                                    <!-- Изображение -->
                                    <img class="card-img-top" src="{{ asset(
                                    $category->image
                                    ? $category->image->path
                                    : App\Services\ImageUploader\ImageUpload::DEFAULT_MO_IMAGE_PATH
                                    ) }}" alt="Card image cap">
                                    <!-- Текстовый контент -->
                                    <div class="card-body">
                                        <h4 class="card-title">{{ $category->name }}</h4>
                                        <p class="card-text">{{ $category->description }}</p>
                                        <a href="{{ route('menu.category', $category->id) }}" class="btn btn-primary">Перейти</a>
                                    </div>
                                </div><!-- Конец карточки -->
                            @endforeach

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

                    </div>
                    <div class="carousel-item">

                        <img class="d-block w-100" src="{{ asset(App\Services\ImageUploader\ImageUpload::DEFAULT_MO_IMAGE_PATH) }}" alt="Второй слайд">

                    </div>
                    <div class="carousel-item">

                        <img class="d-block w-100" src="{{ asset(App\Services\ImageUploader\ImageUpload::DEFAULT_MO_IMAGE_PATH) }}" alt="Третий слайд">

                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>

    <br>
    <hr>
    <hr>
    <br>

        <div class="container">

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
        </div>

</main>

@endsection
