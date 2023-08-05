<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Reservation;
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
        dump($book);
        dd($request->all());
        $reservation = $this->reservationService->getFromCookieOrCreate();

        $quantity = $reservation->books()
            ->find($book->id)
            ->pivot
            ->quantity ?? 0;

        // if ($book->stock < $quantity + 1) {
        //     throw ValidationException::withMessages([
        //         'boo$book' => "There is not enough stock for the quantity you required of {$book->title}",

        //     ]);
        // }

        $reservation->books()->syncWithoutDetaching([
            $book->id => ['quantity' => $quantity + 1]
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
