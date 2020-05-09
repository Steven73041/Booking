@extends('home-layout')
@section('PageTitle', 'Home')
@section('bg-class', 'Home')
<!-- form -->
@section('content')
    <div class="container col-md-4 mx-auto rounded">
        <form method="POST" class="needs-validation" novalidate="" action="{{route('rooms.form')}}">
            <div class="form-row">
                <div class="col-md-6 mb-4">
                    @csrf
                    <select name="city_id" class="form-control form-control-md" aria-describedby="city"
                            placeholder="Choose City" required>
                        <option value="" disabled selected>{{__('Choose City')}}</option>
                        @foreach($cities as $city)
                            <option value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">{{__('Please provide a valid city.')}}</div>
                </div>
                <div class="col-md-6 mb-4">
                    <select name="room_type" class="form-control form-control-md" aria-describedby="room_type"
                            placeholder="Choose Room type" required>
                        <option value="" disabled selected>{{__('Room Type')}}</option>
                        @foreach($room_types as $room_type)
                            <option value="{{$room_type->id}}">{{$room_type->name}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">{{__('Please provide a valid room type.')}}</div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12 mb-4">
                    <input type="text" name="datetimes" class="form-control" value="" required/>
                </div>
            </div>
            <div class="form-row">
                <input type="submit" name="submit" class="btn btn-primary mb-1 mx-auto px-5" value="Submit">
            </div>
        </form>
    </div>
    <!-- our newest rooms! -->
    <h1 class="text-center my-2">{{__('Our Newest Rooms!')}}</h1>
    <!-- Cards -->
    <div class="row new_rooms_div">
        @foreach($newrooms as $newroom)
            <div class="card mx-auto col-md-2">
                <div class="text-center">
                    @if(count($newroom->photos))
                        <img width="232" height="132" class="card-img-top mx-auto mt-3" src="{{asset(get_image($newroom->photos[0]->src, 'card'))}}" alt="{{$newroom->name}}"/>
                    @endif
                </div>
                <div class="card-body p-1 text-center">
                    <h5 class="card-title p-0 m-0">{{$newroom->name}}</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">{{__('City: ').$newroom->city->name}}</li>
                    <li class="list-group-item">{{__('Price: ').$newroom->price}}€</li>
                    <li class="list-group-item">{{__('Room type: ').$newroom->type->name}}</li>
                    <li class="list-group-item">
                        <a href="{{route('rooms.show', $newroom->slug)}}"
                           class="btn btn-outline-info">{{__('View Room')}}</a>
                    </li>
                </ul>
            </div>
        @endforeach
    </div><!-- card row -->
@endsection
