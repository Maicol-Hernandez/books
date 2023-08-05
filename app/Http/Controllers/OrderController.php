<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Book;
use App\Services\ReservationService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    protected ReservationService $reservationService;

    public function __construct(ReservationService $reservationService)
    {
        $this->reservationService = $reservationService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $reservation = $this->reservationService->getFromCookie();

        if (!isset($reservation) || $reservation->books->isEmpty()) {
            return redirect()->back()->withErrors('Your reser$reservation is empty.');
        }

        return view('orders.create')->with([
            'reservation' => $reservation
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        return DB::transaction(function () use ($request): void {
            $user = $request->user();
            $order = $user->orders()->create([
                'status' => 'confirmed'
            ]);

            $reservation = $this->reservationService->getFromCookie();

            $reservationProductsWithQuantity = $reservation
                ->books
                ->mapWithKeys(function (Book $book) {
                    $quantity = $book->pivot->quantity;
                    // if ($book->stock < $quantity) {
                    //     throw ValidationException::withMessages([
                    //         'boo$book' => "There is not enough stock for the quantity you required of {$book->title}",

                    //     ]);
                    // }

                    // $book->decrement('stock', $quantity);
                    $element[$book->id] = ['quantity' => $quantity];

                    return $element;
                });
            dd($reservationProductsWithQuantity);
            $order->products()->attach($reservationProductsWithQuantity->toArray());
        }, 5);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
