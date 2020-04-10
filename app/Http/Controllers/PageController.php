<?php

namespace App\Http\Controllers;
use App\User;
use App\City;
use App\RoomTypes;
use App\Rooms;
use \Illuminate\Http\Request;
use Laravel\Cashier\Exceptions\IncompletePayment;

class PageController extends Controller {

    public function home() {
        $cities = City::all();
        $room_types = RoomTypes::all();
        $newrooms = Rooms::orderBy('updated_at', 'desc')->take(4)->get();
        return view('home', [
            'cities' => $cities,
            'room_types' => $room_types,
            'newrooms' => $newrooms,
            'title' => 'Home'
        ]);
    }

	public function showAbout() {
		return view('pages.about-us', [
			'title' => 'About Us',
		]);
	}

    public function showContact() {
        return view('pages.contact', [
            'title' => 'Contact',
        ]);
    }

    public function showLogin() {
        return view('login', [
            'title' => 'Login',
        ]);
    }

	public function showReadMe() {
		return view('pages.read-me', [
			'title' => 'Read Me',
		]);
	}
}
