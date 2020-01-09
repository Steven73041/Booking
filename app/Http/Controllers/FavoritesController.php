<?php

namespace App\Http\Controllers;

use App\Favorites;
use App\Rooms;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $rooms = Rooms::whereHas('favorites', function (Builder $query) {
            $query->where('user_id', 'like', Auth::user()->id);
        })->paginate(15);
        return view('rooms.rooms', compact('rooms'), [
            'title' => 'My Favorites'
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $favorites = Favorites::where('user_id', Auth::user()->id)->where('room_id', $request->room_id);
        if ($favorites->count()) {
            $favorites->delete();
        } else {
            Favorites::create([
                'user_id' => Auth::user()->id,
                'room_id' => $request->room_id,
            ]);
        }
        return 1;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Favorites $favorites
     * @return \Illuminate\Http\Response
     */
    public function destroy(Favorites $favorites) {
        $this->authorize('edit', $favorites);
        $favorites->delete();
        return 1;
    }
}
