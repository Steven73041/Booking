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
                <h3>{{__('Payments')}}</h3>
                <h4>{{__('Test Cards:')}}</h4>
                <ul class="mb-4">
                    <li>{{__('Success: ')}}<code>4242 4242 4242 4242</code></li>
                </ul>
                <h2>{{__('Credits')}}</h2>
                <p>{{__('Made by ')}}<strong>{{get_author()}}</strong>{{__('using jQuery, SASS and every single feature of Laravel 7.x')}}</p>
            </div>
        </div>
    </div>
@endsection