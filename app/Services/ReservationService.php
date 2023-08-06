<?php

namespace App\Services;

use App\Models\Reservation;
use Illuminate\Support\Facades\Cookie;

class ReservationService
{
    protected string $cookieName = 'reservation';
    protected $cookieExpiration = 0.0;


    public function __construct()
    {
        $this->cookieName = config('reservation.cookie.name');
        $this->cookieExpiration = config('reservation.cookie.expiration');
    }


    /**
     * Get from Cookie or create.
     * 
     * @return \App\Models\Reservation $reservation
     */
    public function getFromCookie(): ?Reservation
    {
        $reservationId = Cookie::get($this->cookieName);

        $reservation = Reservation::find($reservationId);

        return $reservation;
    }

    /**
     * Get from Cookie or create.
     * 
     * @return \App\Models\Reservation $reservation
     */
    public function getFromCookieOrCreate(): Reservation
    {
        $reservation = $this->getFromCookie();

        return $reservation ?? Reservation::create();
    }

    /**
     * make cookie.
     * 
     * @param \App\Models\Reservation $reservation
     * @return \Symfony\Component\HttpFoundation\Cookie $cookie
     */
    public function makeCookie(Reservation $reservation)
    {
        return Cookie::make($this->cookieName, $reservation->id, $this->cookieExpiration);
    }

    /**
     * 
     * @return int
     */
    public function countBooks(): int
    {
        $reservation = $this->getFromCookie();

        if (!is_null($reservation)) {
            return $reservation->books->pluck('pivot.book_id')->count();
        }

        return 0;
    }
}
