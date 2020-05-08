@extends('home-layout')
@section('PageTitle', 'Register')
@section('content')
    <div class="container mx-auto rounded">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header text-center">{{__('Register')}}</div>
                    <div class="card-body">
                        <form method="POST" class="needs-validation" novalidate action="{{route('register')}}">
                            @csrf
                            <div class="form-group row">
                                <label for="firstName"
                                       class="col-md-4 col-form-label text-md-right">{{__('First Name') }}</label>
                                <div class="col-md-6">
                                    <input id="firstName" aria-describedby="firstName" type="text"
                                           class="form-control{{$errors->has('firstName')?' border border-danger':''}}"
                                           name="firstName" value="{{old('firstName')}}" required autofocus>
                                    @if ($errors->has('firstName'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{$errors->first('firstName')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="lastName"
                                       class="col-md-4 col-form-label text-md-right">{{__('Last Name')}}</label>
                                <div class="col-md-6">
                                    <input id="lastName" aria-describedby="lastName" type="text"
                                           class="form-control{{$errors->has('lastName')?' border border-danger':''}}"
                                           name="lastName" value="{{old('lastName')}}" required>
                                    @if ($errors->has('firstName'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{$errors->first('firstName')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{__('E-Mail Address')}}</label>
                                <div class="col-md-6">
                                    <input id="email" aria-describedby="email" type="email"
                                           class="form-control{{$errors->has('email')?' border border-danger':''}}"
                                           name="email" value="{{old('email')}}" required>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{$errors->first('email')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                <div class="col-md-6">
                                    <input id="password-field" aria-describedby="password" type="password"
                                           class="password form-control{{ $errors->has('password') ? ' border border-danger' : '' }}"
                                           name="password" required>
                                    <div class="hide-show">
                                        <span>Show</span>
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                       class="col-md-4 col-form-label text-md-right">{{__('Confirm Password')}}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" aria-describedby="password_confirmation"
                                           type="password" class="password form-control" name="password_confirmation"
                                           required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="pl-0 custom-control custom-checkbox mx-auto">
                                    <input type="checkbox" id="gdpr" name="gdpr"
                                           class="form-control-md custom-control-input p-relative {{$errors->has('gdpr')?'border border-danger':''}}"
                                           aria-describedby="gdpr" required>
                                    <label class="custom-control-label ml-1" for="gdpr"
                                           class="consent {{$errors->has('gdpr')?'border border-danger':''}}">
                                        {{__('I consent to keep my data in your database')}}</label>
                                </div>
                                <div class="invalid-feedback">{{__('If you don'.'t consent, you cannot register')}}</div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{__('Register')}}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
