<!DOCTYPE html>
<html lang="{{str_replace('_', '-', app()->getLocale())}}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('PageTitle')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="https://js.stripe.com/v3/" defer></script>
    <link rel="stylesheet" href="{{url('/css/daterangepickerjquery.min.css')}}">
    <link type="text/css" rel="stylesheet" href="{{url('/css/bootstrap.min.css')}}">
    <link type="text/css" rel="stylesheet" href="{{url('/css/daterangepicker.css')}}"/>
    <link type="text/css" rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link type="text/css" href="{{url('/dist/style.css')}}" rel="stylesheet">
    <script src="{{ asset('js/echo.js') }}"></script>
    <script src="https://js.pusher.com/4.1/pusher.min.js"></script>
    <script type="text/javascript" src="{{url('/js/jquery3-4-1.min.js')}}"></script>
    <script type="text/javascript" src="{{url('/js/main.js')}}" defer></script>
</head>
<body>
<div class="big-bg @yield('bg-class')">
    <!-- header -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/">{{__('Tech Booking')}}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link @if(Route::current()->getName() == 'rooms.index') active @endif"
                       href="{{route('rooms.index')}}">{{__('Our Rooms')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(Route::current()->getName() == 'page.about') active @endif"
                       href="{{route('page.about')}}">{{__('About us')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(Route::current()->getName() == 'page.contact') active @endif"
                       href="{{route('page.contact')}}">{{__('Contact')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(Route::current()->getName() == 'page.read-me') active @endif"
                       href="{{route('page.read-me')}}">{{__('Read Me')}}</a>
                </li>
                @guest
                    <li class="nav-item">
                        <a class="nav-link @if(Route::current()->getName() == 'login') active @endif"
                           href="{{route('login')}}">{{__('Login')}}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link @if(Route::current()->getName() == 'register') active @endif"
                               href="{{route('register')}}">{{__('Register')}}</a>
                        </li>
                    @endif
                @endguest
                @if($weather_error === "OK")
                    <li class="nav-item ml-auto">
                        <a class="nav-link">{{$weather->name.", ".round($weather->main->temp)}}<sup>c</sup>
                            @php $i_f = '' @endphp
                            @switch($weather->weather[0]->main)
                                @case('Rain')
                                @php $i_f = '<i class="fas fa-cloud-rain"></i>' @endphp
                                @break
                                @case('Mist')
                                @php $i_f = '<i class="fas fa-smog"></i>' @endphp
                                @break
                                @case('Drizzle')
                                @php $i_f = '<i class="fas fa-snowflake"></i>' @endphp
                                @break
                                @case('Snow')
                                @php $i_f = '<i class="fas fa-snowflake"></i>' @endphp
                                @break
                                @case('Clear')
                                @php $i_f = '<i class="fas fa-sun"></i>' @endphp
                                @break
                                @case('Clouds')
                                @php $i_f = '<i class="fas fa-cloud"></i>' @endphp
                                @break
                                @default
                                @php $i_f = '<i class="fas fa-sun"></i>' @endphp
                                @break
                            @endswitch
                            @php echo $i_f @endphp
                        </a>
                    </li>
                @endif
                @auth
                    <li class="nav-item dropdown name-pos">
                        <a class="nav-link text-white dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                           aria-haspopup="true"
                           aria-expanded="false">{{__('Hello,').' '.Auth::user()->firstName.' '.Auth::user()->lastName}}</a>
                        <div class="dropdown-menu" id="navbarNavDropdown">
                            <a class="dropdown-item @if(Route::current()->getName() == 'user.edit') active @endif"
                               href="{{route('user.edit',Auth::user()->id)}}">{{__('Edit Profile')}}</a>

                            <a class="dropdown-item @if(Route::current()->getName() == 'bookings.index') active @endif"
                               href="{{route('bookings.index')}}">{{__('My Bookings')}}</a>

                            <a class="dropdown-item @if(Route::current()->getName() == 'rooms.myRooms') active @endif"
                               href="{{route('rooms.myRooms')}}">{{__('My Rooms')}}</a>

                            <a class="dropdown-item @if(Route::current()->getName() == 'favorites.index') active @endif"
                               href="{{route('favorites.index')}}">{{__('My Favorites ')}}<i
                                        class="fas fa-heart"></i></a>

                            <a class="dropdown-item @if(Route::current()->getName() == 'rooms.create') active @endif"
                               href="{{route('rooms.create')}}">{{__('Create Room')}}</a>

                            <a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">{{__('Logout')}}</a>
                        </div>
                    </li>
                    <form id="logout-form" class="d-none" action="{{route('logout')}}" method="POST">
                        @csrf
                    </form>
                @endauth
            </ul>
        </div>
    </nav>
    @yield('content')
</div><!--end big bg-->
<!-- footer -->
<div class="row bg-dark">
    <h5 class="text-center text-white mx-auto py-2 col-12">{{__('Copyrights reserved ').now()->year}} &copy</h5>
    <a class="text-white mx-auto py-2" href="{{route('home')}}">{{__('Home')}}</a>
</div>
<a href="#" class="scrollToTop" title="{{__('Scroll to top')}}"></a>
<div class="modal fade" id="RoomUpdated" tabindex="-1" role="dialog" aria-labelledby="RoomUpdated"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="RoomUpdatedTitle"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-secondary" href="">{{__('Check it Out!')}}</a>
            </div>
        </div>
    </div>
</div>
@php
    $user = auth()->user();
    $fav_ids = [];
    if($user){
        $favorites = $user->favorites()->get('room_id');
        foreach($favorites as $favorite) {
        	$fav_ids[] = $favorite->room_id;
        }
    }
@endphp
<script>
    let favorites = [{{implode(",", $fav_ids)}}];
    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: '47b882509c58b2b5952b',
        cluster: 'eu',
        encrypted: true,
        logToConsole: true
    });

    Echo.channel('price_updated').listen('RoomPriceChanged', (data) => {
        let room = data.room;
        if (favorites.includes(room.id)) {
            let domain_url = '{{url('/')}}';
            let price = room.price;
            let name = room.name;
            let short_description = room.short_description;
            let url = domain_url + "/rooms/" + room.slug;
            let body_html = '<h2>A room you liked has updated its price!</h2><h5>' + price + '€ per night</h5><p>' + short_description + '</p>';

            $('#RoomUpdated .modal-body').html(body_html);
            $('#RoomUpdated .modal-footer a').attr('href', url);
            $('#RoomUpdatedTitle').html(name);
            $('#RoomUpdated').modal('show');
        }
    });
</script>
</body>
</html>
