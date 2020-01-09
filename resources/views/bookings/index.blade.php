@extends('home-layout')
@section('content')
    <div class="content">
        @if($bookings->count())
            @foreach($bookings as $booking)
                <div class="col-8 mx-auto border m-3">
                    <h2 class="text-center mt-1">{{$booking->name}}</h2>
                    <div class="row">
                        <div class="col-md-3 p-3">
                            <img class="col-md p-0" src="../{{$booking->photo}}" alt="{{$booking->name}}">
                            <p class="mt-4">{{__('Price: ').$booking->price.__('€ Per night')}}</p>
                            <button type="button" onclick="window.location.href=('/rooms/{{$booking->room_id}}')"
                                    class="btn btn-outline-info mx-5 mb-3">{{__('View Room')}}
                            </button>
                        </div>
                        <div class="col-md-6">
                            <small>{{__('City: ').$booking->room->city->name}}, {{$booking->area}}</small>
                            <p class="text-truncate">{{$booking->short_description}}</p>
                            <p>{{__('Check in: ').substr($booking->check_in_date,0,10)}}</p>
                            <p>{{__('Check out: ').substr($booking->check_out_date,0,10)}}</p>
                        </div>
                        <div class="col-md-3">
                            <p>{{__('Guests: ').$booking->count_of_guests}}</p>
                            <hr>
                            <p>{{__('Parking: ').$booking->parking}}</p>
                            <hr>
                            <p>{{__('Wifi: ').$booking->wifi}}</p>
                            <hr>
                            <p>{{__('Pet Friendly: ').$booking->pet_friendly}}</p>
                            @if(isset($booking->lat_location, $booking->lng_location))
                                <hr>
                                <a href="https://www.google.com/maps/place/{{$booking->lat_location}},{{$booking->lng_location}}"
                                   target="_blank">{{__('View location in map')}}</a>
                            @endif
                            <hr>
                            <form method="POST" action="{{route('bookings.destroy', $booking->id)}}">
                                @csrf
                                @method('DELETE')
                                <input type="submit" name="submit" class="btn btn-danger mb-1 mx-auto px-5"
                                       value="Delete">
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-8 mx-auto border m-3">
                <h1 class="text-center">{{__('You have no bookings!!')}}</h1>
            </div>
        @endif
    </div>
@endsection
