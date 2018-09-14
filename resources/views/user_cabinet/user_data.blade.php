@extends('user_cabinet.cabinet')

@section('user_data')

<div class="row">
    @include('user_cabinet.message')
    @include('admin.errors')
    {!! Form::open(['route' => ['cabinet.update', $user->getKey()], 'method' => 'put']) !!}
        <input type="hidden" name="updatedUserId" value="{{ $user->getKey() }}">
        <div class="col">
            <div class="form-group">
                <label for="InputName">Имя</label>
                <input
                    type="text"
                    class="form-control"
                    id="InputName"
                    name="name"
                    placeholder="Ваше имя"
                    value="{{ $user->name }}"
                    placeholder="Ваше имя"
                >
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="InputPhone">Телефон</label>
                <input
                    type="text"
                    class="form-control"
                    id="InputPhone"
                    name="phone_number"
                    value="{{ $user->phone_number }}"
                    placeholder="Ваш номер телефона"
                >
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="Email">E-mail</label>
                <input type="text" class="form-control" id="Email" name="email" value="{{ $user->email }}" placeholder="Ваш E-mail">
            </div>
        </div>
        <button class="btn btn-success" type="submit">Подтвердить</button>
    {!! Form::close() !!}
</div>
@endsection