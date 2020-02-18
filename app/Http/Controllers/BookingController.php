<?php

namespace App\Http\Controllers;

use App\Rooms;
use App\Booking;
use App\User;
use Carbon\CarbonPeriod;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

use Laravel\Cashier\Exceptions\IncompletePayment;

class BookingController extends Controller {
    /**
     * Display a listing of the resource.
     * @return Factory\Illuminate\View\View
     */
    public function index() {
        $rooms = Rooms::whereHas('bookings', function (Builder $query) {
            $query->where('user_id', 'like', Auth::user()->id);
        })->paginate(15);
        return view('rooms.rooms', compact('rooms'), [
            'title' => 'My Bookings'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @print_r boolean
     */
    public function store(Request $request) {
        $check_in = $request->session()->pull('check_in', 'default');
        $check_out = $request->session()->pull('check_out', 'default');
        $room_id = $request->session()->pull('room_id', 'default');
        $booking = Booking::create([
            'check_in_date' => $check_in,
            'check_out_date' => $check_out,
            'user_id' => auth()->user()->id,
            'room_id' => $room_id
        ]);
        if ($booking) {
            $request->session()->flush();
            print_r(1);
        } else {
            print_r(0);
        }
    }

    public function stripePay(Request $request) {
        $value = $request->session()->pull('total_price', 'default');
        auth()->user()->createAsStripeCustomer();
        $paymentMethod = $request->payment_method;
        try {
            $payment = auth()->user()->charge($value * 100, $paymentMethod);
            print_r(json_encode($payment->charges->data[0]));
        } catch (IncompletePayment $exception) {
            $room_id = $request->session()->get('room_id');
            $room = Rooms::find($room_id);
            print_r(json_encode([
                'url' => route('cashier.payment',
                    [$exception->payment->id,
                        'redirect' => route('rooms.slug', $room->slug)
                    ])
            ]));
        }
    }

    /**
     *
     * @param Request $request
     * @return Factory\Illuminate\View\View
     */
    public function checkout(Request $request) {
        $room = Rooms::find($request->room_id);
        $check_dates = explode(' - ', $request->datetimes);
        if(count($check_dates) == 2){
            $check_in = date('Y-m-d', strtotime($check_dates[0]));
            $check_out = date('Y-m-d', strtotime($check_dates[1]));
            $arr = [];
            foreach ($room->bookings as $book){
                $period = CarbonPeriod::create($book->check_in_date, $book->check_out_date);
                foreach ($period as $date) {
                    $arr[] = $date->format('Y-m-d');
                }
                if(in_array($check_in, $arr) || in_array($check_out, $arr)){
                    return back()->withErrors(["Some dates are already booked, please use the calendar"]);
                }
            }
            $days = strtotime($check_out) - strtotime($check_in);
            $days = $days / (60 * 60 * 24);
            $request->session()->put('room_id', $room->id);
            $request->session()->put('total_price', $room->price * $days);
            $request->session()->put('check_in', $check_in);
            $request->session()->put('check_out', $check_out);
            return view('stripe', [
                'days' => $days,
                'room' => $room
            ]);
        }else{
            return back()->withErrors(["Invalid Date format, please use the calendar"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param \App\Booking $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking) {
        $this->authorize('edit', $booking);
        $booking->delete();
        return redirect(route('bookings.index'));
    }
}
