<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
// use Illuminate\Support\Str;
use App\Models\Reservation;
// use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ReservationService;
use Illuminate\Validation\ValidationException;

class BookReservationController extends Controller
{

    protected ReservationService $reservationService;

    public function __construct(ReservationService $reservationService)
    {
        $this->reservationService = $reservationService;
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Book $book)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Book $book)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Book $book)
    {
        $reservation = $this->reservationService->getFromCookieOrCreate();
        // $quantity = $reservation->books()
        //     ->find($book->id)
        //     ->pivot
        //     ->quantity ?? 0;

        // if ($book->stock < $quantity + 1) {
        //     throw ValidationException::withMessages([
        //         'boo$book' => "There is not enough stock for the quantity you required of {$book->title}",

        //     ]);
        // }

        $dates = explode(' to ', $request->date_range);

        $startDate = Carbon::parse(trim($dates[0]));
        $endDate = Carbon::parse(trim($dates[1]));

        $reservation->books()->syncWithoutDetaching([
            $book->id => [
                'start_date' => $startDate->format('Y-m-d H:i:s'),
                'end_date' => $endDate->format('Y-m-d H:i:s'),
            ]
        ]);

        $reservation->touch();

        $cookie = $this->reservationService->makeCookie($reservation);

        return redirect()->back()->cookie($cookie);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book, Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book, Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book, Reservation $reservation)
    {
        $reservation->books()->detach([
            $book->id
        ]);

        $reservation->touch();

        $cookie = $this->reservationService->makeCookie($reservation);

        return redirect()->back()->cookie($cookie);
    }
}
