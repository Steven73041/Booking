<?php

namespace App\Http\Controllers;

use App\Rooms;
use App\RoomTypes;
use App\City;
use App\Photos;
use Carbon\CarbonPeriod;
use Illuminate\Support\Carbon;
use App\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Filesystem\Filesystem;
use Intervention\Image\Facades\Image;

class RoomsController extends Controller {
	/**
	 * Display a listing of the resource.
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$room_types = RoomTypes::all();
		$rooms = Rooms::paginate(15);
		return view('rooms.rooms',
			compact('rooms'), [
				'title' => 'Rooms',
				'room_types' => $room_types
			]);
	}

	public function filter(Request $request) {
		$room_types = RoomTypes::all();
		$sort_price = $request->sort_price ? $request->sort_price : 'DESC';
		$rooms = Rooms::where('name', 'LIKE', '%' . $request->name . '%')->orderBy('price', $sort_price)->paginate(15);
		return view('rooms.filtered', [
			'room_types' => $room_types,
			'rooms' => $rooms,
			'title' => 'Rooms'
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		if (isset(Auth::user()->id)) {
			$cities = City::all();
			$room_types = RoomTypes::all();
			return view('rooms.create', [
				'cities' => $cities,
				'title' => 'Create Room',
				'room_types' => $room_types,
			]);
		} else {
			return back();
		}
	}

	/**
	 * Store a newly created resource in storage.
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		if (isset(Auth::user()->id)) {
			$wifi = 'No';
			$pet_friendly = 'No';
			$parking = 'No';
			if ($request->parking) {
				$parking = 'Yes';
			}
			if ($request->wifi) {
				$wifi = 'Yes';
			}
			if ($request->pet_friendly) {
				$pet_friendly = 'Yes';
			}
			$validator = Validator::make($request->all(), [
				'address' => 'required|min:5|max:100',
				'name' => 'required|max:25|min:2',
				'city_id' => 'required|max:20|min:1',
				'area' => 'required|max:20|min:2',
				'photo' => 'required|max:700',
				'photo.*' => 'mimes:jpg,png,gif,jpeg',
				'room_type' => 'required',
			], $errors = [
				'name.required' => 'Please enter Name',
				'city_id.required' => 'Please select a City',
				'area.required' => 'Please enter an Area',
				'photo.*' => 'Only images allowed',
				'room_type.required' => 'Please Select an Room Type',
			]);
			if ($validator->fails()) {
				return back()->withErrors($validator)->withInput();
			}

			$room = Rooms::create([
				'user_id' => Auth::user()->id,
				'name' => $request->name,
				'city_id' => $request->city_id,
				'country_id' => 1,
				'area' => $request->area,
				'room_type' => $request->room_type,
				'price' => $request->price,
				'address' => $request->address,
				'lat_location' => $request->lat_location,
				'lng_location' => $request->lng_location,
				'short_description' => $request->short_description,
				'long_description' => $request->long_description,
				'Parking' => $parking,
				'wifi' => $wifi,
				'pet_friendly' => $pet_friendly
			]);
			if ($request->hasFile('photo')) {
				foreach ($request->file('photo') as $photo) {
					$extension = $photo->getClientOriginalExtension();
					$fileName = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME)
						. '-' . Auth::user()->id . '-' . rand(15, 88888);
					$fileName = $fileName . '.' . $extension;
					$path = $photo->storeAs('images/' . auth()->id(), $fileName);
					$storagePath = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix();
					$image = Image::make($storagePath . $path)->fit(450, 300);
					$image->save($storagePath . $path, 60);
					Photos::create([
						'src' => $path,
						'room_id' => $room->id,
						'user_id' => Auth::user()->id
					]);
				}
			}
			return redirect(route('rooms.show', $room->slug));
		} else {
			return back();
		}
	}

	/**
	 * Update the specified resource in storage.
	 * @param \Illuminate\Http\Request $request
	 * @param \App\Rooms $rooms
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Rooms $room) {
		$this->authorize('edit', $room);
		$wifi = 'No';
		$pet_friendly = 'No';
		$parking = 'No';
		if ($request->parking) {
			$parking = 'Yes';
		}
		if ($request->wifi) {
			$wifi = 'Yes';
		}
		if ($request->pet_friendly) {
			$pet_friendly = 'Yes';
		}
		$validator = Validator::make($request->all(), [
			'name' => 'max:25|min:2',
			'city_id' => 'max:50|min:1',
			'area' => 'max:50|min:2',
			'photo' => 'max:450',
//            'photo.*' => 'mimes:jpg,png,gif,jpeg',
		], $errors = [
//            'photo.*' => 'Only images allowed',
			'photo.max' => 'Image size maximum 45KB',
		]);
		if ($validator->fails()) {
			return back()->withErrors($validator)->withInput();
		}
		$room->update([
			'name' => $request->name,
			'city_id' => $request->city_id,
			'area' => $request->area,
			'room_type' => $request->room_type,
			'price' => $request->price,
			'address' => $request->address,
			'lat_location' => $request->lat_location,
			'lng_location' => $request->lng_location,
			'short_description' => $request->short_description,
			'long_description' => $request->long_description,
			'Parking' => $parking,
			'wifi' => $wifi,
			'pet_friendly' => $pet_friendly
		]);
		if (isset($request->photo)) {
			$storagePath = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix();
			$path_to_delete = $storagePath . "images/" . auth()->id();
			Storage::disk('public')->delete($path_to_delete);
			$files = new Filesystem();
			$files->deleteDirectory($path_to_delete);

			//delete from db too
			foreach ($room->photos as $old_photo) {
				$old_photo->delete();
			}
			foreach ($request->file('photo') as $photo) {
				$extension = $photo->getClientOriginalExtension();
				$fileName = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME)
					. '-' . Auth::user()->id . '-' . rand(15, 88888);
				$fileName = $fileName . '.' . $extension;
				$path = $photo->storeAs('images/' . auth()->id(), $fileName);
				$storagePath = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix();
				$image = Image::make($storagePath . $path)->fit(450, 300);
				$image->save($storagePath . $path, 60);
				Photos::create([
					'src' => $path,
					'room_id' => $room->id,
					'user_id' => Auth::user()->id
				]);
			}
		}
		return back()->withErrors(['Your Room has been updated successfully!']);
	}

	/**
	 * Display the specified resource.
	 * @param \App\Rooms $rooms
	 * @return \Illuminate\Http\Response
	 */

//    public function show(Rooms $room) {
//        return view('rooms.singleRoom', [
//            'room' => $room,
//            'title' => $room->name,
//        ]);
//    }

	public function show($slug) {
		$room = Rooms::findBySlug($slug);
		if ($room) {
			return view('rooms.singleRoom', [
				'room' => $room,
				'title' => $room->name,
			]);
		} else {
			return response('<h1>No Room Found!</h1>');
		}
	}

	public function get_booking_dates(Request $request) {
		$room = Rooms::find($request->room_id);
		$arr = [];
		if ($room->bookings()) {
			foreach ($room->bookings as $book) {
				$period = CarbonPeriod::create($book->check_in_date, $book->check_out_date);
				foreach ($period as $date) {
					$arr[] = $date->format('Y-m-d');
				}
			}
			print_r(json_encode($arr));
		} else {
			print_r(0);
		}

	}

	/**
	 * Show the form for editing the specified resource.
	 * @param \App\Rooms $rooms
	 * @return \Illuminate\Http\Response
	 */

	public function edit(Rooms $room) {
		$cities = City::all();
		$room_types = RoomTypes::all();
		$this->authorize('edit', $room);
		return view('rooms.edit',
			compact('room'), [
				'cities' => $cities,
				'room_types' => $room_types,
				'title' => 'Edit Room',
			]);

	}

	/**
	 * Remove the specified resource from storage.
	 * @param \App\Rooms $rooms
	 * @return \Illuminate\Http\Response
	 */

	public function destroy(Rooms $room) {
		$this->authorize('edit', $room);
		$path_to_delete = public_path('images/' . Auth::user()->id);
		$file = new Filesystem;
		$file->deleteDirectory($path_to_delete);
		foreach ($room->photos as $photo) {
			$photo->delete();
		}
		$room->delete();
		return redirect(route('rooms.myRooms'), 301);
	}

	/**
	 * Take the data with POST and send it to rooms
	 * @param \App\Request $request
	 * @return \Illuminate\Http\Response
	 */

	public function formRooms(Request $request) {
		$check_dates = explode(' - ', $request->datetimes);
		$check_in = date('Y-m-d', strtotime($check_dates[0]));
		$check_out = date('Y-m-d', strtotime($check_dates[1]));
		$room_types = RoomTypes::all();
		$rooms_collection = collect(DB::select("
SELECT `rooms`.`id` FROM `rooms` LEFT JOIN `bookings` ON `rooms`.`id` = `bookings`.`room_id`
WHERE `rooms`.`city_id` = '$request->city_id' AND `rooms`.`room_type` = '$request->room_type'
 AND ((`bookings`.`check_in_date` NOT BETWEEN '$check_in' AND '$check_out'
 AND `bookings`.`check_out_date` NOT BETWEEN '$check_in' AND '$check_out')
 OR `rooms`.`id` NOT IN (SELECT `room_id` FROM `bookings`))"))->toArray();
		$ids = [];
		foreach ($rooms_collection as $collection) {
			$ids[] = $collection->id;
		}
		$rooms = Rooms::find($ids)->paginate(15);
		return view('rooms.rooms', [
			'rooms' => $rooms,
			'title' => 'Rooms',
			'room_types' => $room_types
		]);
	}

	public function myRooms() {
		if (Auth::user()->id) {
			$id = Auth::user()->id;
			$rooms = Rooms::where('user_id', $id)->paginate(15);
			$room_types = RoomTypes::all();
			return view('rooms.rooms', [
				'room_types' => $room_types,
				'rooms' => $rooms,
				'title' => 'My Rooms'
			]);
		} else {
			return redirect(route('home'), 301);
		}
	}

}
