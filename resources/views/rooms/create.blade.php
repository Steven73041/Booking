@extends('home-layout')
@section('PageTitle', 'Create Room')
@section('content')
    <div class="row">
        <div class="container">
            <div class="card">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
            @endif
            <!-- TODO: redesign with rows than columns! -->
                <div class="card-header text-center">{{__('Create Room')}}</div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" class="needs-validation" novalidate
                          action="{{route('rooms.store')}}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-3 m-2">
                                <div>
                                    <label for="name">{{__('Name*')}}</label>
                                    <input type="text" name="name" class="form-control form-control-md"
                                           value="{{old('name')}}" required>
                                    <div class="invalid-feedback">{{__('Please provide a name')}}</div>
                                </div>
                                <div>
                                    <label for="city_id">{{__('City*')}}</label>
                                    <select name="city_id" class="form-control form-control-md" aria-describedby="city"
                                            placeholder="Choose City" required>
                                        <option value="" disabled selected>{{__('Choose City')}}</option>
                                        @foreach($cities as $city)
                                            <option value="{{$city->id}}">{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">{{__('Please provide a valid city.')}}</div>
                                </div>
                            </div>
                            <div class="col-md-3 m-2">
                                <div>
                                    <label for="room_type">{{__('Room Type*')}}</label>
                                    <select name="room_type" class="form-control form-control-md"
                                            aria-describedby="room_type" placeholder="Choose Room type" required>
                                        <option value="" disabled selected>{{__('Room Type')}}</option>
                                        @foreach($room_types as $room_type)
                                            <option value="{{$room_type->id}}">{{$room_type->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">{{__('Please provide a valid room type.')}}</div>
                                </div>
                                <div>
                                    <label for="price">{{__('Price*')}}</label>
                                    <input type="number" name="price" class="form-control form-control-md"
                                           value="{{old('price')}}" required/>
                                    <div class="invalid-feedback">{{__('Please provide a price.')}}</div>
                                </div>
                            </div>
                            <div class="col-md-3 m-2">
                                <div>
                                    <label for="area">{{__('Area*')}}</label>
                                    <input type="text" name="area" class="form-control form-control-md"
                                           value="{{old('area')}}" required/>
                                    <div class="invalid-feedback">{{__('Please provide a valid area.')}}</div>
                                </div>
                                <label for="address">{{__('Address')}}</label>
                                <div>
                                    <input type="text" name="address" class="form-control form-control-md"
                                           value="{{old('address')}}"/>
                                    <div class="invalid-feedback">{{__('Please provide a valid address.')}}</div>
                                </div>
                            </div>
                            <div class="col-md-2 m-2">
                                <div>
                                    <label for="area">{{__('Longtitude')}}</label>
                                    <input type="text" name="lng_location" class="form-control form-control-md"
                                           value="{{old('lng_location')}}"/>
                                    <div class="invalid-feedback">{{__('Please provide a valid password.')}}</div>
                                </div>
                                <div>
                                    <label for="location">{{__('Latitude')}}</label>
                                    <input type="text" name="lat_location" class="form-control form-control-md"
                                           value="{{old('lat_location')}}"/>
                                    <div class="invalid-feedback">{{__('Please provide a valid password.')}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-2 m-2">
                                <input type="checkbox" class="custom-control-input ml-2" id="wifi"
                                       name="wifi" @if(old('wifi')) checked @endif>
                                <label class="custom-control-label" for="wifi">{{__('Wifi')}}</label>
                            </div>
                            <div class="col-md-2 m-2">
                                <input type="checkbox" class="custom-control-input ml-2" id="pet_friendly"
                                       name="pet_friendly" @if(old('pet_friendly')) checked @endif/>
                                <label class="custom-control-label" for="pet_friendly">{{__('Pet Friendly')}}</label>
                            </div>
                            <div class="col-md-2 m-2">
                                <input type="checkbox" class="custom-control-input ml-2" id="parking"
                                       name="parking" @if(old('parking')) checked @endif>
                                <label class="custom-control-label" for="parking">{{__('Parking')}}</label>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-3 m-2">
                                <label for="price">{{__('Short Description')}}</label>
                                <input type="text" name="short_description" class="form-control form-control-md"
                                       value="{{old('short_description')}}">
                                <div class="invalid-feedback">{{__('Please provide a short description.')}}</div>
                                <div class="custom-file mt-2">
                                    <input type="file" id="customFile" enctype="multipart/form-data" name="photo[]"
                                           class="form-control custom-file-input" value="{{old('photo')}}"
                                           aria-describedby="file" required multiple/>
                                    <label class="custom-file-label" for="customFile">{{__('Choose Photo')}}</label>
                                    <div class="invalid-feedback">{{__('Please provide a photo.')}}</div>
                                </div>
                            </div>
                            <div class="col-md-8 m-2">
                                <label for="long_description">{{__('Long Description')}}</label>
                                <textarea class="form-control" rows="4" aria-describedby="long_description"
                                          name="long_description" value="{{old('long_description')}}"></textarea>
                                <div class="invalid-feedback">{{__('Please provide a valid long description.')}}</div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-3 m-2">
                                <input type="submit" name="submit" class="mb-3 mt-3 btn btn-outline-info" value="Save">
                            </div>
                        </div>
                    </form>
                </div> <!-- card body -->
            </div><!-- card -->
        </div><!--container-->
    </div><!-- row -->
@endsection
