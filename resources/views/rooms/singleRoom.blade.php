@extends('home-layout')
@section('PageTitle', $room->name)
@section('bg-class', 'test2')
@section('content')
    @if($errors->first())
        <div class="row alert alert-danger">
            {{$errors->first()}}
        </div>
    @endif
    <div class="row">
        <div class="container">
            <h1 class="text-center">{{$room->name}}</h1>
            <h2 class="text-center">{{$room->city->name}}</h2>
        </div>
    </div>
    <div class="row room_info_row">
        <div class="col-lg-4">
            <div class="container">
                <div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails col-lg"
                     data-ride="carousel">
                    <!--Slides-->
                    <div class="carousel-inner" role="listbox">
                        @php $i = 0 @endphp
                        @foreach($room->photos as $photo)
                            <div class="carousel-item @if($i === 0) active @endif">
                                <img class="d-block w-100" src="{{asset(get_image($photo->src, 'single_room'))}}" alt="{{$room->name}}"/>
                            </div>
                            @php $i++ @endphp
                        @endforeach
                    </div>
                    <!--/.Slides-->
                    <!--Controls-->
                    <a class="carousel-control-prev" href="#carousel-thumb" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">{{__('Previous')}}</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel-thumb" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">{{('Next')}}</span>
                    </a>
                    <!--/.Controls-->
                    <ol class="carousel-indicators">
                        @php $i = 0 @endphp
                        @foreach($room->photos as $photo)
                            <li data-target="#carousel-thumb" data-slide-to="{{$i}}"
                                class="@if($i === 0) active @endif">
                                <img class="d-block w-100" src="{{asset($photo->src)}}" class="img-fluid">
                            </li>
                            @php $i++ @endphp
                        @endforeach
                    </ol>
                </div>
                <!--/.Carousel Wrapper-->
                <span class="ml-3">{{__('Price: ').$room->price.__('€')}}</span>
                @auth
                    <i class="@if(DB::table('favorites')->where('room_id',$room->id)->where('user_id',Auth::user()->id)->get()->count())fas @else far @endif ml-5 fa-heart favorite-heart"></i>
                    <script type="text/javascript" defer>
                        $('.favorite-heart').on('click', function () {
                            var data = {
                                room_id: "{{$room->id}}",
                                _token: "{{csrf_token()}}"
                            };
                            $.ajax({
                                type: "POST",
                                url: "{{route('favorites.store')}}",
                                data: data,
                                success: function (data) {
                                    $('.favorite-heart').toggleClass('fas');
                                    $('.favorite-heart').toggleClass('far');
                                }
                            });
                        });
                    </script>
                @endauth
            </div>
        </div>
        <div class="col-lg-5">
            <div class="ml-3">
                <p>{{__('Area: ').$room->area}}</p>
                <p>{{$room->long_description}}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="ml-3">
                <p>{{__('Pet Friendly: ').$room->pet_friendly}}</p>
                <hr>
                <p>{{__('Wifi: ').$room->wifi}}</p>
                <hr>
                <p>{{__('Parking: ').$room->parking}}</p>
                <hr>
                <p>{{__('Room Type: ').$room->type->name}}</p>
                @if (isset(Auth::user()->id) && $room->bookings->where('user_id',Auth::user()->id)->get(0)===NULL)
                    <form method="POST" class="needs-validation" novalidate action="{{route('booking.checkout')}}">
                        @csrf
                        <input type="hidden" name="room_id" class="form-control" value="{{$room->id}}" required/>
                        <script src="{{asset('js/daterangepickerjquery.js')}}"></script>
                        <script>
                            const data = {
                                room_id: $('input[name="room_id"]').val(),
                                _token: $('meta[name="csrf-token"]').attr("content")
                            };
                            $.ajax({
                                type: "post",
                                url: "{{route('rooms.get_booking_dates')}}",
                                data: data,
                                success: function (data) {
                                    const array = JSON.parse(data);
                                    function unavailable(date) {
                                        let dmy = date.toISOString().split('T')[0];
                                        if ($.inArray(dmy, array) < 0) {
                                            return [true, "", "Free"];
                                        } else {
                                            return [false, "disabled", "Booked"];
                                        }
                                    }
                                    $('#calendar').dateRangePicker({
                                        minDate: 0,
                                        constrainInput: true,
                                        format: "DD-MM-YYYY",
                                        minDays: 2,
                                        startDate: new Date(),
                                        selectForward: true,
                                        separator: ' - ',
                                        // showDateFilter: function (time, date) {
                                        //     return '<div style="padding:0 5px;"><span style="font-weight:bold">' + date + '</span>' +
                                        //         '<div style="opacity:0.3;">$' + Math.round(Math.random() * 999) + '</div></div>';
                                        // },
                                        beforeShowDay: function (date) {
                                            let k = unavailable(date);
                                            return k;
                                        }
                                    });
                                },
                                error: function (error) {
                                    $('#calendar').dateRangePicker({
                                        minDate: 0,
                                        constrainInput: true,
                                        format: "DD-MM-YYYY",
                                        minDays: 2,
                                        startDate: new Date(),
                                        selectForward: true,
                                        separator: ' - ',
                                        // showDateFilter: function (time, date) {
                                        //     return '<div style="padding:0 5px;"><span style="font-weight:bold">' + date + '</span>' +
                                        //         '<div style="opacity:0.3;">$' + Math.round(Math.random() * 999) + '</div></div>';
                                        // },
                                    });
                                }
                            });
                            // const array = ["2020-01-17", "2020-01-19", "2020-01-21"];
                        </script>
                        <input type="text" id="calendar" class="form-control" name="datetimes" autocomplete="off" required placeholder="Booking Dates"/>
                        <hr>
                        <input type="submit" name="submit" class="btn btn-primary mb-1 mx-auto px-5" value="Book">
                        @can('edit', $room)
                            <a type="button" class="btn btn-outline-primary mb-1 mx-auto" href="{{route('rooms.edit', $room->slug)}}">{{__('Edit Room')}}</a>
                        @endcan
                    </form>
                @endif
            </div>
        </div>
    </div><!-- row -->
    @if(isset($room->lat_location, $room->lng_location, $room->area, $room->city->name, $room->name))
        <hr>
        <div class="row room_info_row">
            <div class="container">
                <iframe class="col-12" height="400"
                        src="https://maps.google.com/maps?width=100%&amp;height=300&amp;hl=en&amp;coord={{$room->lat_location}},{{$room->lng_location}}&amp;q={{$room->area}},{{$room->city->name}}+({{$room->name}})&amp;ie=UTF8&amp;t=&amp;z=14&amp;iwloc=B&amp;output=embed"
                        frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
            </div>
        </div><!--row-->
    @endif
    <hr>
    <div class="row room_info_row">
        <div class="container">
            <h1 class="col-12 text-center">{{__('Reviews')}}</h1>
            @if($room->reviews->count())
                @foreach ($room->reviews->sortByDesc('created_at') as $review)
                    <div class="row text-center review border border-dark p-4 m-2">
                        <form method="POST"
                              class="review_form_update col-md-7 row @can('edit', $review) review_edit @endcan"
                              action="{{route('reviews.update',$review->id)}}">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" value="{{$room->id}}" name="room_id"/>
                            <div class="col-md-3 text-left @can('edit', $review) review_div @endcan">{{__('Rate: ')}}
                                <strong>{{$review->rate}}</strong></div>
                            <input type="number" class="d-none col-md-3" name="rate" min="1" max="10"
                                   value="{{$review->rate}}"/>
                            <div
                                class="col-md-7 @can('edit', $review) review_div @endcan">{{__('Description: ').$review->review}}</div>
                            <textarea name="review" cols="20" rows="4" from="review_form_update"
                                      value="{{$review->review}}"
                                      class="mx-auto col-md-7 form-control-md d-none {{$errors->any()?'border border-danger':''}}"
                                      required
                                      placeholder="{{$errors->has('review')?$errors->first('review'):''}}">{{$review->review}}</textarea>
                            <input type="submit" name="submit" value="Save"
                                   class=" r-0 position-absolute btn btn-primary @can('edit', $review) review_edit_btn @endcan d-none"/>
                        </form>
                        <div
                            class="col-md-2 text-center">{{__('Date: ').date('d/m/Y', strtotime($review->created_at))}}</div>
                        @can('delete', $review)
                            <div class="col-md-2 text-right">
                                <form method="POST" action="{{route('reviews.destroy', $review->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="form-control btn btn-danger delete_button d-none"
                                           name="submit" value="Delete"/>
                                </form>
                            </div>
                            <div class="col-md-1">
                                <a href="#" class="edit_button">{{__('Edit')}}</a>
                            </div>
                        @endcan
                    </div>
                @endforeach
            @else
                <h2 class="text-center text-info">{{__('There are no Reviews')}}</h2>
            @endif
            @auth
                <form method="POST" action="{{route('reviews.store')}}" class="needs-validation" novalidate
                      id="review_form">
                    @csrf
                    <input type="hidden" name="room_id" value="{{$room->id}}"/>
                    <div class="form-row text-center">
                        <label for="rating" class="col-12">{{__('Rate')}}</label>
                        <input type="number" min="1" max="5" required name="rate"
                               placeholder="{{$errors->reviews->first('rate')?$errors->reviews->first('rate'):''}}" value="{{old('rate')}}"
                               class="mx-auto form-control col-md-1 col-sm-2 col-lg-1 {{$errors->first('rate')?'border border-danger':''}}"/>
                    </div>
                    <div class="form-row text-center">
                        <label for="review" class="col-12">{{__('Review')}}</label>
                        <textarea name="review" cols="40" rows="5" from="review_form" required
                                  class="mx-auto form-control col-md-6 form-control-md {{$errors->reviews->first('review')?'border border-danger':''}}"
                                  placeholder="{{$errors->reviews->first('review')?$errors->reviews->first('review'):''}}">{{old('review')}}</textarea>
                    </div>
                    <div class="form-row text-center">
                        <input type="submit" name="submit" value="Submit" class="mx-auto btn btn-primary m-1 mx-auto px-5"/>
                    </div>
                </form>
                @if (count($errors->reviews) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->reviews->all() as $message)
                                <li>{{$message}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            @else
                <h3 class="text-center">{{__('You must ')}}<a
                        href="{{route('login')}}">{{__('Login')}}</a>{{__(' to write a review')}}</h3>
            @endauth
        </div>
    </div><!--row-->
    <script type="text/javascript" defer>
        $('.edit_button').on('click', function (e) {
            e.preventDefault();
            if ($(this).closest('.row.review').find('.edit_button').html() === 'Exit Edit') {
                $(this).closest('.row.review').find('.edit_button').html('Edit');
            } else {
                $(this).closest('.row.review').find('.edit_button').html('Exit Edit');
            }
            $(this).closest('.row.review').find('.review_edit_btn').fadeToggle(1);
            $(this).closest('.row.review').find('.review_edit > input, .delete_button, .review_edit > textarea, .review_div').toggleClass('d-none');
        });
    </script>
@endsection
