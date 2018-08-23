@extends('main_layout')

@section('content')

<main role="main">

        <div class="container">
            <div class="row">
                <div class="col">
                    <div>
                        <a href="{{ route('menu')}}" class="btn btn-default">
                            <button class="btn btn-success">Перейти к меню</button>
                        </a>
                    </div>
                    <div class="text-center">
                        <img src="{{ asset('/storage/uploads/index.jpg') }}" width="600">
                    </div>
                </div>
            </div>
        </div>

</main>

@endsection
