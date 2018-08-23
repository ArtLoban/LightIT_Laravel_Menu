@extends('main_layout')

@section('content')

<main role="main">

    <div class="container">
        <div class="text-center">
            <p><h3>Категории блюд</h3></p>
        </div>
    </div>

    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">

                @foreach( $categories as $category)
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <img class="card-img-top" src="{{ asset(
                                    $category->image
                                    ? $category->image->path
                                    : App\Services\ImageUploader\ImageUpload::DEFAULT_MO_IMAGE_PATH
                                    ) }}" alt="Card image cap">
                            <div class="card-body">
                                <p class="card-text">{{ $category->name }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="{{ route('menu.category', $category->id) }}">
                                            <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</main>

@endsection
