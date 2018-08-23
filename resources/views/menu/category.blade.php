@extends('main_layout')

@section('content')

<main role="main">

    <div class="container">
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
                        <tr>{{ $dish->name }} || </tr>
                        <tr>{{ $dish->price }} || </tr>
                        <tr>{{ $dish->weight }} || </tr>

                        <hr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

</main>

@endsection
