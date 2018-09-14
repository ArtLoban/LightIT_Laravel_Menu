@extends('main_layout')

@section('content')

<main role="main">

        <div class="container">
            <div class="row justify-content-center">
                <h5>Кабинет пользователя</h5>
            </div>
            <div class="row">
                <div class="col">
                    <nav class="navbar navbar-expand-md bg-light-gray">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item cabinet-item {{ Request::is('cabinet') ? 'cabinet-item-active':'' }}">
                                <a class="text-left" href="{{ route('cabinet.index') }}">Личные данные</a>
                            </li>
                            <li class="nav-item cabinet-item {{ Request::is('cabinet/history') ? 'cabinet-item-active':'' }}">
                                <a class="text-left" href="{{ route('cabinet.history') }}">История заказов</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

            @yield('user_data')
        </div>

</main>

@endsection
