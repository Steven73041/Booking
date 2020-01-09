@extends('home-layout')
@section('PageTitle', 'Edit User')
@section('content')
<div class="row">
    <div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <!-- TODO: redesign -->
    <div class="card">
    <div class="card-header text-center">{{__('Edit User')}}</div>
    <div class="card-body">
    <form method="POST" class="needs-validation" novalidate action="{{route('user.update',$user->id)}}">
    @csrf
    @method('PATCH')
    <div class="form-row">
    <div class="col-md-6 m-3">
    <label for="firstName">{{__('First Name')}}</label>
        <input type="text" name="firstName" class="form-control form-control-md" value="{{$user->firstName}}" placeholder="First Name" >
    <label for="lastName">{{__('Last Name')}}</label>
        <input type="text" name="lastName" class="form-control form-control-md" value="{{$user->lastName}}" placeholder="Last Name" >
    </div>
    </div>

    <div class="form-row">
    <div class="col-md-6 m-3">
    <label for="city">{{__('City')}}</label>
        <input type="text" name="city" class="form-control form-control-md" value="{{$user->city}}" placeholder="City" >
    <label for="phone">{{__('Phone')}}</label>
        <input type="text" name="phone" class="form-control form-control-md" value="{{$user->phone}}" placeholder="Phone" >
    </div>
    </div>

    <div class="form-row">
        <div class="col-md-6 m-3">
            <label for="email">{{__('E-mail')}}</label>
                <input type="email" name="email" class="form-control form-control-md" value="{{$user->email}}" placeholder="E-mail" >
                    <div class="invalid-feedback">{{__('Please provide a valid email.')}}</div>
            <label for="password">Password*</label>
            <input type="password" name="password" class="form-control form-control-md" value="" placeholder="Password" >
                <div class="invalid-feedback">{{__('Please provide a valid password.')}}</div>
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-6 m-3">
        <label for="password_confirmation">{{__('Confirm Password*')}}</label>
            <input type="password" name="password_confirmation" value="" placeholder="Confirm Password" class="form-control form-control-md {{$errors->has('password')?'border border-danger':''}}" aria-describedby="password" required>
                <div class="invalid-feedback">{{__('Please provide a valid password.')}}</div>
            <input type="submit" name="submit" class="mb-3 mt-3 btn btn-outline-info" value="Edit" >
        </div>
    </div>
    </form>
    </div>
    </div>

    <form method="POST" class="d-inline" action="{{route('user.destroy',$user->id)}}">
    @csrf
    @method('DELETE')
        <input type="submit" name="submit" class="mb-3 ml-4 mt-3 btn btn-outline-danger" value="Delete">
    </form>
    </div>
    </div>

    </div><!--container-->
</div><!-- row -->
@endsection
