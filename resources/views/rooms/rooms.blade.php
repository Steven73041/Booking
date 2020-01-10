@extends('home-layout')
@section('PageTitle', $title?$title:'Rooms')
@section('content')
    <div class="content">
        @if($title==='Rooms')
            <div class="col-8 mx-auto border m-3">
                <div class="row">
                    <div class="col-md-3 price">
                        <span href="#" class="sort_price">{{__('Price')}}</span>
                    </div>
                    <div class="col-md-6">
                        <input type="text" value="" oninput="key_up()" placeholder="Search by Name"
                               class="form-control name_filter">
                    </div>
                    <div class="col-md-3">
                        <select name="room_type" class="form-control count_filter">
                            <option value="">{{__('All')}}</option>
                            @foreach($room_types as $room_type)
                                <option value="{{$room_type->id}}">{{$room_type->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
    @endif
    <!-- TODO: find a way to template this -->
        <div class="filtered-data">
            @if($rooms->count())
                @foreach($rooms as $room)
                    <div class="col-8 mx-auto border m-3 room_row">
                        <h2 class="text-center mt-1">{{$room->name}}</h2>
                        <div class="row">
                            <div class="col-md-3 p-3">
                                <img class="col-md p-0" src="{{$room->photos[0]->src ?? ''}}" alt="{{$room->name}}">
                                <p class="mt-4">{{__('Price: ').$room->price.__('€ Per night')}}</p>
                                <a href="{{route('rooms.slug', $room->slug)}}"
                                   class="btn btn-outline-info mx-5 mb-3">{{__('View Room')}}</a>
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
                                <hr>@if(isset($room->lat_location) && isset($room->lng_location))
                                    <a href="https://www.google.com/maps/place/{{$room->lat_location}},{{$room->lng_location}}"
                                       target="_blank">{{__('View location in map')}}</a>@endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <h1 class="text-center text-white">{{__('You have no rooms.')}}</h1>
            @endif
            <div class="d-flex pagination-links">
                @if($rooms->count())
                    {{ $rooms->links() }}
                @endif
            </div>
        </div>
    </div>
    <script>
        function filterRooms() {
            var data = {
                sort_price: sort_price,
                name: $('.name_filter').val(),
                _token: "{{csrf_token()}}"
            };
            $.ajax({
                type: "post",
                url: "rooms/filter",
                data: data,
                success: function (data) {
                    $('.filtered-data').html(data);
                }
            });
        }

        var sort_price;
        var timer = 0;
        $('.sort_price').on('click', function () {
            if (sort_price === 'ASC') {
                sort_price = 'DESC';
            } else {
                sort_price = 'ASC';
            }
            filterRooms();
        });

        function key_up() {
            clearTimeout(timer);
            timer = setTimeout(function () {
                filterRooms();
            }, 300);
        };
        $('.count_filter').on('change', function () {
            filterRooms();
        });
    </script>
@endsection
