@extends('main_layout')

@section('content')

<main role="main">

   <div class="container">

       <div class="row">
           <div class="col offset-1">
               <a href="{{ route('menu') }}" class="btn btn-success back-btn">< Back</a>
           </div>
       </div>

        <div class="row justify-content-center">
            <div class="col-10">
                <div class="row align-items-center">
                    <div class="col-5">
                        <div class="text-center">
                            <img class="" width="300" src="{{ asset(
                                    $category->image
                                    ? $category->image->path
                                    : App\Services\ImageUploader\ImageUpload::DEFAULT_MO_IMAGE_PATH
                                    ) }}" alt="Card image cap">
                        </div>
                    </div>
                    <div class="col-7">
                        <div class="text-center">
                            <p><h3>{{ $category->name }}</h3></p>
                            <span>{{ $category->description }}</span>
                        </div>
                    </div>
                </div>
                <hr>

                <div class="row justify-content-center">
                    <div class="col-md-10">
                        @foreach($dishes as $dish)
                            <div class="row justify-content-between align-items-center">
                                <div class="col-6">
                                    <img class="" width="120" src="{{ asset(
                                                $dish->image
                                                ? $dish->image->path
                                                : App\Services\ImageUploader\ImageUpload::DEFAULT_MO_IMAGE_PATH
                                                ) }}" alt="Card image cap">
                                    <a href="{{ route('menu.dish', $dish->id) }}">{{ $dish->name }}</a>
                                </div>
                                <div class="col-6 text-right">
                                    <span>{{ $dish->price }} грн</span>
                                    <div class="item-counter">

                                        {!! Form::open(['route' => 'categories.store']) !!}
                                            <div class="number">
                                                <span class="minus btn btn-sm btn-danger">-</span>
                                                <input type="text" value="1" size="2"/>
                                                <span class="plus btn btn-sm btn-success">+</span>
                                            </div>
                                        {!! Form::close() !!}
                                    </div>
                                    <a href="{{ route('menu') }}" class="btn btn-info order-dish">Заказать</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

@endsection
