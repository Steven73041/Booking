@if($rooms->count())
    @foreach($rooms as $room)
        <div class="col-8 mx-auto border m-3">
            <h2 class="text-center mt-1">{{$room->name}}</h2>
            <div class="row">
                <div class="col-md-3 p-3">
                    @if($room->photos[0]->src)
                    <img class="col-md p-0" src="{{get_image_path($room->photos[0]->src) ?? ''}}" alt="{{$room->name}}">
                    @endif
                    <p class="mt-4">{{__('Price: ').$room->price.__('€ Per night')}}</p>
                    <a href="{{route('rooms.show', $room->slug)}}" class="btn btn-outline-info mx-5 mb-3">{{__('View Room')}}</a>
                </div>
                <div class="col-md-6">
                    <small>{{__('City: ').$room->city->name}}, {{$room->area}}</small>
                    <p class="text-truncate">{{$room->short_description}}</p>
                </div>
                <div class="col-md-3">
                    <p>{{__('Room Type: ').$room->type->name}}</p>
                    <hr>
                    <p>{{__('Parking: ').$room->parking}}</p>
                    <hr>
                    <p>{{__('Wifi: ').$room->wifi}}</p>
                    <hr>
                    <p>{{__('Pet Friendly: ').$room->pet_friendly}}</p>
                    <hr>
                    @if(isset($room->lat_location) && isset($room->lng_location))
                        <a href="https://www.google.com/maps/place/{{$room->lat_location}},{{$room->lng_location}}"
                           target="_blank">{{__('View location in map')}}</a>@endif
                </div>
            </div>
        </div>
    @endforeach
@else
    <h1 class="text-center text-white">{{__('You have no rooms.')}}</h1>
@endif
