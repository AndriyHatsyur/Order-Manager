@extends('layouts.app')

@section('content')

    <div class='container'>
        <div class='row justify-content-center'>
            <div class="col-5 mt-5">
                <div class='card'>
                    <div class='card-header text-uppercase'>
                        Вхід
                    </div>
                    <div class='card-body'>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label>Табельний</label>
                                <input type="text" class="form-control{{ $errors->has('t_number') ? ' is-invalid' : '' }}" name="t_number" value="{{ old('t_number') }}"  placeholder="Табельний">
                                @if ($errors->has('t_number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('t_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Пароль</label>
                                <input name="password"  type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Пароль">
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" name="remember" class="form-check-input">
                                <label for="exampleCheck1" class="form-check-label">Запамятати мене</label>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Вхід</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
@endsection