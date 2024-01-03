<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = Booking::select('id', 'name', 'booking_date', 'booking_time')->get();
        return view('booking', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $booking_dates = Booking::where([
            ['booking_date', '>=', now()],
            ['booking_slot', 'FULL_DAY']
        ])->pluck('booking_date');

        $morning_dates = Booking::where([
            ['booking_date', '>=', now()],
            ['booking_slot', 'MORNING']
        ])->pluck('booking_date');

        $evening_dates = Booking::where([
            ['booking_date', '>=', now()],
            ['booking_slot', 'EVENING']
        ])->pluck('booking_date');

        $commonDates = $morning_dates->intersect($evening_dates);
        $booked_dates = $booking_dates->merge($commonDates);
        return view('addbooking', compact('booked_dates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookingRequest $request)
    // public function store(BookingRequest $request)
    {

        $booking = Booking::create($request->all());

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $booking = Booking::find($id);
        return view('viewbooking', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $booking = Booking::find($id);
        $booking_dates = Booking::where('booking_date', '>=', now())->pluck('booking_date');
        return view('editbooking', compact('booking', 'booking_dates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        Booking::whereId($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'booking_type' => $request->booking_type,
            'booking_date' => $request->booking_date,
            'booking_time' => $request->booking_time,
        ]);

        return redirect()->route('bookings.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Booking::destroy($id);
        return redirect()->back();
    }

    public function checkBooking(Request $request)
    {
        $booking = Booking::select('booking_slot')->where([
            ['booking_date', $request->booking_date]
        ])->first();
        return response()->json($booking);
    }
}
