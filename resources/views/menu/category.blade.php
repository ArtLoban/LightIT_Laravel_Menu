@extends('main_layout')

@section('content')

<main role="main">

   <div class="container">

       <div class="row">
           <div class="row">
               <a href="{{ route('menu') }}" class="btn btn-success">< Back to Menu</a>
           </div>
       </div>

        <div class="row">
            <div class="col-md-12">
                <div class="text-center">
                    <p><h3>{{ $category->name }}</h3></p>
                    <span>{{ $category->description }}</span>
                </div>
                <hr>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <table>
                    @foreach($dishes as $dish)
                        <tr>
                            <img class="" width="100" src="{{ asset(
                                    $dish->image
                                    ? $dish->image->path
                                    : App\Services\ImageUploader\ImageUpload::DEFAULT_MO_IMAGE_PATH
                                    ) }}" alt="Card image cap">
                        </tr>
                        <tr>
                            <a href="{{ route('menu.dish', $dish->id) }}">
                                {{ $dish->name }}
                            </a>
                             ||
                        </tr>
                        <tr>{{ $dish->price }} грн || </tr>
                        <tr>{{ $dish->weight }} г || </tr>

                        <hr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

</main>

@endsection
