@extends('home-layout')
@section('PageTitle', 'Edit Room')
@section('content')
    <div class="row">
        <div class="container">
            <div class="card">
                @if ($errors->any())
                    @if ($errors->first()==='Your Room has been updated successfully!')
                        <div class="alert alert-success">
                            <h2 class="text-center">{{$errors->first()}}</h2>
                        </div>
                    @else
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                @endif
                <div class="card-header text-center">{{__('Edit Room')}}</div>
                <div class="card-body">
                    <form method="POST" action="{{route('rooms.update',$room->id)}}" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <div class="form-row">
                            <div class="col-md-3 m-2">
                                <label for="name">{{__('Name')}}</label>
                                <input type="text" name="name" class="form-control form-control-md"
                                       value="{{$room->name}}">
                                <label for="city_id">{{__('City')}}</label>
                                <select name="city_id" class="form-control form-control-md" aria-describedby="city"
                                        placeholder="Choose City" required>
                                    <option value="" disabled selected>{{__('Choose City')}}</option>
                                    @foreach($cities as $city)
                                        <option @if($room->city_id===$city->id) selected @endif value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 m-2">
                                <label for="room_type">{{__('Room Type')}}</label>
                                <select name="room_type" class="form-control form-control-md"
                                        aria-describedby="room_type" placeholder="Choose Room type" required>
                                    <option value="" disabled selected>{{__('Room Type')}}</option>
                                    @foreach($room_types as $room_type)
                                        <option @if($room->type->id===$room_type->id) selected @endif value="{{$room_type->id}}">{{$room_type->name}}</option>
                                    @endforeach
                                </select>
                                <label for="price">{{__('Price*')}}</label>
                                <input type="number" name="price" class="form-control form-control-md"
                                       value="{{$room->price}}">
                            </div>
                            <div class="col-md-3 m-2">
                                <label for="area">{{__('Area')}}</label>
                                <input type="text" name="area" class="form-control form-control-md"
                                       value="{{$room->area}}">
                                <label for="address">{{__('Address')}}</label>
                                <input type="text" name="address" class="form-control form-control-md"
                                       value="{{$room->address}}">
                            </div>
                            <div class="col-md-2 m-2">
                                <label for="lng_location">{{__('Longtitude')}}</label>
                                <input type="text" name="lng_location" class="form-control form-control-md"
                                       value="{{$room->lng_location}}">
                                <label for="lat_location">{{__('Latitude')}}</label>
                                <input type="text" name="lat_location" class="form-control form-control-md"
                                       value="{{$room->lat_location}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-2 m-2">
                                <input type="checkbox" @if($room->wifi==='Yes') checked
                                       @endif class="custom-control-input ml-2" id="wifi" name="wifi">
                                <label class="custom-control-label" for="wifi">{{__('Wifi')}}</label>
                            </div>
                            <div class="col-md-2 m-2">
                                <input type="checkbox" class="custom-control-input ml-2" id="pet_friendly"
                                       name="pet_friendly" @if($room->pet_friendly==='Yes') checked @endif>
                                <label class="custom-control-label" for="pet_friendly">{{__('Pet Friendly')}}</label>
                            </div>
                            <div class="col-md-2 m-2">
                                <input type="checkbox" class="custom-control-input ml-2" id="customCheck1"
                                       name="parking" @if($room->parking==='Yes') checked @endif>
                                <label class="custom-control-label" for="customCheck1">{{__('Parking')}}</label>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-3 m-2">
                                <label for="price">{{__('Short Description')}}</label>
                                <input type="text" name="short_description" class="form-control form-control-md"
                                       value="{{$room->short_description}}">
                                <div class="invalid-feedback">{{__('Please provide a short description.')}}</div>
                                <div class="custom-file mt-2">
                                    <input type="file" id="customFile" enctype="multipart/form-data" name="photo[]"
                                           class="form-control custom-file-input" value="{{$room->photo}}"
                                           aria-describedby="file" multiple>
                                    <label class="custom-file-label" for="customFile">{{__('Choose Photo')}}</label>
                                </div>
                            </div>
                            <div class="col-md-8 m-2">
                                <label for="long_description">{{__('Long Description')}}</label>
                                <textarea class="form-control" rows="4" aria-describedby="long_description"
                                          name="long_description" value="">{{$room->long_description}}</textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-3 m-2">
                                <input type="submit" name="submit" class="mb-3 mt-3 btn btn-outline-info" value="Edit">
                            </div>
                        </div>
                    </form>
                    <form method="POST" action="{{route('rooms.destroy', $room->id)}}">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn btn-danger" name="submit" value="Delete"
                               onclick="if(confirm('Are you sure you want to delete?')){return true;}else{return false;}">
                    </form>
                </div> <!-- card body -->
            </div><!-- card -->
        </div><!--container-->
    </div><!-- row -->
@endsection
