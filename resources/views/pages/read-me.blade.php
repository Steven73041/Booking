@extends('home-layout')
@section('PageTitle', $title?:'Read Me')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1>{{__('Read Me')}}</h1>
                <h3>{{__('Highlights')}}</h3>
                <ul class="mb-4">
                    <li>{{__('Upload/Edit Rooms gallery')}}</li>
                    <li>{{__('Create/Edit User')}}</li>
                    <li>{{__('Booked dates disabled in calendar of room')}}</li>
                    <li>{{__('Ajax favorites')}}</li>
                    <li>{{__('Stripe payment')}}</li>
                    <li>{{__('Add/Edit/Delete Reviews')}}</li>
                </ul>
                <h3>{{__('Hidden highlights')}}</h3>
                <ul class="mb-4">
                    <li>{{__('Image class cropping images to 450*450, 500*350 and 232*132 to prevent serve scaled images.')}}</li>
                    <li>{{__('Session setting/unsetting for all critical requests (payments, bookings etc.).')}}</li>
                    <li>{{__('Strict security policies for CRUD based on ownership of object.')}}</li>
                    <li>{{__('Weather "widget" by open API based on IP location, using FontAwesome for icons.')}}</li>
                    <li>{{__('Using bootsrap at 100% of building front-end before adding custom SASS.')}}</li>
                    <li>{{__('Using animate.js for some "not so" beautiful animations.')}}</li>
                    <li>{!!__('Live Notifications about updates in price of favorite rooms (Using <a href="https://pusher.com/" target="_blank">Pusher</a>).')!!}
                        <span class="badge badge-primary badge-pill">{{__('New')}}</span>
                        <ol>
                            <li>{{__('Create a user, then create a room.')}}</li>
                            <li>{{__('Create another user, add in favorites the room created with the first user.')}}</li>
                            <li>{{__('Update the Price of room with the first user.')}}</li>
                            <li>{{__('Check the tab/window of the second user.')}}</li>
                            <li>{{__('You can be anywhere in the site with the second user to get notified about the price of favorite room.')}}</li>
                        </ol>
                    </li>
                </ul>
                <h3>{{__('Payments')}}</h3>
                <h4>{{__('Test Cards:')}}</h4>
                <ul class="mb-4">
                    <li>{{__('Success: ')}}<code>4242 4242 4242 4242</code></li>
                </ul>
                <h2>{{__('Credits')}}</h2>
                <p>{{__('Made by ')}}<strong>{{get_author()}}</strong>{{__(' using jQuery, SASS and every single feature of ')}}<a href="https://laravel.com/">{{__('Laravel 7.x')}}</a></p>
                <p></p>
            </div>
        </div>
    </div>
@endsection