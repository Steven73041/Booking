<?php

namespace App\Http\Controllers;

use App\Reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;

class ReviewsController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        if(isset(Auth::user()->id)){
            $id = Auth::user()->id;
            $validator = Validator::make($request->all(),[
                'room_id' => 'required',
                'rate' => 'required|max:1|min:1|regex:/^[0-5]+$/',
                'review' => 'required|max:150|min:10'
            ],$errors = [
                'review.required' => 'Please enter a valid Review',
                'rate.regex' => 'Only numbers allowed for Rating',
                'review.min' => 'Minimum 10 characters',
                'review.max' => 'Maximum 150 characters'
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator, 'reviews')->withInput();
            }
            Reviews::create([
                'room_id' => $request->room_id,
                'user_id' => $id,
                'rate' => $request->rate,
                'review' => $request->review
            ]);
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reviews  $reviews
     * @return \Illuminate\Http\Response
     */
    public function show(Reviews $reviews){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reviews  $reviews
     * @return \Illuminate\Http\Response
     */
    public function edit(Reviews $reviews){
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reviews  $reviews
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reviews $review){
        if((isset(Auth::user()->id) && Auth::user()->id == $review->user_id)
        && ($review->room_id == $request->room_id)){
        $validator = Validator::make($request->all(),[
            'rate' => 'required|max:2|min:1|regex:/^[0-9]+$/',
            'review' => 'required|max:150|min:3'
        ],$errors = [
            'rating.required' => 'Please enter a valid Rating',
            'rate.regex' => 'Only letters allowed for Rating',
            'review.min' => 'Minimum 10 characters',
            'review.max' => 'Maximum 150 characters',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $review->update([
            'review' => $request->review,
            'rate' => $request->rate
        ]);
        return back();
        }else{
            return back()->withErrors(['This Review and/or this Room is not yours, you try to hack us?']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reviews  $reviews
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        if(isset(Auth::user()->id)){
            $user = User::find(Auth::user()->id);
            $review = Reviews::find($id);
            if($user->id === $review->user_id || $review->room->user->id === $user->id){
            Reviews::destroy($id);
                return back();
            }
            else{
                return back()->withErrors(['This Room is not yours, you try to hack us?']);
            }
        }else{
            return back();
        }
    }

}
