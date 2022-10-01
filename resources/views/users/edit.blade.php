@extends('welcome')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-6">
                <h1>Редактирование аккаунта</h1>
                @if(session()->has('success'))
                    <div class="alert alert-success">Товар успешно отредактирован!</div>
                @endif
                <form method="POST" action="">
                    @csrf
                    <div class="mb-3">
                        <label for="inputFullname" class="form-label">ФИО:</label>
                        <input type="text" name="fullname" class="form-control @error('fullname') is-invalid @enderror" id="inputFullname" placeholder="ФИО" aria-describedby="invalidInputFullName" value="{{Auth::user()->fullname}}">
                        @error('fullname') <div id="invalidInputFullName" class="invalid-feedback">{{$message}}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="inputAddress" class="form-label">Адрес:</label>
                        <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" id="inputAddress" placeholder="Адрес" aria-describedby="invalidInputAddress" value="{{Auth::user()->address}}">
                        @error('address') <div id="invalidInputAddress" class="invalid-feedback">{{$message}}</div> @enderror
                    </div>
                    <p class="small">При вводе пароля, изменения его не коснутся.</p>
                    <div class="mb-3">
                        <label for="inputPassword" class="form-label">Пароль:</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="inputPassword" placeholder="Пароль" aria-describedby="invalidInputPassword">
                        @error('password') <div id="invalidInputPassword" class="invalid-feedback">{{$message}}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="inputPasswordConfirmation" class="form-label">Повторите пароль:</label>
                        <input type="password" name="password_confirmation" class="form-control @error('password') is-invalid @enderror" id="inputPasswordConfirmation" placeholder="Повторите пароль">
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Редактировать аккаунт
                    </button>
                </form>
            </div>
            <div class="col"></div>
        </div>
    </div>
@endsection
