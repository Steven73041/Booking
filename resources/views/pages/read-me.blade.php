@extends('home-layout')
@section('PageTitle', $title?:'Read Me')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-sm-12">
                <h1>{{__('Read Me')}}</h1>
                <h2>{{__('Highlights')}}</h2>
                <ul>
                    <li>{{__('Upload/Edit Rooms gallery')}}</li>
                    <li>{{__('Create/Edit User')}}</li>
                    <li>{{__('Booked dates disabled in calendar of room')}}</li>
                    <li>{{__('Ajax favorites')}}</li>
                    <li>{{__('Stripe payment')}}</li>
                    <li>{{__('Add/Edit/Delete Reviews')}}</li>
                </ul>
                <h2>{{__('Payments')}}</h2>
                <h3>{{__('Test Cards:')}}</h3>
                <ul>
                    <li>{{__('Success: ')}}<code>4242 4242 4242 4242</code></li>
                </ul>
            </div>
        </div>
    </div>
@endsection